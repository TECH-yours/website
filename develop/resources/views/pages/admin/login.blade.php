<!doctype html>
<html>
<head>
    @include('includes.admin.lib_css')
</head>
<body style="margin:0; padding:0; height: 100vh; display:flex; justify-content: center;">
<div class="container" style="margin-top: 15%">
    <div class="col-auto" style="margin-bottom: 50px;margin-top: 50px;">
        <img class="center-block" style="max-width: 100%;" src="/frontend/img/logo.png"/>
    </div>
    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user-alt"></i></div>
            </div>
            <input type="text" class="form-control" id="user" placeholder="{{trans('account.id')}}">
        </div>
    </div>
    <div class="col-auto">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-key"></i></div>
            </div>
            <input type="password" class="form-control" id="password" placeholder="{{trans('account.password')}}" autocomplete="off">
        </div>
    </div>
    <div class="col-auto">
        <div class="d-flex">
            <div class="w-100 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" id="login" data-loading-text="<span class='spinner-grow spinner-grow-sm'></span>">登入</button>
            </div>
        </div>
    </div>
    </div>
</div>

</body>
</html>
@include('includes.admin.lib_script')

<script>
    $(document).on('click', '#login', function () {
        ajax('post', '/api/admin/login', {
            user: $('#user').val(),
            password: $('#password').val(),
        }, function (d) {
            if (d.success) {
                console.log(d);
            } else {
                alert('登入失敗');
            }
        });
    });
</script>