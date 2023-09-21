<?php

namespace App\Http\Requests\TaskList;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required'
        ];
    }

    public function withValidator($validator) : void {
        if($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'msg' => 'Required field not filled',
                'status' => false,
                'errors' => $validator->errors(),
                'url' => route('tasklist.store')
            ], 403));
        }
    }
}
