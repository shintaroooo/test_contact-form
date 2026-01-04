@extends('layouts.app')

@section('no_header', true)
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('page_title', '')

@section('content')
    <div class="thanks-wrapper">
        <div class="thanks-background">Thank you</div>

        <div class="thanks-container">
            <p class="thanks-message">お問い合わせありがとうございました</p>

            <div class="form-buttons">
                <a href="{{ route('contacts.create') }}" class="thanks-button">HOME</a>
            </div>
        </div>
    </div>
@endsection
