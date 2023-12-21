<?php

namespace Modules\Leaderboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaderBoardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|in:daily,monthly',
             'reward' => 'required|numeric|min:1',
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
