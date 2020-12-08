<?php

namespace App\Http\Requests\IssueRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateIssue extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {

        return [
            'title' => ['sometimes', 'required', 'unique:issues', 'max:100', 'alpha_dash'],
            'description' => ['sometimes', 'required', 'max:255'],
            'assigned_to' => ['sometimes', 'nullable', 'exists:users,id'],
            'due_date' => ['sometimes', 'required', 'date', 'after:today'],
            'order' => ['sometimes', 'required', 'numeric'],
            'priority' => ['sometimes', 'required', Rule::in(['low', 'medium', 'high'])],
            'state_id' => ['sometimes', 'required', 'exists:states,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
