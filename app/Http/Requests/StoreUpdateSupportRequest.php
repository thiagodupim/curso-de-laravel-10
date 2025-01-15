<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateSupportRequest extends FormRequest
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
        $rules = [
            'subject' => 'required|min:3|max:255|unique:supports',
            'body' => [
                'required',
                'min:3',
                'max:100000',
            ],
        ];

        //Exceção quando for update
        if ($this->method() === 'PUT' || $this->method() === 'PATCH') {
            $rules['subject'] = [
                'required',
                'min:3',
                'max:255',

                //"unique:supports,subject,{$this->id},id",
                //Acima está dizendo que ele é único na tabela supports para a coluna subject
                //Mas, pode adicionar uma exceção quando o id que está recebendo for igual o valor da coluna id

                //Abaixo faz mesma coisa, porém mais legível
                Rule::unique('supports')->ignore($this->support ?? $this->id),
            ];
        }

        return $rules;
    }
}
