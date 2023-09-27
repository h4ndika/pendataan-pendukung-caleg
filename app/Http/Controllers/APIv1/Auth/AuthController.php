<?php

namespace App\Http\Controllers\APIv1\Auth;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\Ketua;
use App\Models\Anggota;
use App\Http\Resources\AdminResource;
use App\Http\Resources\KetuaResource;
use App\Http\Resources\AnggotaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:3,1,login')->only('login');
        $this->middleware('auth:admin-api,ketua-api,anggota-api')->only('me','changePassword','refresh');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(
        string $token,
        string $guard,
        int $statusCode = 200,
        $ttlMinutes = null
    ) {
        $user = auth()
            ->guard("{$guard}-api")
            ->user();

        $activeTTL =
            $ttlMinutes ??
            auth("{$guard}-api")
                ->factory()
                ->getTTL();

        $data = $user;

        if ($user instanceof Admin) {
            $data = new AdminResource($user);
        } elseif ($user instanceof Ketua) {
            $data = new KetuaResource($user);
        } else {
            $data = new AnggotaResource($user);
        }

        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $activeTTL * 60,
                'data' => $data,
            ],
            $statusCode
        );
    }

    /**
     * Login and get JWT token with email and password.
     *
     * @param Request $request
     * @param string $guard
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, string $guard)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $request->username,
                'password' => $request->password,
            ];
          } else {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
            ];
          }

        if (
            !($token = auth()
                ->guard("{$guard}-api")
                ->attempt($credentials))
        ) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token, $guard);
    }

    /**
     * Change user's account password.
     *
     * @param string $guard
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request, string $guard)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $auth = auth()->user();

        if ($guard == 'admin') {
            $query = Admin::query();
        } elseif ($guard == 'ketua') {
            $query = Ketua::query();
        } else {
            $query = Anggota::query();
        }

        $user = $query->where('username', $auth->username)->firstOrFail();


        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(
                [
                    'message' => 'Invalid credentials.',
                ],
                403
            );
        }

        return response()->json([
            'success' => $user->update(['password' => $request->new_password]),
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(string $guard)
    {
        auth("{$guard}-api")->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(string $guard)
    {
        $token = auth()
            ->guard("{$guard}-api")
            ->refresh();

        return $this->respondWithToken($token, $guard);
    }

    public function me()
    {
        $user = auth()->user();

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }
}
