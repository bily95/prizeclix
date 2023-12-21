<?php

namespace Modules\Coupon\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'id' => $this->id ? ['required', 'numeric'] : 'nullable',
            'token' => ['required', 'string', 'min:5', 'max:191'],
            'rewards' => ['required', 'numeric'],
            'limit' => ['required', 'numeric'],
            'expire_at' => ['nullable'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'token' => 'Code',
            'rewards' => 'Reward',
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
