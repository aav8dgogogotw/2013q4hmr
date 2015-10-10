var inviteNum = 5;
var inviteNum2 = 10;
var joinNum = 2;
var joinNum2 = 4;

function HiiirTrack(Code) {
    var ImgObj=new Image();
    ImgObj.src='http://log.hiiir.com/tracklog.php?Val='+Code;
    ImgObj=null;
    return false;
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function logClick(click) {
    $.post('api/active.php', {action:'logClick.post', click:click}, function(res) {}, 'json');
}

function close(next) {
    $.unblockUI();
    if(next)
        location.reload();
}

function show(showObj) {

    $.blockUI({
        message: $('#'+showObj.name), 
        css: {
            top: showObj.top,
            left: showObj.left,
            border:'none',
            textAlign:'center',
            cursor:'',
            width: showObj.width,
            height: showObj.height,
            backgroundColor:''
        },
        overlayCSS:{
            backgroundColor: '#FFFFFF',
            cursor:'',
            opacity:showObj.opacity
        }
    });
}


function show2(showObj) {

    $.blockUI({
        message: $('#'+showObj.name), 
        css: {
            top: showObj.top,
            left: showObj.left,
            border:'none',
            textAlign:'center',
            cursor:'',
            width: showObj.width,
            height: showObj.height,
            backgroundColor:''
        },
        overlayCSS:{
            backgroundColor: '#000000',
            cursor:'',
            opacity:showObj.opacity
        }
    });
}



function init(fnc) {
    $(function(){
        fnc();

        // FB.Event.subscribe('edge.create',
        //     function(response) {
                
        //     }
        // );

        // FB.Event.subscribe('edge.remove',
        //     function(response) {
                
        //     }
        // );
    });
}

/**
     * click
     *
     * - 1: index_click 活動首頁
     * - 2: intro_click 遊戲介紹
     * - 3: active_click 活動辦法
     * - 4: award_click 得獎名單
     * - 5: facebook_share 分享到FACEBOOK
     * - 6: official_click 至官網造訪
     * - 7: start_game "尋寶去"點擊
     * - 8: molome_click MOLOME點擊
     */
function linkClick(click) {
    switch(parseInt(click)) {
        case 0:
            logClick(7);
            fbLogin();
        break;
        case 1:
            HiiirTrack('3132385f33343239cea34869696972547261636b');
            logClick(12);
            window.open("https://www.facebook.com/laurel.hmr?fref=ts");
        break;
        case 2:
            var showObj = {
                name: "event",
                top: "107px",
                left: "25%",
                width: "717px",
                height: "458px",
                opacity: 0.5
            };
            show(showObj);
            logClick(3);
        break;
        case 3:
            logClick(2);
            var showObj = {
                name: "game",
                top: "75px",
                left: "25%",
                width: "717px",
                height: "497px",
                opacity: 0.5
            };
            show(showObj);
        break;
        case 4:
            logClick(4);
            var showObj = {
                name: "win",
                top: "75px",
                left: "25%",
                width: "717px",
                height: "458px",
                opacity: 0.5
            };
            show(showObj);            
        break;
        case 5:
            logClick(6);
            window.open("http://me.molome.tw/");
        break;
        case 6:
            logClick(8);
            window.open("https://www.molome.tw/");
        break;
        case 7:
            logClick(13);
            window.open("https://www.molome.tw/auth/facebook/me");
            break;
    }
}

function inviteLogin(requestIds) {
    FbFunc.FbLogin(function(res) {
        if(res.authResponse) {

            //註冊新資訊
            FB.api('/me', function(response) {                        
                fb_id = response.id;
                if(!fb_id || fb_id == 0)
                    setTimeout(function(){location.reload();}, 500);
                else {
                    $.post('api/active.php', {action:'user.post', data:response, token: res.authResponse.accessToken}, 
                        function(resp) {
                            if(resp.message == "OK") {
                                $.post("api/active.php", 
                                    {action:'request.post', 
                                    data:response, 
                                    token: res.authResponse.accessToken, 
                                    requestIds: requestIds}, function(res) {
                                        if(!res.sender.error) {
                                            $("#fb_icon").show();
                                            var pic = "<img src='http://graph.facebook.com/"+
                                            res.sender.id+"/picture' id='fb_pic'/>"
                                            $("#fb_icon").append(pic);
                                            $("#fb_name").html(res.sender.name);
                                        }
                                    }, "json");
                            }else {
                                alert(resp.detail);
                                location.reload();
                            }
                    }, 'json');
                }
            });
        }else {
            alert("您已取消授權！！");
        }
    });
}



function fbLogin() {
    FbFunc.FbLogin(function(res) {
        if(res.authResponse) {

            //註冊新資訊
            FB.api('/me', function(response) {                        
                fb_id = response.id;
                if(!fb_id || fb_id == 0)
                    setTimeout(function(){location.reload();}, 500);                            
                else {
                    $.post('api/active.php', {action:'user.post', data:response, token: res.authResponse.accessToken}, function(res) {
                        if(res.message == "OK") {
                            ga('send', 'event', 'index_game_button', 'index_game_click', 'index_game)');
                            ga('send', 'event', 'index_nav_game', 'index_nav_game', 'index_nav_game');
                            location.href = "?page=game";
                        }else {
                            alert(res.detail);
                            location.reload();
                        }
                    }, 'json');
                }
            });
        }else {
            alert("您已取消授權！！");
        }
    });
}

$(document).on("click","#fb-fans-btn",function(event){
        closeFans();
    });

function checkFans() {
   // alert('玩遊戲之前必須先按讚加入"桂冠輕鬆生活"粉絲團');
    $.post('api/active.php', {action:'fans.get'}, function(response) {
    //$.post('api/active.php', {action:'user.put', act:"act1"}, function(res) {} 'json');
        if(response.message == "OK") {
            if(response.isFans) {
                $.post('api/active.php', {action:'user.put', act:"act1"}, function(res) {
                    if(res.message == "OK") {
                        getAward("A");
                        closeFans();
                    }else {
                        alert(res.detail);
                        location.reload();
                    }
                }, 'json');
            }else {
                var showObj = {
                    name: "m1block",
                    top: "140px",
                    left: "25%",
                    width: "605px",
                    height: "382px"
                };
              //  document.write(showObj)
                show2(showObj);
               // closeFans();
            }
        }else {
            location.href = "/";
        }
    }, "json");

    $.post('api/active.php', {action:'logActStart.post',  act:"A"}, function(res) {}, 'json');
}

function closeFans() {
    $.post('api/active.php', {action:'fans.get'}, function(response) {

        if(response.message == "OK") {
            if(response.isFans) {
                $.post('api/active.php', {action:'user.put', act:"act1"}, function(res) {
                    if(res.message == "OK") {

                        getAward("A");
                    }else {
                        alert(res.detail);
                        location.reload();
                    }
                }, 'json');
                $.post('api/active.php', {action:'logLike.post'}, function(res) {}, 'json');
               // alert("你現在可以進行遊戲!!");
                close();

                
               location.href = "?page=game";
              //  location.reload();
            }else {
               // alert("您尚未加入粉絲團喔！！");
               checkFans();
              //  close();
            }
        }else {
            location.href = "/";
          //  location.href = "/?page=game";
        }
    }, "json");
}

function inviteFriend(pass) {
    FbFunc.FbInvite(function(response){

        if(response != null) {

            var to = response.to;
            $.post('api/active.php', {action:'friend.post', ids:to}, function(res) {
                if(res.message == "OK") {
                    if(res.num >= inviteNum) {
                        $.post('api/active.php', {action:'user.put', act:"act2"}, function(res) {
                            if(res.message == "OK") {
                                if(pass == 2) {
                                    getAward("B");
                                }
                            }else {
                                alert(res.detail);
                                location.reload();
                            }
                        }, 'json');
                    }else if(pass == 2) {
                        var msg = inviteNum - res.num;
                        if(window.confirm("您還要再邀請"+msg+"位好友即可過關，是否邀請更多好友？")) {
                            inviteFriend(2);
                        }else {
                            close();
                        }
                    }

                    if(res.num >= inviteNum2) {
                        $.post('api/active.php', {action:'user.put', act:"act5"}, function(res) {
                            if(res.message == "OK") {
                                if(pass == 5) {
                                    getAward("E");
                                }
                            }else {
                                alert(res.detail);
                                location.reload();
                            }
                        }, 'json');
                    }else if(pass == 5) {
                        var msg = inviteNum2 - res.num;
                        if(window.confirm("您還要再邀請"+msg+"位好友即可過關，是否邀請更多好友？")) {
                            inviteFriend(5);
                        }else {
                            close();
                        }
                    }
                }
            }, 'json');
            $.post('api/active.php', {action:'invite.post', friend:to}, function(res) {}, 'json');
        }
    });
}

function postMsg(pass) {
    FbFunc.FbFeed(function(res) {
        if(res) {
            $.post('api/active.php', {action:'user.put', act:"act2"}, function(res) {
                if(res.message == "OK") {
                    if(pass)
                        getAward("C");
                }else {
                    alert(res.detail);
                    location.reload();
                }
            }, 'json');
            $.post('api/active.php', {action:'logClick.post', click:5}, function(res) {}, 'json');
            $.post('api/active.php', {action:'logShare.post'}, function(res) {}, 'json');
           //分享塗鴉牆後就接表單
         //  alert("你已經成功地分享於塗鴉牆, 後續請填寫抽獎表單!!");
         //  close();
          // location.href = "/?page=lottery";
           lotteryForm(0,1);

        }
    });
    
}




function checkGame(num) {
    $.post('api/active.php', {action:'friend.get'}, function(res) {
        if(res.message == "OK") {
            if(parseInt(res.num) >= num){

                if(parseInt(num) == joinNum) {
                    $.post('api/active.php', {action:'user.put', act:"act4"}, function(res) {
                        if(res.message == "OK") {
                            getAward("D");
                        }else {
                            alert(res.detail);
                            location.reload();
                        }
                    }, 'json');
                }

                if(parseInt(num) == joinNum2) {
                    $.post('api/active.php', {action:'user.put', act:"act6"}, function(res) {
                        if(res.message == "OK") {
                            getAward("F");
                        }else {
                            alert(res.detail);
                            location.reload();
                        }
                    }, 'json');
                }
            }else {

                switch(num) {
                    case 2:
                        if(window.confirm("您邀請的好友中尚未滿二位參與遊戲！請再邀請更多好友來幫助您。")) {
                                inviteFriend(4);
                            }else {
                                close();
                        }
                    break;
                    case 4:
                        if(window.confirm("您邀請的好友中尚未滿四位參與遊戲！請再邀請更多好友來幫助您。")) {
                                inviteFriend(6);
                            }else {
                                close();
                        }
                    break;
                }                
            }
        }
    }, 'json');
}

function getAward(stage) {
    $.post('api/active.php', {action:'awardsn.get', stage:stage}, function(res) {
        if(res.message == "OK") {
            var name = "";
            switch(stage) {
                case "A": 
                    name = "m1_2block";
                break;
                case "B":
                    name = "m2_2block";
                break;
                case "C":
                    name = "m3_2block";
                break;
                case "D":
                    name = "m4_2block";
                break;
                case "E":
                    name = "m5_2block";
                break;
                case "F":
                    name = "m6_2block";
                break;
            }

            var showObj = {
                name: name,
                top: "100px",
                left: "25%",
                width: "605px",
                height: "382px",
                opacity: 0.5
            };
            show(showObj);

            if(res.award != "" && res.award.sn != "") {
                $("#"+name).find(".num>span, .num2>span").html(res.award.sn);
            }else {
                if(stage == "D") {
                    $("#"+name).find(".num>span, .num2").html("5000份早餐已全數發罄 記得下周二再來領取序號呦。");
                    $("#"+name).find(".num>span, .num2").css("font-size", "13px");
                    $("#"+name).find(".num>span, .num2").css("right", "35px");
                }else {
                    $("#"+name).find(".num>span, .num2>span").html("追加中，請耐心等候。");
                }
            }
                
            if(res.extra != "" && res.extra.sn != "") {
                $("#"+name).find(".ex").show();
                $("#"+name).find(".ex>span").html(res.extra.sn);
            }
        }else {
            alert(res.detail);
            location.reload();
        }
    }, 'json');
}

function mapAction(stage) {
    switch(stage) {
        case 1:
            $.post('api/active.php', {action:'logActStart.post',  act:"A"}, function(res) {}, 'json');
            mapAnimate(1)
        break;
        case 2:
            $.post('api/active.php', {action:'logActStart.post',  act:"B"}, function(res) {}, 'json');
            mapAnimate(2)
        break;
        case 3:
            $.post('api/active.php', {action:'logActStart.post',  act:"C"}, function(res) {}, 'json');
            mapAnimate(3)
        break;
        case 4:
            $.post('api/active.php', {action:'logActStart.post',  act:"D"}, function(res) {}, 'json');
            mapAnimate(4)
        break;
        case 5:
            $.post('api/active.php', {action:'logActStart.post',  act:"E"}, function(res) {}, 'json');
            mapAnimate(5)
        break;
        case 6:
            $.post('api/active.php', {action:'logActStart.post',  act:"F"}, function(res) {}, 'json');
            mapAnimate(6)
        break;
    }
}

function mapAnimate(stage) {

    var name;
    name = "m"+stage+"block"

    var showObj = {
        name: name,
        top: "100px",
        left: "25%",
        width: "605px",
        height: "382px",
        opacity: 0.5
    };
    show(showObj); 
}

function tipShow(way) {

    var name = "way"+way;

    var showObj = {
        name: name,
        top: "175px",
        left: "0px",
        width: "100%",
        height: "100%",
        opacity: 0.0
    };
    show(showObj);

    $("#"+name).bind("click", function() {close();});
}

function pictureClick(){
   $.post('api/active.php', {action:'logClick.post', click:4}, function(res) {}, 'json');
  //  window.open("http://fv38.com/80437");
    //location.href='';  
}

function introClick(){
    $.post('api/active.php', {action:'logClick.post', click:20}, function(res) {}, 'json');
    location.href='?page=recipe'; 
}

function activeClick(){
    $.post('api/active.php', {action:'logClick.post', click:23}, function(res) {}, 'json');
    location.href='?page=activity'; 
    }

<!--//首頁影片的放大-->
function videoUrlForm(){
    //7. 觀看影片按鈕
    ga('send', 'event', 'watch_film_button', 'watch_film_click', 'watch_film');
 $.post('api/active.php', {action:'logClick.post', click:6}, function(res) {}, 'json');
    var showObj = {
        name: "video_url",
        top: "150px",
        left: "30%",
        width: "640px",
        height: "480px",
        opacity: 0.5
    };
   
    show2(showObj);
}

<!--//recipe食譜的放大-->
function recipeForm(){
   
    ga('send', 'event', 'recipe_large_button', 'recipe_large_click', 'recipe_large');
 $.post('api/active.php', {action:'logClick.post', click:6}, function(res) {}, 'json');
    var showObj = {
        name: "recipe_url",
        top: "150px",
        left: "30%",
        width: "600px",
        height: "600px",
        opacity: 0.5
    }; 
    show2(showObj);
}

function recipe02Form(){
   
    ga('send', 'event', 'recipe02_large_button', 'recipe02_large_click', 'recipe02_large');
 $.post('api/active.php', {action:'logClick.post', click:6}, function(res) {}, 'json');
    var showObj = {
        name: "recipe02_url",
        top: "150px",
        left: "30%",
        width: "640px",
        height: "480px",
        opacity: 0.5
    }; 
    show2(showObj);
}

function recipe03Form(){
   
    ga('send', 'event', 'recipe03_large_button', 'recipe03_large_click', 'recipe03_large');
 $.post('api/active.php', {action:'logClick.post', click:6}, function(res) {}, 'json');
    var showObj = {
        name: "recipe03_url",
        top: "150px",
        left: "30%",
        width: "640px",
        height: "480px",
        opacity: 0.5
    }; 
    show2(showObj);
}

function recipe04Form(){
   
    ga('send', 'event', 'recipe04_large_button', 'recipe04_large_click', 'recipe04_large');
 $.post('api/active.php', {action:'logClick.post', click:6}, function(res) {}, 'json');
    var showObj = {
        name: "recipe04_url",
        top: "150px",
        left: "30%",
        width: "640px",
        height: "480px",
        opacity: 0.5
    }; 
    show2(showObj);
}

function recipe05Form(){
   
    ga('send', 'event', 'recipe05_large_button', 'recipe05_large_click', 'recipe05_large');
 $.post('api/active.php', {action:'logClick.post', click:6}, function(res) {}, 'json');
    var showObj = {
        name: "recipe05_url",
        top: "150px",
        left: "30%",
        width: "640px",
        height: "480px",
        opacity: 0.5
    }; 
    show2(showObj);
}
<!--//recipe食譜的放大結束-->


<!--//完成得到抽獎資格的頁面(遊戲成功)-->
function lotterySuccessForm(){
    $.post('api/active.php', {action:'logClick.post', click:9}, function(res) {}, 'json');
   // location.reload();
    var showObj = {
        name: "Success",
        top: "50px",
        left: "30%",
        width: "604px",
        height: "384px",
        opacity: 0.5
    };
    show(showObj);
}

<!--//完成得到參加獎的頁面(遊戲失敗)-->
function lotteryFailForm(){
    $.post('api/active.php', {action:'logClick.post', click:11}, function(res) {}, 'json');
    var showObj = {
        name: "Fail",
        top: "50px",
        left: "30%",
        width: "604px",
        height: "384px",
        opacity: 0.5
    };
    show(showObj);
}





// 如果領完獎不需切換頁面的話，可以CALL這支來replay遊戲


function replay() {
    //4. 成功與失敗再玩一次的按鈕 
    ga('send', 'event', 'success_again_button', 'success_again_click', 'success_again');
    close();
    var swf = swfobject.getObjectById('flashcontent');
    swf.replay();
   // location.reload();
}




// 寫入flash
jQuery(document).ready(function() {
    swfobject.embedSWF('swf/game.swf', 'flashcontent', '990', '515', '9.0.0', 'js/libs/expressInstall.swf', null, {wmode: 'opaque'});
});


//368縣市的處理
department=new Array();
department[1]=["請選擇細項", "照燒豬肉炒烏龍", "沙茶燒肉炒烏龍", "泡菜海鮮炒烏龍"];  
department[2]=["請選擇細項", "炸醬麵", "香菇肉燥麵", "野菇燻雞焗飯"]; 
department[3]=["請選擇細項", "咖哩嫩雞飯", "起司海鮮飯", "南瓜燻雞飯", "野菇燻雞焗飯"];        
department[4]=["請選擇細項", "鮭魚炒飯", "蝦仁炒飯", "素三杯炒飯", "香腸蛋炒飯", "鹹魚雞粒炒飯", "韓式泡菜豬肉炒飯"];

department[5]=["請選擇細項", "蕃茄肉醬義大利麵", "奶油培根義大利麵", "青醬蛤蜊義大利麵", "奶油明太子義大利細麵", "泰式酸辣墨魚義大利麵", "墨西哥香辣香腸義大利麵"];              
function renew(index){
    for(var i=0;i<department[index].length;i++)
        document.myCity.addr.options[i]=new Option(department[index][i], department[index][i]);   // 設定新選項
    document.myCity.addr.length=department[index].length; // 刪除多餘的選項
}















