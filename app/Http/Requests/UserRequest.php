<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if (request()->method() === 'POST') {
            return [
                'name'      => ['required', 'unique:users,name', 'max:255'],
                'email'     => ['required', 'email', 'unique:users,email'],
                'password'  => ['required', 'confirmed'],
                'image'     => ['sometimes']
            ];
        } else {
            return [
                'name'      => ['required', "unique:users,name,{$this->user->id}", 'max:255'],
                'email'     => ['required', 'email'],
                'password'  => ['sometimes'],
                'image'     => ['sometimes']
            ];
        }
    }
}
