@include('includes.language')
<header class="fixed-top">

    <nav class="navbar navbar-expand-lg navbar-light bg-light mobile-hidden">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class=""><img src="/" style="margin-bottom: 5px; height: 30px;"/>
                    <b>YoursHealth | 友益食</b>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="collapse navbar-collapse" id="navbarNavDropdown" style="margin: 0;">
                <ul class="navbar-nav w-100">
                    <div class="ml-auto"></div>
                    
                    <li class="nav-item" style="margin: 0 1.5em;font-size:0.9em;">
                        <a class="nav-link" href="/restaurants">餐廳列表</a>
                    </li>
                    
                    <li class="nav-item dropdown" style="margin: 0 1.5em;font-size:0.9em;">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        會員專區
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="w-100 d-flex flex-column align-items-center mb-3" style="padding-bottom: 1em; border-bottom: solid #bbb 1px;">
                                <img class="userPicture" src="/images/user/_default.jpg" width="80" height="80" alt="User Profile photo" style="border-radius: 80px;">
                                <h6 class="text-center mt-1"><span class="userName">-</span></h6>
                            </a>

                            <a class="none-member">
                                <div class="w-100 d-flex justify-content-center">
                                    <button id="login" class="btn btn-success" style="border-radius: 20px;">Line 登入</button>
                                </div>
                            </a>
                            <a class="member" style="display:none;"><a class="dropdown-item" href="/user">會員專區</a></a>
                            <!-- <a class="member" style="display:none;"><a class="dropdown-item" href="/user/profile">基本資料</a></a>
                            <a class="member" style="display:none;"><a class="dropdown-item" href="/user/wishlist">一鍵訂購</a></a>
                            <a class="member" style="display:none;"><a class="dropdown-item" href="/user/order">訂單查詢</a></a> -->
                            <a class="member" style="display:none;"><a class="dropdown-item" href="#" onClick="javascript:logout(); return false;">登出</a></a>
                        </div>
                    </li>


                </ul>
            </ul>
        </div>
    </nav>
</header>
