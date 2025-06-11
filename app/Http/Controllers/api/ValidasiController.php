<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidasiRequest;
use App\Http\Requests\UpdateValidasiRequest;
use App\Models\Validasi;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        $validasi = Validasi::with(['user', 'kriteria'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Validation data retrieved successfully',
            'data' => $validasi
        ], 200);
    }

    public function show($id)
    {
        $validasi = Validasi::with(['user', 'kriteria'])->find($id);

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
            'komentar' => 'nullable|string|max:255',
        ]);

        $validator = Validasi::where('user_id', auth()->user()->id)
            ->where('kriteria_id', $request->kriteria_id)
            ->with(['user:id,name,role_id', 'user.role:id,code', 'kriteria'])
            ->first();

        if (!$validator) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation not found'
            ], 404);
        }

        $currentUserRole = auth()->user()->role_id;

        if (($currentUserRole !== 2 && $currentUserRole !== 3)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action'
            ], 403);
        }

        if ($currentUserRole == 3) {
            $role2Validator = Validasi::where('kriteria_id', $request->kriteria_id)
                ->whereHas('user', function ($query) {
                    $query->where('role_id', 2);
                })
                ->where('status', 'valid')
                ->exists();

            if (!$role2Validator) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation by role 2 is required before role 3 can validate'
                ], 404);
            }
        }

        if ($validator->is_validated == 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation already completed'
            ], 400);
        }

        if ($request->has('komentar')) {
            $validator->update([
                'is_validated' => 1,
                'komentar' => $request->komentar,
                'validated_at' => now(),
            ]);
        } else {
            $validator->update([
                'is_validated' => 1,
                'validated_at' => now(),
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
