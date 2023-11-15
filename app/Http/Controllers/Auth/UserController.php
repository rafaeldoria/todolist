<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        try {
            $user = $this->userRepository->store([
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

    public function show(Request $request){
        try {
            $email = $request->has('email') ? $request->input('email') : '';
            $data = $this->userRepository->showByEmail($email);
            
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('users.get', null, $e);
        }
        return new userResource($data,[
            'type' => 'show',
            'route' => 'user.show'
        ]);
    }
}
