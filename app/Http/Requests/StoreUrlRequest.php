<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUrlRequest extends FormRequest
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
        return [
            'url.name' => 'required|max:255|url'
        ];
    }

    public function messages()
    {
        return [
            'url.name.required' => __('messages.errors.name_required'),
            'url.name.max' => __('messages.errors.name_greater_than'),
            'url.name.url' => __('messages.errors.name_valid_url'),
        ];
    }
}
