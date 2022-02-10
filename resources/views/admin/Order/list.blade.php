@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái</th>
                <th width="10%">Action</th>
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
                    <td>{{ $order['total'] }}</td>
                    <td>{{ $order['payment_method'] }}</td>
                    <td>{!! App\Helpers\Helper::active($order['status']) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
