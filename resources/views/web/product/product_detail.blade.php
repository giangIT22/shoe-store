@extends('layouts.guest', ['titlePage' => $productDetail->name])
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Home</a></li>/
                    <li><a
                            href="{{ route('category.index', ['category_slug' => $productDetail->category->slug, 'category_id' => $productDetail->category_id]) }}">{{ $productDetail->category->name }}</a>
                    </li>/
                    <li class='active'>{{ $productDetail->name }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <!-- ============================================== HOT DEALS ============================================== -->
                        <div class="sidebar-widget hot-deals wow fadeInUp">
                            <h3 class="section-title">hot deals</h3>
                            <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
                                @foreach ($hotDealProducts as $product)
                                    <div class="item">
                                        <div class="products">
                                            <div class="hot-deal-wrapper">
                                                <div class="image">
                                                    <img src="{{ asset($product->image) }}" alt="">
                                                </div>
                                                <div class="sale-offer-tag">
                                                    <span>{{ round(100 - ($product->sale_price / $product->product_price) * 100) }}%<br>off</span>
                                                </div>

                                            </div><!-- /.hot-deal-wrapper -->

                                            <div class="product-info text-left m-t-20">
                                                <h3 class="name">
                                                    <a
                                                        href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                </h3>
                                                @include('partitions.web.rating', [
                                                    'productId' => $product->id,
                                                ])

                                                <div class="product-price">
                                                    @if ($product->sale_price)
                                                        <span class="price">
                                                            {{ number_format($product->sale_price) }} ??</span>
                                                        <span
                                                            class="price-before-discount">{{ number_format($product->product_price) }}
                                                            ??</span>
                                                    @else
                                                        <span class="price">{{ number_format($product->product_price) }}
                                                            ??</span>
                                                    @endIf

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div><!-- /.sidebar-widget -->
                        </div>
                        <!-- ============================================== HOT DEALS: END ============================================== -->

                        <!-- ============================================== NEWSLETTER ============================================== -->
                        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                            <h4 class="section-title" style="font-size: 13px">????NG K?? NH???N TIN KHUY???N M??I
                                </h3>
                                <div class="sidebar-widget-body outer-top-xs">
                                    <form>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Nh???p email c???a b???n">
                                        </div>
                                        <button class="btn btn-primary">????ng k??</button>
                                    </form>
                                </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">
                                    <div id="owl-single-product">
                                        @foreach ($multiImages as $image)
                                            <div class="single-product-gallery-item" id="slide{{ $image->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                    href="{{ asset($image->image_path) }}">
                                                    <img class="img-responsive" alt=""
                                                        src="{{ asset($image->image_path) }}"
                                                        data-echo="{{ asset($image->image_path) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach
                                    </div><!-- /.single-product-slider -->

                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            @foreach ($multiImages as $image)
                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                        data-slide="{{ $image->id }}" href="#slide{{ $image->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                            src="{{ asset($image->image_path) }}"
                                                            data-echo="{{ asset($image->image_path) }}" />
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div><!-- /#owl-single-product-thumbnails -->
                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">{{ $productDetail->name }}</h1>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                @include('partitions.web.rating', [
                                                    'productId' => $productDetail->id,
                                                ])
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#"
                                                        class="lnk">({{ $reviews ? $reviews->count() : 0 }}
                                                        ????nh gi??)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">T??nh tr???ng :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span
                                                        class="value">{{ $productDetail->product_qty > 0 ? 'C??n h??ng' : 'H???t h??ng' }}</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        {{ $productDetail->description }}
                                    </div><!-- /.description-container -->
                                    {{-- choose size product --}}
                                    <div class="product-size">
                                        <label class="title-size">Size</label>
                                        <select class="list-size-product" name="size_id">
                                            <option>Ch???n k??ch th?????c</option>
                                            @foreach ($sizes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($productDetail->sale_price)
                                                        <span
                                                            class="price">{{ number_format($productDetail->sale_price) }}
                                                            ??</span>
                                                        <span
                                                            class="price-before-discount">{{ number_format($productDetail->product_price) }}??</span>
                                                    @else
                                                        <span
                                                            class="price">{{ number_format($productDetail->product_price) }}??</span>
                                                    @endIf
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <input type="hidden" value="{{ $productDetail->id }}" class="product_id">
                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" value="1" id="qty_product">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-7">
                                                <button class="btn btn-primary add-cart-product" style="outline: none"
                                                    disabled>
                                                    <i class="fa fa-shopping-cart inner-right-vs"></i> Th??m v??o gi??? h??ng
                                                </button>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->

                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">{{ $productDetail->description }}</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">

                                                    @if (empty($reviews))
                                                    @else
                                                        @foreach ($reviews as $review)
                                                            <div class="review">

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <img style="border-radius: 50%"
                                                                            src="{{ $review->user->profile_photo_path ? asset($review->user->profile_photo_path) : asset('frontend/assets/images/no-image.jpg') }}"
                                                                            width="40px;" height="40px;">
                                                                        <b
                                                                            style="margin-right: 10px;">{{ $review->user->name }}</b>


                                                                        @if ($review->rating == null)
                                                                        @elseif($review->rating == 1)
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                        @elseif($review->rating == 2)
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                        @elseif($review->rating == 3)
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                        @elseif($review->rating == 4)
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-unchecked"></span>
                                                                        @elseif($review->rating == 5)
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                            <span class="fa fa-star star-checked"></span>
                                                                        @endif

                                                                    </div>

                                                                    <div class="col-md-6">

                                                                    </div>
                                                                </div> <!-- // end row -->



                                                                <div class="review-title"><span class="date"><i
                                                                            class="fa fa-calendar"></i><span>
                                                                            {{ $review->created_at->toDateTimeString() }}
                                                                        </span></span></div>
                                                                <div class="text">"{{ $review->comment }}"
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->



                                            <div class="product-add-review">
                                                <h4 class="title">Vi???t ????nh gi?? c???a b???n</h4>
                                                <div class="review-table">

                                                </div><!-- /.review-table -->

                                                <div class="review-form">
                                                    @guest
                                                        <p> <b>????? th??m ????nh gi?? s???n ph???m b???n c???n ph???i :<a
                                                                    href="{{ route('user.login') }}"> ????ng nh???p</a> </b>
                                                        </p>
                                                    @else
                                                        <div class="form-container">

                                                            <form role="form" class="cnt-form">

                                                                <input type="hidden" class="review_product_id"
                                                                    value="{{ $productDetail->id }}">

                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="cell-label">&nbsp;</th>
                                                                            <th>1 stars</th>
                                                                            <th>2 stars</th>
                                                                            <th>3 stars</th>
                                                                            <th>4 stars</th>
                                                                            <th>5 stars</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="cell-label">Ch???t l?????ng</td>
                                                                            <td><input type="radio" name="quality"
                                                                                    class="radio" value="1"></td>
                                                                            <td><input type="radio" name="quality"
                                                                                    class="radio" value="2"></td>
                                                                            <td><input type="radio" name="quality"
                                                                                    class="radio" value="3"></td>
                                                                            <td><input type="radio" name="quality"
                                                                                    class="radio" value="4"></td>
                                                                            <td><input type="radio" name="quality"
                                                                                    class="radio" value="5"></td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>

                                                                <div class="row">

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">????nh gi??<span
                                                                                    class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4"
                                                                                placeholder="Nh???p n???i dung ????nh gi?? c???a b???n v??? s???n ph???m"></textarea>
                                                                            <span class="text-danger review-error"></span>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-upper btn-add-review">G???i
                                                                        ????nh gi??</button>
                                                                </div><!-- /.action -->

                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->

                                                    @endguest


                                                </div><!-- /.review-form -->

                                            </div><!-- /.product-add-review -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== related PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">S???n ph???m li??n quan</h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                            @foreach ($relatedProducts as $item)
                                <div class="item item-carousel">
                                    <div class="products">

                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a
                                                        href="{{ route('product.detail', ['product_id' => $item->id, 'slug' => $item->product_slug]) }}"><img
                                                            src="{{ $item->image }}" alt=""></a>
                                                </div><!-- /.image -->

                                                {{-- <div class="tag sale"><span>sale</span></div> --}}
                                            </div><!-- /.product-image -->


                                            <div class="product-info text-left">
                                                <h3 class="name"><a
                                                        href="{{ route('product.detail', ['product_id' => $item->id, 'slug' => $item->product_slug]) }}">{{ $item->name }}</a>
                                                </h3>
                                                @include('partitions.web.rating', [
                                                    'productId' => $item->id,
                                                ])
                                                <div class="description"></div>

                                                <div class="product-price">
                                                    @if ($item->sale_price)
                                                        <span class="price">{{ number_format($item->sale_price) }}
                                                            VND</span>
                                                        <span
                                                            class="price-before-discount">{{ number_format($item->product_price) }}
                                                            VND</span>
                                                    @else
                                                        <span class="price">{{ number_format($item->product_price) }}
                                                            VND</span>
                                                    @endIf

                                                </div><!-- /.product-price -->

                                            </div><!-- /.product-info -->
                                            <div class="cart clearfix animate-effect fix-style">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <a href="{{ route('product.detail', ['product_id' => $item->id, 'slug' => $item->product_slug]) }}"
                                                                data-toggle="tooltip"
                                                                class="btn btn-primary icon" type="button"
                                                                data-original-title="" title=""> <i
                                                                    class="fa fa-shopping-cart"></i>
                                                                T??y
                                                                ch???n</a>
                                                        </li>
                                                        <li class="lnk"> <a data-toggle="tooltip"
                                                                class="add-to-cart preview-product"
                                                                id="11" data-original-title=""
                                                                title="">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- /.product -->

                                    </div><!-- /.products -->
                                </div><!-- /.item -->
                            @endforeach
                        </div>
                    </section>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection

@push('css')
    <style>
        .description-container {
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            display: -webkit-box;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('/js/add_to_cart.js') }}"></script>
    <script src="{{ asset('/js/add_review_product.js') }}"></script>
    <script>
        let i = 1;
        let qtyProduct = document.querySelector('#qty_product');
        let plus = document.querySelector('.plus');
        let minus = document.querySelector('.minus');

        plus.addEventListener('click', function() {
            ++i;
            qtyProduct.value = i;
        });

        minus.addEventListener('click', function() {
            --i;
            if (i < 1) {
                qtyProduct.value = 1;
                i = 1;
            } else {
                qtyProduct.value = i;
            }

        });
    </script>
@endpush
