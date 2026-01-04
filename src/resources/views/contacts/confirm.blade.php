@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('page_title', 'Confirm')

@section('content')
    <div class="confirm-box">
        <form action="{{ route('contacts.store') }}" method="post">
            @csrf
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @php
                            $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'][$contact['gender']];
                        @endphp
                        {{ $genderText }}
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $contact['email'] }}</td>
                    <input type="hidden" name="email" value="{{ $contact['email'] }}">
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $contact['tel1'] }}-{{ $contact['tel2'] }}-{{ $contact['tel3'] }}</td>
                    <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $contact['address'] }}</td>
                    <input type="hidden" name="address" value="{{ $contact['address'] }}">
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{ $contact['building'] }}</td>
                    <input type="hidden" name="building" value="{{ $contact['building'] }}">
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        @php
                            $categoryNames = [
                                1 => '商品のお届けについて',
                                2 => '商品の交換について',
                                3 => '商品トラブル',
                                4 => 'ショップへのお問い合わせ',
                                5 => 'その他',
                            ];
                        @endphp
                        {{ $categoryNames[$contact['category_id']] ?? '' }}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        {!! nl2br(e($contact['detail'])) !!}
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    </td>
                </tr>
            </table>

            {{-- ボタン --}}
            <div class="form-buttons">
                <button type="submit" name="action" value="submit">送信</button>
                <button type="submit" name="action" value="back">修正</button>
            </div>
        </form>
    </div>
@endsection
