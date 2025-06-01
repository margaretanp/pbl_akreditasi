<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidasiRequest;
use App\Http\Requests\UpdateValidasiRequest;
use App\Models\DetailKriteriaModel;
use App\Models\Validasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        $validasi = Validasi::with(['user', 'detailKriteria'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Validation data retrieved successfully',
            'data' => $validasi
        ], 200);
    }

    public function show($id)
    {
        $validasi = Validasi::with(['user', 'detailKriteria'])->find($id);

        if (!$validasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Validation data retrieved successfully',
            'data' => $validasi
        ], 200);
    }

    public function store(StoreValidasiRequest $request)
    {
        $data = $request->validated();
        $validasi = Validasi::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Validation created successfully',
            'data' => $validasi
        ], 201);
    }

    public function update(UpdateValidasiRequest $request, $id)
    {
        $validasi = Validasi::find($id);

        if (!$validasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation not found'
            ], 404);
        }

        $data = $request->validated();
        $validasi->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Validation updated successfully',
            'data' => $validasi
        ], 200);
    }

    public function destroy($id)
    {
        $validasi = Validasi::find($id);

        if (!$validasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation not found'
            ], 404);
        }

        $validasi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Validation deleted successfully'
        ], 200);
    }
    public function validasi(Request $request)
    {
        $request->validate([
            'status' => 'required:in:valid,invalid',
            'komentar' => 'nullable|string|max:255',
        ]);

        $validator = Validasi::where('id_user', auth()->user()->id)
            ->where('id_detail_kriteria', $request->id_detail_kriteria)
            ->with(['user:id,name,role_id', 'user.role:id,name', 'detailKriteria'])
            ->first();

        if (!$validator) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation not found'
            ], 404);
        }

        $detailKriteria = DetailKriteriaModel::findOrFail($request->id_detail_kriteria);

        if ($request->status === 'valid') {
            $detailKriteria->update(attributes: ['status_validasi' => 'accepted']);
        } elseif ($request->status === 'invalid') {
            $detailKriteria->update(['status_validasi' => 'rejected']);
        }

        if ($request->has('komentar')) {
            $validator->update([
                'status' => $request->status,
                'komentar' => $request->komentar,
                'validate_at' => now(),
            ]);
        } else {
            $validator->update([
                'status' => $request->status,
                'validate_at' => now(),
            ]);
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Validation status updated successfully',
                'data' => $validator
            ],
            200
        );
    }
}
