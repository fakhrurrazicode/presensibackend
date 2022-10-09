<?php

namespace App\Http\Controllers;

use App\Models\TanggalLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TanggalLiburController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $tanggal_liburs = TanggalLibur::where('dalam_rangka', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('catatan', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('tanggal_start', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('tanggal_end', 'LIKE', '%' . $request->get('search') . '%');

        $data['total'] = $tanggal_liburs->count();

        $tanggal_liburs->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $tanggal_liburs->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tanggal_libur.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tanggal_libur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'tanggal_start' => ['required'],
            'tanggal_end' => ['required'],
            'dalam_rangka' => ['required'],
            // 'catatan' => ['required'],
        ]);

        TanggalLibur::create([
            'tanggal_start' => $request->get('tanggal_start') . ' 00:00:00',
            'tanggal_end' => $request->get('tanggal_end') . ' 23:59:59',
            'dalam_rangka' => $request->get('dalam_rangka'),
            'catatan' => $request->get('catatan'),
        ]);

        return redirect()->route('tanggal_libur.index')->with([
            'success' => 'TanggalLibur baru berhasil di tambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TanggalLibur $tanggal_libur)
    {
        return view('tanggal_libur.edit', ['tanggal_libur' => $tanggal_libur]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TanggalLibur $tanggal_libur)
    {
        $request->validate([
            'tanggal_start' => ['required'],
            'tanggal_end' => ['required'],
            'dalam_rangka' => ['required'],
            // 'catatan' => ['required'],
        ]);

        $tanggal_libur->update([
            'tanggal_start' => $request->get('tanggal_start') . ' 00:00:00',
            'tanggal_end' => $request->get('tanggal_end') . ' 23:59:59',
            'dalam_rangka' => $request->get('dalam_rangka'),
            'catatan' => $request->get('catatan'),
        ]);

        return redirect()->route('tanggal_libur.index')->with([
            'success' => 'TanggalLibur berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TanggalLibur $tanggal_libur)
    {
        $tanggal_libur->delete();

        return [
            'status' => true,
            'message' => 'Data tanggal_libur ' . $tanggal_libur->nama_hari . ' berhasil di hapus',
        ];
    }
}
