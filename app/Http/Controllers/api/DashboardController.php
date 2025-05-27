<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Add sample data to pass to the view
        $data = [
            'total_kriteria' => 42,
            'tervalidasi' => 28,
            'belum_valid' => 14,
            'activities' => [
                'Kriteria 1.1 telah divalidasi oleh Validator 1',
                'Kriteria 2.3 memerlukan revisi',
                'Dokumen pendukung untuk Kriteria 3.2 diunggah'
            ]
        ];
        
        return view('dashboard.index', $data);
    }
}