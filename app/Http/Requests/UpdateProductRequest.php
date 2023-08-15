<?php

namespace App\Http\Requests;

use App\Rules\CompanyExists;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        if ($this->isMethod("PUT")) {
            $rules = [
                'companyId' => ['required', new CompanyExists()],
                'name' => 'required',
                'color' => 'required',
                'code' => 'required',
            ];
        }
        else
            $rules = [
                'companyId' => ['sometimes','required', new CompanyExists()],
                'name' => 'sometimes|required',
                'color' => 'sometimes|required',
                'code' => 'sometimes|required',
            ];
        return $rules;
    }
    protected function prepareForValidation(): void
    {
        if ($this->companyId) {
            $this->merge(['company_id'=>$this->companyId]);
        }
    }
}
