<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeKriteriaRequest;
use App\Http\Requests\updateKriteriaRequest;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = KriteriaModel::all();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Kriteria data retrieved successfully',
                'data' => $kriteria
            ],
            200
        );
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

        if(!$kriteria) {
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
}