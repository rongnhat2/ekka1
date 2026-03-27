@extends('admin.layout')
@section('title', 'Sản phẩm')

@section('css')
    <link href="{{ asset('manager/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection()


@section('body')

<div class="page-content">
    <div class="container-fluid">
        <div class="main-body">
            <div class="main-tab on-show" tab-name="Main">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="m-b-0">Sản phẩm</h4>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="align-justify-center">
                                    <a href="#" class="btn btn-default btn-sm flex-right main-tab-control" atr="Create">Sản phẩm<i class="fas fa-plus m-l-5"></i></a> 
                                </div>
                            </div>
                        </div>
                        <div class="m-t-25">
                            <table id="data-table" class="table"> </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-tab" tab-name="Create" id="tab-create">
                <div class="error-log"></div>
                <div class="page-header no-gutters has-tab">
                    <div class="d-md-flex m-b-15 align-items-center justify-content-between">
                        <div class="media align-items-center m-b-15">
                            <div class="m-l-15">
                                <h4 class="m-b-0" valid-appended="name-append"></h4>
                            </div>
                        </div>
                        <div class="m-b-15">
                            <button class="btn btn-primary push-data" atr="Create">
                                <i class="anticon anticon-save"></i>
                                <span>Lưu lại</span>
                            </button>
                            <button class="btn btn-defaul m-l-5 main-tab-close">
                                <span>Hủy</span>
                            </button>
                        </div>
                    </div> 
                </div>
                <div class="tab-content m-t-15">
                    <div class="tab-pane fade show active" id="product-edit-basic" >
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" class="data-id">
                                <div class="form-group">
                                    <label class="font-weight-semibold" for="productName">Tiêu đề</label>
                                    <input type="text" class="form-control data-title"   valid-data="valid-text" id="productName" placeholder="Tiêu đề" value="" >
                                    <div class="valid-data"></div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="productPrice">Mô tả ngắn</label>
                                            <textarea class="form-control data-description" name="description" placeholder="Mô tả ngắn" rows="20" required=""></textarea>
                                            <div class="valid-data"></div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 avatar-wrapper"> 
                                        <div class="form-group image-select-group">
                                            <div class="form-header">
                                                <label>Icon (220 x 220) </label>
                                                <label class="image-select" for="image-update"><i class="fas fa-search m-r-10"></i>Chọn ảnh</label>
                                                <input type="file" class="form-control image-input" id="image-update" name="image"  accept="image/*">
                                            </div>
                                            <div class="form-preview icon-preview form_1_1 data-image-preview" style="background-image: url('/manager/images_global/noimage.jpg');"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group summernote">
                                    <label class="font-weight-semibold" for="productPrice">Chi tiết</label>
                                    <textarea class="form-control data-detail " name="detail" placeholder="Mô tả đầy đủ" rows="4" required=""></textarea>
                                </div>    
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()


@section('sub_layout')
 
<div class="modal modal-right fade quick-view show" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-between align-items-center">
                <h5 class="modal-title"> </h5>
            </div>
            <div class="modal-body scrollable ps-container ps-theme-default">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal m-r-10" ></button>
                <button type="button" class="btn btn-primary push-modal" atr="Push"></button>
            </div>
        </div>
    </div>            
</div>

@endsection()

@section('js')
    
    <script src="{{ asset('manager/assets/js/page/news.js') }}"></script>

@endsection()