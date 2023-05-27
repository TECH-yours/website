@section('includes.header_meta')
    @include('includes.header_meta', ['page_title' => 'Admin - 餐廳清單'])
@endsection

@section('css')
@endsection

@extends('layouts.admin')
@section('content')
    
<div class="container" style="margin-top: 5%">
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
            <th class="th-sm col-1">area</th>
            <th class="th-sm col-3">name</th>
            <th class="th-sm col-2">餐廳數量</th>
            <th class="th-sm col-1">操作</th>
            </tr>
        </thead>
    </table>
</div>

@endsection
@section('end_script')
<script>
    var TableList = $('#TableList').DataTable( {
        responsive: true,
        "columns": [
            { "data": "id" },
            { "data": "area" },
            { "data": "name" },
            { "data": "meals_count" },
            { "data": "operation" },
        ],
        "lengthMenu": [15, 25, 50, 100],
        "iDisplayLength": 15,
        "ajax": "/api/admin/list/restaurant", 
        "drawCallback": function (settings) {
            $("td").css({"vertical-align": "middle"});
            $("th").css({"vertical-align": "middle", "text-align": "center"});
            $('#updateTime').text(moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
        }
    });
    new $.fn.dataTable.FixedHeader( TableList );
    $("#TableList_filter").append("&emsp;<button class='btn btn-primary' id='add-btn'>新增餐廳</button>");
</script>
@endsection