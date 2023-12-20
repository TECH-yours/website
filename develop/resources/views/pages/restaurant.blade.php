@include('includes.language')
@extends('layouts.default', ['page_header' =>'餐廳列表','page_parent' =>'Home','page_parent_path' =>'/','page_path' =>'restaurant'])
@section('content')


<div id="breadcrumb" class="breadcrumb-area bg-img" style="background-image: url(/img/cover.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 class="page-title">餐廳列表</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="/">HOME</a></li>
                            <li class="breadcrumb-item active breadcrumb-item-active" aria-current="page">Restaurant</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="d-flex flex-wrap">
    @foreach ($restaurants as $restaurant)
    <div class="col-12 col-sm-6 col-md-4 col-lg-3" style="padding: 1rem;">
        <div class="card">
            <img class="card-img-top" src="/images/{{ $restaurant->thumbnailImageUrl }}" alt="Restaurants thumbnail" style="height: 180px; object-fit: contain;">
            <div class="card-body">
                <h5 class="card-title mt-1">{{ $restaurant->name }}</h5>
                <p class="card-text">{{ $restaurant->address }}</p>
                <a href="/restaurant/{{ $restaurant->id }}/menu" class="btn btn-primary">查看菜單</a>
                <a href="{{ $restaurant->google_map_url }}" target="_blank" class="btn btn-light"><i class="fas fa-map"></i></a>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>

@stop
@section('end_script')
@stop
