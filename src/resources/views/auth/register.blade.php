@extends('layouts.auth')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('page_title', 'Register')

@section('content')
    <div class="auth-wrapper">
        <form action="{{ route('register.store') }}" method="post">
            @csrf
            {{-- お名前 --}}
            <div class="form-group">
                <label>お名前</label>
                <input type="text" name="name" placeholder="例：山田 太郎" value="{{ old('name') }}">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- メールアドレス --}}
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="例：coachtech1106">
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror

            </div>
            {{-- 登録ボタン --}}
            <div class="form-buttons">
                <button type="submit" class="register-btn">登録</button>
            </div>
        </form>
    </div>
@endsection
