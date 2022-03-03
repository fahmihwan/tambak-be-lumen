<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email:dns|unique:users',
            'telp' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'password' => Hash::make($request->password),
            'google_id' => ''
        ]);

        if ($user) {
            $code = Str::random(32);
            $request->session()->put('kode_otp', $code);
            $data = array(
                'id_user' => $user->id,
                'code' => $code,
            );
            Mail::send('mail', $data, function ($message) use ($request) {
                $message->to($request->email, $request->nama)->subject('Verify Kode OTP');
                $message->from('lokalprogrammer@gmail.com', 'Jala');
            });
            return response()->json([
                'status' => true,
                'message' => 'User Created, Please confirm your account via the link sent via email!',
                'data' => $user,
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Server Error'
        ], 500);
    }

    public function verify(Request $request)
    {
        if ($request->session()->get('kode_otp') == $request->code) {
            $user = User::find($request->id_user);
            if ($user) {
                $user->update([
                    'email_verified_at' => date('Y-m-d H:i:s')
                ]);
                $request->session()->forget('kode_otp');
                return response()->json([
                    'status' => true,
                    'message' => 'Email verification successful'
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Id User Not Found'
            ], 404);
        }
        return response()->json([
            'status' => false,
            'message' => 'Invalid Kode OTP'
        ], 400);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->email_verified_at) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Success',
                        'token' => $this->jwt($user),
                    ], 200);
                }
                return response()->json([
                    'status' => false,
                    'message' => 'Please verify your email'
                ], 404);
            }
            return response()->json([
                'status' => false,
                'message' => 'Email or password not provided'
            ], 404);
        }
        return response()->json([
            'status' => false,
            'message' => 'Email or password not provided'
        ], 404);
    }

    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function tes(Request $request)
    {
        return 'authentice';
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $this->refresh($token);
    }
    public static function refresh($token)
    {
        try {
            $decoded = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            //TODO: do something if exception is not fired
        } catch (\Firebase\JWT\ExpiredException $e) {
            JWT::$leeway = 720000;
            $decoded = (array) JWT::decode($token, env('JWT_SECRET'), ['HS256']);
            // TODO: test if token is blacklisted
            $decoded['iat'] = time();
            $decoded['exp'] = time() + 10;

            return JWT::encode($decoded, env('JWT_SECRET'));
        } catch (\Exception $e) {
            return $e;
        }
    }
}
