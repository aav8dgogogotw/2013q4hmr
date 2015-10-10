$.FBLogin = function(options) {
    //指定變數
    Hiiir = {};
    Hiiir.defaults = {
        'AppId'	: '',
        'ToURL' : '',
        'Login' : false,
        'RedirectURL' : 'http://www.facebook.com/',
        'ChannelUrl' : '',
        'Scope' : 'email,read_stream,publish_stream,offline_access,user_likes',
        'Height' : 1800
    };
    
    var Settings = $.extend(Hiiir.defaults, options);
    $('body').append('<div id="fb-root"></div>');
    
    FB.init({
        appId: Settings.AppId, 
        status: true,
        oauth: true, 
        cookie: true,
        xfbml: true,
        frictionlessRequests: true,
        channelUrl: Settings.ChannelUrl
    });

    if(Settings.ToURL != '' && Settings.ToURL != 'undefined'){
        //判斷登入後要導入的網址
        FB.Event.subscribe('auth.login', function(response) {
            //For Safari 5.X版以後用，要自己接到session後，在Server端加入Cookie
            //避開Chrome是105
            if(navigator.userAgent.toLowerCase().indexOf("safari") > -1 &&  navigator.userAgent.toLowerCase().indexOf('chrome') == -1) {
                if (response.session && FbCookie.getCookie('uid') != response.session.uid) {
                    $('body').prepend("<form id='safariFix'></form>");
                    $('#safariFix')
                    .attr('method', 'POST')
                    .attr('action', location.href)
                    .append('<input type="hidden" name="fb_session" id="safariFix_session" />');
                    $('#safariFix_session').attr('value', JSON.stringify(response.session));
                    $('#safariFix').submit();
                }
            } 
            else {
                // HiiirTrack('38345f32303636cea34869696972547261636b'); // Whenever the user logs in, we refresh the page
            }
        });
    }
    //設定IFrame高度
    if(Settings.Height){
        FB.Canvas.setSize({
            width:760,
            height:Settings.Height
        });
    }
		
    (function(d) {
        var js, id = 'facebook-jssdk';
        if (d.getElementById(id)) {return;}
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/zh_TW/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
	
    FbCookie = 
    {
        getCookie:function (c_name)
        {
            if (document.cookie.length>0)
            {
                var c_list = document.cookie.split("\;");
                for ( i in c_list )
                {
                    var cook = c_list[i].split("=");
                    if ( cook[0] == c_name )
                    {
                        return unescape(cook[1]);
                    }
                } 
            }
            return null
        }
    };
    
    FbFunc = 
    {
        FbLogin:function(func) {
            // location.href = "https://graph.facebook.com/oauth/authorize?client_id="+Settings.AppId+"&redirect_uri="+Settings.RedirectURL+"&scope="+Settings.Scope;
            FB.login(function(response) {
                func(response);                
            }, {
                scope:Settings.Scope
            });            
        },
        FbLogout:function() {
            FB.logout(function(response) 
            {
                //做清除session的動作
                document.location.reload();
            });
        },
        FbCheckFans:function(func) {
            FB.api(
                {
                    method:'pages.isFan',
                    page_id:Settings.FansId
                },
                function(response) {
                    func(response);
                }
            );
        },        
        FbFansClose:function(func) {
            FB.api(
                {
                    method:'pages.isFan',
                    page_id:Settings.FansId
                },
                function(response) {
                    func(response);
                }
            );
        },
        FbInvite:function(func) {
            $.post('api/active.php', {action:'friend.get', list:true}, function(res) {

                FB.ui({
                    method: 'apprequests',
                    message: '家庭代餐邀請你加入輕鬆的生活',
                    title: '家庭代餐',
                    display: 'iframe',
                    // exclude_ids: res.list
                }, function(response){
                    func(response);
                });
            }, "json");            
        },
        FbFeed: function(func) {
            FB.ui({
                method: 'feed',
                link: 'http://event.laurel.com.tw/2013Q4hmr/',
                picture: 'http://event.laurel.com.tw/2013Q4hmr/images/fb_icon.jpg',
                name: '簡單做 開心吃 快樂料理在我家',
                caption: 'www.laurel.com.tw',
                description: '簡單美味幸福入口，就在這裡，就在家裡，美味五招煮、扣、拌、加、好，給你一整天的好時光。記住了這輕鬆料理五字訣，還能抽獎玩遊戲喔！',
            }, function(response){
                func(response);
            });
        },

    


        FbCheckLogin: function(func) {
            FB.getLoginStatus(function(response){
                FB.api('/me', function(response) {
                });
            });
        }
    };
};