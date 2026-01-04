@extends('layouts.admin-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/logout.css') }}">
@section('page_title', 'Logout')

@section('content')
    <div class="auth-wrapper">
        <div class="logout-message">
            <p>ログアウトしました</p>

            <a href="{{ route('login') }}" class="btn-login">
                ログイン画面に戻る
            </a>
        </div>
    </div>
@endsection
