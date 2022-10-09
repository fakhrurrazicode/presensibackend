<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Bidang;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function rekapPresensiForm()
    {
        return view('report.rekap_presensi');
    }

    public function rekapPresensiGenerate(Request $request)
    {
        // return $request->all();

        $tanggal = $request->filled('tanggal') ? $request->get('tanggal') : date('Y-m-d');
        $bidang_id = $request->filled('bidang_id') ? $request->get('bidang_id') : null;

        $query = Presensi::query();

        $query->leftJoin('pegawai', 'presensi.pegawai_id', '=', 'pegawai.id');
        $query->leftJoin('bidang', 'presensi.bidang_id', '=', 'bidang.id');
        $query->whereDate('presensi.created_at', '=', $tanggal);

        if ($bidang_id) {

            $query->where('presensi.bidang_id', '=', $bidang_id);
        }

        $list_presensi = $query->get();

        if ($request->has('export_as_pdf')) {

            $data = [
                'list_presensi' => $list_presensi,
                'tanggal' => $tanggal,
            ];

            $output_filename = 'rekap_presensi_';
            $output_filename .= str_replace('-', '_', $tanggal);
            if ($bidang_id) {
                $bidang = Bidang::find($bidang_id);
                $output_filename .= '_' . $bidang->kode;
                $data['bidang'] = $bidang;
            }
            $output_filename .= ".pdf";

            // return view('report.pdf.rekap_presensi', ['list_presensi' => $list_presensi]);
            $pdf = Pdf::loadView('report.pdf.rekap_presensi', $data)->setPaper('a4', 'landscape');



            return $pdf->download($output_filename);
        }

        if ($request->has('export_as_spreadsheet')) {
            return response()->json([
                'message' => 'Maaf, fitur ini berlum tersedia'
            ]);
        }
    }
}
