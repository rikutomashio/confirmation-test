@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__content">
  <div class="category__heading">
    <h2>Admin</h2>
  </div>

  {{-- 検索フォーム --}}
<div class="category__search">
  <h3>検索</h3>
  <form class="search-form" action="{{ route('admin.contacts.index') }}" method="get">
    @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力" value="{{ request('keyword') }}">

      <select class="search-form__item-select" name="category_id">
        <option value="">カテゴリ</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
          </option>
        @endforeach
      </select>

      <input type="date" name="birthday" value="{{ request('birthday') }}" class="search-form__item-date">
    </div>

    <div class="search-form__button">
      <form method="GET" action="{{ route('admin.contacts.index') }}">
    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="キーワード">

    <select name="category_id">
        <option value="">カテゴリ選択</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @selected(request('category_id') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">検索</button>
</form>

      <button class="search-form__button-submit" type="submit">検索</button>
      <a href="{{ route('admin.contacts.index') }}">リセット</a>
    </div>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
    </form>


    <div class="export-button">
    <a href="{{ route('admin.contacts.export') }}" class="btn btn-success">エクスポート</a>
    </div>

  </form>
</div>


    {{-- お問い合わせ一覧 --}}
  <table class="category-table__inner">
  <tr class="category-table__row">
    <th>お名前</th>
    <th>性別</th>
    <th>メール</th>
    <th>お問い合わせ種別</th>
    <th>詳細</th>
  </tr>

  @forelse ($contacts as $contact)
  <tr class="category-table__row">
    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->category->category_name ?? '未設定' }}</td>
    <td>
      <a href="{{ route('admin.contacts.show', $contact->id) }}">詳細</a>
    </td>
  </tr>
  @empty
  <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('削除しますか？')">
        削除
    </button>
  </form>

  <tr>
    <td colspan="5">データがありません</td>
  </tr>
  @endforelse
</table>



  {{-- フラッシュメッセージ --}}
  @if(session('message'))
  <div class="category__alert--success">
    {{ session('message') }}
  </div>
  @endif

  {{-- エラー表示 --}}
  @if ($errors->any())
  <div class="category__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

</div>
@endsection
