<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResumeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'mimes:jpg,bmp,png,svg',
            'files.*' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,docx|max:1024',
            'experience' => 'required|integer',
            'expected_salary' => 'required|integer',
            'positions' => 'required|array',
            'skills' => 'required|array',
            'languages' => 'required|array',
        ];
    }
}
