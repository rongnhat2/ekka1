@extends('admin.layout')
@section('title', 'Carousel')

@section('css') 
@endsection()


@section('body')

<div class="page-content">
    <div class="container-fluid">


        <!-- end page title -->

        <div class="row carousel-data">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-b-10">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="card-title">Danh mục Slider</h4>
                            </div> 
                        </div>
                        <div class="row m-b-10"> 
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group image-select-group">
                                    <div class="form-header">
                                        <label>Hình ảnh * ( nên lựa các ảnh có cùng kích cỡ: ví dụ 1920 x 768 ) </label>
                                        <label class="image-select" for="image_list"><i class="fas fa-upload m-r-10"></i>Chọn ảnh</label>
                                        <input type="file" class="form-control image-upload-label product-images" id="image_list" name="image_list[]" required="" accept="image/*" multiple="">
                                    </div>
                                    <div class="form-preview multi-upload">
                                    </div>
                                </div>
                                <button class="btn btn-primary push-data" atr="Create">
                                    <i class="anticon anticon-save"></i>
                                    <span>Lưu lại</span>
                                </button>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>

    </div> 
</div>
            
@endsection()
 
@section('js')

<script src="{{ asset('manager/assets/js/page/carousel.js') }}"></script>

@endsection()