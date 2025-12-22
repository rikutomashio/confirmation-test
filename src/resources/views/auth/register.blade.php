@extends('layouts.app')

@section('content')
<h2>会員登録</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <label>名前</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>メールアドレス</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>パスワード</label>
    <input type="password" name="password" required>

    <label>パスワード（確認用）</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">登録</button>
</form>
@endsection
