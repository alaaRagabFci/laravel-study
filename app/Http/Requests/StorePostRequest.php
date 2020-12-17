<?php

namespace App\Http\Requests;

use App\Rules\NamePattern;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' =>  ['required', 'unique:posts', 'max:255', new NamePattern],
            'content' => 'required',
            // 'user_id' => 'required|integer|exists:users,id',
            'array.*' => 'integer',
            'photo' => 'mimes:jpeg,bmp,png',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('validation.post.title', ['title' => 'title']),
            // 'title.required' => 'The :attribute is required',
            'content.required' => 'A message is required',
        ];
    }
}
