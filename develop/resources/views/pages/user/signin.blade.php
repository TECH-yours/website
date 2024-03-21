@section('includes.header_meta')
    @include('includes.header_meta', ['page_title' => '商品列表'])
@endsection

@section('css')

@endsection

@extends('layouts.main')
@section('content')

<button id="login" type="button" class="btn btn-primary">Login with LINE</button>

@endsection

@section('end_script')

<script src="./js/signin.min.js"></script>

@endsection
