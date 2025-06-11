<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storedetailKriteriaRequest;
use App\Http\Requests\updatedetailKriteriaRequest;
use App\Models\DetailKriteriaModel;
use App\Models\Validasi;
use App\Models\KriteriaModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DetailKriteriaController extends Controller
{
    public function index()
    {
        $detailKriteria = DetailKriteriaModel::with('kriteria', 'jenisKriteria', 'createdBy')->get();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Detail Kriteria data retrieved successfully',
                'data' => $detailKriteria
            ],
            200
        );
    }

    public function show($id)
    {
        $detailKriteria = DetailKriteriaModel::find($id)->load('kriteria', 'jenisKriteria', 'createdBy');

        if (!$detailKriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Detail Kriteria not found'
                ],
                404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Detail Kriteria data retrieved successfully',
                'data' => $detailKriteria
            ],
            200
        );
    }

    public function store(storedetailKriteriaRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        if ($user->role->id !== 5) {
            return response()->json([
                'status' => 'error',
                'message' => 'User is not authorized to create Detail Kriteria'
            ], 403);
        }

        $data['created_by'] = $user->id;


        try {
            if ($request->hasFile('file_url')) {
                $data['file_url'] = $this->processUploadedFile($request->file('file_url'));
            }

            $detailKriteria = DetailKriteriaModel::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Detail Kriteria created successfully',
                'data' => $detailKriteria->load('kriteria', 'jenisKriteria', 'createdBy')
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error creating detail kriteria: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create detail kriteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(updatedetailKriteriaRequest $request, $id)
    {
        $detailKriteria = DetailKriteriaModel::find($id);

        if (!$detailKriteria) {
            return response()->json([
                'status' => 'error',
                'message' => 'Detail Kriteria not found'
            ], 404);
        }

        try {
            $data = $request->validated();

            // Handle file upload if exists
            if ($request->hasFile('file_url')) {
                // Delete old file if exists
                if ($detailKriteria->file_url && file_exists(public_path($detailKriteria->file_url))) {
                    unlink(public_path($detailKriteria->file_url));
                }
                $data['file_url'] = $this->processUploadedFile($request->file('file_url'));
            }

            // Update detail kriteria
            $detailKriteria->update($data);

            // Reset validation status for all related validasi records
            $this->resetValidationStatus($detailKriteria);

            return response()->json([
                'status' => 'success',
                'message' => 'Detail Kriteria updated successfully and validation status reset',
                'data' => $detailKriteria->fresh(['kriteria', 'jenisKriteria', 'createdBy'])
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error updating detail kriteria: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update detail kriteria',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Tampilkan Status Tiap Isian

    public function byUser(Request $request)
    {
        $userId = $request->query('user_id', auth()->id());

        $detailKriteria = DetailKriteriaModel::where('created_by', $userId)
            ->with([
                'kriteria',
                'jenisKriteria',
                'createdBy',
                'validasi' => function ($query) {
                    $query->with('user.role');
                }
            ])
            ->get()
            ->map(function ($item) {
                $item->status = $item->validasi->map(function ($validation) {
                    return [
                        'role' => $validation->user->role->name,
                        'status' => $validation->is_validated ? 'Approved' : 'Pending',
                        'komentar' => $validation->komentar,
                        'validated_at' => $validation->validated_at
                    ];
                });

                return $item;
            });

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Kriteria by user retrieved successfully',
            'data' => $detailKriteria
        ], 200);
    }

    public function destroy($id)
    {
        $detailKriteria = DetailKriteriaModel::find($id);

        if (!$detailKriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Detail Kriteria not found'
                ],
                404
            );
        }

        if ($detailKriteria->file_url && file_exists(public_path($detailKriteria->file_url))) {
            unlink(public_path($detailKriteria->file_url));
        }

        $detailKriteria->delete();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Detail Kriteria deleted successfully'
            ],
            200
        );
    }

    private function processUploadedFile($file)
    {
        $fileOriginalName = $file->getClientOriginalName();
        $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $fileName = str_replace(' ', '_', $fileName);
        $originalExt = strtolower($file->getClientOriginalExtension());

        $fileSavedName = $fileName . '_' . time() . '.pdf';
        $storagePath = storage_path('app/public/detail_kriteria');

        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $fullPath = $storagePath . '/' . $fileSavedName;

        if ($originalExt === 'pdf') {
            $file->storeAs('public/detail_kriteria', $fileSavedName);
        } elseif (in_array($originalExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
            $this->convertImageToPdfSimple($file, $fullPath);
        } elseif ($originalExt === 'txt') {
            $this->convertTextToPdfSimple($file, $fullPath);
        } else {
            throw new \Exception('Unsupported file type. Supported formats: PDF, JPG, JPEG, PNG, GIF, BMP, TXT');
        }

        return 'storage/detail_kriteria/' . $fileSavedName;
    }

    /**
     * Reset validation status when detail kriteria is updated
     */
    private function resetValidationStatus(DetailKriteriaModel $detailKriteria)
    {
        Validasi::where('kriteria_id', $detailKriteria->kriteria_id)
            ->where('user_id', auth()->id())
            ->update([
                'is_validated' => 0,
                'validated_at' => null,
                'komentar' => null,
                'status' => 'pending'
            ]);
    }

    private function convertImageToPdfSimple($file, $outputPath)
    {
        $imageData = base64_encode(file_get_contents($file->getRealPath()));
        $imageMimeType = $file->getMimeType();

        $html = "
        <html>
        <head>
            <style>
                body { margin: 0; padding: 20px; text-align: center; }
                img { max-width: 100%; max-height: 90vh; }
            </style>
        </head>
        <body>
            <img src='data:{$imageMimeType};base64,{$imageData}' alt='Converted Image'>
        </body>
        </html>
    ";

        $pdf = Pdf::loadHTML($html);
        $pdf->save($outputPath);
    }

    private function convertTextToPdfSimple($file, $outputPath)
    {
        $content = file_get_contents($file->getRealPath());
        $content = nl2br(htmlspecialchars($content));

        $html = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6; margin: 20px; }
            </style>
        </head>
        <body>
            {$content}
        </body>
        </html>
    ";

        $pdf = Pdf::loadHTML($html);
        $pdf->save($outputPath);
    }
}


