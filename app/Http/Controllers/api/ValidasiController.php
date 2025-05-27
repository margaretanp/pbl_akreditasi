<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidasiRequest;
use App\Http\Requests\UpdateValidasiRequest;
use App\Models\Validasi;

class ValidasiController extends Controller
{
    public function index()
    {
        $validasi = Validasi::with(['validator', 'user'])->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Validation data retrieved successfully',
            'data' => $validasi
        ], 200);
    }

    public function show($id)
    {
        $validasi = Validasi::with(['validator', 'user'])->find($id);

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
}
