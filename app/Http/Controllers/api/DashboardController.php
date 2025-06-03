<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use App\Models\UsersModel;

class DashboardController extends Controller
{
    /**
     * Dashboard umum — bisa kasih info dasar saja
     */
    public function index()
    {
        return response()->json([
            'message' => 'Welcome to General Dashboard',
        ]);
    }

    /**
     * Dashboard untuk dosen — tampilkan berapa kriteria dosen ini sudah isi sendiri
     */
    public function dosenDashboard()
    {
        $user = auth()->user();
        dd(get_class(auth()->user()));

        $jumlah = $user->kriteria()->count();
        $acc = $user->kriteria()->where('status', 'accepted')->count();
        $tolak = $user->kriteria()->where('status', 'rejected')->count();

        return response()->json([
            'nama' => $user->name,
            'jumlah_kriteria_diisi' => $jumlah,
            'acc' => $acc,
            'tolak' => $tolak,
        ]);
    }

    /**
     * Dashboard untuk kajur
     */
    public function kajurDashboard()
    {
        $totalKriteria = KriteriaModel::whereNotNull('user_id')->count();
        $accCount = KriteriaModel::where('status', 'accepted')->count();
        $tolakCount = KriteriaModel::where('status', 'rejected')->count();

        // Ambil semua dosen
        $dosenList = UsersModel::whereHas('role', function ($q) {
            $q->where('name', 'dosen');
        })->get();

        $statusPerDosen = $dosenList->map(function ($dosen) {
            $jumlah = $dosen->kriteria()->count();
            return [
                'nama' => $dosen->name,
                'sudah_submit' => $jumlah > 0,
                'jumlah_kriteria' => $jumlah,
            ];
        });

        return response()->json([
            'total_kriteria' => $totalKriteria,
            'acc' => $accCount,
            'tolak' => $tolakCount,
            'status_dosen' => $statusPerDosen,
        ]);
    }

    /**
     * Dashboard untuk direktur — bisa disamakan dengan kajur atau kasih tambahan
     */
    public function direkturDashboard()
    {
        // Bisa duplicate dari kajur
        return $this->kajurDashboard();
    }
}
