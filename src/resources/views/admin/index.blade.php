@extends('layouts.app')

@section('body-class', 'admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<main class="main">

  {{-- 共通見出し --}}
  <div class="page-heading">
    <h2>Admin</h2>
  </div>

  {{-- 上段：検索・操作 --}}
  <div class="category__top">

    <div class="category__search">
      <h3>検索</h3>

      {{-- 検索フォーム --}}
      <form class="search-form" action="{{ route('admin.contacts.index') }}" method="get">

        <div class="search-form__item">
          {{-- キーワード --}}
          <input
            type="text"
            name="keyword"
            placeholder="名前やメールアドレスを入力"
            value="{{ request('keyword') }}"
          >

          {{-- 性別 --}}
          <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
          </select>

          {{-- お問い合わせ種別 --}}
          <select name="category_id">
            <option value="">お問い合わせ種別</option>
            @foreach ($categories as $category)
              <option
                value="{{ $category->id }}"
                {{ request('category_id') == $category->id ? 'selected' : '' }}
              >
                {{ $category->name }}
              </option>
            @endforeach
          </select>

          {{-- 生年月日 --}}
          <input type="date" name="birthday" value="{{ request('birthday') }}">
        </div>

        <div class="search-form__button">
          <button type="submit">検索</button>
          <button
            type="button"
            onclick="location.href='{{ route('admin.contacts.index') }}'">
            リセット
          </button>
        </div>

      </form>

      {{-- エクスポート --}}
      <div class="search-form__export">
        <a href="{{ route('admin.contacts.export') }}">エクスポート</a>
      </div>
    </div>

  </div>

  {{-- 一覧テーブル --}}
  <div class="category-table">
    <table class="category-table__inner">
      <thead>
        <tr class="category-table__row">
          <th>お名前</th>
          <th>性別</th>
          <th>メール</th>
          <th>お問い合わせ種別</th>
          <th>操作</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($contacts as $contact)
          <tr class="category-table__row">
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>

            {{-- 性別表示 --}}
            <td>
              {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}
            </td>

            <td>{{ $contact->email }}</td>

            {{-- お問い合わせ種別 --}}
            <td>{{ $contact->category->name ?? '未設定' }}</td>

            <td>
              <a href="{{ route('admin.contacts.show', $contact->id) }}">詳細</a>

              <form
                action="{{ route('admin.contacts.destroy', $contact) }}"
                method="POST"
                style="display:inline"
              >
                @csrf
                @method('DELETE')
                <button
                  type="submit"
                  onclick="return confirm('削除しますか？')">
                  削除
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5">データがありません</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- ページネーション --}}
  <div class="pagination">
    {{ $contacts->links() }}
  </div>

</main>
@endsection
