@extends('layouts.admin-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/delete.css') }}">
@endsection

@section('page_title', 'Delete')

@section('content')
    <div class="delete-container">
        <div class="delete-message">
            <p>データを削除しました</p>
        </div>

        <div class="delete-actions">
            <a href="{{ route('admin.search') }}" class="btn-back">
                検索結果画面に戻る
            </a>
        </div>
    </div>
@endsection
