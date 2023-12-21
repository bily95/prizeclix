<?php

namespace Modules\DailyTasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DailyTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|in:earn,offer',
            'title' => 'required|string|min:5|max:191',
            'reward' => 'required|numeric|min:1',
            'require' => 'required_if:type,earn',
            'condition' => 'required_if:type,offer',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'string' => ':attribute is must be string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
