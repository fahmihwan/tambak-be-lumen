<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $socialite = Socialite::driver('google')->stateless()->user();

            $user = User::where('email', $socialite['email'])->first();
            if ($user) {
                $user->update([
                    'google_id' => $socialite['id']
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                    'data' => $user
                ]);
            }

            $user = User::create([
                'nama' => $socialite['name'],
                'email' => $socialite['email'],
                'telp' => '',
                'password' => '',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'google_id' => $socialite['id']
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $user
            ]);
        } catch (InvalidStateException $e) {
            return $e->getMessage();
        }
    }
}
