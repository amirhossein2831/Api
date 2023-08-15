<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProducerRequest extends FormRequest
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
        if ($this->isMethod('PUT')) {
            $rules= [
                'name'=>'required',
                'address' => 'required',
                'phone' => 'required',
                'nationalCode' => 'required',
                'city' => 'required',
            ];
        }else
            $rules= [
                'name'=>'sometimes|required',
                'address' => 'sometimes|required',
                'phone' => 'sometimes|required',
                'nationalCode' => 'sometimes|required',
                'city' => 'sometimes|required',
            ];
        return $rules;
    }
    protected function prepareForValidation(): void
    {
        if ($this->nationalCode) {
            $this->merge(['national_code'=>$this->nationalCode]);
        }
    }
}
