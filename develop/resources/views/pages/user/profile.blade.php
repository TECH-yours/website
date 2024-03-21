@section('includes.header_meta')
    @include('includes.header_meta', ['page_title' => '商品列表'])
@endsection

@section('css')

@endsection

@extends('layouts.user')
@section('content')

<div class="col-12 mb-5" style="padding-top: 1em;">
    <h3 class="mt-3">基本資料</h3>      
    <hr>
    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-lg-3 d-flex flex-column align-items-center">
            <img class="userPicture" src="/images/user/_default.jpg" width="200" height="200" alt="User Profile photo" style="border-radius: 80px;">
            <hr>
            <p>註冊時間：<span id="user_created_at"></span></p>
        </div>
        <div class="col-12 col-lg-6 d-flex justify-content-start flex-wrap">
            <div class="col-12 form-group mb-3">
                <label for="username">Line 名稱</label>
                <input type="text" class="form-control mt-1 userName" id="" placeholder="" value="" disabled>
            </div>
            <div class="col-12 form-group mb-3">
                <label for="email">電子郵件</label>
                <input type="text" class="form-control mt-1 userEmail" id="email" placeholder="" value="" disabled>
            </div>
            <div class="col-12 form-group mb-3">
                <label for="name">真實姓名</label>
                <input type="text" class="form-control mt-1 user_name" id="name" placeholder="請輸入姓名" value="">
            </div>
            <div class="col-12 form-group mb-3">
                <label for="phone">手機</label>
                <input type="text" class="form-control mt-1 userPhone" id="phone" placeholder="請輸入連絡電話" value="">
            </div>
            <div class="col-12 form-group mb-3">
                <label for="birthday">生日</label>
                <input type="date" class="form-control mt-1 userBirthday" id="birthday" value="">
            </div>
            <div class="col-12 d-flex justify-content-end mt-5">
                <button type="button" class="btn btn-primary" id="save">更新資料</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('end_script')
<script src="/js/user/profile.min.js"></script>
@endsection
