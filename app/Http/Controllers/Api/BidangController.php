<?php

namespace App\Http\Controllers\Api;

use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{

    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $bidangs = Bidang::where('nama', 'LIKE', '%' . $search . '%');

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
    public function index(Request $request)
    {

        $bidang = Bidang::all();

        return response()->json([
            'bidang' => $bidang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'kode' => ['required', 'unique:bidang,kode'],
            'nama' => ['required'],
            // 'singkatan' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $bidang = Bidang::create($request->all());

        return response()->json([
            'bidang' => $bidang
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
        $bidang = Bidang::find($id);

        if ($bidang) {
            return response()->json([
                'bidang' => $bidang,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data not found.',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'kode' => ['required', 'unique:bidang,kode,' . $id],
            'nama' => ['required'],
            // 'singkatan' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $bidang = Bidang::find($id);
        $bidang->update($request->all());

        return response()->json([
            'bidang' => $bidang
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bidang = Bidang::find($id);
        $bidang->delete();

        return response()->json([
            'bidang' => $bidang,
        ]);
    }
}
