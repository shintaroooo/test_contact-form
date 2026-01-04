@extends('layouts.auth')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('page_title', 'Login')

@section('content')
    <div class="auth-wrapper">
        <form action="{{ route('login.store') }}" method="post">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例: coachtech123">
            </div>

            {{-- ボタン --}}
            <div class="form-buttons">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
@endsection
