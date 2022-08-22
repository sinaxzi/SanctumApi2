<?php

namespace App\Http\Requests;

use App\Rules\IranPhone;
use Illuminate\Foundation\Http\FormRequest;

class StoreRegisterUserRequest extends FormRequest
{
    /**
     * Indicates whether validation should stop after the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|string',
            'email' => 'bail|required|string|unique:users,email',
            'password' => 'bail|required|string',
            'telephone' => ['bail','integer','unique:users,telephone','required',new IranPhone()],
            'user_code' => 'bail|unique:users,user_code|required|integer|digits:5',
            'IsAdmin' => 'bail|integer',
        ];
    }
}
