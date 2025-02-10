<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf_token" content="{{csrf_token()}}" />
    <title>Cache Manager </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<main class="content">
    <div class="container">

        <div class="row" style="padding-top: 100px;justify-content: center">

            <div class="col-md-4">
                {{-- @if($errors->has('errorlogin'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{$errors->first('errorlogin')}}
                    </div>
                @endif --}}
                <form id="cache-manager" class="form-cache" method="post" action="/manager/login">
                    {{ csrf_field() }}
                    <label><strong>Authentication</strong></label>
                    <div class="form-group">
                        <input  class="form-control" name="key" id="path" required placeholder="Password" autocomplete="off" type="password"/>
                    </div>
                    <div class="form-group">
                        <input  class="form-control" value="{{ $secret_key??'' }}" name="secret_key" id="secret_key" required placeholder="Secret Key" autocomplete="off" type="password"/>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://www.notiflix.com/content/min/notiflix-lib.min.js"></script>
</body>
</html>
