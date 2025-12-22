@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__content">
  <div class="category__heading">
    <h2>お問い合わせ詳細</h2>
  </div>

  <div class="category-table">
    <table class="category-table__inner">
      <tr>
        <th>お名前</th>
        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $contact->email }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $contact->tel }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $contact->address }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $contact->building }}</td>
      </tr>
      <tr>
        <th>お問い合わせ種別</th>
        <td>{{ $contact->category->category_name ?? '未設定' }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $contact->content }}</td>
      </tr>
    </table>
  </div>

  <div class="form__button">
    <a href="{{ route('admin.contacts.index') }}" class="form__button-submit">削除</a>
  </div>
</div>
@endsection
