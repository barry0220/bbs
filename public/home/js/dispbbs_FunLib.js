//dispbbs.asp

var _KD_BBSDOMAIN = "http://club.kdnet.net";
var _KD_DOMAIN = "http://www.kdnet.net";
var _KD_JSAPI = "http://jsapi.kdnet.net";

//展开引用楼层
function showQuoteCon(qid){
	$('#'+qid+' .quote-hide').removeClass('quote-hide');
	$('#'+qid+' .hide-tips').hide();
}

//弹出层控制--赞
function ding(announceid,posttable,t,div) {
	$.ajax({
		url: "ding.asp?announceid="+announceid+'&posttable='+posttable+'&t='+t+'&div='+announceid,
		type: "GET",
		cache: false,
		success: function(html){
		$('[id=ding_'+announceid+']').html(html);
		}
	});
}

//弹出层控制--取消赞同
function cancelAgree(obj){
/*
	if($(obj).attr('class') == 'agree-on'){
		$(obj).attr('title','取消赞同');
		$(obj).children().eq(0).html('取消赞同');
		$(obj).mouseout(function(){
			$(this).attr('title','赞同');
			$(this).children().eq(0).html('赞同');
		});
	}
	*/
}

//弹出层控制--举报
function openReport(topicid,posttable,announceid,boardid) {
   //alert(announceid+posttable);
	$.openPopupLayer({
		name: "RPopup",
		width: 600,
		url: "nreport.asp?id="+announceid+"&posttable="+posttable+"&bid="+boardid+"&tid="+topicid
	});
}

//弹出层控制--只看此人
function openSesPopup_new() {
	$.openPopupLayer({
		name: "SeePopups",
		width: 310,
		url: "see.asp"
	});
}


//弹出层控制
function openReturn1Popup(data,follow,boardid,status,content,lay,username,pages,tb) {
//location.href = location.href + "#Preply"
document.getElementById("baidu").src="return1_ubb.asp?table=DV_BBS8&aid="+data+"&f=" + follow + "&bid="+boardid+"&status="+status+"&content="+escape(content)+"&lay="+lay+"&un="+escape(username)+'&pages='+pages+'&tb='+tb;
document.getElementById("baidu").height= 780;
}

//弹出层控制
function openReturnPopup(data,follow,boardid,status,username,pages,tb) {
	document.getElementById("baidu").src="return_ubb.asp?aid="+data+"&f=" + follow + "&bid="+boardid+"&status="+status+"&username="+escape(username)+'&pages='+pages+'&tb='+tb;
	document.getElementById("baidu").height= 780;
}

//弹出层控制
function openReturnPopup_phone(data,follow,boardid,status,username,pages,tb) {
	$.openPopupLayer({
		name: "AddReturnPopup",
		width: 800,
		url: "return_phone.asp?aid="+data+"&f=" + follow + "&bid="+boardid+"&status="+status+"&username="+escape(username)+'&pages='+pages+'&tb='+tb
	});
}

// Sart 移除元素方法 
function closeDiv(obj) { 
    var divobj = document.getElementById(obj); 
    divobj.parentNode.removeChild(divobj); 
} 

//延伸阅读tab转换	
function tabChange(){
	$(".tab-title li").mouseover(function(){
		var i=$(".tab-title li").index(this);
		if(i==0){
			$(this).addClass("select");
			$(this).siblings("li").removeClass("select")
			$(".new-hot-box").hide(0)
			$(".mutuality-box").show()
		}
		if(i==1){
			return false
		}
		if(i==2){
			$(this).addClass("select");
			$(this).siblings("li").removeClass("select")
			$(".mutuality-box").hide(0)
			$(".new-hot-box").show()
		}
	})		
} 

// 微博一键分享 
function postToWb(type, boardid, rootid){
	var _url = location.href.toLowerCase();
	
	//var _u = 'http://testclub.kdnet.net/WeiBo_UploadPic/dispbbs_temp.asp?boardid='+boardid+'&id='+rootid+'&type='+type;	//测试
	var _u = 'http://club.kdnet.net/WeiBo_UploadPic/dispbbs_temp.asp?boardid='+boardid+'&id='+rootid+'&type='+type;	//正式
	window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
}

//提示信息显示与收起
	//1【sta】有两个值，'ok'为成功状态，'err'为失败或错误状态
	//2【context】为提示的信息内容
function showPromptMsg(sta,context){ 
	var cls = 'prompt-ok';
	if(sta=='err'){ cls='prompt-err'; }
	$('.collection-f .prompt-content').parent().attr('class',cls).show();
	$('.collection-f .prompt-content').html('<i></i>'+context).animate({top:'0px'},500);
	setTimeout(function(){
		$('.collection-f .prompt-content').animate({top:'100px'},500);
		setTimeout(function(){
			$('.collection-f .prompt-content').parent().hide();
		},600);
	},1500);
}

//点击后目标关闭
var isclose = false;
function openCollection(obj){
    $('body').bind('click', function(){
        if(isclose){
            $(obj).hide();
            setTimeout(function(){ isclose = false; }, 100);
        }
    });
    setTimeout(function(){ isclose = true; }, 100);
}

