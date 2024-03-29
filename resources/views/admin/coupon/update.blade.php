@extends('layouts.admin', ['titlePage' => 'Cập nhật coupon'])
@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content col-md-12" style="margin: 0">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex justify-content-between">
                        <h3 class="box-title">Cập nhật mã giảm giá</h3>
                        <a href="{{ route('all.coupons') }}" type="button" class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('coupon.update', ['coupon_id' => $coupon->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group mb-30">
                                                    <h5>Mã Coupon<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="coupon_name" class="form-control" value="{{ $coupon->coupon_name }}">
                                                        @error('coupon_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-30">
                                                    <h5>Coupon Discount<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="coupon_discount" class="form-control" value="{{ $coupon->coupon_discount }}">
                                                        @error('coupon_discount')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-30">
                                                    <h5>Thời hạn mã giảm giá<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="date" name="coupon_validity" value="{{ $coupon->coupon_validity}}">
                                                        @error('coupon_validity')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-30">
                                                    <h5>Giá tối thiểu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="minimum_price" class="form-control" value="{{ $coupon->minimum_price }}">
                                                        @error('minimum_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 2nd row  -->

                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Cập nhật">
                                        </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
