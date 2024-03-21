@include('includes.language')
@extends('layouts.default', ['page_header' =>'餐廳菜單','page_parent' =>'Home','page_parent_path' =>'/','page_path' =>'menu'])
@section('content')

<div class="container-fluid">

    <div class="d-flex flex-wrap">
        <div class="col-12" style="height: 380px;">
            <img src="/images/{{ $restaurant->thumbnailImageUrl }}" style="height: 100%; width: 100%; object-fit: cover;">
        </div>
        <div class="col-12 restaurant-info" style="height: 380px;">
            <div class="like-btn {{ rand(0, 1) ? 'active' : '' }}">
                <i class="far fa-heart"></i>
                <i class="fas fa-heart" style="color: #ff0000;"></i>
            </div>
            <h2>{{ $restaurant->name }}</h2>
            <div class="tag-group mb-2">
                <div class="tag">
                    <div class="tag-icon"><i class="fas fa-utensils"></i></div>
                    <div class="tag-text">健康餐</div>
                </div>
                <div class="tag">
                    <div class="tag-icon"><i class="fas fa-map-marker-alt"></i></i></div>
                    <div class="tag-text">{{ $restaurant->address }}</div>
                </div>
                <div class="tag">
                    <div class="tag-icon"><i class="fas fa-clock"></i></div>
                    <div class="tag-text">營業時間：{{ $restaurant->open_time }} - {{ $restaurant->close_time }}</div>
                </div>
            </div>
            <div class="restaurant-btn-group mb-2">
                <button class="btn action-btn outline">外送規則</button>
                <button class="btn action-btn outline">營業資訊</button>
                <button class="btn action-btn">線上點餐</button>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <h2 class="section-heading">菜單</h2>
        <div class="d-flex flex-wrap">
            @foreach ($meals as $meal)
            <div class="col-12 meals-box" style="padding: 1rem;" data-category="{{ $meal->category_name }}">
                <div class="card">
                    <div class="card-body">
                        <div class="meal-info">
                            <p class="meal-name">{{ $meal->name }}</h5>
                            <p class="meal-description">{{ $meal->name }}簡介</p>
                            <p class="meal-price">NT$&ensp;{{ $meal->price }}</h5>
                        </div>
                        <div class="meal-img">
                            <img src="https://picsum.photos/120?random={{ $meal->id }}" alt="Meal image" style="height: 100%; width: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@stop
@section('end_script')
@stop
