// if(typeof(KD)=="undefined"){KD={};}
if(typeof(KD)=="undefined"){KD={};}

KD.user = {
    titleSuffix: ' - 凯迪网络 全球华人最具影响力的言论及媒体平台',
    navData: {
      'index':{url:'index_login.asp',title:'我的主页'},
      'fposts':{url:'at.asp',title:'提到我的'},
      'reme':{url:'replyme.asp',title:'回复我的'},
      'test_reme':{url:'replyme_test.asp',title:'回复我的'},
	  'topic':{url:'posts.asp?t=1',title:'我的主贴'},
	  'reply':{url:'reply.asp',title:'我的回复'},
	  'blog':{url:'posts.asp?t=2',title:'我的博文'},
	  't':{url:'posts.asp?t=3',title:'我的微评'},
          'honors':{url:'honors.asp',title:'我的勋章'},
           'honors2':{url:'honors.asp#xt2',title:'我的勋章'},
	  'sms':{url:'control_SMS.asp',title:'我的私信'},
          'notice':{url:'control_SMS.asp?t=5',title:'我的通知'},
	  'sendSMS':{url:'control_SMS.asp?t=2',title:'发信息'},
	  'collection':{url:'control_collect.asp',title:'我的收藏'},
	  'collections':{url:'control_collect_new.asp',title:'我的收藏'},
	  'shop':{url:'control_shop.asp',title:'我的订单'},
	  'setting':{url:'control_base.asp',title:'我的设置'},
	  'password':{url:'control_password.asp',title:'我的密码'},	  
          'face':{url:'control_base.asp?t=3',title:'我的头像'},
	  'mobile':{url:'control_mobile.asp',title:'手机绑定'},
	  'bindAccount':{url:'bind_account.asp',title:'帐号绑定'},
	  'checkemail':{url:'check_email.asp',title:'邮件认证'},
          'checkphone':{url:'check_phone.asp',title:'手机认证'},
          'fans':{url:'control_follow.asp?t=1',title:'我的粉丝'},
	  'follow':{url:'control_follow.asp?t=0',title:'我关注的人'},
	  'black':{url:'control_follow.asp?t=2',title:'我的黑名单'},
	  'visit':{url:'visit_his.asp?t=1',title:'我访问过谁'},
	  'byVisit':{url:'visit_his.asp',title:'谁访问过我'},
	  'post':{url:'posts.asp?userid=' + userid, title:'我的主贴'},
	  'info':{url:'info.asp?userid=' + userid, title:'我的详细资料'},
	  'fansView':{url:'follow_list.asp?t=1&userid=' + userid,title:'关注我的人'},
	  'followView':{url:'follow_list.asp?t=0&userid=' + userid,title:'我关注的人'},
	  'integral':{url:'integral.asp?t=2',title:'我的积分'},
          'chongzhi':{url:'integral.asp',title:'充值'},
	  'invite':{url:'integral.asp?t=6',title:'我的邀请'},
          'record':{url:'recodes.asp',title:'浏览记录'},
	  'recycle':{url:'recycle.asp',title:'我的回收站'},
		  'vip':{url:'integral.asp?t=7',title:'凯迪会员'},	//sunny modify 20130902 积分
		  'chongzhisuccess':{url:'integral.asp?t=5',title:'积分充值成功'},	//sunny modify 20130902 积分
		  'couponsearch':{url:'coupon_search.asp',title:'现金券查询'},	//sunny modify 20130902 积分
  		  'vipsuccess':{url:'integral.asp?t=13',title:'会员付款成功'},	//sunny modify 20130902 积分
  		  'couponcharge':{url:'integral.asp?t=9',title:'现金券兑换'},	//sunny modify 20130902 积分
  		  'integrallog':{url:'integral.asp?t=2',title:'积分日志'},	//sunny modify 20130902 积分
  		  'paylog':{url:'integral.asp?t=1',title:'交易记录'},	//sunny modify 20130902 积分
		  'vipsearch':{url:'vip_search.asp',title:'会员查询'},	//sunny modify 20130902 积分
		  'abidingvip':{url:'integral.asp?t=14',title:'凯迪会员'},	//sunny 永久会员 20130929
 		  'abidingvipsuccess':{url:'integral.asp?t=15',title:'会员付款成功'},	//sunny 永久会员 20130929
 		  'givelotteryinfo':{url:'lottery.asp?t=1',title:'赠送彩票信息'},	//sunny 20131106 lottery
		  'goodsordersearch':{url:'goodsorder_search.asp',title:'订单查询'}, //modify sunny group purchase
		  'givingsearch':{url:'giving_search.asp?t=1',title:'打赏我的'} //sunny 打赏

   },
	init: function(args){
		//if(typeof(args) != 'undefined') {
			//if(typeof(args.submit_name)!='undefined')this.submit_name = args.submit_name;
		//}
		$("#fetch_commend_btn").click(function(){KD.user.fetchCommend()});
		$("#fetch_reply_btn").click(function(){KD.user.fetchReply()});
		$('#post_filter a').each(function(i,it){if (i != 0) $(it).click(function(){KD.user.fetchPost(it)});});
	},
	goto: function (name,el) {
		  KD.user.scrollTop();
		  document.location.hash = name;
		  document.body.className = name;
		  var url = KD.user.navData[name].url;
		  if (name == 'bindAccount' || name == 'integral') url += document.location.search;
		  $(cf).attr('src', url);
		  document.title = KD.user.navData[name].title.replace('我',username) + KD.user.titleSuffix;
	},
	fetchData: function(drawEl,url,data,callback){
		$.ajax({
		  url: url,
		  type: "GET",
		  data: data,
		  cache: false,
		  beforeSend: function(){
		    drawEl.html('<div class="defaultcont"><span class="loading">载入中...请稍候...</span></div>');
		  },
		  onError: function(){
		    drawEl.html('<div class="defaultcont">载入失败...请重试...</div>');
		  },
		  success: function(html){
		    if (html.search("div") == -1) {
		    	drawEl.html(html);
		    } else {
		    	drawEl.html(html);
		    	$("div.describe2 img[rel]").click(function(){$(this).overlay({expose: {color: '#000',opacity: 0.2,closeSpeed: 1000},top:'center',load:true});});
		    }
		  }
	  });
	},
	fetchCommend: function(){
		var drawEl = $('#myfollowact_2');
		if (drawEl.html() == '' || drawEl.html().search('defaultcont') != -1) {
			this.fetchData(drawEl,KDNET_USER_URL+'/ajax.asp',{a:'fetchCommend'});
		}
	},
	fetchReply: function(){
		var drawEl = $('#Active_cont_2');
		if (drawEl.html() == '' || drawEl.html().search('defaultcont') != -1) {
			this.fetchData(drawEl,KDNET_USER_URL+'/ajax.asp',{a:'fetchReply',userid:userid});
		}
	},
	fetchPost: function(el){
		var tab = el.href.split('#')[1];
		var drawEl = $('#'+tab);
		if (drawEl.html() == '' || drawEl.html().search('defaultcont') != -1) {
			this.fetchData(drawEl,KDNET_USER_URL+'/ajax.asp',{a:'fetchPost',t:tab,userid:userid});
		}
	},
	scrollTop: function(){
		$(document).scrollTop(0);
	}
}

$(document).ready(function(){
	KD.user.init({});
});