@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Customer ID</th>
                <th>Phương thức thanh toán</th>
                <th>Gửi mail xác nhận</th>
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
                    <td>{{ $order['customer_id'] }}</td>
                    <td>{{ $order['payment_method'] }}</td>
                    {{-- <td>{!! App\Helpers\Helper::active($order['status'], 'order', $order['id']) !!}</td> --}}
                    <td>
                        @if ($order['status'] == 0)
                            <span class="badge badge-danger product-active-btn" onclick="sendOrderMail({{ $order['id'] }})"
                                style="cursor: pointer">Chưa gửi</span>
                        @else
                            <span class="badge badge-success product-active-btn">Đã gửi</span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/{{ $order['id'] }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onclick="removeRow({{ $order['id'] }}, '/admin/order/destroy')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
