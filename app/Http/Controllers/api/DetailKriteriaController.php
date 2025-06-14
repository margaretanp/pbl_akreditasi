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

        $user = auth()->user();

        if ($detailKriteria->created_by !== $user->id || $user->role->id !== 5) {
            return response()->json([
                'status' => 'error',
                'message' => 'Detail Kriteria not found'
            ], 404);
        }

        if ($request->hasFile('file_url')) {
            if ($detailKriteria->file_url && file_exists(public_path($detailKriteria->file_url))) {
                unlink(public_path($detailKriteria->file_url));
            }

            $file = $request->file('file_url');
            $fileOriginalName = $file->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName = str_replace(' ', '_', $fileName);
            $originalExt = strtolower($file->getClientOriginalExtension());

            $fileSavedName = $fileName . '_' . time() . '.pdf';
            $storagePath = storage_path('app/public/detail_kriteria');
            $fullPath = $storagePath . '/' . $fileSavedName;

            if ($originalExt === 'pdf') {
                // If already PDF, just store it
                $file->storeAs('detail_kriteria', $fileSavedName, 'public');
            } elseif (in_array($originalExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                // Convert image to PDF
                $this->convertImageToPdfSimple($file, $fullPath);
            } elseif ($originalExt === 'txt') {
                // Convert text to PDF
                $this->convertTextToPdfSimple($file, $fullPath);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unsupported file type. Supported formats: PDF, JPG, JPEG, PNG, GIF, BMP, TXT'
                ], 400);
            }

            $data['file_url'] = 'storage/detail_kriteria/' . $fileSavedName;
        }

        $validator = \Validator::make($request->all(), (new updatedetailKriteriaRequest())->rules());
        if ($validator->fails()) {
            \Log::error('Validation errors:', $validator->errors()->toArray());
        }
        $detailKriteria->update($data);
        $detailKriteria->refresh();
        $detailKriteria->load('kriteria', 'jenisKriteria', 'createdBy');

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Detail Kriteria updated successfully',
                'data' => $detailKriteria
            ],
            200
        );
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


