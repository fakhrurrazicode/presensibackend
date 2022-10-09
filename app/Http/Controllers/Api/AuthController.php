<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\HariJamKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nip' => ['required', function ($attribute, $value, $fail) {
                $nip = $value;
                $password = request()->get('password');

                $pegawai = Pegawai::where('nip', '=', $nip)->whereHas('user')->first();



                if ($pegawai) {
                    $user = $pegawai->user;

                    if (!$user) {
                        $fail('NIP/Password invalid 3');
                    }

                    if (Hash::check($password, $user->password) == false) {
                        $fail('NIP/Password invalid 2');
                    }
                } else {
                    $fail('NIP/Password invalid 1');
                }
            },],
            'password' => ['required'],
            // 'fcm_token' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $pegawai = Pegawai::where('nip', '=', $request->get('nip'))->whereHas('user')->first();

        $credentials = $request->only('email', 'password');
        if (Auth::attempt([
            'email' => $pegawai->user->email,
            'password' => $request->get('password'),
        ])) {

            $accessToken = Auth::user()->createToken('secret')->accessToken;

            $user = User::with(['pegawai'])->find(Auth::user()->id);

            if ($request->filled('fcm_token')) {
                $user->update(['fcm_token' => $request->get('fcm_token')]);
                $user = User::with(['pegawai'])->find(Auth::user()->id);
            }


            return response()->json([
                'access_token' => $accessToken,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized.',
            ], 401);
        }
    }

    public function index(Request $request)
    {
        $user = User::with(['pegawai'])->find(Auth::user()->id);
        $accessToken = Auth::user()->createToken('secret')->accessToken;

        if ($request->filled('fcm_token')) {
            $user->update(['fcm_token' => $request->get('fcm_token')]);
            $user = User::with(['pegawai'])->find(Auth::user()->id);
        }


        return response()->json([
            'access_token' => $accessToken,
            'user' => $user,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => ['required', function ($attribute, $value, $fail) use ($request) {
                $user = Auth::user();
                if (!Hash::check($request->get('old_password'), $user->password)) {
                    $fail('Password lama invalid');
                }
            }],
            'new_password' => ['required', 'confirmed'],
        ]);

        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ], 400);
        }

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->get('new_password')),
        ]);

        return response()->json([
            'message' => 'Password berhasil di update'
        ], 200);
    }
}
