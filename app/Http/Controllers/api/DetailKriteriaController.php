<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storedetailKriteriaRequest;
use App\Models\DetailKriteriaModel;
use Illuminate\Http\Request;

class DetailKriteriaController extends Controller
{
    public function index()
    {
        $detailKriteria = DetailKriteriaModel::all();

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
        $detailKriteria = DetailKriteriaModel::all()->find($id);

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

        $file = $request->file('file');
        $path = $file->store('uploads/detail_kriteria', 'public');

        $data['file_url'] = '/storage/' . $path;

        $detailKriteria = DetailKriteriaModel::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Kriteria created successfully',
            'data' => $detailKriteria
        ], 201);
    }
}
