@extends('layouts.guest')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>/
                    <li class='active'>Giỏ hàng</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row cart">
                @if ($productsInCart)
                    <div class="shopping-cart">
                        <div class="shopping-cart-table ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-description item">Ảnh sản phẩm </th>
                                            <th class="cart-product-name item">Tên sản phầm</th>
                                            <th class="cart-qty item">Đơn giá</th>
                                            <th class="cart-qty item">Số lượng</th>
                                            <th class="cart-sub-total item">Thành tiền</th>
                                            <th class="cart-romove item">Xóa</th>
                                        </tr>
                                    </thead><!-- /thead -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="shopping-cart-btn">
                                                    <span class="">
                                                        <a href="{{ route('index') }}"
                                                            class="btn btn-upper btn-primary outer-left-xs">Tiếp tục
                                                            mua hàng</a>
                                                    </span>
                                                </div><!-- /.shopping-cart-btn -->
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($productsInCart as $product)
                                            <tr>
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail"
                                                        href="{{ route('product.detail', ['product_id' => $product['id']]) }}">
                                                        <img src="{{ asset($product['product_image']) }}" alt="">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'>
                                                        <a
                                                            href="{{ route('product.detail', ['product_id' => $product['id']]) }}">{{ $product['product_name'] }}</a>
                                                    </h4>

                                                    <div class="cart-product-info">
                                                        <span
                                                            class="product-size">Size:<span>{{ $product['product_size'] }}</span></span>
                                                        <span
                                                            class="product-color">Color:<span>{{ $product['product_color'] }}</span></span>
                                                    </div>
                                                </td>
                                                <td class="cart-product-sub-total"><span
                                                        class="cart-sub-total-price">{{ number_format($product['product_price'], 0, '', '.') }}&nbsp;VND</span>
                                                <td class="cart-product-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient qty-plus"
                                                                id="{{ $product['id'] . '-' . $product['size_id'] . '-' . $product['color_id'] }}">
                                                                <span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient qty-minus"
                                                                id="{{ $product['id'] . '-' . $product['size_id'] . '-' . $product['color_id'] }}">
                                                                <span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                            <input type="hidden" id="item-cart"
                                                                value="{{ $product['id'] }}">
                                                        </div>
                                                        <input disabled="true" type="text"
                                                            value="{{ $product['amount'] }}" class="qty-input"
                                                            id="qty-input-{{ $product['id'] . '-' . $product['size_id'] . '-' . $product['color_id'] }}">
                                                    </div>
                                                </td>
                                                <td class="cart-product-sub-total"><span class="cart-sub-total-price"
                                                        id="sum-{{ $product['id'] . '-' . $product['size_id'] . '-' . $product['color_id'] }}">{{ number_format($product['product_price'] * $product['amount'], 0, '', '.') }}&nbsp;VND</span>
                                                </td>
                                                <td class="romove-item"><a href="#" title="cancel"
                                                        id="cancel{{ $product['id'] . '-' . $product['size_id'] . '-' . $product['color_id'] }}"
                                                        class="icon cart-cancel"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->
                            </div>
                        </div><!-- /.shopping-cart-table -->
                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            
                        </div><!-- /.estimate-ship-tax -->

                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            
                        </div><!-- /.estimate-ship-tax -->

                        @php
                            $sumTotal = 0;
                            
                            foreach ($productsInCart as $product) {
                                $sumTotal += $product['product_price'] * $product['amount'];
                            }
                            
                        @endphp
                        <div class="col-md-4 col-sm-12 cart-shopping-total">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="cart-grand-total">
                                                Tổng tiền<span
                                                    class="inner-left-md">{{ number_format($sumTotal, 0, '', '.') }}&nbsp;VND</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead><!-- /thead -->
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="cart-checkout-btn pull-right">
                                                <a href="{{ route('checkout.create') }}"
                                                    class="btn btn-primary checkout-btn">Thực hiện thanh toán</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody><!-- /tbody -->
                            </table><!-- /table -->
                        </div><!-- /.cart-shopping-total -->
                    </div><!-- /.shopping-cart -->
                @else
                    <div class="not-cart">
                        <h1>Giỏ hàng</h2>
                            <h4>Không có sản phẩm nào trong giỏ hàng. Quay lại cửa hàng để tiếp tục mua sắm.</p>
                    </div>
                @endif
            </div> <!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
