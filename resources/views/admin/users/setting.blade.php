@extends('admin.main')

@section('content')
    @include('admin.alert')
    <form action="#" method="POST">
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Name"
                value="{{ $user->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control"
                placeholder="Email" value="{{ $user->email }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="tel" name="phone" class="form-control" placeholder="Tel"
                value="{{ $user->phone }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="address" class="form-control"
                placeholder="Address" value="{{ $user->address }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="credit_card" @if ($user != null && $user->payment_method == 'credit_card')
                    selected="selected"
                    @endif>Thẻ tín dụng</option>
                <option value="atm_card" @if ($user != null && $user->payment_method == 'atm_card')
                    selected="selected"
                    @endif>Thẻ ATM nội địa</option>
                <option value="cod" @if ($user == null || $user->payment_method == 'cod')
                    selected="selected"
                    @endif>Thanh toán khi nhận hàng</option>
            </select>
        </div>

        <div @if (($user != null && $user->payment_method != 'credit_card') || $user == null)
            class="input-group hidden"
        @else
            class="input-group"
            @endif id="credit_card">
            <div class="input-group mb-3">
                <input class="form-control" type="text" name="credit_card_number"
                    value="{{ $user != null ? $user->credit_card_number : '' }}"
                    placeholder="Card number">
            </div>

            <div class="input-group mb-3" style="width: 70%;">
                <input type="date" name="expiration_date" placeholder="Expiration date"
                    value="{{ $user != null ? $user->expiration_date : '' }}"
                    class="form-control" />
            </div>

            <div class="input-group mb-3" style="width: 30%;">
                <input class="form-control" type="number" name="cvv_code"
                    value="{{ $user != null ? $user->cvv_code : '' }}" placeholder="CVV">
            </div>

            <div class="input-group mb-3">
                <input class="form-control" type="text" name="credit_card_name"
                    value="{{ $user != null ? $user->credit_card_name : '' }}" placeholder="Credit card name">
            </div>
        </div>

        <div @if (($user != null && $user->payment_method != 'atm_card') || $user == null)
            class="input-group hidden"
        @else
            class="input-group"
            @endif id="atm_card">
            <div class="input-group mb-3">
                <input class="form-control" type="text" name="atm_card_number"
                    value="{{ $user != null ? $user->atm_card_number : '' }}"
                    placeholder="Card number">
            </div>

            <div class="input-group mb-3">
                <input class="form-control" type="text" name="bank_name"
                    value="{{ $user != null ? $user->bank_name : '' }}" placeholder="Bank name">
            </div>

            <div class="input-group mb-3">
                <input class="form-control" type="text" name="atm_card_name"
                    value="{{ $user != null ? $user->atm_card_name : '' }}" placeholder="ATM card name">
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control"
                placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="re_password" class="form-control"
                placeholder="Retype Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
        </div>
        @csrf
    </form>
@endsection
