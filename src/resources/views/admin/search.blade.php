@extends('layouts.admin-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('page_title', 'Admin')

@section('content')
    <div class="admin-container">
        {{-- 検索フォーム --}}
        <form action="{{ route('admin.search') }}" method="get" class="search-form">
            <input type="text" name="keyword" class="input-keyword" placeholder="お名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}">

            <select name="gender" class="input-gender">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id" class="input-category">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" class="input-date" value="{{ request('date') }}">
            <button type="submit" class="btn-search">検索</button>
            <a href="{{ route('admin.reset') }}" class="btn-reset">リセット</a>
        </form>

        {{-- エクスポート --}}
        <div class="admin-export">
            <a href="{{ route('admin.export', request()->query()) }}" class="btn-export"
                onclick="setTimeout(() => { window.location.href='{{ route('admin.export.complete') }}'; },500);">
                エクスポート
            </a>
        </div>

        {{-- 一覧テーブル --}}
        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                        <td>
                            {{ $contact->gender_text }}
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content ?? '' }}</td>
                        <td>
                            <button type="button" class="btn-detail" data-id="{{ $contact->id }}">
                                詳細
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="no-data">検索結果がありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- ページネーション --}}
        <div class="pagination">
            {{ $contacts->appends(request()->query())->links() }}
        </div>
        {{-- モーダル表示 --}}
        <div id="detailModal" class="modal">
            <div class="modal-content">
                <button class="modal-close">×</button>
                <dl class="modal-detail">
                    <dt>お名前</dt>
                    <dd id="m-name"></dd>
                    <dt>性別</dt>
                    <dd id="m-gender"></dd>
                    <dt>メールアドレス</dt>
                    <dd id="m-email"></dd>
                    <dt>電話番号</dt>
                    <dd id="m-tel"></dd>
                    <dt>住所</dt>
                    <dd id="m-address"></dd>
                    <dt>建物</dt>
                    <dd id="m-building"></dd>
                    <dt>お問い合わせの種類</dt>
                    <dd id="m-category"></dd>
                    <dt>お問い合わせ内容</dt>
                    <dd id="m-detail"></dd>
                </dl>
                <form method="post" id="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">削除</button>
                </form>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                console.log('modal js loaded');
                document.querySelectorAll('.btn-detail').forEach(btn => {
                    btn.addEventListener('click', async () => {
                        const id = btn.dataset.id;

                        const res = await fetch(`/admin/detail/${id}`);
                        const data = await res.json();

                        document.getElementById('m-name').textContent = data.name;
                        document.getElementById('m-gender').textContent = data.gender;
                        document.getElementById('m-email').textContent = data.email;
                        document.getElementById('m-tel').textContent = data.tel;
                        document.getElementById('m-address').textContent = data.address;
                        document.getElementById('m-building').textContent = data.building;
                        document.getElementById('m-category').textContent = data.category;
                        document.getElementById('m-detail').textContent = data.detail;

                        document.getElementById('delete-form').action = `/admin/delete/${id}`;

                        document.getElementById('detailModal').classList.add('show');
                    });
                });
                document.querySelector('.modal-close').addEventListener('click', () => {
                    document.getElementById('detailModal').classList.remove('show');
                });
            });
        </script>
    @endsection
