@extends('layouts.admin', ['titlePage' => 'Cập nhật thông tin danh mục con'])

@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="box-title">Cập nhật danh mục con</h3>
                                <a href="{{ route('all.sub_categories') }}" type="button"
                                    class="btn btn-rounded btn-primary mb-5">Quay lại</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="post"
                                    action="{{ route('sub_category.update', ['sub_category_id' => $subCategory->id]) }}">
                                    @csrf
                                    <div class="form-group mb-20">
                                        <h5>Lựa chọn danh mục<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" id="select" class="form-control">
                                                <option value="">Select category</option>
                                                @foreach ($categories as $category)
                                                    @if (old('category_id', $subCategory->category->id) == $category->id)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-20">
                                        <h5>Tên<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="sub_category_name" class="form-control"
                                                value="{{ old('sub_category_name', $subCategory->sub_category_name) }}">
                                            @error('sub_category_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-20">
                                        <h5>Slug <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="sub_category_slug" class="form-control"
                                                value="{{ old('sub_category_slug', $subCategory->sub_category_slug) }}">
                                            @error('sub_category_slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
@endsection
