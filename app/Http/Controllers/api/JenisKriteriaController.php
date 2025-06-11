<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storejenisKriteriaRequest;
use App\Http\Requests\updatejenisKriteriaRequest;
use App\Models\JenisKriteriaModel;
use Illuminate\Http\Request;

class JenisKriteriaController extends Controller
{
    public function index()
    {
        $jenisKriteria = JenisKriteriaModel::all();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Jenis Kriteria data retrieved successfully',
                'data' => $jenisKriteria
            ],
            200
        );
    }

    public function show($id)
    {
        $jenisKriteria = JenisKriteriaModel::find($id);

        if (!$jenisKriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Jenis Kriteria not found'
                ],
                404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Jenis Kriteria data retrieved successfully',
                'data' => $jenisKriteria
            ],
            200
        );
    }

    public function store(storejenisKriteriaRequest $request)
    {
        $data = $request->validated();

        $jenisKriteria = JenisKriteriaModel::create($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Jenis kriteria created successfully',
                'data' => $jenisKriteria
            ], 201
        );
    }

    public function update(updatejenisKriteriaRequest $request, $id)
    {
        $jenisKriteria = JenisKriteriaModel::find($id);

        if(!$jenisKriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Role not found'
                ], 404
            );
        }
        $data = $request->validated();

        $jenisKriteria->update($data);

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Jenis Kriteria updated successfully',
                'data' => $jenisKriteria
            ], 200
        );
    }

    public function destroy($id)
    {
        $jenisKriteria = JenisKriteriaModel::find($id);

        if(!$jenisKriteria) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Jenis Kriteria not found'
                ], 404
            );
        }

        $jenisKriteria->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Jenis Kriteria deleted successfully'
            ], 200
        );
    }
}