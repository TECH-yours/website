@include('includes.language')
@extends('layouts.default', ['page_header' =>'餐廳菜單','page_parent' =>'Home','page_parent_path' =>'/','page_path' =>'menu'])
@section('content')


<div id="breadcrumb" class="breadcrumb-area bg-img" style="background-image: url(/img/cover.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center" style="background-color: rgba(187, 187, 187, 0.8);">
            <div class="col-6 h-100">
                <h2 class=" mt-5">餐廳菜單</h2>
                <hr>
                <!-- <h5 class="card-title mt-1">{{ $restaurant->name }}</h5>
                <p class="card-text">{{ $restaurant->address }}</p>
                <p class="card-text">{{ $restaurant->tel }}</p> -->
                <!-- <p class="card-text"><a href="{{ $restaurant->google_map_url }}" target="_blank">Google Map</a></p> -->
            </div>
            <div class="col-6 h-100">
                <img src="/images/{{ $restaurant->thumbnailImageUrl }}" style="height: 100%; width: 100%; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="d-flex flex-wrap">
    @foreach ($meals as $meal)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3" style="padding: 1rem;">
        <div class="card">
            <div class="card-header">
                <span class="badge badge-pill badge-primary">{{ $meal->category_name }}</span>
            </div>
            <div class="card-body">
                <h5 class="card-title mt-1">{{ $meal->name }}</h5>
                <p class="card-text">NT${{ $meal->price }}</p>
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>

@stop
@section('end_script')
@stop
