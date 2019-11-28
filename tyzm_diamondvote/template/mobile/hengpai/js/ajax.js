function $v(id) {
    return document.getElementById(id);
}
$.ajaxSetup({
    	headers: { "vote-version": "2.3" }
});
function Recheck_area(item_id){
      ajax_timeoutId = window.setTimeout(function() {
          tips('cls');
          alert("加载文件出错了,请刷新网页重试");
      }, 6000);
      window.BMap_loadScriptTime = (new Date).getTime();
      jQuery.getScript("http://api.map.baidu.com/getscript?v=2.0&ak=Cvrx5f6GLCiAHh87aDXMN0GmswzVAjEa&services=&t=")
      .done(function() { getLocation(item_id);
      })
      .fail(function() {
          tips('cls'); alert('加载文件出错了,请刷新网页重试!');
      });
}

//获取地理位置
function getLocation(item_id){
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        window.clearTimeout(ajax_timeoutId);
        if(this.getStatus() == BMAP_STATUS_SUCCESS){
            votedata.gps_city = r.address.province + "-" + r.address.city + "-" + r.address.district ;
            votedata.gps_address = r.address.street + "-" + r.address.street_number;
            votedata.latitude = r.point.lat;
            votedata.longitude = r.point.lng;   
            votedata.Location_post = 1;
            getsent(item_id);
        }
        else { alert('failed'+this.getStatus()); }        
    },{enableHighAccuracy: true , timeout:5000,maximumAge:600000 });
}

/*
//重置提及参数
function resetpostform(){
	retrypost = 0 ;
	auth_token = "";
	auth_key = "";
	Location_post = 0;
	latitude = 0 ;
	longitude = 0 ;
	accuracy = 0;
	gps_address = "";
	gps_city = "";
	ajax_timeoutId = 0;
	lock = false;
	post_yzm = 0;
}
*/

function getvotedata(){
	retrypost = 0;
	lock = false;
	ajax_timeoutId = 0;
	var votedata =  {
        bno:0,
		post_yzm:0,
		latitude:0,
		longitude:0,
		accuracy:0,
		Location_post:0,
		gps_city:"",
		gps_address:"",
		auth_token:"",
		auth_key:"",
		ajax:1,
		v:Math.random()
	};
	return votedata;
}

var auth_token = "";
var auth_key = "";
var retrypost = 0;
var lock = false;

var socket=null;
var useSocket=false;

//投票发送数据
var votedata = getvotedata();

function getsent(bno,obj) {
	if (lock) {
        tips("load","投票中...你点太快了！",0); 
        return;
    }
	tips("load","投票中....",0);
	lock = true;
  	if ( typeof obj == 'object' ){ 
      	votedata = $.extend(votedata,obj); 
  	}
	if (retrypost > 4){
		tips("load","投票异常，请刷新重试....",0);
		return ;
	}
    if ( typeof(bno) == 'undefined' ){  bno = votedata.bno; }
    if ($.isNumeric(bno)) { votedata.bno = bno;  }

	$.ajax({
		  type: "post",
		  contentType:"application/x-www-form-urlencoded",
		  dataType: "json",
		  data:votedata,
		  url: 'post.php?action=vote&item_id='+bno+'&ajax=1&v='+Math.random(),
		  beforeSend: function (xhr) {
		      xhr.setRequestHeader('vote-id', ''+bno);
		  },
		  success: function (result) {
              lock = false;
		  	  retrypost++;
		      //tips('cls');
		      votedata.post_yzm = 0;
                if (result == null){
                    tips("no","出错了，服务器无反应...",3);
                    return false;
                }
		        if(result.code=='success') {
                    console.log(result);
		        	retrypost = 0;
		        	votedata = getvotedata();
                	$('#tp_'+bno).html(Math.round($('#tp_'+bno).text())+1);
                	var msg = "投票成功";
                	if ( result.msg && isNaN( result.msg ) ){ msg = result.msg; } 
                	var tip_time = 2;
                	if ( result.cj_tip ){
                		msg += '<br><br>';
                		msg += result.cj_tip;
                		tip_time = 20;
                	}

                    if ( result.cj_url ){
                        tips("cls");
                        layer.open({
                            className: 'tpSuccess', //样式类名
                            content: '<img style="width:100%;" src="http://pic.wxl00.cn/img/0/css/zpic.png"/>',
                            btn: ['砸金蛋','x'],
                            yes: function(index){
                                window.location.href = result.cj_url;
                            }    
                        }); 
                        return ;
                    }

                    tips("ok",msg,tip_time);
                }
                else if (result.code=='Recheck_area'){
                	if ( votedata.Location_post == 0 ){
                		Recheck_area(bno);
                	}else{
                		alert('请勿重复提交');
                	}
                    return false;
                }
                //需要
                else if (result.code=='need_luosimao'){
                    if ( typeof(LUOCAPTCHA) == 'undefined'){
                        alert('请刷新网页后再试'); tips('cls');
                    }
                    show_luosimao();
                }
                else if (result.code=='no_subscribe'){
                    showSubscribe();
                    return false;
                }else if (result.code=='needcheck' || result.code=='needcheck1'){
                    tips('cls');
                    $('#checkp').show();
                    return false;
                }else if (result.code=='ERROR_001'){
                    tips("no","投票服务器繁忙",3);
                }else if (result.code=='yzm'){
                	tips('cls');
                    showyzm(bno);
                }else if (result.code=='yzm_error'){
                	tips("no",result.msg,1);
                    showyzm(bno);
                }else {
                	tips("no",result.msg,3);
                }
		  },
		  complete: function () {
		  	    lock = false;
		  },
		  error: function (data) {
		  		alert('出错了');
		    	console.info("error: " + data.responseText);
		  }
	});
}






