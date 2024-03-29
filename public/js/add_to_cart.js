$(document).ready(function() {

    $('.add-cart-product').click(function(e) {
        e.preventDefault();

        let productId = document.querySelector('.product_id').value;
        let amount = document.querySelector('#qty_product').value;

        let regex = /^\d+$/;
        console.log(regex.test(amount));
        if (!regex.test(amount)) {
            alert('Vui lòng nhập số lượng là số nguyên dương');
            $('#qty_product').val(1);
        } else {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: '/store-cart',
                data: {
                    'product_id': productId,
                    'amount': amount,
                    'size_id': $('.list-size-product').val(),
                    'color_id': $('.list-color-product').val()
                },
                success: function(response) {
                    count = 0;
                    sumPrice = 0;
                    console.log(response)
                    if (response.status) {
                        //Update box-cart
                        if (response.products.status == false) {
                            alert(`Sản phẩm này không còn đủ số lượng để đặt hàng. \nSố lượng sản phẩm này còn: ${response.products.amount}.`);
                            $('#qty_product').val(1);
                        } else {
                            let listProducts = response.products.map((product) => {
                                let priceProduct = product.product_price.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' });
                                return `<div class="row" style="margin-bottom: 10px;">
                                <div class="col-xs-4">
                                    <div class="image"> <a
                                            href="/product/detail/${product.product_id}"><img
                                                src="${product.product_image}"
                                                alt=""></a>
                                    </div>
                                </div>
                                <div class="col-xs-7">
                                    <h3 class="name"><a
                                            href="/product/detail/${product.product_id}">${product.product_name}</a>
                                    </h3>
                                    <div class="price">
                                        ${priceProduct}
                                    </div>
                                </div>
                            </div>`
                            });

                            let element = document.querySelector('.not-product');
                            if (element !== null) {
                                $('.not-product').remove();
                                $('.show-list-item-cart').after(`<ul class="dropdown-menu box-cart">
                                    <li>
                                        <div class="cart-item product-summary list-item-cart">
                                            ${listProducts.join(' ')}
                                        </div>
                                        <!-- /.cart-item -->
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="clearfix cart-total">
                                            <div class="pull-right"> <span class="text">Tổng tiền
                                                    :</span><span
                                                    class="price sum-price-product">{{ $sum ? number_format($sum, 0, '', '.') . ' vnd' : 0 }}</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <a href="/checkout"
                                                class="btn btn-upper btn-primary m-t-20 btn-block"
                                                style="font-size: 12px;">Tiến hành
                                                thanh toán</a>
                                            <a href="/cart/shopping-cart"
                                                class="btn btn-upper btn-primary m-t-20 btn-block">Giỏ hàng</a>
                                        </div>
                                        <!-- /.cart-total-->
        
                                    </li>
                                </ul>`);
                            } else {
                                $('.list-item-cart').html(listProducts.join(' '));
                            }

                            for (product of response.products) {
                                count += product.amount;
                                sumPrice += product.amount * product.product_price;
                            }

                            sumPrice = sumPrice.toLocaleString('it-IT', { style: 'currency', currency: 'vnd' });

                            document.querySelector('.basket-item-count').innerHTML = count;
                            document.querySelector('.total-price-basket .value').innerHTML = sumPrice;
                            $('.sum-price-product').text(sumPrice);
                            $('.show-notification').addClass('show-alert');

                            setTimeout(function() {
                                $('.show-notification').removeClass('show-alert');
                            }, 1000)
                            $('#qty_product').val(1);
                        }
                    } else {
                        window.location.href = '/login';
                    }
                }
            });
        }
    });
})