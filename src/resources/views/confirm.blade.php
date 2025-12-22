
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>Confirm</h2>
  </div>

  <form class="form" action="/contacts" method="post">
    @csrf

    <table class="confirm-table__inner">

      <tr>
        <th>お名前</th>
        <td>
          {{ $contact['last_name'] }} {{ $contact['first_name'] }}
          <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
          <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">

        </td>
      </tr>

      <tr class="confirm-table__row">
      <th class="confirm-table__header">性別</th>
        <td class="confirm-table__text">
        {{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}

        {{-- ★ 必須：送信用 --}}
          <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
  </td>
</tr>


      <tr>
        <th>メールアドレス</th>
        <td>
          {{ $contact['email'] }}
          <input type="hidden" name="email" value="{{ $contact['email'] }}">
        </td>
      </tr>

      <tr>
        <th>電話番号</th>
        <td>
          {{ $contact['tel'] }}
          <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
        </td>
      </tr>

      <tr>
        <th>住所</th>
        <td>
          {{ $contact['address'] }}
          <input type="hidden" name="address" value="{{ $contact['address'] }}">
        </td>
      </tr>

      <tr>
        <th>建物名</th>
        <td>
          {{ $contact['building'] }}
          <input type="hidden" name="building" value="{{ $contact['building'] }}">
        </td>
      </tr>

      <tr class="confirm-table__row">
  <th class="confirm-table__header">お問い合わせの種類</th>
  <td class="confirm-table__text">
    {{ $contact['category_id'] == 1 ? '商品のお届けについて'
      : ($contact['category_id'] == 2 ? '商品の交換について'
      : ($contact['category_id'] == 3 ? '商品トラブル'
      : ($contact['category_id'] == 4 ? 'ショップへのお問い合わせ'
      : 'その他'))) }}
    <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
  </td>
</tr>


      <tr>
        <th>お問い合わせ内容</th>
        <td>
          {{ $contact['content'] }}
          <input type="hidden" name="content" value="{{ $contact['content'] }}">
        </td>
      </tr>

    </table>

    <div class="form__button">
      <button type="submit">送信</button>
      <button type="button" onclick="history.back()">修正</button>
    </div>


  </form>
</div>
@endsection
