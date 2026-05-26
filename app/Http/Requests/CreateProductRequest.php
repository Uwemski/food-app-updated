<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=>'required|min:3',
            'category_id' => 'required',
            'price'=>'required',
            'quantity'=>'required',
            'image'=>'required|mimes:jpeg,png,pdf,jpg,avif|max:10025',
            'is_available'=> 'required|boolean',
        ];
    }

    public function prepareForValidation()
    {
        $input = $this->all();

        foreach($input as $key => $value){
            if(is_string($value)){
                $input[$key] = strip_tags($value);
            }
        }

        $this->replace($input);
    }
}
