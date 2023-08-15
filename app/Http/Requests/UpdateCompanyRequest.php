<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            $rules = [
                'name' => 'required',
                'country' => 'required',
                'number' => 'required'
            ];
        }
        else
            $rules = [
                'name'=>'sometimes|required',
                'country'=>'sometimes|required',
                'number'=>'sometimes|required'
            ];
        return $rules;
    }
}
