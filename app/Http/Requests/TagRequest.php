<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        if (request()->method === 'POST') {
            return [
                'name' => ['required', 'unique:tags,name' ,'min:2', 'max:50'],
            ];
        } else {
            return [
                'name' => ['required', "unique:tags,name,{$this->tag->id}" ,'min:2', 'max:50'],
            ];
        }
    }
}
