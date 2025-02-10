<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Signout</title>
    <script src='{{asset('/login/log.js')}}'></script>
    <script src='{{asset('/login/oidc-client.js')}}'></script>
</head>
<body>
<form id="form1" runat="server">
    <script>
        Oidc.Log.logger = console;
        Oidc.Log.level = Oidc.Log.DEBUG;
        new Oidc.UserManager().signoutCallback().then(function (user) {
            var theState = user.state;
            if (typeof theState == "undefined")
                theState = '/';
            window.location.href = theState;
        }).catch(function (err) {
            log(err);
        });
    </script>
</form>
</body>
</html>
