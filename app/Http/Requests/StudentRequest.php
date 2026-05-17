<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::guard('web')->check()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'      => ['required', 'string'],
            'username'  => ['required', 'string'],
            'status'    => ['required', 'string'],
            'school_id' => ['required', 'integer'],
            'lab_id'    => ['required', 'integer']
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string'];
        } else {
            $rules['password'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
