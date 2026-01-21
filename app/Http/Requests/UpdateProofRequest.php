<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProofRequest extends FormRequest
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
    {//dd($this->route('proof'));

        return [
            'nome' => ['required', 'string'],
            'referencia' => [
                'required',
                 Rule::unique('proofs', 'referencia')->ignore($this->route('proof'))
            ],
            'comment' => ['nullable', 'string']
        ];
    }
}
