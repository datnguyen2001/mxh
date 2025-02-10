<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>Cache Manager </title>
    <style>
        .form-cache{
            padding:20px;
            border:1.2px solid #ccc;
            margin:10px;
            position: relative;
        }
        .form-cache>label{
            position:absolute;
            top:-15px;
            display: inline-block;
            padding: 0 10px;
            left:20px;
            background-color:#FFFFFF;
            margin: 0;
            font-weight: bold;
        }
        .form-group>input{
            border:none;
        }
        .content{
            padding-top: 100px;
        }
    </style>
    <link href="https://static.mediacdn.vn/congnghenoidung/web_css/manager.main.v10102022.min.css" rel="stylesheet"/>
</head>
<body>
<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="cache-manager" class="form-cache" method="post" action="#">
                    @csrf
                    <label>Cache Manager</label>
                    <div class="form-group">
                        <textarea  class="form-control" name="path" cols="100%" rows="5" id="path" placeholder="Nhập Url"></textarea>
                        <input type="hidden" value="" name="action" id="action">
                    </div>
                    <div class="" id="box_action">
                        <a href="#" class="btn btn-success btn_action mb-1" id="btn_update" data-action="update" title="Nạp lại cache theo url">Update</a> <!--nạp lại cache theo url nhập-->
                        <a href="#" class="btn btn-danger btn_action mb-1" id="btn_delete" data-action="delete" title="Xóa cache theo url">Delete</a> <!--xóa cache theo url nhập-->
                        <a href="#" class="btn btn-info btn_action mb-1" id="btn_remove_port" data-action="remove_port" title="Xóa port memcache nhập tương ứng">Remove Port</a> <!--xóa port memcache nhập tương ứng, all là xóa hết-->
                        <a href="#" class="btn btn-secondary btn_proxy  btn_action mb-1"  data-action="flush_proxy" title="Xóa cache proxy">Flush Proxy</a> <!--xóa cache proxy-->
                        <a href="#" class="btn btn-secondary btn_proxy btn_action mb-1" id="btn_cache_proxy" data-action="cache_proxy" title="Cache Proxy">Cache Proxy </a><!-- call theo api sau: https://apicache.cnnd.vn/api/-->
                        <a href="#" class="btn btn-danger btn_action mb-1" id="btn_flush" data-action="flush" title="Xóa all cache">Flush</a> <!--xóa all cache -->
                        <a href="#" class="btn btn-danger btn_action mb-1" id="btn_flush" data-action="clearZone" title="Clear Zone" style="float: right;">Flush Zone</a> <!--xóa all cache -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://static.mediacdn.vn/congnghenoidung/web_js/manager.main.v10102022.min.js"></script>
<script>
    $('#box_action .btn_action').on('click',function (e){
        e.preventDefault();
        var action=$(this).attr('data-action'),path=$('#path').val();
        $('form #action').val(action);
        if(path=='' && action!=='flush' && action!=='flush_proxy' && action!=='remove_all_port' && action!=='clearZone'){
            if (action=='remove_port'){
                Notiflix.Report.failure('Error','Vui lòng nhập tên ServerMemcache để thực hiện thao tác này!');
            }else {
                Notiflix.Report.failure('Error','Bạn cần nhập Url để thực hiện thao tác này!');
            }
            $('#path').focus();
            return 0;
        }
        $.ajax({
            method: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url: "/manager/cache",
            data : {
                "path": path,
                "action":  action
            },
            dataType: 'json',
            beforeSend: function() {
                Notiflix.Loading.standard('Processing...');
            },
            success:function(response){
                Notiflix.Loading.remove();
                if(response.status){
                    Notiflix.Report.success('Success',response.message);
                    $('#path').val('');
                }else{
                    Notiflix.Report.failure('Error',response.message);
                }
            }
        })
    })
</script>
</body>
</html>
