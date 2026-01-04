
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Confirm</h2>
  </div>

  <form class="form" action="{{ route('contacts.store') }}" method="post">
    @csrf

    <!-- お名前 -->
    <div class="form__group">
      <div class="form__group-title">お名前</div>
      <div class="form__group-content">
        {{ $inputs['last_name'] }} {{ $inputs['first_name'] }}
      </div>
    </div>

    <!-- 性別 -->
    <div class="form__group">
      <div class="form__group-title">性別</div>
      <div class="form__group-content">
        @if ($inputs['gender'] == 1) 男性
        @elseif ($inputs['gender'] == 2) 女性
        @else その他
        @endif
      </div>
    </div>

    <!-- メールアドレス -->
    <div class="form__group">
      <div class="form__group-title">メールアドレス</div>
      <div class="form__group-content">
        {{ $inputs['email'] }}
      </div>
    </div>

    <!-- 電話番号 -->
    <div class="form__group">
      <div class="form__group-title">電話番号</div>
      <div class="form__group-content">
        {{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}
      </div>
    </div>

    <!-- 住所 -->
    <div class="form__group">
      <div class="form__group-title">住所</div>
      <div class="form__group-content">
        {{ $inputs['address'] }}
      </div>
    </div>

    <!-- 建物名 -->
    <div class="form__group">
      <div class="form__group-title">建物名</div>
      <div class="form__group-content">
        {{ $inputs['building'] ?? '—' }}
      </div>
    </div>

    <!-- お問い合わせの種類 -->
    <div class="form__group">
      <div class="form__group-title">お問い合わせの種類</div>
      <div class="form__group-content">
        {{ $category->name }}
      </div>
    </div>

    <!-- お問い合わせ内容 -->
    <div class="form__group">
      <div class="form__group-title">お問い合わせ内容</div>
      <div class="form__group-content">
        {!! nl2br(e($inputs['content'])) !!}
      </div>
    </div>

    <!-- hidden -->
    @foreach($inputs as $name => $value)
      @if(is_array($value))
        @foreach($value as $v)
          <input type="hidden" name="{{ $name }}[]" value="{{ $v }}">
        @endforeach
      @else
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
      @endif
    @endforeach
        <input type="hidden" name="category_id" value="{{ $category->id }}">


    <!-- ボタン -->
<div class="form__group">
  <button type="submit">送信</button>

  <button
  type="submit"
  name="back"
  value="true"
  formaction="{{ route('contacts.confirm') }}"
>
  修正する
</button>

</div>

</form>
</div>
@endsection
