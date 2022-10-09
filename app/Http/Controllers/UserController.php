<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function paginated(Request $request)
    {
        $limit = $request->filled('limit') ? $request->get('limit') : 10;
        $offset = $request->filled('offset') ? $request->get('offset') : 0;
        $search = $request->filled('search') ? $request->get('search') : '';
        $sort = $request->filled('sort') ? $request->get('sort') : 'id';
        $order = $request->filled('order') ? $request->get('order') : 'DESC';

        $users = User::with(['pegawai'])
            ->where('name', 'LIKE', '%' . $request->get('search') . '%')
            ->orWhere('email', 'LIKE', '%' . $request->get('search') . '%');

        $data['total'] = $users->count();

        $users->skip($offset)->limit($limit)->orderBy($sort, $order);

        $data['rows'] = $users->get();

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'email' => ['required', 'email', 'unique:users'],
            'name' => ['required'],
            'password' => ['required', 'confirmed'],
            // 'is_admin' => ['required'],
        ]);

        User::create([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
            'is_admin' => $request->get('is_admin') ? 1 : 0,
        ]);

        return redirect()->route('user.index')->with([
            'success' => 'User baru berhasil di tambahkan',
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
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'name' => ['required'],
            // 'password' => ['required', 'confirmed'],
            // 'is_admin' => ['required'],
        ]);

        $user->update([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'is_admin' => $request->get('is_admin') ? 1 : 0,
        ]);

        return redirect()->route('user.index')->with([
            'success' => 'User berhasil di ubah',
        ]);
    }

    public function change_password(User $user)
    {
        return view('user.change_password', ['user' => $user]);
    }

    /**
     * Update password
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request, User $user)
    {
        $request->validate([
            'old_password' => ['required', function ($attribute, $value, $fail) {
                $user = Auth::user();
                if (!Hash::check($value, $user->password)) {
                    $fail('Password lama invalid');
                }
            },],
            'password' => ['required', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('user.index')->with([
            'success' => 'Password User berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return [
            'status' => true,
            'message' => 'Data user ' . $user->name . ' berhasil di hapus',
        ];
    }
}
