<?php

namespace Modules\OffersNetwork\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:50',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Fill required fields',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'category title',
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
