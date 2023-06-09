@section('includes.header_meta')
    @include('includes.header_meta', ['page_title' => 'Admin - 餐廳清單'])
@endsection

@section('css')
@endsection

@extends('layouts.admin')
@section('content')
    
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-12">
            <h3>餐廳清單</h3>
        </div>
    </div>
    <hr>
    <table id="TableList" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
            <th class="th-sm col-1">#</th>
            <th class="th-sm col-1">郵遞區號</th>
            <th class="th-sm col-3">餐廳名稱</th>
            <th class="th-sm col-2">餐廳數量</th>
            <th class="th-sm col-1">操作</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            <th class="th-sm col-1">#</th>
            <th class="th-sm col-1">area</th>
            <th class="th-sm col-3">name</th>
            <th class="th-sm col-2">餐廳數量</th>
            <th class="th-sm col-1">操作</th>
            </tr>
        </tfoot>

    </table>
</div>

<div class="modal fade" id="_modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="md-method">新增</span>餐廳 </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- tab -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a id="info-nav" class="nav-link active" data-toggle="tab" href="#info_tab">餐廳資訊</a>
                    </li>
                    <li class="nav-item com-detail">
                        <a id="meals-nav" class="nav-link" data-toggle="tab" href="#meals_tab">餐點資訊</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="info_tab">
                        <div class="d-flex flex-wrap">
                            <div class="col-12 col-lg-8">
                                <div class="form-group">
                                    <label class="col-form-label">餐廳名稱:</label>
                                    <input type="text" class="form-control" id="edit_name">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label">{{trans('dictionary.uploadImage')}}:</label>
                                    <input type="file" id="file" name='file'>
                                    <input type="hidden" id="filecount" value='0'>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="col-12 col-lg-2">
                                <div class="form-group">
                                    <label class="col-form-label">郵遞區號:</label>
                                    <input type="text" class="form-control" id="edit_area">
                                </div>
                            </div>
                            <div class="col-12 col-lg-10">
                                <div class="form-group">
                                    <label class="col-form-label">地址:</label>
                                    <input type="text" class="form-control" id="edit_address"  >
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="col-12 col-lg-5">
                                <div class="form-group">
                                    <label class="col-form-label">電話號碼:</label>
                                    <input type="text" class="form-control" id="edit_tel">
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="form-group">
                                    <label class="col-form-label">電子郵件:</label>
                                    <input type="text" class="form-control" id="edit_email"  >
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="col-form-label">Google 地圖連結:</label>
                                <input type="text" class="form-control" id="edit_google_map_url">
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">經度:</label>
                                    <input type="text" class="form-control" id="edit_lat">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="col-form-label">緯度:</label>
                                    <input type="text" class="form-control" id="edit_lng"  >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-success save-btn" data-action="add" data-loading-text="<span class='spinner-grow spinner-grow-sm'></span>" data-dismiss="modal">儲存</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="meals_tab">
                        <div class="d-flex flex-wrap">
                        <table class="col-12 table table-striped" id="meals-table">
                            <thead class=""><!-- thead-dark -->
                                <tr>
                                    <th class="col-2">#</th>
                                    <th class="col-7 text-left">餐點清單</th>
                                    <th class="col-3"> <button class="btn btn-primary" id="add-meal-btn">&emsp;新增&emsp;</button> </th>
                                </tr>
                            </thead>
                            <tbody id="meals-list"></tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger delete-btn" data-action="delete" data-loading-text="<span class='spinner-grow spinner-grow-sm'></span>">delete</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="meals-modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="md-method">新增</span>餐點 </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">類別:</label>
                        <select class="selectpicker col-12" data-size="5"  data-live-search="true" id="meal_category"  title="Choose one of the following...">
                            <option data-subtext="School" value="1" selected>Name</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">餐點名稱:</label>
                        <input type="text" class="form-control" id="meal_name">
                    </div>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-form-label">價錢:</label>
                            <input type="number" class="form-control" id="meal_price">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="col-form-label">熱量:</label>
                            <input type="number" class="form-control" id="meal_calorie" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">敘述:</label>
                        <textarea class="form-control" id="meal_description" rows="3"></textarea>
                    </div>
                </div>
                <!-- <div class="col-12">
                    <div class="form-group">
                        <label class="col-form-label">Allgery:</label>
                        <select class="selectpicker col-12" data-size="5"  data-live-search="true" data-actions-box="true" id="edit_allgery"  title="Choose one of the following..." multiple>
                            <option data-content="<span class='badge badge-success'>甲殼類</span>">甲殼類</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success save-meals-btn" data-action="add" data-loading-text="<span class='spinner-grow spinner-grow-sm'></span>" data-dismiss="modal">儲存</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('end_script')
<script src="/js/admin/restaurant.min.js"></script>
@endsection