@extends('layouts.app')

@section('content')
<h2>ログイン</h2>

@if ($errors->any())
    <p>{{ $errors->first() }}</p>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <label>メールアドレス</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>パスワード</label>
    <input type="password" name="password" required>

    <button type="submit">ログイン</button>
</form>
@endsection
