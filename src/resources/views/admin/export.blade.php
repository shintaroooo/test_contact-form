@extends('layouts.admin-layout')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/export.css') }}">
@endsection

@section('page_title', 'Export')

@section('content')
    <div class="export-container">
        <p class="export-message">
            CSVファイルをエクスポートしました
        </p>

        <a href="{{ route('admin.search') }}" class="btn-back">
            検索結果画面に戻る
        </a>
    </div>
@endsection
