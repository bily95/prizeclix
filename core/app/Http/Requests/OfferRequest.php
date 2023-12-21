<?php

namespace App\Http\Requests;

use App\Rules\FileTypeValidate;
use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
    public function rules()
    {
        if (request('is_builtin')) {
            $customParams = [
                'offer_keys' => ['required', 'array'],
            ];
        } else {
            $customParams = [
                'offer_params' => ['required', 'array'],
            ];
        }

        $defaultParams = [
            'name' => ['required', 'string', 'min:2', 'max:191'],
            'bgcolor' => ['required', 'string', 'min:2', 'max:191'],
            'image' => !$this->offer_id && request('image') != null
            ? ['required', 'image', new FileTypeValidate(['png', 'jpg'])]
                : 'nullable',
            'iframe_url' => ['required', 'string', 'min:5'],
            'is_active' => 'nullable',
            'is_auto_pay' => 'nullable',
            'is_available' => 'nullable',
            'en_api' => 'nullable',
            'user_level' => 'required|gte:1',
        ];

        return array_merge($customParams, $defaultParams);
    }
}
