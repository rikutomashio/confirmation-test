<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;


class ContactController extends Controller
{
    // 入力画面
    public function index()
    {
        return view('index');
    }

    // 確認画面
    public function confirm(ContactRequest $request)
    {
        // ここに来た時点でバリデーションは完了している
        $inputs = $request->validated();

        return view('confirm', compact('inputs'));
    }

     // 送信処理
    public function store(ContactRequest $request)
    {
    $data = $request->validated();

    // 電話番号を結合
    $data['tel'] = $data['tel1'] . '-' . $data['tel2'] . '-' . $data['tel3'];

    // 不要な分割キーを削除
    unset($data['tel1'], $data['tel2'], $data['tel3']);

    Contact::create($data);

    return redirect('/thanks');
    }


    // 完了画面
    public function thanks()
    {
        return view('thanks');
    }

    

}
