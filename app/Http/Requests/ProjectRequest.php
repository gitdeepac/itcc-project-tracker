<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true; // no rule base auth so allowed all 
	}

	/**
	 * Get the validation rules that apply to the request.
	 */
	public function rules(): array
	{
		$isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

		return [
			'name'        => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
			'client_name' => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
			'deadline'    => [$isUpdate ? 'sometimes' : 'required', 'date', 'after:today'],
			'status'      => [$isUpdate ? 'sometimes' : 'required', 'in:active,on_hold,completed'],
		];
	}

	/**
	 * response message for validation errors.
	 */
	public function messages(): array
    {
        return [
            'name.required'        => 'Project name is required.',
            'client_name.required' => 'Client name is required.',
            'deadline.required'    => 'Deadline is required.',
            'deadline.after'       => 'Deadline must be a future date.',
            'status.in'            => 'Status must be active, on_hold or completed.',
        ];
    }
}