//显示并收藏信息
function collectionNews(obj){
	//如果上方的空间足够显示当前的收藏框则正常显示，否则为下方显示
	if(($(obj).offset().top-$(window).scrollTop()) < ($('.coll-box').height()+30)){
		$('.coll-box').addClass('coll-box-b');
	} else {
		$('.coll-box').removeClass('coll-box-b');
	}
	
	//收藏成功后显示收藏提示框并转换事件
	//$('.collection-f .collection-btn').html('<a href="javascript:;" title="取消收藏" onClick="delcollcet(); ">取消收藏</a>');
	setTimeout(function(){ $('.coll-box').show(); 

	$("input[name='addTag']").focus();	//sunny add 20130718 收藏分类标签默认有焦点
	$("#addTag").keydown(function(e){if (e.keyCode == 13){addtag();}});	//sunny add 20130718 收藏分类标签文本框支持回车键
	
	},10);
}

//取消收藏
function cancelCollectionNews(){
	//成功取消后则转换并显示提示
	$('.collection-f .collection-btn').html('<a href="javascript:;" title="收藏" onClick="collect();">收藏</a>');
	$('.coll-box').hide();
}

//移动加框效果
function overInput(obj){ $(obj).addClass('text-hover'); }
function outInput(obj){ $(obj).removeClass('text-hover'); }

//输入框检测
function checkInput(levId,objId){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	obj.focus();
}

//是否显示错误提示
function showArm(objId,showDel){ //判断提示
	var obj = $(objId);
	if(showDel=='show'){
		if(obj.val()==''){
			obj.addClass('text-err').next().show();
		} else {
			obj.removeClass('text-err').next().hide();
		}
	} else if(showDel=='del'){
		obj.next().hide();
	}
}

//选中时检测是否有值
function checkFocus(levId,objId){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	obj.addClass('text-focus');
	//判断是否有值，没有值则添加样式
	if(obj.val()==''){
		lev.addClass('label-focus');
	}
}

//失去焦点时判断
function checkBlur(levId,objId){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	obj.removeClass('text-focus');
	lev.removeClass('label-focus');
	if(obj.val()==''){ lev.show(); }
	showArm(obj,'show');
}

//键盘按下与弹起时的操作
function checkKeyDownUp(levId,objId,numOnly){
	var lev = $(levId), obj = $(objId);	//提示信息层, 输入框
	if(obj.val()==''){
		lev.show();
	} else {
		lev.hide();
	}
	//只能输入数字
	if(numOnly){
		if(isNaN(obj.val())){
			showArm(obj,'show');
			lev.show();
			obj.val('').next().show();
		}
	}
}

//收藏
function collect(){
	var topicid = $("#topicid").attr("value");
	var data = "a=collect&tid="+escape(topicid);

	$.ajax({
		//url: "<%=KD_BBSDOMAIN%>/checktag.asp",
		url: _KD_BBSDOMAIN + "/checktag.asp",
		//url: "http://bbs.kdnet.net/checktag.asp",
		type: "POST",
		data: data,
		cache: false,
		success: function(html){
			if (html.search("errtag") >= 0) {
				showPromptMsg('err',html.replace("errtag|", ""));
				$('.coll-box').hide();
			}
			else {
				collectionNews($('.collection-btn'));
				openCollection('.coll-box');
			}
		}
	});	
}

//添加收藏分类标签
function addtag(){
	var topicid = $("#topicid").attr("value");
	var data = "a=add&addtag=" + escape($("input[name='addTag']").val())+"&tid="+escape(topicid);

	$.ajax({
		//url: "<%=KD_BBSDOMAIN%>/checktag.asp",
		url: _KD_BBSDOMAIN + "/checktag.asp",
		//url: "http://bbs.kdnet.net/checktag.asp",
		type: "POST",
		data: data,
		cache: false,
		success: function(html){
			if (html.search("errtag") >= 0) {
				showPromptMsg('err',html.replace("errtag|", ""));
				$('.coll-box').hide();
			}
			else {
				//隐藏收藏框
				$('.coll-box').hide();
				//收藏操作
				if($('#addTag').val()!=''){
					//标签添加成功后弹出提示框并清空标签输入框
					$('#addTag').val('');
					$('.add-tag #label1').show();
					showPromptMsg('ok',html);
				}
				isclose = true;
			}
		}
	});	
}

//选择收藏分类标签
function seltag(){
	var key = escape($("input[name='addTag']").val())
	var data = "a=seltag&strkey="+key

	$.ajax({
		//url: "<%=KD_BBSDOMAIN%>/checktag.asp",
		url: _KD_BBSDOMAIN + "/checktag.asp",
		//url: "http://bbs.kdnet.net/checktag.asp",
		type: "POST",
		data: data,
		cache: false,
		success: function(html){
			if (html != "") {
				$("#id_nowtag").empty().append(html);
			}
		}
	});	
}

//删除收藏分类标签
function delcollcet(){
	var topicid = $("#topicid").attr("value");
	var data = "a=delcollect&tid="+escape(topicid);

	$.ajax({
		//url: "<%=KD_BBSDOMAIN%>/checktag.asp",
		url: _KD_BBSDOMAIN + "/checktag.asp",
		//url: "http://bbs.kdnet.net/checktag.asp",
		type: "POST",
		data: data,
		cache: false,
		success: function(html){
			if (html.search("errtag") >= 0) {
				showPromptMsg('err',html.replace("errtag|", ""));
				$('.coll-box').hide();
			}
			else {
				cancelCollectionNews();
				showPromptMsg('ok',html);
				openCollection('.coll-box');
			}
		}
	});	
}

function tagclick(obj){
	$('.coll-box .input-box-f input').eq(0).val($(obj).html()).focus().prev().hide();
}

