@extends('layouts.app')

@section('title', 'ログイン')

@section('body-class', 'auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="auth-wrapper">

  {{-- 見出し --}}
  <div class="page-heading">
    <h2>Login</h2>
  </div>

  {{-- フォーム --}}
  <form action="{{ route('login') }}" method="POST" class="auth-form">
    @csrf

    {{-- エラー表示 --}}
    @if ($errors->any())
      <ul class="auth-error">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    {{-- メールアドレス --}}
    <div class="form-group">
      <label>メールアドレス</label>
      <input type="email" name="email" value="{{ old('email') }}">
    </div>

    {{-- パスワード --}}
    <div class="form-group">
      <label>パスワード</label>
      <input type="password" name="password">
    </div>

    {{-- ボタン --}}
    <div class="form-button">
      <button type="submit">ログイン</button>
    </div>

  </form>

</div>

@endsection
