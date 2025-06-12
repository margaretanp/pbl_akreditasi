<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeKriteriaRequest;
use App\Http\Requests\updateKriteriaRequest;
use App\Models\KriteriaModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class KriteriaController extends Controller
{
    public function index()
    {
        // Get authenticated user (if any)
        $user = auth()->user();

        // If no user is authenticated, return read-only data
        if (!$user) {
            $kriteria = KriteriaModel::select('id', 'name')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Kriteria data retrieved successfully',
                'data' => $kriteria
            ], 200);
        }

        // Role-based data filtering
        switch ($user->role->id) {
            case 2: // Kajur role - can see all kriteria
                $kriteria = KriteriaModel::with(["detailKriteria", "validators"])->all();
                break;

            case 3: // Direktur role - can only see validated kriteria
                $kriteria = KriteriaModel::whereHas('validators', function ($query) {
                    $query->where('is_validated', true)
                        ->whereHas('user', function ($userQuery) {
                            $userQuery->where('role_id', 2); // Validated by Kajur (role id 2)
                        });
                })->with(["detailKriteria", "validators"])->get();
                break;

            default: // Other roles - limited access
                $kriteria = KriteriaModel::where('is_rejected', false)
                    ->with(["detailKriteria", "validators"])->get();
                break;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Kriteria data retrieved successfully',
            'data' => $kriteria
        ], 200);
    }

    public function show($id)
    {
        $kriteria = KriteriaModel::find($id);

        if (!$kriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Kriteria not found'
                ]
                ,
                404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Kriteria data retrieved successfully',
                'data' => $kriteria
            ]
            ,
            200
        );
    }

    public function store(storeKriteriaRequest $request)
    {
        $data = $request->validated();

        $kriteria = KriteriaModel::create($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Kriteria created successfully',
                'data' => $kriteria
            ]
            ,
            201
        );
    }

    public function update(updateKriteriaRequest $request, $id)
    {
        $kriteria = KriteriaModel::find($id);

        if (!$kriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Role not found'
                ],
                404
            );
        }

        $data = $request->validated();

        $kriteria->update($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Kriteria updated successfully',
                'data' => $kriteria
            ],
            200
        );
    }

    public function destroy($id)
    {
        $kriteria = KriteriaModel::find($id);

        if (!$kriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Kriteria not found'
                ],
                404
            );
        }

        $kriteria->delete();
        return response()->json(
            [
                'status' => 'success',
                'meessage' => 'Kriteria deleted successfully'
            ],
            200
        );
    }

    public function reject(request $request, $id)
    {
        $user = auth()->user();

        if ($user->role->id !== 2 || $user->role->id !== 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action. Only Kajur or Direktur can reject kriteia.'
            ]);
        }
        $data = $request->validate([
            'is_rejected' => 'required|boolean'
        ]);

        $kriteria = KriteriaModel::find($id);
        if (!$kriteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'kriteria not found'
            ], 404);
        }
        $kriteria->update([
            'is_rejected' => $data['is_rejected'],
            'rejected_at' => now()
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Kriteria rejection status updated successfully',
            'data' => $kriteria
        ], 200);
    }

    public function generateMergedPdf($id)
    {
        try {
            $kriteria = KriteriaModel::with('DetailKriteria.jenisKriteria', 'DetailKriteria.createdBy')
                ->find($id);

            if (!$kriteria) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kriteria not found'
                ], 404);
            }

            // Get detail kriteria with files
            $detailKriterias = $kriteria->DetailKriteria()
                ->whereNotNull('file_url')
                ->get();

            if ($detailKriterias->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No PDF files found for this kriteria'
                ], 404);
            }

            // Delete old merged file if exists
            if ($kriteria->merged_file_url && Storage::disk('public')->exists(str_replace('storage/', '', $kriteria->merged_file_url))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $kriteria->merged_file_url));
            }

            // Initialize PDF merger
            $merger = PDFMerger::init();

            // Create and add description page
            $descriptionPdf = $this->createDescriptionPage($detailKriterias, $kriteria);
            $merger->addPDF($descriptionPdf, 'all');

            // Add each PDF file
            foreach ($detailKriterias as $detail) {
                $filePath = public_path($detail->file_url);

                if (file_exists($filePath)) {
                    $merger->addPDF($filePath, 'all');
                } else {
                    Log::warning("File not found: " . $filePath);
                }
            }

            // Generate merged filename
            $mergedFileName = 'merged_kriteria_' . $id . '_' . time() . '.pdf';
            $mergedPath = storage_path('app/public/kriteria_merged/' . $mergedFileName);

            // Create directory if needed
            if (!file_exists(dirname($mergedPath))) {
                mkdir(dirname($mergedPath), 0755, true);
            }

            // Merge and save
            $merger->merge();
            $merger->save($mergedPath);

            // Update kriteria with merged file URL
            $mergedUrl = 'storage/kriteria_merged/' . $mergedFileName;
            $kriteria->update([
                'merged_file_url' => $mergedUrl,
                'merged_at' => now()
            ]);

            // Clean up temp description file
            if (file_exists($descriptionPdf)) {
                unlink($descriptionPdf);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'PDF merged successfully',
                'data' => [
                    'kriteria' => $kriteria->fresh(),
                    'merged_file_url' => $mergedUrl,
                    'total_files_merged' => $detailKriterias->count(),
                    'merged_at' => $kriteria->merged_at
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('PDF merge error for kriteria ' . $id . ': ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to merge PDF files: ' . $e->getMessage()
            ], 500);
        }
    }

    private function createDescriptionPage($detailKriterias, $kriteria)
    {
        $html = "
    <html>
    <head>
        <style>
            body { 
                font-family: sans-serif; 
                font-size: 12px; 
                line-height: 1.6; 
                margin: 20px; 
                color: #333;
            }
            .header {
                text-align: center;
                border-bottom: 3px solid #2c3e50;
                padding-bottom: 20px;
                margin-bottom: 30px;
            }
            .title {
                font-size: 28px;
                font-weight: bold;
                color: #2c3e50;
                margin-bottom: 10px;
            }
            .section {
                margin-bottom: 25px;
            }
            .section-title {
                font-size: 16px;
                font-weight: bold;
                color: #2c3e50;
                border-bottom: 2px solid #3498db;
                padding-bottom: 8px;
                margin-bottom: 15px;
            }
            .document-item {
                margin-bottom: 20px;
                padding: 15px;
                border: 1px solid #bdc3c7;
                border-radius: 5px;
                background-color: #fefefe;
            }
            .doc-header {
                font-weight: bold;
                font-size: 14px;
                color: #2c3e50;
                margin-bottom: 8px;
                padding-bottom: 5px;
                border-bottom: 1px solid #ecf0f1;
            }
            .doc-description {
                color: #2c3e50;
                font-style: italic;
                margin-bottom: 10px;
                background-color: #f8f9fa;
                padding: 8px;
                border-radius: 3px;
            }
            .doc-meta {
                font-size: 10px;
                color: #7f8c8d;
                line-height: 1.4;
            }
            .no-description {
                color: #95a5a6;
                font-style: italic;
            }
        </style>
    </head>
    <body>
        <div class='header'>
            <div class='title'>Detail Dokumen " . htmlspecialchars($kriteria->name) . "</div>
        </div>

        <div class='section'>";

        foreach ($detailKriterias as $detail) {
            $html .= "
            <div class='document-item'>
                <div class='doc-header'>Dokumen " . ($detail->JenisKriteria->name) . "</div>
                <p>Deskripsi:</p>";

            if (!empty($detail->description)) {
                $html .= "<div class='doc-description'>" . nl2br(htmlspecialchars($detail->description)) . "</div>";
            } else {
                $html .= "<div class='doc-description no-description'>Tidak ada deskripsi</div>";
            }

            $html .= "
                <div class='doc-meta'>
                    <strong>Dibuat oleh:</strong> " . htmlspecialchars($detail->createdBy->name ?? 'N/A') . "<br>
                    <strong> " . ($detail->updated_at ? $detail->updated_at->format('d F Y, H:i:s') : 'N/A') . "</strong>
                </div>
            </div>";
        }

        $html .= "
        </div>
        
        <div class='section'>
            <div class='section-title'>Catatan</div>
            <p style='color: #7f8c8d; font-style: italic;'>
                Dokumen ini merupakan gabungan dari semua file yang terkait dengan kriteria \"" . htmlspecialchars($kriteria->name) . "\". 
                Setiap dokumen individual dapat diidentifikasi berdasarkan deskripsi dan metadata yang tercantum di atas.
            </p>
        </div>
    </body>
    </html>";

        // Generate temporary PDF
        $tempFileName = 'description_' . $kriteria->id . '_' . time() . '.pdf';
        $tempPath = storage_path('app/temp/' . $tempFileName);

        if (!file_exists(dirname($tempPath))) {
            mkdir(dirname($tempPath), 0755, true);
        }

        $pdf = Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'defaultFont' => 'Monserrat',
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true
            ]);

        $pdf->save($tempPath);

        return $tempPath;
    }
    
    // Submit ke Direktur Jika Semua Disetujui Kajur

public function submitToDirektur(Request $request)
{
    // Ambil semua kriteria yang dimiliki oleh user yang login (dosen)
    $userKriteria = KriteriaModel::whereHas('validasi', function($query) {
        $query->where('user_id', auth()->id());
    })->with('validasi')->get();

    // Cek apakah semua kriteria sudah disetujui kajur (role_id 2)
    foreach ($userKriteria as $kriteria) {
        $kajurValidation = $kriteria->validasi->firstWhere('user.role_id', 2);
        
        if (!$kajurValidation || $kajurValidation->is_validated != 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not all criteria have been approved by the department head'
            ], 400);
        }
    }

    // Update timestamp submitted_to_direktur_at
    foreach ($userKriteria as $kriteria) {
        $kriteria->update(['submitted_to_direktur_at' => now()]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'All criteria successfully submitted to director',
        'data' => $userKriteria
    ], 200);
}
}