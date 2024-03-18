<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductResquestUpdate extends FormRequest
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
            'name' => ['min:3', 'max:100'],
            'description' => ['min:3', 'max:200'],
            'price' => ['decimal:2'],
            'due_in' => ['after_or_equal:today'],
            'image' => ['image', 'mimes:jpg,png,jpeg', 'max:1024'],
            'category_id' => ['exists:categories,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.min' => 'O campo Nome não pode ser menor que 3',
            'name.max' => 'O campo Nome não pode ser maior que 100',

            'description.min' => 'O campo Descrição não pode ser menor que 3',
            'description.max' => 'O campo Descrição não pode ser maior que 100',

            'price.decimal' => 'O campo Preço tem que ser um decimal, ex: 1.99, 10.99',

            'due_in.decimal' => 'O campo Vencimento não pode ser menor que a data de hoje',

            'image.image' => 'O campo Imagem tem que ser um imagem',
            'image.mimes' => 'O campo Imagem tem que ser do tipo JPG ou PNG',
            'image.max' => 'O campo Imagem deve ser enviado arquivos com até 2MB',

            'category_id.exists' => 'O campo Categoria deve conter um categoria existente',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
