<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;


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
    // 修正するボタンが押されたら入力画面へ
    if ($request->has('back')) {
        return redirect('/')
            ->withInput();
    }
    $inputs = $request->validated();

    // 電話番号を結合（表示用）
    $inputs['tel'] =
        $inputs['tel1'] . '-' . $inputs['tel2'] . '-' . $inputs['tel3'];

    // 性別を文字列に変換（表示用）
    $genderMap = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];
    $inputs['gender_label'] = $genderMap[$inputs['gender']];

    // カテゴリ名取得
    $category = Category::find($inputs['category_id']);

    return view('confirm', compact('inputs', 'category'));
}

 // 送信処理 ← ★これを追加
    public function store(Request $request)
    {
        Contact::create($request->all());

        return view('thanks');
    }



    // 完了画面
    public function thanks()
    {
        return view('thanks');
    }

    

}
