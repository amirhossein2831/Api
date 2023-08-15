<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'nationalCode' => 'required|numeric',
            'city'=>'required'
        ];
    }
    protected function prepareForValidation(): void
    {
            $this->merge(['national_code'=>$this->nationalCode]);
    }
}
