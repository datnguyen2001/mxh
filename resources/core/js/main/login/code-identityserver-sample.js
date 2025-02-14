// Copyright (c) Brock Allen & Dominick Baier. All rights reserved.
// Licensed under the Apache License, Version 2.0. See LICENSE in the project root for license information.

///////////////////////////////
// UI event handlers
///////////////////////////////
//document.getElementById('clearState').addEventListener("click", clearState, false);
//document.getElementById('getUser').addEventListener("click", getUser, false);
//document.getElementById('removeUser').addEventListener("click", removeUser, false);
////document.getElementById('querySessionStatus').addEventListener("click", querySessionStatus, false);

//document.getElementById('signout').addEventListener("click", signOut, false);
//document.getElementById('callApi').addEventListener("click", callApi, false);

///////////////////////////////
// config
///////////////////////////////
Oidc.Log.logger = console;
Oidc.Log.level = Oidc.Log.DEBUG;
//console.log("Using oidc-client version: ", Oidc.Version);

var url = window.location.origin;

var settings = {
    authority: 'https://idscungcau1.cnnd.vn',
    client_id: 'cungcau',
    redirect_uri: url + '/code-identityserver-sample-callback.html',
    post_logout_redirect_uri: url + '/code-identityserver-sample-callback-signout.html',
    response_type: 'code',
    scope: 'openid email cungcau_api',

    silent_redirect_uri: url + '/code-identityserver-sample-silent.html',
    automaticSilentRenew: true,
    validateSubOnSilentRenew: true,
    silentRequestTimeout: 10000
};
var mgr = new Oidc.UserManager(settings);

///////////////////////////////
// events
///////////////////////////////
mgr.events.addAccessTokenExpiring(function () {
    console.log("token expiring");
    log("token expiring");

    // maybe do this code manually if automaticSilentRenew doesn't work for you
    mgr.signinSilent().then(function (user) {
        log("silent renew success", user);

        console.log("reconnect hub signalR");

        _token = user.access_token;

    }).catch(function (e) {
        log("silent renew error", e.message);
    })
});

mgr.events.addAccessTokenExpired(function () {
    console.log("token expired");
    log("token expired");
    mgr.signinSilent().then(function (user) {
        log("silent renew success", user);

        console.log("reconnect hub signalR");

        _token = user.access_token;

    }).catch(function (e) {
        log("silent renew error", e.message);
    })
});

mgr.events.addSilentRenewError(function (e) {
    console.log("silent renew error", e.message);
    log("silent renew error", e.message);
});

mgr.events.addUserLoaded(function (user) {
    console.log("user session has been established (or re-established).", user);
    mgr.getUser().then(function () {
        console.log("getUser loaded user after userLoaded event fired");
    });
});

mgr.events.addUserUnloaded(function (e) {
    console.log("user session has been terminated.");
});

mgr.events.addUserSignedIn(function (e) {
    log("user logged in to the token server", e);
});
mgr.events.addUserSignedOut(function (e) {
    log("user logged out of the token server", e);
});
mgr.events.addUserSessionChanged(function (e) {
    log("user session changed", e);
})

///////////////////////////////
// functions for UI elements
///////////////////////////////
function clearState() {
    mgr.clearStaleState().then(function () {
        log("clearStateState success");
    }).catch(function (e) {
        log("clearStateState error", e.message);
    });
}

function getUser() {
    mgr.getUser().then(function (user) {
        log("got user", user);

    }).catch(function (err) {
        log(err);
    });
}

function removeUser() {
    mgr.removeUser().then(function () {
        log("user removed");
    }).catch(function (err) {
        log(err);
    });
}

function startSigninMainWindow() {
    var someState = { message: window.location.href };
    mgr.signinRedirect({ state: someState, useReplaceToNavigate: false}).then(function (abc) {
        log("signinRedirect done", abc);

        var theState = user.state;
        var theMessage = theState.message;
        console.log("here's our post-login state", theMessage);

    }).catch(function (err) {
        log(err);
    });
}

function signOut() {
    mgr.signoutRedirect({ state: window.location.href }).then(function (resp) {
        log("signed out", resp);
    }).catch(function (err) {
        log(err);
    });
}

function callApi() {
    mgr.getUser().then(function (user) {
        //var url = "http://localhost:57091/api/testapi";
        //var url = "http://localhost:60298/api/values";
        var url = "https://localhost:44361/weatherforecast";

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url);
        xhr.onload = function () {
            log(xhr.status, JSON.parse(xhr.responseText));
        }
        xhr.setRequestHeader("Authorization", "Bearer " + user.access_token);
        xhr.send();
    });
}


//Disable send button until connection is established
//document.getElementById("sendSignal").disabled = true;
//document.getElementById("sendLogoutSignal").disabled = true;



