<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductResquestCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return auth()->check();
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
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:3', 'max:200'],
            'price' => ['required', 'decimal:2'],
            'due_in' => ['required', 'after_or_equal:today'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:1024'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é não pode ser vazio',
            'name.min' => 'O campo Nome não pode ser menor que 3',
            'name.max' => 'O campo Nome não pode ser maior que 100',

            'description.required' => 'O campo Descrição é não pode ser vazio',
            'description.min' => 'O campo Descrição não pode ser menor que 3',
            'description.max' => 'O campo Descrição não pode ser maior que 100',

            'price.required' => 'O campo Preço é não pode ser vazio',
            'price.decimal' => 'O campo Preço tem que ser um decimal, ex: 1.99, 10.99',

            'due_in.required' => 'O campo Vencimento é não pode ser vazio',
            'due_in.decimal' => 'O campo Vencimento não pode ser menor que a data de hoje',

            'image.required' => 'O campo Imagem é não pode ser vazio',
            'image.image' => 'O campo Imagem tem que ser um imagem',
            'image.mimes' => 'O campo Imagem tem que ser do tipo JPG ou PNG',
            'image.max' => 'O campo Imagem deve ser enviado arquivos com até 2MB',

            'category_id.required' => 'O campo Categoria é não pode ser vazio',
            'category_id.exists' => 'O campo Categoria deve conter um categoria existente',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
