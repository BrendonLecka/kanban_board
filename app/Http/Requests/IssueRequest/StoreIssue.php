<?php

namespace App\Http\Requests\IssueRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreIssue extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'title' => ['required', 'unique:issues', 'max:100', 'alpha_dash'],
            'description' => ['required', 'max:255'],
            'created_by' => ['required', 'exists:users,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'due_date' => ['required', 'date', 'after:today'],
            'position' => ['sometimes', 'numeric'],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'state_id' => ['required', 'exists:states,id'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
