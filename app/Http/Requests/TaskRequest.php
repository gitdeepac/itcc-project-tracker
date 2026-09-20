<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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

		// Get project deadline for due_date validation
        $project  = $this->route('project');
        $deadline = $project->deadline->format('Y-m-d');
        return [
            'title'          => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'assignee'       => [$isUpdate ? 'sometimes' : 'required', 'string', 'max:255'],
            'estimate_hours' => ['nullable', 'numeric', 'min:0', 'max:999.99'],
            'status'         => [$isUpdate ? 'sometimes' : 'required', 'in:todo,in_progress,done'],
            'due_date'       => [
                $isUpdate ? 'sometimes' : 'required',
                'date',
                'before_or_equal:' . $deadline,
            ],
            'completed_at'   => ['nullable', 'date'],
        ];
    }

	/**
	 * response message for validation errors.
	 */
	public function messages(): array
    {
        return [
            'title.required'      => 'Task title is required.',
            'assignee.required'   => 'Assignee is required.',
            'status.in'           => 'Status must be todo, in_progress or done.',
            'due_date.required'   => 'Due date is required.',
            'due_date.before_or_equal' => 'Task due date cannot exceed the project deadline.',
        ];
    }
}
