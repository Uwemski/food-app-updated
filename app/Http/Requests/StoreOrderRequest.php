<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_name'=> 'required|string|max:20',
            'customer_phone'=> 'required|string|max:20',
            'customer_address'=> 'required|string|max:500',
            'delivery_notes'=> 'nullable|string|max:500'        
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
