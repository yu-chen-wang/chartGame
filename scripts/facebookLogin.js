
//初始化
window.fbAsyncInit = function () {
    FB.init({
        appId: 492289464627468,
        cookie: true,
        xfbml: true,
        version: 'v2.12'
    });
    //記錄用戶行為資料 可在後台查看用戶資訊
    FB.AppEvents.logPageView();
};

//嵌入臉書sdk
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) { return; }
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

