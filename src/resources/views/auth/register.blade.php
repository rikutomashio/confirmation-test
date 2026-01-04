@extends('layouts.app')

@section('title', '会員登録')

@section('body-class', 'auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<div class="auth-wrapper">

  {{-- 見出し --}}
  <div class="page-heading">
    <h2>Register</h2>
  </div>

  {{-- フォーム --}}
  <form action="{{ route('register') }}" method="POST" class="auth-form">
    @csrf

    {{-- エラー表示 --}}
    @if ($errors->any())
      <ul class="auth-error">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    {{-- お名前（1つに統合） --}}
    <div class="form-group">
      <label for="name">お名前</label>
      <input
        type="text"
        id="name"
        name="name"
        placeholder="山田 太郎"
        value="{{ old('name') }}"
      >
    </div>

    {{-- メール --}}
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input
        type="email"
        id="email"
        name="email"
        value="{{ old('email') }}"
      >
    </div>

    {{-- パスワード --}}
    <div class="form-group">
      <label for="password">パスワード</label>
      <input
        type="password"
        id="password"
        name="password"
      >
    </div>

    {{-- ボタン --}}
    <div class="form-button">
      <button type="submit">登録</button>
    </div>

  </form>

</div>

@endsection
