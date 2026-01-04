@extends('layouts.admin-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection

@section('page_title', 'Reset')

@section('content')
    <div class="reset-wrapper">
        <p class="reset-message">
            検索結果をリセットしました
        </p>

        <div class="reset-buttons">
            <a href="{{ route('admin.index') }}" class="btn-back">
                TOPに戻る
            </a>
        </div>
    </div>
@endsection
