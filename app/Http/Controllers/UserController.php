<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUser;
use Illuminate\Http\Request;
use App\Repositories\UserRepositories;
use App\Services\ResponseService;
use App\Transformer\User\UserResource;
use Exception;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositories $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        try {
            $user = $this->userRepository->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password')
            ]);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('users.store', null, $e);
        }

        return new UserResource($user, [
            'type' => 'store',
            'route' => 'users.store'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = auth()->attempt($credentials)) {
                throw new \Exception('Unauthorized.', -401);
            }
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('users.login', null, $e);
        }

        return response()->json(compact('token'));
    }

    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Throwable|Exception $e) {
            return ResponseService::exception('users.logout', null, $e);
        }
        return response(['status' => true,'msg' => 'Logout success'], 200);
    }
}
