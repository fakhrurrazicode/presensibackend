<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PresensiController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'presensi.id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';
        $tanggal = $request->filled('tanggal') ? $request->get('tanggal') : date('Y-m-d');
        $bidang_id = $request->filled('bidang_id') ? $request->get('bidang_id') : null;

        $presensis = Presensi::query();

        $presensis->leftJoin('pegawai', 'presensi.pegawai_id', '=', 'pegawai.id');
        $presensis->leftJoin('bidang', 'presensi.bidang_id', '=', 'bidang.id');

        $presensis->whereDate('presensi.created_at', '=', $tanggal);
        if ($bidang_id) {
            $presensis->where('presensi.bidang_id', '=', $bidang_id);
        }
        $presensis->where(function ($query) use ($search) {
            $query->where('pegawai.nama', 'LIKE', '%' . $search . '%');
            $query->orWhere('bidang.nama', 'LIKE', '%' . $search . '%');
        });




        $data['total'] = $presensis->count();

        $presensis->skip($offset)->limit($limit)->orderBy($sort, $order);

        $presensis->with(['bidang', 'pegawai']);

        $data['rows'] = $presensis->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presensi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('presensi.create');
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
            'nip' => ['required', 'unique:presensi'],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'golongan_id' => ['required'],
            'jabatan' => ['required'],
            'bidang_id' => ['required'],

            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $presensi = Presensi::create([
            'nip' => $request->get('nip'),
            'nama' => $request->get('nama'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'golongan_id' => $request->get('golongan_id'),
            'jabatan' => $request->get('jabatan'),
            'bidang_id' => $request->get('bidang_id'),
        ]);


        User::create([
            'email' => $request->get('email'),
            'name' => $request->get('nama'),
            'password' => Hash::make($request->get('password')),
            'pegawai_id' => $presensi->id,
            'is_admin' => 0,
        ]);

        return redirect()->route('presensi.index')->with([
            'success' => 'Presensi baru berhasil di tambahkan',
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
    public function edit(Presensi $presensi)
    {
        return view('presensi.edit', ['presensi' => $presensi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presensi $presensi)
    {
        $request->validate([
            'nip' => ['required', 'unique:presensi,nip,' . $presensi->id],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'golongan_id' => ['required'],
            'jabatan' => ['required'],
            'bidang_id' => ['required'],
        ]);

        $presensi->update([
            'nip' => $request->get('nip'),
            'nama' => $request->get('nama'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'golongan_id' => $request->get('golongan_id'),
            'jabatan' => $request->get('jabatan'),
            'bidang_id' => $request->get('bidang_id'),
        ]);

        return redirect()->route('presensi.index')->with([
            'success' => 'Presensi berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presensi $presensi)
    {
        $presensi->delete();

        return [
            'status' => true,
            'message' => 'Data presensi ' . $presensi->nama . ' berhasil di hapus',
        ];
    }
}
