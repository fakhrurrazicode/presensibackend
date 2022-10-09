<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'pegawai.id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $pegawais = Pegawai::query();

        $pegawais->select('pegawai.*');

        $pegawais->join('users', 'users.pegawai_id', '=', 'pegawai.id');
        $pegawais->join('bidang', 'bidang.id', '=', 'pegawai.bidang_id');
        $pegawais->leftJoin('golongan', 'golongan.id', '=', 'pegawai.golongan_id');

        $pegawais->where(function ($query) use ($search) {
            $query->where('pegawai.nip', 'LIKE', '%' . $search . '%');
            $query->orWhere('pegawai.nama', 'LIKE', '%' . $search . '%');
            $query->orWhere('pegawai.tempat_lahir', 'LIKE', '%' . $search . '%');

            $query->orWhere('golongan.golongan', 'LIKE', '%' . $search . '%');
            $query->orWhere('golongan.nama_pangkat', 'LIKE', '%' . $search . '%');

            $query->orWhere('bidang.kode', 'LIKE', '%' . $search . '%');
            $query->orWhere('bidang.nama', 'LIKE', '%' . $search . '%');
            $query->orWhere('bidang.singkatan', 'LIKE', '%' . $search . '%');
        });

        $data['total'] = $pegawais->count();

        $pegawais->skip($offset)->limit($limit)->orderBy($sort, $order);
        $pegawais->with(['user', 'bidang', 'golongan']);

        $data['rows'] = $pegawais->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
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
            'nip' => ['required', 'unique:pegawai'],
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

        $pegawai = Pegawai::create([
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
            'pegawai_id' => $pegawai->id,
            'is_admin' => 0,
        ]);

        return redirect()->route('pegawai.index')->with([
            'success' => 'Pegawai baru berhasil di tambahkan',
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
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', ['pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nip' => ['required', 'unique:pegawai,nip,' . $pegawai->id],
            'nama' => ['required'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'golongan_id' => ['required'],
            'jabatan' => ['required'],
            'bidang_id' => ['required'],
        ]);

        $pegawai->update([
            'nip' => $request->get('nip'),
            'nama' => $request->get('nama'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'golongan_id' => $request->get('golongan_id'),
            'jabatan' => $request->get('jabatan'),
            'bidang_id' => $request->get('bidang_id'),
        ]);

        return redirect()->route('pegawai.index')->with([
            'success' => 'Pegawai berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return [
            'status' => true,
            'message' => 'Data pegawai ' . $pegawai->nama . ' berhasil di hapus',
        ];
    }
}
