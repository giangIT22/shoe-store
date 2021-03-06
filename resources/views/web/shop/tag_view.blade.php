@extends('layouts.guest')

@php
$minDate = \Carbon\Carbon::now()->subDays(15);
@endphp

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Home</a></li>/
                    <li><a href="#">Tag</a></li>/
                    <li class='active'>{{ request()->tag_name }}</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row'>
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('partitions.web.sidebar')
                    <!-- /.side-menu -->
                    <!-- ================================== TOP NAVIGATION : END ================================== -->
                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">

                            <!-- ============================================== PRICE SILDER============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h4 class="widget-title">GIÁ SẢN PHẨM</h4>
                                </div>
                                <form action="{{ route('product.tag', ['tag_name' => request('tag_name')]) }}"
                                    class="filter-price" method="get">
                                    <ul class="list-value">
                                        <li class="filter-item">
                                            <span>
                                                <label>
                                                    <input type="radio" name="filter_value" value="<500000"
                                                        {{ request('filter_value') == '<500000' ? 'checked' : '' }}>
                                                    Giá dưới 500.000 vnd
                                                </label>
                                            </span>
                                        </li>

                                        <li class="filter-item">
                                            <span>
                                                <label>
                                                    <input type="radio" name="filter_value" value="500000-1000000"
                                                        {{ request('filter_value') == '500000-1000000' ? 'checked' : '' }}>
                                                    500.000 vnd - 1.000.000 vnd
                                                </label>
                                            </span>
                                        </li>

                                        <li class="filter-item">
                                            <span>
                                                <label>
                                                    <input type="radio" name="filter_value" value="1000000-2000000"
                                                        {{ request('filter_value') == '1000000-2000000' ? 'checked' : '' }}>
                                                    1.000.000 vnd - 2.000.000 vnd
                                                </label>
                                            </span>
                                        </li>

                                        <li class="filter-item">
                                            <span>
                                                <label>
                                                    <input type="radio" name="filter_value" value="2000000-3000000"
                                                        {{ request('filter_value') == '2000000-3000000' ? 'checked' : '' }}>
                                                    2.000.000 vnd - 3.000.000 vnd
                                                </label>
                                            </span>
                                        </li>

                                        <li class="filter-item">
                                            <span>
                                                <label>
                                                    <input type="radio" name="filter_value" value=">3000000"
                                                        {{ request('filter_value') == '>3000000' ? 'checked' : '' }}>
                                                    Giá trên 3.000.000 vnd
                                                </label>
                                            </span>
                                        </li>
                                    </ul>
                                    <!-- /.price-range-holder -->
                                    <button class="lnk btn btn-primary">Show Now</button>
                                </form>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== PRICE SILDER : END ============================================== -->
                            <!-- ============================================== PRODUCT TAGS ============================================== -->
                            <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs">
                                <h3 class="section-title">Product tags</h3>
                                <div class="sidebar-widget-body outer-top-xs">
                                    <div class="tag-list">
                                        @foreach ($productTags as $tag)
                                            <a class="item {{ $tag->name == request()->tag_name ? 'active' : '' }}"
                                                href="{{ route('product.tag', ['tag_name' => $tag->name]) }}">
                                                {{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                    <!-- /.tag-list -->
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-filter -->
                    </div>
                    <!-- /.sidebar-module-container -->
                </div>
                <!-- /.sidebar -->
                <div class='col-md-9'>
                    @php
                        $slider = DB::table('sliders')->first();
                    @endphp
                    <div id="category" class="category-carousel hidden-xs">
                        <div class="item">
                            <div class="image"> <img src="{{ $slider->slider_image }}" alt=""
                                    class="img-responsive"> </div>
                        </div>
                    </div>


                    <div class="clearfix filters-container m-t-10">
                        <div class="row">
                            <div class="col col-sm-6 col-md-2">
                                <div class="filter-tabs">
                                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                    class="icon fa fa-th-large"></i>Grid</a> </li>
                                        <li><a data-toggle="tab" href="#list-container"><i
                                                    class="icon fa fa-th-list"></i>List</a></li>
                                    </ul>
                                </div>
                                <!-- /.filter-tabs -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-12 col-md-6">
                                <div class="col col-sm-3 col-md-6 no-padding">
                                    <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                    Tùy chọn <span class="caret"></span> </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation">
                                                        <a
                                                            href="{{ route(
                                                                'product.tag',
                                                                array_merge(request()->query(), [
                                                                    'tag_name' => request('tag_name'),
                                                                    'sort' => 0,
                                                                ]),
                                                            ) }}">Giá:
                                                            tăng dần</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a
                                                            href="{{ route(
                                                                'product.tag',
                                                                array_merge(request()->query(), [
                                                                    'tag_name' => request('tag_name'),
                                                                    'sort' => 1,
                                                                ]),
                                                            ) }}">Giá:
                                                            giảm dần</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /.fld -->
                                    </div>
                                    <!-- /.lbl-cnt -->
                                </div>
                                {{-- <!-- /.col -->
                <div class="col col-sm-3 col-md-6 no-padding">
                  <div class="lbl-cnt"> <span class="lbl">Show</span>
                    <div class="fld inline">
                      <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                        <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1 <span class="caret"></span> </button>
                        <ul role="menu" class="dropdown-menu">
                          <li role="presentation"><a href="#">1</a></li>
                          <li role="presentation"><a href="#">2</a></li>
                          <li role="presentation"><a href="#">3</a></li>
                          <li role="presentation"><a href="#">4</a></li>
                          <li role="presentation"><a href="#">5</a></li>
                          <li role="presentation"><a href="#">6</a></li>
                          <li role="presentation"><a href="#">7</a></li>
                          <li role="presentation"><a href="#">8</a></li>
                          <li role="presentation"><a href="#">9</a></li>
                          <li role="presentation"><a href="#">10</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.fld --> 
                  </div>
                  <!-- /.lbl-cnt --> 
                </div>
                <!-- /.col --> --}}
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-6 col-md-4 text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        <li class="prev"><a
                                                href="{{ route(
                                                    'product.tag',
                                                    array_merge(request()->query(), [
                                                        'tag_name' => request()->tag_name,
                                                        'page' => $currentPage == 1 ? $currentPage : $currentPage - 1,
                                                    ]),
                                                ) }}">
                                                <i class="fa fa-angle-left"></i></a></li>
                                        @for ($i = 1; $i <= $lastPage; $i++)
                                            <li class="{{ $i == $currentPage ? 'active' : '' }}"><a
                                                    href="{{ route(
                                                        'product.tag',
                                                        array_merge(request()->query(), [
                                                            'tag_name' => request()->tag_name,
                                                            'page' => $i,
                                                        ]),
                                                    ) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="next"><a
                                                href="{{ route(
                                                    'product.tag',
                                                    array_merge(request()->query(), [
                                                        'tag_name' => request()->tag_name,
                                                        'page' => $currentPage == $lastPage ? $lastPage : $currentPage + 1,
                                                    ]),
                                                ) }} "><i
                                                    class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row">
                                        {{-- item --}}
                                        @foreach ($products as $product)
                                            <div class="col-sm-6 col-md-4 wow fadeInUp">
                                                <div class="products">
                                                    <div class="product">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a
                                                                    href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}">
                                                                    <img height="249px;"
                                                                        src="{{ asset($product->image) }}"
                                                                        alt=""></a>
                                                            </div>
                                                            @if ($product->created_at > $minDate && $product->created_at < now())
                                                                <div class="tag new"><span>new</span></div>
                                                            @endif
                                                        </div>
                                                        <div class="product-info text-left">
                                                            <h3 class="name"><a
                                                                    href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}">{{ $product->name }}</a>
                                                            </h3>
                                                            @include('partitions.web.rating', [
                                                                'productId' => $product->id,
                                                            ])
                                                            <div class="description"></div>
                                                            <div class="product-price">
                                                                @if ($product->sale_price)
                                                                    <span class="price">
                                                                        {{ number_format($product->sale_price) }}
                                                                        đ</span>
                                                                    <span
                                                                        class="price-before-discount">{{ number_format($product->product_price) }}
                                                                        đ</span>
                                                                @else
                                                                    <span
                                                                        class="price">{{ number_format($product->product_price) }}
                                                                        đ</span>
                                                                @endIf
                                                            </div>
                                                        </div>
                                                        <div class="cart clearfix animate-effect fix-style">
                                                            <div class="action">
                                                                <ul class="list-unstyled">
                                                                    <li class="add-cart-button btn-group">
                                                                        <a href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}"
                                                                            data-toggle="tooltip"
                                                                            class="btn btn-primary icon" type="button"
                                                                            data-original-title="" title=""> <i
                                                                                class="fa fa-shopping-cart"></i>
                                                                            Tùy
                                                                            chọn</a>
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
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane " id="list-container">
                                <div class="category-product">
                                    <div class="category-product-inner wow fadeInUp">
                                        @foreach ($products as $product)
                                            <div class="products">
                                                <div class="product-list product">
                                                    <div class="row product-list-row">
                                                        <div class="col col-sm-4 col-lg-4">
                                                            <div class="product-image">
                                                                <div class="image"> <img height="249px;"
                                                                        src="{{ asset($product->image) }}"
                                                                        alt=""> </div>
                                                            </div>
                                                            <!-- /.product-image -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col col-sm-8 col-lg-8">
                                                            <div class="product-info">
                                                                <h3 class="name fix-lh"><a
                                                                        href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}">{{ $product->name }}</a>
                                                                </h3>
                                                                @include('partitions.web.rating', [
                                                                    'productId' => $product->id,
                                                                ])
                                                                <div class="product-price">
                                                                    @if ($product->sale_price)
                                                                        <span class="price">
                                                                            {{ number_format($product->sale_price) }}
                                                                            đ</span>
                                                                        <span
                                                                            class="price-before-discount">{{ number_format($product->product_price) }}
                                                                            đ</span>
                                                                    @else
                                                                        <span
                                                                            class="price">{{ number_format($product->product_price) }}
                                                                            đ</span>
                                                                    @endIf
                                                                </div>
                                                                <div class="description m-t-10">
                                                                    {{ $product->description }}</div>
                                                                <div class="cart clearfix animate-effect">
                                                                    <div class="action">
                                                                        <ul class="list-unstyled">
                                                                            <li class="add-cart-button btn-group">
                                                                                <a href="{{ route('product.detail', ['product_id' => $product->id, 'slug' => $product->product_slug]) }}"
                                                                                    data-toggle="tooltip"
                                                                                    class="btn btn-primary icon"
                                                                                    type="button" data-original-title=""
                                                                                    title=""> <i
                                                                                        class="fa fa-shopping-cart"></i>
                                                                                    Tùy
                                                                                    chọn</a>
                                                                            </li>
                                                                            <li class="lnk"> <a data-toggle="tooltip"
                                                                                    class="add-to-cart preview-product"
                                                                                    id="11" data-original-title=""
                                                                                    title="">
                                                                                    <i class="fa fa-eye"
                                                                                        aria-hidden="true"></i>
                                                                                </a> </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($product->created_at > $minDate && $product->created_at < now())
                                                        <div class="tag new"><span>new</span></div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                        <div class="clearfix filters-container">
                            <div class="text-right">
                                <div class="pagination-container">
                                    <ul class="list-inline list-unstyled">
                                        <li class="prev"><a
                                                href="{{ route(
                                                    'product.tag',
                                                    array_merge(request()->query(), [
                                                        'tag_name' => request()->tag_name,
                                                        'page' => $currentPage == 1 ? $currentPage : $currentPage - 1,
                                                    ]),
                                                ) }}">
                                                <i class="fa fa-angle-left"></i></a></li>
                                        @for ($i = 1; $i <= $lastPage; $i++)
                                            <li class="{{ $i == $currentPage ? 'active' : '' }}"><a
                                                    href="{{ route(
                                                        'product.tag',
                                                        array_merge(request()->query(), [
                                                            'tag_name' => request()->tag_name,
                                                            'page' => $i,
                                                        ]),
                                                    ) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="next"><a
                                                href="{{ route(
                                                    'product.tag',
                                                    array_merge(request()->query(), [
                                                        'tag_name' => request()->tag_name,
                                                        'page' => $currentPage == $lastPage ? $lastPage : $currentPage + 1,
                                                    ]),
                                                ) }} "><i
                                                    class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /.pagination-container -->
                            </div>
                            <!-- /.text-right -->

                        </div>
                        <!-- /.filters-container -->

                    </div>
                    <!-- /.search-result-container -->

                </div>
                <!-- /.col -->
            </div>

        </div>
        <!-- /.body-content -->
    @endsection
