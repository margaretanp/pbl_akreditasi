<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storedetailKriteriaRequest;
use App\Http\Requests\updatedetailKriteriaRequest;
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
        $detailKriteria = DetailKriteriaModel::find($id)->with('kriteria', 'jenisKriteria', 'validasi');

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

        if ($request->hasFile('file_url')) {
            $fileOriginalName = $request->file('file_url')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileExt = $request->file('file_url')->getClientOriginalExtension();
            $fileSavedName = $fileName . '_' . time() . '.' . $fileExt;
            $path = $request->file('file_url')->storeAs('detail_kriteria', $fileSavedName, 'public');

            $data['file_url'] = 'storage/' . $path;
        }

        $detailKriteria = DetailKriteriaModel::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Detail Kriteria created successfully',
            'data' => $detailKriteria
        ], 201);
    }

    public function update(updatedetailKriteriaRequest $request, $id)
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

        $data = $request->validated();

        if ($request->hasFile('file_url')) {
            if ($detailKriteria->file_url && file_exists(public_path($detailKriteria->file_url))) {
                unlink(public_path($detailKriteria->file_url));
            }

            $fileOriginalName = $request->file('file_url')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileExt = $request->file('file_url')->getClientOriginalExtension();
            $fileSavedName = $fileName . '_' . time() . '.' . $fileExt;
            $path = $request->file('file_url')->storeAs('detail_kriteria', $fileSavedName, 'public');

            $data['file_url'] = 'storage/' . $path;
        }

        $detailKriteria->update($data);

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
}
