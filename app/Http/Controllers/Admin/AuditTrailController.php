<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditTrailController extends Controller
{
    /**
     * Tampilkan riwayat audit sistem.
     */
    public function index(Request $request): View
    {
        $query = AuditTrail::with('user');

        if ($request->filled('aksi')) {
            $query->where('aksi', $request->input('aksi'));
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->input('tanggal_dari'));
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->input('tanggal_sampai'));
        }

        $auditTrails = $query->latest('created_at')->paginate(20)->withQueryString();
        $aksiList = AuditTrail::distinct()->pluck('aksi')->sort()->values();

        return view('admin.audit-trail.index', compact('auditTrails', 'aksiList'));
    }
}
