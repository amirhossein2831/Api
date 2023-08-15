<?php

namespace App\Http\Requests;

use App\Rules\CompanyExists;
use App\Rules\ProducerExists;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'companyId'=>['required',new CompanyExists()],
            'name' => 'required',
            'color' => 'required|string',
            'code' => 'required|numeric',
        ];
    }
    protected function prepareForValidation(): void
    {
        $this->merge(
            [
                'company_id'=>$this->companyId
            ]
        );
    }
}
