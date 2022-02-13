@extends('admin.main')

@section('content')

    @include('admin.alert')

    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
    <!-- form start -->
    <form action="#" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên sản phẩm và số lượng</label><br>
                @foreach ($order->products as $key => $product)
                    {{ $product }}<br>Số lượng: {{ $order->quantity[$key] }}<br>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tổng giá trị đơn hàng:</label>
                        {{ number_format($order->total) }}đ
                    </div>
                </div>
            </div>

            <label>Phương thức thanh toán:</label>
            <div class="input-group mb-3">
                <select name="payment_method" id="payment_method" class="form-control">
                    <option value="credit_card" @if ($order->payment_method == 'credit_card') selected @endif>Thẻ tín dụng</option>
                    <option value="atm_card" @if ($order->payment_method == 'atm_card') selected @endif>Thẻ ATM nội địa</option>
                    <option value="cod" @if ($order->payment_method == 'cod') selected @endif>Thanh toán khi nhận hàng</option>
                </select>
            </div>

            <div id="credit_card" @if ($order->payment_method != 'credit_card')
                class="hidden"
            @endif>
                <div class="input-group mb-3">
                    <input type="text" name="credit_card_number" class="form-control" placeholder="Credit card number"
                        value="{{ $customer->credit_card_number }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-credit-card"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="number" name="cvv_code" class="form-control" placeholder="CVV code"
                        value="{{ $customer->cvv_code }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="date" name="expiration_date" class="form-control"
                        value="{{ $customer->expiration_date }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="credit_card_name" class="form-control" placeholder="Credit card name"
                        value="{{ $customer->credit_card_name }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="atm_card" @if ($customer->payment_method != 'atm_card')
                class="hidden"
            @endif>
                <div class="input-group mb-3">
                    <input type="text" name="atm_card_number" class="form-control" placeholder="ATM card number"
                        value="{{ $customer->atm_card_number }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-credit-card"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="bank_name" class="form-control" placeholder="Bank name"
                        value="{{ $customer->bank_name }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-university"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="atm_card_name" class="form-control" placeholder="ATM card name"
                        value="{{ $customer->atm_card_name }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật thông tin đơn hàng</button>
        </div>
    </form>

@endsection
