<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Đăng nhập</title>
</head>
<body>
<form id="form1" runat="server">
    <script src='{{asset('/login/log.js')}}'></script>
    <script src='{{asset('/login/oidc-client.js')}}'></script>
    <script src="{{asset('/login/signalr.min.js')}}"></script>
    <script src="{{asset('/login/code-identityserver-sample.js')}}" async></script>
</form>
</body>
</html>
