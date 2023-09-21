<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUser extends FormRequest
{
    public function authorize() : bool {
        return true;
    }

    public function rules() : array {
        return [
            'email' => 'unique:users,email|required',
            'name' => 'required',
            'password' => 'required',
        ];
    }

    public function withValidator($validator) : void {
        // dd('teste');
        if($validator->fails()){
            throw new HttpResponseException(response()->json([
                'msg' => 'Required field not filled',
                'status' => false,
                'errors' => $validator->errors(),
                'url' => route('users.store')
            ], 403));
        }
    }

}
