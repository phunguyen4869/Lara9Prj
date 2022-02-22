@extends('admin.main')

@section('content')
    @include('admin.alert')
    Bonk!!! {{ $name }} <br>
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    <h3>Danh sách đơn hàng:</h3>
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order['id'] }}</td>
                    <td>
                        @foreach ($order['products'] as $product)
                            {{ $product }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order['quantity'] as $quantity)
                            {{ $quantity }}<br>
                        @endforeach
                    </td>
                    <td>{{number_format($order['total']) }}</td>
                    <td>{{ $order['payment_method'] }}</td>
                    <td>
                        @if ($order['status'] == 0)
                            Chưa xác nhận
                        @elseif ($order['status'] == 1)
                            Đã xác nhận
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
