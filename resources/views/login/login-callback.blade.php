<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Đăng nhập</title>
    <script src='{{asset('/login/log.js')}}'></script>
    <script src='{{asset('/login/oidc-client.js')}}'></script>
</head>
<body>
<form id="form1" runat="server">
    <pre id='out'></pre>
    <script>
        Oidc.Log.logger = console;
        Oidc.Log.level = Oidc.Log.DEBUG;
        new Oidc.UserManager({ response_mode: 'query' }).signinRedirectCallback().then(function (user) {
            log("signin response success", user);
            console.log("signin response success", user);
            var theState = user.state;
            var theMessage = theState.message;
            console.log(theMessage);
            if (typeof theMessage == 'undefined')
                theMessage = '/';
            window.location.href = theMessage;
        }).catch(function (err) {
            log(err);
        });
    </script>
</form>
</body>
</html>
