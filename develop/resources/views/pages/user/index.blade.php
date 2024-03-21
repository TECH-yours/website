@section('includes.header_meta')
    @include('includes.header_meta', ['page_title' => '會員中心'])
@endsection

@section('css')

@endsection

@extends('layouts.user')
@section('content')

<div class="col-12 d-flex flex-wrap" style="padding-top: 1em;">
    <div class="col-12 col-lg-6 mb-3">
        <div class="col-12" style="padding: 0 1em;">
            <div style="background: #bbb;">
                <div class="row"  style="padding: 0.3em;">
                    <h5>基本資料</h5>
                </div>
                <div class="bg-light d-flex flex-wrap"  style="padding: 1em 0.5em;">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <h5 class="mt-3"><span class="userName">姓名</span></h5>
                        <img class="userPicture" src="/img/user/_default.jpg" width="150" height="150" alt="User Profile photo" style="border-radius: 80px;">
                    </div>
                    <div class="col-12 col-sm-6 col-lg-8">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-secondary mx-3 userRole">New</span>
                            <a id="upgrade" href="#"><span class="badge bg-warning">立即升級VIP</span></a>
                        </div>
                        <div class="d-flex mt-3 mb-3 align-items-center">
                            <p class="col-4 mb-0">會員推薦碼：</p>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="code" aria-label="code" aria-describedby="button-addon2" disabled>
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2" disabled>Copy</button>
                            </div>
                        </div>
                        <div class="input-group mt-1">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control user_name" placeholder="（真實姓名）" aria-label="（真實姓名）" aria-describedby="basic-addon1" disabled>
                        </div>
                        <!-- <div class="input-group mt-1">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div> -->
                        <div class="input-group mt-1">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                            <input type="text" class="form-control userPhone" placeholder="（連絡電話）" aria-label="（連絡電話）" aria-describedby="basic-addon1" disabled>
                        </div>
                        <div class="input-group mt-1">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control userEmail" placeholder="（電子信箱）" aria-label="（電子信箱）" aria-describedby="basic-addon1" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mb-3">
        <div class="col-12" style="padding: 0 1em;">
            <div style="background: #bbb;">
                <div class="row"  style="padding: 0.3em;">
                    <h5>訂單查詢</h5>
                </div>
                <div class="bg-light d-flex flex-wrap"  style="padding: 1em 0.5em;">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>訂單編號</th>
                                <th>訂單日期</th>
                                <th>訂單狀態</th>
                                <th>訂單金額</th>
                            </tr>
                        </thead>
                        <tbody id="orders">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 d-flex flex-wrap" style="padding-top: 1em;">
    <div class="col-12 col-sm-6 col-lg-3 mb-3" style="padding: 0.5em; height:200px;">
        <div class="w-100 d-flex flex-column align-items-center justify-content-center" style="height:200px;background-color: #bbb; ">
            <p class="mb-3" style=""><span id="point_count" style="font-size: 3em;" >0</span>&emsp;點</p>
            <h5>會員點數</h5>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3 mb-3" style="padding: 0.5em; height:200px;">
        <div class="w-100 d-flex flex-column align-items-center justify-content-center" style="height:200px;background-color: #bbb; ">
            <p class="mb-3" ><span id="coupon_count" style="font-size: 3em;">-</span>&emsp;張</p>
            <h5>優惠卡券</h5>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3 mb-3" style="padding: 0.5em; height:200px;">
        <div    class="w-100 d-flex flex-column align-items-center justify-content-center" 
                style="height:200px;background-color: #bbb; "
                onClick=location.href="/user/wishlist">
            <p class="mb-3" style="font-size: 3em"><i class="text-warning fas fa-bolt fa-lg"></i></p>
            <h5>一鍵速訂</h5>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-3 mb-3" style="padding: 0.5em; height:200px;">
        <div    class="w-100 d-flex flex-column align-items-center justify-content-center" 
                style="height:200px;background-color: #bbb; "
                onClick=location.href="https://lin.ee/saDCWlq" target="_blank">
            <p class="mb-3" style="font-size: 3em"><i class="text-success fab fa-line fa-lg"></i></p>
            <h5>線上客服</h5>
        </div>
    </div>
</div>

@endsection

@section('end_script')
<script src="/js/user/dashboard.min.js"></script>
@endsection
