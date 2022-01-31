<?php

namespace App\Http\Requests;

use App\Domain\Contracts\UserContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            UserContract::NAME     => ['required', 'string', 'max:255'],
            UserContract::EMAIL    => ['required', 'email', 'unique:users'],
            UserContract::PASSWORD => ['required', 'min:6'],
        ];
    }
}
