@include('includes.language')
@extends('layouts.default', ['page_header' =>'餐廳列表','page_parent' =>'Home','page_parent_path' =>'/','keyword' =>''])
@section('content')


<div id="breadcrumb" class="breadcrumb-area bg-img" style="background-image: url(/images/meals-table.png);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2>全台餐廳懶人包</h2>
                    <h4>本站所有品項整合POS 系統</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <!--  Search Form -->
    <form action="./" method="GET">
        <div class="py-3 d-flex flex-wrap">
            <div class="col-12">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="取餐位置" name="location">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">自動定位</button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <select class="custom-select" name="category">
                        <option value="">請選擇餐廳類別</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="請輸入關鍵字" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">搜尋</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <h2 class="section-heading">新進品牌</h2>
    <div class="horizontal-scroll-wrapper">
        @foreach ($restaurants as $restaurant)
        @if (rand(0, 1))
            <div class="col-7 col-lg-4 restaruant-box" style="padding: 1rem;">
                <div class="card" onclick="location.href='/restaurant/{{ $restaurant->id }}/menu';" style="cursor: pointer;">
                    <img class="card-img-top" src="/images/{{ $restaurant->thumbnailImageUrl }}" alt="Restaurants thumbnail" style="height: 180px; object-fit: cover;">
                    <div class="like-btn {{ rand(0, 1) ? 'active' : '' }}">
                        <i class="far fa-heart"></i>
                        <i class="fas fa-heart" style="color: #ff0000;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mt-1">{{ $restaurant->name }}</h5>
                        <div class="tag-group">
                            <div class="tag">
                                <div class="tag-icon"><i class="fas fa-utensils"></i></div>
                                <div class="tag-text">健康餐</div>
                            </div>
                            <div class="tag">
                                <div class="tag-icon"><i class="fas fa-dollar-sign"></i></div>
                                <div class="tag-text">200-400</div>
                            </div>
                            <div class="tag">
                                <div class="tag-icon"><i class="fas fa-motorcycle"></i></div>
                                <div class="tag-text">滿 500 免運</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div>


    <h2 class="section-heading">猜你喜歡</h2>
    <div class="horizontal-scroll-wrapper">
        @foreach ($restaurants as $restaurant)
        @if (rand(0, 1))
            <div class="col-7 col-lg-4 restaruant-box" style="padding: 1rem;">
                <div class="card" onclick="location.href='/restaurant/{{ $restaurant->id }}/menu';" style="cursor: pointer;">
                    <img class="card-img-top" src="/images/{{ $restaurant->thumbnailImageUrl }}" alt="Restaurants thumbnail" style="height: 180px; object-fit: cover;">
                    <div class="like-btn {{ rand(0, 1) ? 'active' : '' }}">
                        <i class="far fa-heart"></i>
                        <i class="fas fa-heart" style="color: #ff0000;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mt-1">{{ $restaurant->name }}</h5>
                        <div class="tag-group">
                            <div class="tag">
                                <div class="tag-icon"><i class="fas fa-utensils"></i></div>
                                <div class="tag-text">健康餐</div>
                            </div>
                            <div class="tag">
                                <div class="tag-icon"><i class="fas fa-dollar-sign"></i></div>
                                <div class="tag-text">200-400</div>
                            </div>
                            <div class="tag">
                                <div class="tag-icon"><i class="fas fa-motorcycle"></i></div>
                                <div class="tag-text">滿 500 免運</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div>

    <h2 class="section-heading">所有餐廳</h2>
    <div class="d-flex flex-wrap">
        @foreach ($restaurants as $restaurant)
        <div class="col-12 col-lg-6 col-xl-4 restaruant-box" style="padding: 1rem;">
            <div class="card" onclick="location.href='/restaurant/{{ $restaurant->id }}/menu';" style="cursor: pointer;">
                <img class="card-img-top" src="/images/{{ $restaurant->thumbnailImageUrl }}" alt="Restaurants thumbnail" style="height: 380px; object-fit: cover;">
                <div class="like-btn {{ rand(0, 1) ? 'active' : '' }}">
                    <i class="far fa-heart"></i>
                    <i class="fas fa-heart" style="color: #ff0000;"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-1">{{ $restaurant->name }}</h5>
                    <div class="tag-group">
                        <div class="tag">
                            <div class="tag-icon"><i class="fas fa-utensils"></i></div>
                            <div class="tag-text">健康餐</div>
                        </div>
                        <div class="tag">
                            <div class="tag-icon"><i class="fas fa-dollar-sign"></i></div>
                            <div class="tag-text">200-400</div>
                        </div>
                        <div class="tag">
                            <div class="tag-icon"><i class="fas fa-motorcycle"></i></div>
                            <div class="tag-text">滿 500 免運</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>


</div>

@stop
@section('end_script')
@stop
