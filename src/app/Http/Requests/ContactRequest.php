<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:8'],
            'last_name' => ['required', 'string', 'max:8'],
            'gender' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tel1' => ['required', 'digits_between:1,5'],
            'tel2' => ['required', 'digits_between:1,5'],
            'tel3' => ['required', 'digits_between:1,5'],
            'address' => ['required', 'string'],
            'building' => ['nullable', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'content' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
     {
         return [
             'first_name.required' => '姓を入力してください',
             'first_name.string' => '姓を文字列で入力してください',
             'first_name.max' => '姓を8文字以下で入力してください',
             'last_name.required' => '名を入力してください',
             'last_name.string' => '名を文字列で入力してください',
             'last_name.max' => '名を8文字以下で入力してください',
             'gender.required' => '性別を選択してください',
             'email.required' => 'メールアドレスを入力してください',
             'email.string' => 'メールアドレスを文字列で入力してください',
             'email.email' => '有効なメールアドレス形式を入力してください',
             'email.max' => 'メールアドレスを255文字以下で入力してください',
             'tel1.required' => '電話番号を入力してください',
             'tel1.digits_between' => '電話番号を5桁までで入力してください',
             'tel2.required' => '電話番号を入力してください',
             'tel2.digits_between' => '電話番号を5桁までで入力してください',
             'tel3.required' => '電話番号を入力してください',
             'tel3.digits_between' => '電話番号を5桁までで入力してください',
             'address.required' => '住所を入力してください',
             'category_id.required' => 'お問い合わせの種類を選択してください',
             'content.required' => 'お問い合わせ内容を入力してください',
             'content.max' => 'お問い合わせ内容を120文字以下で入力してください',
            ];
        }
}