<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BidangController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $bidangs = Bidang::where('singkatan', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('nm_bidang', 'LIKE', '%' . $request->get('search') . '%');

        $data['total'] = $bidangs->count();

        $bidangs->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $bidangs->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bidang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bidang.create');
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
            'singkatan' => ['required', 'unique:bidang'],
            'nm_bidang' => ['required'],
        ]);

        Bidang::create([
            'singkatan' => $request->get('singkatan'),
            'nm_bidang' => $request->get('nm_bidang'),
        ]);

        return redirect()->route('bidang.index')->with([
            'success' => 'Bidang baru berhasil di tambahkan',
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
    public function edit(Bidang $bidang)
    {
        return view('bidang.edit', ['bidang' => $bidang]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bidang $bidang)
    {
        $request->validate([
            'singkatan' => ['required', 'unique:bidang,singkatan,' . $bidang->id],
            'nm_bidang' => ['required'],
        ]);

        $bidang->update([
            'singkatan' => $request->get('singkatan'),
            'nm_bidang' => $request->get('nm_bidang'),
        ]);

        return redirect()->route('bidang.index')->with([
            'success' => 'Bidang berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bidang $bidang)
    {
        $bidang->delete();

        return [
            'status' => true,
            'message' => 'Data bidang ' . $bidang->nm_bidang . ' berhasil di hapus',
        ];
    }
}
