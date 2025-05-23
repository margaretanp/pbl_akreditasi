<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKomentarRequest;
use App\Http\Requests\UpdateKomentarRequest;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index()
    {
        return response()->json(Komentar::all());
    }

    public function show($id)
    {
        $komentar = Komentar::find($id);
        return $komentar
            ? response()->json($komentar)
            : response()->json(['message' => 'Komentar not found'], 404);
    }

    public function store(StoreKomentarRequest $request)
    {
        $komentar = Komentar::create($request->validated());
        return response()->json($komentar, 201);
    }

    public function update(UpdateKomentarRequest $request, $id)
    {
        $komentar = Komentar::find($id);
        if (!$komentar) {
            return response()->json(['message' => 'Komentar not found'], 404);
        }
        $komentar->update($request->validated());
        return response()->json($komentar);
    }

    public function destroy($id)
    {
        $komentar = Komentar::find($id);
        if (!$komentar) {
            return response()->json(['message' => 'Komentar not found'], 404);
        }
        $komentar->delete();
        return response()->json(['message' => 'Komentar deleted']);
    }
}

