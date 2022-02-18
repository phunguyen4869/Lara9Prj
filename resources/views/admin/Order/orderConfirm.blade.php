@component('mail::message')
    # Order confirmed
Xin chào {{$customerName}},<br>
    Đơn hàng của bạn đã được ghi nhận!
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Số lượng</th>
            <th>Tổng giá trị đơn hàng</th>
            <th>Phương thức thanh toán</th>
            <th>Tên sản phẩm</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $orderID }}</td>
            <td>
                @foreach ($quantity as $quantity)
                    {{ $quantity }}<hr>
                @endforeach
            </td>
            <td>{{ $total }}</td>
            <td>
                @if ($payment_method == 'cod')
                    Thanh toán khi nhận hàng
                @elseif ($payment_method == 'atm_card')
                    Thanh toán qua thẻ ATM
                @elseif ($payment_method == 'credit_card')
                    Thanh toán qua thẻ tín dụng
                @endif
            </td>
            <td>
                @foreach ($products as $product)
                    {{ $product }}<hr>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>

    Thanks,
    {{ config('app.name') }}
@endcomponent
