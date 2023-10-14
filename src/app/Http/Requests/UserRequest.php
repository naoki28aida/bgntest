<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:191',
            'email' => [
                'required',
                'string',
                'email',
                'unique:users',
                'max:191',
            ],
            'password' => 'required|string|min:8|max:191|confirmed',
        ];

        if (request()->is('login')) {
            $rules['email'] = [
                'required',
                'string',
                'email',
                'max:191',
                Rule::exists('users')->where(function ($query) {
                    return $query->where('email_verified_at', '!=', null);
                }),
            ];
            $rules['password'] = 'required|string|min:8|max:191';
            unset($rules['name']);
        }
        if (request()->is('reset-password')) {
            $rules['email'] = [
                'required',
                'string',
                'email',
                'max:191',
                Rule::exists('users')->where(function ($query) {
                    return $query->where('email_verified_at', '!=', null);
                }),
            ];
            $rules['password'] = 'required|string|min:8|max:191|confirmed';
            unset($rules['name']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須項目です。',
            'name.string' => '名前は文字列でなければなりません。',
            'name.max' => '名前は191文字以下で入力してください。',

            'email.required' => 'メールアドレスは必須項目です。',
            'email.string' => 'メールアドレスは文字列でなければなりません。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'email.max' => 'メールアドレスは191文字以下で入力してください。',
            'email.exists' => 'お送りしたメールのURLをご確認ください。',

            'password.required' => 'パスワードは必須項目です。',
            'password.string' => 'パスワードは文字列でなければなりません。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは191文字以下で入力してください。',
            'password.confirmed' => '確認用のパスワードと一致しません。',
        ];
    }
}
