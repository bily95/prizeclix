<?php

namespace Modules\OffersNetwork\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SetUpOffersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:5|max:50',
            'keys' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Fill required fields',
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
