<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ProjectStatusEnum;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $validator->errors()->add('code', -1);

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->status(200);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'status'=> ['required', new Enum(ProjectStatusEnum::class)],
            'client_id' => ['required_without:company_id', 'exists:clients,id'],
            'company_id' => ['required_without:client_id', 'exists:companies,id'],
        ];
    }
}
