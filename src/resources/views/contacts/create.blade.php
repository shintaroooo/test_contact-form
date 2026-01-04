@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('page_title', 'Contact')

@section('content')
    <div class="contact-form">
        <form action="{{ route('contacts.confirm') }}" method="post">
            @csrf
            {{-- お名前 --}}
            <div class="form-group">
                <label>お名前 <span class="required">※</span></label>
                <div class="name-inputs">
                    <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                </div>
                <div class="form-error">
                    @error('last_name')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-error">
                    @error('first_name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- 性別 --}}
            <div class="form-group">
                <label>性別 <span class="required">※</span></label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                        男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                        女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                        その他</label>
                </div>
                <div class="form-error">
                    @error('gender')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            {{-- メールアドレス --}}
            <div class="form-group">
                <label>メールアドレス <span class="required">※</span></label>
                <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                <div class="form-error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            {{-- 電話番号 --}}
            <div class="form-group">
                <label>電話番号 <span class="required">※</span></label>
                <div class="tel-inputs">
                    <input type="text" name="tel1" placeholder="0000" maxlength="5" value="{{ old('tel1') }}">
                    -
                    <input type="text" name="tel2" placeholder="1234" maxlength="5" value="{{ old('tel2') }}">
                    -
                    <input type="text" name="tel3" placeholder="5678" maxlength="5" value="{{ old('tel3') }}">
                </div>
                <div class="form-error">
                    @error('tel1')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-error">
                    @error('tel2')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-error">
                    @error('tel3')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- 住所 --}}
            <div class="form-group">
                <label>住所 <span class="required">※</span></label>
                <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                <div class="form-error">
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            {{-- 建物名 --}}
            <div class="form-group">
                <label>建物名</label>
                <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>

            {{-- お問い合わせの種類 --}}
            <div class="form-group">
                <label>お問い合わせの種類 <span class="required">※</span></label>
                <select name="category_id">
                    <option value="">選択してください</option>
                    <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
                    <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
                    <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="5" {{ old('category_id') == 5 ? 'selected' : '' }}>その他</option>
                </select>
                <div class="form-error">
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            {{-- お問い合わせ内容 --}}
            <div class="form-group">
                <label>お問い合わせ内容 <span class="required">※</span></label>
                <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                <div class="form-error">
                    @error('detail')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            {{-- ボタン --}}
            <div class="form-buttons">
                <button type="submit">確認画面</button>
            </div>
        </form>
    </div>
@endsection
