document.domain = "kdnet.net";
var dragimgurl = "upload/"; //批量上传的图片路径
var selectrange; //ie保存选择
var selectstart; //非ie保存开如始位置
var selectend; //非ie保存结束位置
var rewriteselectstart = 0;
var chicktextareaeditor = 0;
var friendsData = null;
var flpici = 0;//上传图片编号


document.execCommand('BackgroundImageCache', false, true);
//var atuserid = 5963891;
function getusers(atuserid) {
	if(atuserid<=0)
	{
		return;
	}
    var getallusers = "";
    //alert(atuserid);
    // 创建Ajax.Request对象，发起一个Ajax请求
    var data = { 'userid': atuserid };
    $.getJSON("http://user.kdnet.net/checkatuser_at.asp?jsoncallback=?",
							data,
							function (obj) {

							    var datas = obj.user;
							    if (datas != "") {
							        var userdata = datas.split('$');
							        for (var i = 0; i < userdata.length; i++) {
							            if (userdata[i].toString() != "") {
							                //中文转换拼音
							                var username = CC2PY(userdata[i].toString());
							                if (getallusers == "") {
							                    getallusers = "{user:'" + username + "',name:'" + userdata[i].toString() + "'}";
							                }
							                else {
							                    getallusers = getallusers + "," + "{user:'" + username + "',name:'" + userdata[i].toString() + "'}";
							                }
							            }
							        }
							    }
							    getallusers = "[" + getallusers + "] ";
							    friendsData = eval(getallusers);
							    //alert(getallusers);
							    //document.getElementById("scrolltop").innerHTML = getallusers;

							});
    return getallusers;
}

function gettextareaid() {
    var tbody = document.getElementById("body");
    return tbody;
}
var webcookies = {
    //获得coolie 的值      
    getCookie: function (name) {
        var cookieArray = document.cookie.split(";"); //得到分割的cookie名值对      
        var cookie = new Object();
        for (var i = 0; i < cookieArray.length; i++) {
            var arr = cookieArray[i].split("=");       //将名和值分开      
            if (arr[0].replace(/\s/ig, '') == name) return unescape(arr[1].replace(/\s/ig, '')); //如果是指定的cookie，则返回它的值      
        }
        return "";
    }, addCookie: function (objName, objValue, objHours) {      //添加cookie  
        var str = objName + "=" + escape(objValue);
        if (objHours > 0) {                               //为时不设定过期时间，浏览器关闭时cookie自动消失  
            var date = new Date();
            var ms = objHours * 3600 * 1000;
            date.setTime(date.getTime() + ms);
            str += "; expires=" + date.toGMTString();
        }
        document.cookie = str;
    }, delCookie: function (name)//删除cookie   
    {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = getCookie(name);
        if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
    }
}
var closepreview = false;
function loadopenorclose() {
    var ocpreview = "1";
    try {
        ocpreview = webcookies.getCookie(cookiename);
    }
    catch (e) { }
    if (ocpreview == "1") {
        closepreview = false;
    }
    if (ocpreview == "0") {
        closepreview = true;
    }
    if (closepreview) {
        webcookies.addCookie(cookiename, 0, 7200);
        document.getElementById("showorclosepre").title = "打开预览";
        if (cookiename != "postcookieopenorclose") {
            document.getElementById("showorclosepre").className = 'rf btn-preview-b';
        }
        closepreview = true;
        document.getElementById("getcontents").style.display = "none";
    }
    else {
        if (chicktextareaeditor == 1) {
            if (document.getElementById("getcontents").style.display == "none") {
                setupshowprecontents();

                webcookies.addCookie(cookiename, 1, 7200);
                document.getElementById("showorclosepre").title = "关闭预览";
                if (cookiename != "postcookieopenorclose") {

                    document.getElementById("showorclosepre").className = 'rf btn-preview';
                }
                closepreview = false;
                document.getElementById("getcontents").style.display = "";
            }
        }
    }
}
function setuppostwindowsize() {
    document.getElementById("postInputL").style.width = "100%";
    document.getElementById("textareaBox").style.width = "790px";

	var ta = document.getElementById('body');
	if (browser.msie && browser.version == '8.0') { ta.style.width = (ta.parentNode.offsetWidth - 20) + 'px'; }

    //document.getElementById("body").style.width = "96%";
}
function postloadopenorclose() {
    var ocpreview = "1";
    try {
        ocpreview = webcookies.getCookie(cookiename);
    }
    catch (e) { }
    if (ocpreview == "1") {
        closepreview = false;
    }
    if (ocpreview == "0") {
        closepreview = true;
    }
    if (closepreview) {
        //alert("qqqzzzz");
        //document.getElementById("showorclosepre").title = "打开预览";
        webcookies.addCookie(cookiename, 0, 7200);
        if (cookiename != "postcookieopenorclose") {

            document.getElementById("showorclosepre").className = 'rf btn-preview-b';
        }
        document.getElementById("showprecontents").style.display = "none";
        closepreview = true;
        document.getElementById("postopenbtn").style.display = "";
        findDimensions();
        setuppostwindowsize();
    }
    else {
        if (chicktextareaeditor == 1) {
            //alert("dsfsdf");
            //document.getElementById("showorclosepre").title = "关闭预览";
            document.getElementById("showprecontents").style.display = "";
            webcookies.addCookie(cookiename, 1, 7200);
            closepreview = false;
            document.getElementById("postopenbtn").style.display = "none";
            if (cookiename != "postcookieopenorclose") {

                document.getElementById("showorclosepre").className = 'rf btn-preview';
            }
        }
    }
}



function openorclose(obj) {
    var statetitle = obj.title;
    if (statetitle == "关闭预览") {
        webcookies.addCookie(cookiename, 0, 7200);
        obj.title = "打开预览";
        if (cookiename != "postcookieopenorclose") {
            obj.className = 'rf btn-preview-b';
        }
        closepreview = true;
        document.getElementById("getcontents").style.display = "none";
        try {
            document.getElementById("postopenbtn").style.display = "";
            //alert("www")
            obj.title = "关闭预览";
            findDimensions();
            setuppostwindowsize();
            document.getElementById("showprecontents").style.display = "none";
            if (cookiename != "postcookieopenorclose") {
                obj.className = 'rf btn-preview';
            }
            document.getElementById("showorclosepre").title = "打开预览";
            if (cookiename != "postcookieopenorclose") {
                document.getElementById("showorclosepre").className = 'rf btn-preview-b';
            }
        } catch (e) { }
        try {
            delbodyscrolltop();
        } catch (e) { }
    }
    else {
        setupshowprecontents();
        webcookies.addCookie(cookiename, 1, 7200);
        obj.title = "关闭预览";
        if (cookiename != "postcookieopenorclose") {
            obj.className = 'rf btn-preview';
        }
        closepreview = false;
        document.getElementById("getcontents").style.display = "";
        try {
            document.getElementById("postopenbtn").style.display = "none";
            obj.title = "打开预览";
            document.getElementById("showprecontents").style.display = "";
            if (cookiename != "postcookieopenorclose") {
                obj.className = 'rf btn-preview-b';
            }
            //alert(obj.id+"--"+obj.className);
            document.getElementById("showorclosepre").title = "关闭预览";
            if (cookiename != "postcookieopenorclose") {

                document.getElementById("showorclosepre").className = 'rf btn-preview';
            }
            setuppostwindowsize();
            findDimensions();

        } catch (e) { }
        try {
            if (ispparent == 0) {
                getparentobj().getElementById("baidu").height = document.body.scrollHeight + 30;
            }
            else {
                getparentobj().getElementById("baidu").height = document.body.scrollHeight + 30;
                getpparentobj().getElementById("baidu").height = document.body.scrollHeight + 30;
            }
        } catch (e) { }
        openpreview(0);
    }
}
function getparentobj() {
    var getobj;
    getobj = parent.document;
    return getobj;
}
function getpparentobj() {
    var getobj;
    getobj = parent.parent.document;
    return getobj;
}
function getuploadimg(url, result) {
    //alert(url);
    if (result == "1") {
        if (url != "") {
            document.getElementById("imgurl").value = url;
            document.getElementById("imgurl").style.display = "";
            document.getElementById("showinfo").style.display = "";
            document.getElementById("upiframe").style.display = "none";
            addpicok();
        }
    }
    else {
        selectupload(document.getElementById("selectnet"), 'localupload');
        alert(url);
    }
}
function closeall() {
    try {
        document.getElementById("colorlayer").style.display = "none";
        document.getElementById("showaddlink").style.display = "none";
        document.getElementById("showaddpic").style.display = "none";
        document.getElementById("showaddflash").style.display = "none";
        document.getElementById("photoCpv").style.display = "none";
    }
    catch (e) { }
}
//指定光标位置
function setSelRange(selectstart, selectend) {
    var t = gettextareaid();
    t.focus();  //先聚集
    try {
        movefocuspos(t, selectstart);
        //t.setSelectionRange(selectstart, selectend);  //设光标 
    } catch (e) { }
}
//
function addlink() {
    //加链接
    saveselectfont();
    saveselectblock();
    if (showselecttip()) {
        alert("请选择要添加链接的文字！");
        document.getElementById("showaddlink").style.display = "none";
        resetselectfont();
        return;
    }
    closeall();
    document.getElementById("showaddlink").style.display = "";
    showExposeMask();
}
function addlinkok() {
    var strhyperLink = document.getElementById("hyperLink").value;
	strhyperLink=strhyperLink.replace(/\s/ig,"");
	//alert(strhyperLink+'dds');
    if (strhyperLink == "") {
        alert("请填写链接地址！");
        return;
    }
    var ahref = "[url=" + strhyperLink + "]$stxt$[/url]";

    replaceandinsert(ahref, 'url');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
    ahref = "";
    document.getElementById("hyperLink").value = "http://";
    document.getElementById("showaddlink").style.display = "none";
    hideExposeMask();
}
//替换插入内容前提示
function showselecttip() {
    var t = gettextareaid();
    if (document.selection) {
        var seltxt = selectrange.text;
        if (seltxt == "") {
            return true;
        }
    } else {
        var ubbLength = t.value.length;
        var seltxt = t.value.slice(selectstart, selectend)
        if (seltxt == "") {
            return true;
        }
    }
    return false;
}
//替换插入内容
function replaceandinsert(inserthtml, labelname) {
    var t = gettextareaid();
    if (document.selection) {
        var seltxt = selectrange.text;
        if (labelname != "") {
            seltxt = replaceselectcontents(seltxt, labelname);
        }
        selectrange.text = inserthtml.replace("$stxt$", seltxt);
        inserthtml = inserthtml.replace("$stxt$", seltxt);
    } else {

        var ubbLength = t.value.length;
        var seltxt = t.value.slice(selectstart, selectend)
        var replacehtml = seltxt;
        if (labelname != "") {
            replacehtml = replaceselectcontents(replacehtml, labelname);
        }
        inserthtml = inserthtml.replace("$stxt$", replacehtml);
        t.value = t.value.slice(0, selectstart) + inserthtml + t.value.slice(selectstart + seltxt.length, ubbLength);
    }
    selectend = selectstart + inserthtml.length; //保存插入后的光标位置
    //alert(selectstart + "---" + selectend);
}
//替换插入内容
function replacepasteandinsert(inserthtml, labelname) {
    var t = gettextareaid();
    if (document.selection) {
        var seltxt = selectrange.text;
        if (labelname != "") {
            seltxt = replaceselectcontents(seltxt, labelname);
        }
        selectrange.text = inserthtml.replace("$stxt$", seltxt);
        inserthtml = inserthtml.replace("$stxt$", seltxt);
    } else {

        var ubbLength = t.value.length;
        var seltxt = t.value.slice(selectstart, selectend)
        var replacehtml = seltxt;
        if (labelname != "") {
            replacehtml = replaceselectcontents(replacehtml, labelname);
        }
        inserthtml = inserthtml.replace("$stxt$", replacehtml);
        t.value = t.value.slice(0, selectstart) + inserthtml + t.value.slice(selectstart + seltxt.length, ubbLength);
    }
    selectend = replacepastestart + inserthtml.length; //保存插入后的光标位置
    //alert(selectstart + "---" + selectend);
}

//根据内容替换指定标签
function replaceselectcontents(replacehtml, labelname) {

    var restart = eval("/\\[" + labelname + "s*=\\s*([^\\]\"]+?)(?:\"[^\\]]*?)?\\s*\\]/ig");
    replacehtml = replacehtml.replace(restart, '');

    var restart = eval("/\\[" + labelname + "\\]/ig");
    replacehtml = replacehtml.replace(restart, '');

    if (labelname == "left" || labelname == "center" || labelname == "right") {
        replacehtml = replacehtml.replace(/\[(left|center|right)\]/ig, '');
        replacehtml = replacehtml.replace(/\[\/(left|center|right)\]/ig, '');
    }

    var reend = eval("/\\[\\/" + labelname + "\\]/ig");
    replacehtml = replacehtml.replace(reend, '');
    return replacehtml;
}


function closelink() {
    document.getElementById("hyperLink").value = "http://";
    document.getElementById("showaddlink").style.display = "none";
    hideExposeMask();
}
//选择贴图方式
function selectupload(obj, id) {
    document.getElementById("httplink").style.display = "none";
    document.getElementById("localupload").style.display = "none";
    document.getElementById("uploadtype").value = 0;
    if (id == "localupload") {
         document.getElementById("showshuiyinselect").style.display = "";
         document.getElementById("showuploadtip").style.display = "";
       document.getElementById("selectnet").className = "";
        document.getElementById("selectlocal").className = "on";
        document.getElementById("showhistoryuploadimg").style.display = "";
        //var msie6 = navigator.userAgent.indexOf("MSIE 6");
        ///if (msie6 >= 0) {
        //document.getElementById("upiframe").src = uploaddir + "uploadpicie6.html";
        document.getElementById("upiframe").src = "uploadpicie6_rong.html";
        //document.getElementById("iscloseuploadimgbtn").style.display = "none";
        //}
        // else {
        //     document.getElementById("upiframe").src = "uploadpic.html";
        // }
        document.getElementById("uploadtype").value = 1;

        document.getElementById("imgurl").value = "";
        document.getElementById("imgurl").style.display = "none";
        document.getElementById("showinfo").style.display = "none";
        document.getElementById("upiframe").style.display = "";
    }
    else {
        document.getElementById("showshuiyinselect").style.display = "none";
        document.getElementById("showuploadtip").style.display = "none";
        document.getElementById("showhistoryuploadimg").style.display = "none";
        //document.getElementById("iscloseuploadimgbtn").style.display = "";
        document.getElementById("selectnet").className = "on";
        document.getElementById("selectlocal").className = "";
    }
    document.getElementById(id).style.display = "";
}
function pastepicandtxt() {
    //带图片粘贴
    saveselectfocus();
    closeall();
    document.getElementById("pasteallhtml").innerHTML = "";
    document.getElementById("photoCpv").style.display = "";
}
function pasteaftercleardivhtml(event) {
    if (event.keyCode == 86) {
        setTimeout(function () { cleardivhtml(); }, 300);
    }
}
function cleardivhtml() {
    var pasteallhtml = document.getElementById("pasteallhtml").innerHTML;
    pasteallhtml = clearimghtml(pasteallhtml);
    pasteallhtml = getpasteimg(pasteallhtml);
    pasteallhtml = clearpastehtml(pasteallhtml);
    //pasteallhtml = formatdata(pasteallhtml); //格式化数据
    var aftertext = ubbtohtml(pasteallhtml, '');
    document.getElementById("pasteallhtml").innerHTML = aftertext;
}
function pastepicandtxtok() {
    var pasteallhtml = document.getElementById("pasteallhtml").innerHTML;

    var ishtml = isrunformat();
    pasteallhtml = clearimghtml(pasteallhtml);
    pasteallhtml = getpasteimg(pasteallhtml);
    pasteallhtml = clearpastehtml(pasteallhtml);
    if (ishtml) {
        pasteallhtml = formatdata(pasteallhtml); //格式化数据
    }

    var oldselectstart = selectstart + pasteallhtml.length;
    if (checkmsiever()) {
        oldselectstart = getselstartpos + pasteallhtml.length;
    }

    insertcontent(pasteallhtml);

    openpreview(1);
    setSelRange(oldselectstart, oldselectstart);

    document.getElementById("pasteallhtml").innerHTML = "";
    document.getElementById("photoCpv").style.display = "none";
    hideExposeMask();
}

//多图片上传
function flashuploadpic(imgurl) {
    showfloadpics(imgurl);
    flpici++;
	shuiyinoperation(imgurl);
}

function showfloadpics(imgurl) {
    var oldchilds = flpici - 1;
    if (flpici <= 0) {
        oldchilds = 0;
    }
    var m = document.getElementById("showhistoryuploadimg");
    var delchilds = flpici - 10;
    if (delchilds >= 0) {
        m.removeChild(document.getElementById("span" + delchilds + ""));
    }
    var progress = m.insertBefore(document.createElement("span"), document.getElementById("span" + oldchilds + ""));
    progress.id = "span" + flpici;
    progress.innerHTML = '<em class="st" id="em' + flpici + '"  onclick="selectuploadedimg(document.getElementById(img' + flpici + '),' + flpici + ');"></em><img id=img' + flpici + ' onclick="selectuploadedimg(this,' + flpici + ');" title="取消选择图片" src="' + imgurl + '" />';
    webcookies.addCookie("saveuploadimg", m.innerHTML);
}
loaduploadimg();
function loaduploadimg() {
    var m = document.getElementById("showhistoryuploadimg");
    m.innerHTML = webcookies.getCookie("saveuploadimg");
    //alert(m.childNodes[0].id);
    if (m.childNodes.length > 0) {
        flpici = parseInt(m.childNodes[0].id.replace("span", "")) + 1;
    }
    //alert(flpici);
    var maxpic = 0;
    for (var i = flpici; i >=0; i--) {
        if (maxpic > 12) {
            break;
        }
        maxpic++;
        try {
            document.getElementById("em" + i + "").style.display = "none";
            document.getElementById("img" + i + "").title = "点击选择图片";
        } catch (e) { }
    }
}

//选中已经上传的图片
function selectuploadedimg(obj,id) {
    if (obj.title == "点击选择图片") {
        obj.title = "取消选择图片";
        document.getElementById("em" + id + "").style.display = "block";
    }
    else {
        obj.title = "点击选择图片";
        document.getElementById("em" + id + "").style.display = "none";
    }
}


function addpic() {
    //贴图
    saveselectfocus();
    closeall();
    selectupload(document.getElementById("selectnet"), 'localupload');
    //document.getElementById("upiframe").src = "uploadpic.html";
    document.getElementById("httpaddr").value = "";
    document.getElementById("showaddpic").style.display = "";

    if (document.getElementById("showhistoryuploadimg").innerHTML == "") {
        loaduploadimg();
    }

    showExposeMask();
}
//保存光标位置
function saveselectfocus() {
    var t = gettextareaid();
    if (document.selection) {
        selectrange = t.createTextRange();
    }
    else {
        selectstart = t.selectionStart;
        selectend = t.selectionEnd;
    }
}

var getselstartpos = 0;
function getPos(textBox) {

    var start = 0;

    var end = 0;

    if (document.selection) {

        var range = document.selection.createRange();

        if (range.parentElement().id == textBox.id) {

            var range_all = document.body.createTextRange();

            range_all.moveToElementText(textBox);

            //两个range，一个是已经选择的text(range)，一个是整个textarea(range_all) 

            //range_all.compareEndPoints()比较两个端点，如果range_all比range更往左(further to the left)，则 //返回小于0的值，则range_all往右移一点，直到两个range的start相同。 

            for (start = 0; range_all.compareEndPoints("StartToStart", range) < 0; start++) {
                range_all.moveStart('character', 1);
            }
            getselstartpos = start;
            var ssstart = start;
            // 计算一下\n 
            var textvalue = textBox.value;
            for (var i = 0; i <= start; i++) {
                if (textvalue.charAt(i) == '\n')
                    start++;
            }
        }
    }
    else
    { start = textBox.selectionStart; }

    return { s: start, e: textvalue }
}


//根据保存的光标位置插入内容
function insertcontent(inserthtml) {
    var t = gettextareaid();

    if (document.selection) {
        t.focus();
        selectrange.text = t.value.slice(0, selectstart) + inserthtml + t.value.slice(selectstart, t.value.length);
    } else {
        selectend = selectstart;
        var ubbLength = t.value.length;
        var seltxt = t.value.slice(selectstart, selectend)
        inserthtml = inserthtml + seltxt;
        t.value = t.value.slice(0, selectstart) + inserthtml + t.value.slice(selectstart, ubbLength);
    }
    selectstart = selectstart + inserthtml.length; //保存插入后的光标位置
}

function shuiyinoperation(imgurl)
{
		var splitlists=imgurl.split("/");
		var geturlname=splitlists[(splitlists.length-1)];

	if(geturlname!="")
	{
		var urls="http://upfile1.kdnet.net/shuiyin.asp?pics="+geturlname+"";
		if(document.getElementById("addimgshuiyin").checked)
		{
			creatimgshuiyin(urls);
		}
		else
		{
			urls = "http://upfile1.kdnet.net/no_shuiyin.asp?pics="+geturlname+"";
			creatimgshuiyin(urls);
		}
	}
}

function addpicok() {
    var httpurl = document.getElementById("httpaddr").value;
    var uploadtype = document.getElementById("uploadtype").value;
    var httpaddr = "\n[img]" + httpurl + "[/img]";
    if (uploadtype == 1) {
        httpaddr = "";
        //取出图片并转成ubb
        for (var i = flpici; i >= 0; i--) {
            var isexist = 0;
            var imgobj;
            try {
                imgobj = document.getElementById("img" + i + "");
                isexist = 1;
            } catch (e) { isexist =0; }
            if (isexist == 1 && imgobj!=null) {
                try {
                    if (imgobj.title == "取消选择图片") {
						var imgurl=imgobj.src;
						var cleardomain=imgurl.split(".net");
						if(cleardomain.length>0)
						{
							imgurl=cleardomain[1];
							httpaddr = "\n[img]" + imgurl + "[/img]\n"+httpaddr;
						}
                    }
                } catch (e) { }
            }
        }
        //清除历史记录
        document.getElementById("showhistoryuploadimg").innerHTML = "";
        loaduploadimg();
    }
    else {

        if (httpurl == "") {
            alert("上传图片格式不正确！只支持.jpg|.png|.gif格式。");
            return;
        }

        var formatstart = httpurl.lastIndexOf('.');
        var filetype = httpurl.substring(formatstart + 1, formatstart + 5).toLowerCase();
        var isftype = false; // gif, jpg, jpeg, png, bmp
        if (filetype == "jpg" || filetype == "png" || filetype == "gif" || filetype == "jpeg" || filetype == "bmp") {
            isftype = true;
        }
        if (!isftype) {
            alert("上传图片格式不正确！只支持.jpg|.png|.gif|.jpeg|.bmp格式。");
            return;
        }
    }
    httpaddr = httpaddr + "\n";

    var oldselectstart = selectstart + httpaddr.length;
    if (checkmsiever()) {
        oldselectstart = getselstartpos + httpaddr.length;
    }

    insertcontent(httpaddr);

    openpreview(1);
    setSelRange(oldselectstart, oldselectstart);

    httpaddr = "";
    document.getElementById("httpaddr").value = "http://";
    document.getElementById("showaddpic").style.display = "none";
    hideExposeMask();
}
var cbnum=0;
function creatimgshuiyin(url)
{
 var script = document.createElement("script");

    creatimgshuiyin[cbnum] = function (response) {
        try {
            //alert("finish!");
        }
        catch (e) {
        }
        finally {
            delete creatimgshuiyin[cbnum];
            script.parentNode.removeChild(script);
        }
    };
    script.src = url;
    document.body.appendChild(script);
	cbnum++;
}

function selectimg(obj) {
    var httpurl = obj.alt;
    var httpaddr = "[img]" + httpurl + "[/img]";
    if (httpurl == "") {
        return;
    }

    var formatstart = httpurl.lastIndexOf('.');
    var filetype = httpurl.substring(formatstart + 1, formatstart + 4).toLowerCase();
    var isftype = false;
    if (filetype == "jpg" || filetype == "png" || filetype == "gif" || filetype == "jpeg" || filetype == "bmp") {
        isftype = true;
    }
    if (!isftype) {
        alert("上传图片格式不正确！只支持.jpg|.png|.gif|.jpeg|.bmp格式。");
        return;
    }

    insertcontent(httpaddr);
    openpreview(1);
    setSelRange(selectstart, selectstart);
    httpaddr = "";
}

function closepic() {
    document.getElementById("showaddpic").style.display = "none";
    hideExposeMask();
}

//选择视频上传方式
function selectvideoupload(obj, id) {
    document.getElementById("neturl").style.display = "";
    document.getElementById("localvideoupload").style.display = "none";
    document.getElementById("videotype").value = 0;
    if (id == "localvideoupload") {
        document.getElementById("selectneturl").className = "";
        document.getElementById("selectlocalvideo").className = "on";

        document.getElementById("iframevideo").style.display = "";
        document.getElementById("iframevideo").src = "SDK_v32/demo/plugin/diyupload.php";
        document.getElementById("videotype").value = 1;

        document.getElementById("videourl").style.display = "none";
        document.getElementById("showvideoinfo").style.display = "none";

        document.getElementById("neturl").style.display = "none";
        document.getElementById("netvideourl").value = "";

        document.getElementById("localvideoupload").style.display = "";
    }
    else {
        document.getElementById("selectneturl").className = "on";
        document.getElementById("selectlocalvideo").className = "";
    }
}


//上传成功返回执行
function getuploadvideo(url, vid) {
    //alert(url);
    if (url != "") {
        //addCookie("videourl", url, "24");
        //alert(vid);
        document.getElementById("videourl").value = url; //"http://player.56.com/open_"+vid+".swf";
        document.getElementById("videourl").style.display = "";
        document.getElementById("showvideoinfo").style.display = "";
        document.getElementById("localvideoupload").style.display = "";
        document.getElementById("iframevideo").style.display = "none";
    }
}
//上传失败返回执行
function getuploadbadvideo(result) {
    alert(result);
    document.getElementById("iframevideo").src = "SDK_v32/demo/plugin/diyupload.php";
}


function addflash() {
    //Flash
    saveselectfocus();
    closeall();
    selectvideoupload(document.getElementById("selectneturl"), 'neturl');
    document.getElementById("showaddflash").style.display = "";
    showExposeMask();
    $('#netvideourl').val('');
}
function addflashok() {
    //netvideourl videourl
    var flashurl = $('#netvideourl').val();
    if(flashurl.match(/https?:\/\/play\.video\.qcloud\.com([^\"]*?)/)){
        $('.loadingtip').html('正在解析中……');
        var urldata = flashurl;
        var iframe = "[video2]" + urldata + "[/video2]";

        insertcontent(iframe);
        openpreview(1);
        setSelRange(oldselectstart, oldselectstart);
        hideExposeMask();

        $('.loadingtip').html('');
        return false;
    }

    var url = encodeURIComponent(flashurl);
    if(!flashurl){
        alert('请输入视频地址');
        $('#netvideourl').focus();
        return;
    }
    $('.loadingtip').html('正在解析中……');
    $.ajax({
        url: "http://helper.kdnet.net/api/video/parsingByKeyword",
        // url: "http://helper.test.kdnet.net/api/video/parsingByKeyword",
        dataType: 'jsonp',
        jsonp:'callback',
        data: {
            keyword:url
        },
        success: function(json){
            if(json.success){
                // $('#netvideourl').val('http://');
                $('#showaddflash').hide();
                var data = json.data.iframe
                var pattern = /\"https?:\/\/([^\"]*?)\"/ig;   //匹配iframe地址
                var urldata = String(data.match(pattern));
                urldata = urldata.replace(/\"/g,'');

                var iframe = "[video2]" + urldata + "[/video2]";

                insertcontent(iframe);
                openpreview(1);
                setSelRange(oldselectstart, oldselectstart);
                hideExposeMask();
            }else{
                alert(json.message);
            }
            $('.loadingtip').html('');
        }
    });

    return;
    var flashurl = document.getElementById("netvideourl").value;
    var videotype = document.getElementById("videotype").value;
    if (videotype == 1) {
        flashurl = document.getElementById("videourl").value;
    }

    var flashwidth = document.getElementById("width").value;
    var flashheight = document.getElementById("height").value;

    var flashlink = "[video=" + flashwidth + "," + flashheight + "]" + flashurl + "[/video]";
    if (flashurl == "") {
        return;
    }
    //var formatstart = flashurl.lastIndexOf('.'); ////swf,flv,mp3,wav,wma,mid,avi,mpg,asf,rm,rmvb
    //var filetype = flashurl.substring(formatstart + 1, formatstart + 4).toLowerCase();
    //var isftype = false;
    //if (filetype == "swf" || filetype == "flv" || filetype == "mp3" || filetype == "wav" || filetype == "wma" || filetype == "mid" || filetype == "avi" || filetype == "mpg" || filetype == "asf" || filetype == "rm" || filetype == "rmvb") {
    //    isftype = true;
    //}
    //if (!isftype) {
    //    alert("上传格式不正确！只支持.swf|.flv|.mp3|.wav|.wma|.mid|.avi|.mpg|.rm|.rmvb格式。");
    //    return;
    //}

    var oldselectstart = selectstart + flashlink.length;
    if (checkmsiever()) {
        oldselectstart = getselstartpos + flashlink.length;
    }

    insertcontent(flashlink);
    openpreview(1);
    setSelRange(oldselectstart, oldselectstart);

    flashlink = "";
    // document.getElementById("netvideourl").value = "http://";
    // document.getElementById("showaddflash").style.display = "none";
    hideExposeMask();
}
function closeflash() {
    // document.getElementById("netvideourl").value = "http://";
    document.getElementById("showaddflash").style.display = "none";
    hideExposeMask();
}
function addfontweight() {
    //粗体
    selectstart = getStartCursor();
    var fw = "[b]$stxt$[/b]";
    //var fw = "[strong]$stxt$[/strong]";
    add(fw, 'b');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);

}
function addfonti() {
    //斜体
    selectstart = getStartCursor();
    var fi = "[i]$stxt$[/i]";
    add(fi, 'i');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}
function addfontu() {
    //斜体
    selectstart = getStartCursor();
    var fu = "[u]$stxt$[/u]";
    add(fu, 'u');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}
function addalignleft() {
    //左对齐
    selectstart = getStartCursor();
    var fu = "[left]$stxt$[/left]";
    add(fu, 'left');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}
function addaligncenter() {
    //居中对齐
    selectstart = getStartCursor();
    var fu = "[center]$stxt$[/center]";
    add(fu, 'center');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}
function addalignright() {
    //右对齐
    selectstart = getStartCursor();
    var fu = "[right]$stxt$[/right]";
    add(fu, 'right');
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}
//取编辑器内容插入标签
function add(txt, replacelabel) {
    var t = gettextareaid();
    saveselectfont();
    if (document.selection) {
        var seltxt = document.selection.createRange().text;

        if (seltxt == "") {
            alert("请选择文字！再操作！");
            document.getElementById("colorlayer").style.display = "none";
            resetselectfont();
            return;
        }

        if (replacelabel != "") {
            seltxt = replaceselectcontents(seltxt, replacelabel);
        }
        selectrange = document.selection.createRange();
        document.selection.createRange().text = txt.replace("$stxt$", seltxt);
        txt = txt.replace("$stxt$", seltxt);

    } else {
        var cp = t.selectionStart;
        var ubbLength = t.value.length;
        var seltxt = t.value.slice(t.selectionStart, t.selectionEnd)

        var replaceseltxt = seltxt;
        if (replacelabel != "") {
            replaceseltxt = replaceselectcontents(replaceseltxt, replacelabel);
        }

        if (seltxt == "") {
            alert("请选择文字！再操作！");
            document.getElementById("colorlayer").style.display = "none";
            resetselectfont();
            return;
        }
        txt = txt.replace("$stxt$", replaceseltxt);
        t.value = t.value.slice(0, t.selectionStart) + txt + t.value.slice(t.selectionStart + seltxt.length, ubbLength);
    }
    selectend = selectstart + txt.length;

    seltxt = "";
}
//保存先择的内容区
var isselected = false;
function saveselectblock() {
    isselected = false;
    if (document.selection) {
        selectrange = document.selection.createRange();
        selectstart = getStartCursor();
        if (selectrange.text != "") {
            isselected = true;
        }
    }
    else {
        var t = gettextareaid();
        selectstart = t.selectionStart;
        selectend = t.selectionEnd;
        if (selectend != selectstart) {
            isselected = true;
        }
    }
}
//获取光标位置
function getStartCursor() {
    var t = gettextareaid();

    if (document.selection) {
        t.focus();
        var ds = document.selection;
        var range = ds.createRange();
        var stored_range = range.duplicate();
        stored_range.moveToElementText(t);
        stored_range.setEndPoint("EndToEnd", range);
        var rangetxt = stored_range.text;
        var msie6 = navigator.userAgent.indexOf("MSIE 6");

        //if (msie6 < 0) {
            rangetxt = stored_range.text.replace(/\r\n/ig, "\n");
        //}
        t.selectionStart = rangetxt.length - range.text.length;
        t.selectionEnd = t.selectionStart + range.text.length;
        return t.selectionStart;
    } else return t.selectionStart
}
var replacepastestart = 0;
function savepasteselectblock() {
    isselected = false;
    if (document.selection) {
        selectrange = document.selection.createRange();
        //selectstart = getpasteStartCursor();
        if (selectrange.text != "") {
            replacepastestart = getpasteStartCursor();
            isselected = true;
        }
    }
    else {
        var t = gettextareaid();
        selectstart = t.selectionStart;
        selectend = t.selectionEnd;
        if (selectend != selectstart) {
            isselected = true;
        }
    }
}
//获取光标位置
function getpasteStartCursor() {
    var t = gettextareaid();

    if (document.selection) {
        t.focus();
        var ds = document.selection;
        var range = ds.createRange();
        var stored_range = range.duplicate();
        stored_range.moveToElementText(t);
        stored_range.setEndPoint("EndToEnd", range);
        var rangetxt = stored_range.text;
        t.selectionStart = rangetxt.length - range.text.length;
        t.selectionEnd = t.selectionStart + range.text.length;
        //var ddf = rangetxt.split("\r\n");

        //alert(t.selectionStart + "--" +stored_range.text+"--"+ range.text);
        return t.selectionStart;
    } else return t.selectionStart
}

//选中文字
function selstartandend(t, s, z) {
    if (document.selection) {
        var range = t.createTextRange();
        range.moveEnd('character', -t.value.length);
        range.moveEnd('character', z);
        range.moveStart('character', s);
        range.select();
    } else {
        t.setSelectionRange(s, z);
        t.focus();
    }
}

//显示或隐藏
function showorhidden(obid) {
    if (document.getElementById(obid).style.display == "") {
        document.getElementById(obid).style.display = "none";
    }
    else {
        document.getElementById(obid).style.display = "";
    }
}

//点击当前窗体任何位置关闭
var isclosewin = false;
function closeallwindow(closeobj) {
    $('body').bind("click", function () {
        if (isclosewin) {
            document.getElementById(closeobj).style.display = "none";
            setTimeout(function () { isclosewin = false; }, 100);
        }
    });
    setTimeout(function () { isclosewin = true; }, 100);
}
function closeopenwindow(closeobj) {
    $('body').bind("mouseup", function () {
        var sfsdfs = document.getElementById(closeobj).focus();
        if (isclosewin) {
            document.getElementById(closeobj).style.display = "none";
            setTimeout(function () { isclosewin = false; }, 100);
        }
    });
    setTimeout(function () { isclosewin = true; }, 100);
}
function mousedownobj(obj) {
    isclosewin = false;
    setTimeout(function () { isclosewin = true; }, 100);

}
//保存选择
function saveselectfont() {
    var msie6 = navigator.userAgent.indexOf("MSIE 6");

    if (getOs() == "MSIE" && msie6 < 0) {
        try {
            if (rewriteselectstart == selectstart) {
                selstartandend(gettextareaid(), selectstart, selectend);
            }
        } catch (e) { }
        rewriteselectstart = selectstart;
    }
}
function resetselectfont() {
    if (getOs() == "MSIE") {
        rewriteselectstart = 0;
        selectend = 0;
    }
}
//颜色
function showcolormenu() {
    saveselectfont();
    saveselectblock();
    if (showselecttip()) {
        document.getElementById("colorlayer").style.display = "none";
        alert('请选择要添加颜色的文字！');
        resetselectfont();
        return;
    }
    showorhidden('colorlayer');
    closeallwindow('colorlayer');

}

function selectcolor(color) {
    var colorhtml = "[color=" + color + "]$stxt$[/color]";
    replaceandinsert(colorhtml, 'color');
    document.getElementById("colorlayer").style.display = "none";
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}

//@人

document.getElementById('showallatlists').onclick = function (event) {
    saveselectfocus();
    showatdatalist();

    document.getElementById('atmen').style.display = 'block';
    stopBubble(event);
	try
	{
		document.onclick = function () {
			document.getElementById('atmen').style.display = 'none';
			document.onclick = null;
		}
	}catch(e){}
}

document.getElementById('atmen').onclick = function (event) {
    stopBubble(event);
}
function stopBubble(e) {
    if (e && e.stopPropagation) {
        e.stopPropagation();    //w3c
    } else {
        window.event.cancelBubble = true; //IE
    }
}

//onenter
function onenter(event,obj)
{
	var ie = (document.all)? true:false
	if (ie)
	{
		try{
		event = window.event;
		}catch(e){}
	}
	if(event.keyCode==13)
	{
		insertatok(obj,0);
	}
}


function inquiry(data, str, num) {
	        if (friendsData == null) {
                getusers(atuserid);
            }

            if (friendsData == null) {
                return false;
            }
    if (str == '') return friendsData.slice(0, num);

    var reg = new RegExp(str, 'i');
    var i = 0;
    //var dataUserName = {};
    var sd = [];

    while (sd.length < num && i < data.length) {
        if (reg.test(data[i]['user']) || reg.test(data[i]['name'])) {
            sd.push(data[i]);
            //dataUserName[data[i]['user']] = true;
        }
        i++;
    }
    sd = bubbleSort(sd, str);

    return sd;
}

//冒泡排序
function bubbleSort(array, str) {
    str = str.toLocaleLowerCase();
    var i = 0, len = array.length, j, d;
    for (; i < len; i++) {
        for (j = 0; j < len; j++) {
            if (str.charCodeAt(0) >= 65 && str.charCodeAt(0) <= 122) {
                if (array[i].user.toLocaleLowerCase().indexOf(str) < array[j].user.toLocaleLowerCase().indexOf(str)) {
                    d = array[j]; array[j] = array[i]; array[i] = d;
                }
            }
            else {
                if (array[i].name.indexOf(str) < array[j].name.indexOf(str)) {
                    d = array[j]; array[j] = array[i]; array[i] = d;
                }
            }
        }
    }
    return array;
}

function showatdatalist() {
	        if (friendsData == null) {
                getusers(atuserid);
            }

            if (friendsData == null) {
                return false;
            }

    var char = document.getElementById("searchatname").value;
    var data = inquiry(friendsData, char, 5);
    var html = '<li onmouseout="showmouseout(this);" onmouseover="showmouseover(this);" onclick="insertatok(this,1);">$NAME$</li>';
    var h = '';
    var len = data.length;

    if (len > 0) {
        var reg = new RegExp(char);
        var em = '<em>' + char + '</em>';
        for (var i = 0; i < len; i++) {
            var hm = data[i]['user'].replace(reg, em);
            h += html.replace(/\$ACCOUNT\$|\$NAME\$/g, data[i]['name']).
						replace('$SACCOUNT$', hm).replace('$ID$', data[i]['name']);
        }
    }
    document.getElementById("showatdatalists").innerHTML = h;
}

function insertatok(obj,valuetype) {
    var atdata = obj.innerHTML;
    if (valuetype == 0) {
        atdata = document.getElementById("searchatname").value;
    }
    if (atdata != "") {
        atdata = "@" + atdata + " ";
    }
    var oldselectstart = selectstart + atdata.length;
    if (checkmsiever()) {
        oldselectstart = getselstartpos + atdata.length;
    }

    insertcontent(atdata);

    openpreview(1);
    setSelRange(oldselectstart, oldselectstart);

    document.getElementById("atmen").style.display = "none";
    document.getElementById("searchatname").value = "";
}

//关闭@人
function closeatwin() {
    document.getElementById("atmen").style.display = "none";
    document.getElementById("searchatname").value = "";
}


function selectcolor(color) {
    var colorhtml = "[color=" + color + "]$stxt$[/color]";
    replaceandinsert(colorhtml, 'color');
    document.getElementById("colorlayer").style.display = "none";
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}


//经过
var cssname;
function showmouseout(obj) {
    if (cssname != "") {
        obj.className = cssname;
    }
    else {
        obj.className = "";
    }
}
function showmouseover(obj) {
    cssname = obj.className;
    if (cssname != "") {
        obj.className = "" + cssname + " on";
    }
    else {
        obj.className = "on";
    }
}


//字体大小
function showsizemenu() {
    saveselectfont();
    saveselectblock();
    if (showselecttip()) {
        alert("请先选中文字！再操作！");
        document.getElementById("sizelayer").style.display = "none";
        resetselectfont();
        return;
    }
    showorhidden('sizelayer');
    closeallwindow('sizelayer');
}

function selectsize(size) {
    var sizehtml = "[size=" + size + "]$stxt$[/size]";
    replaceandinsert(sizehtml, 'size');
    document.getElementById("sizelayer").style.display = "none";
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}

//字体大小

//字号
function selectfontfamily() {
    saveselectfont();
    saveselectblock();
    if (showselecttip()) {
        alert("请先选中文字！再操作！");
        document.getElementById("fontfamilylayer").style.display = "none";
        resetselectfont();
        return;
    }
    showorhidden('fontfamilylayer');
    closeallwindow('fontfamilylayer');
}

function selectfamily(obj) {
    var sizehtml = "[font=" + obj.title + "]$stxt$[/font]";
    replaceandinsert(sizehtml, 'font');
    document.getElementById("fontfamilylayer").style.display = "none";
    var selend = selectend;
    openpreview(1);
    selstartandend(gettextareaid(), selectstart, selend);
}

//字号


function checkmsiever() {
    var result = false;
    if (navigator.userAgent.indexOf("MSIE 6") > 0 || navigator.userAgent.indexOf("MSIE 7") > 0 || navigator.userAgent.indexOf("MSIE 8") > 0) {
        result = true;
    }
    return result;
}
var getselectstartpos = 0;

//表情
function selectsm(id) {
    var oldselectstart = selectstart;
    if (checkmsiever()) {
        oldselectstart = getselstartpos;
    }
    var title = wpsmiliestrans[id][0];
    insertcontent(title);
    openpreview(1);
    oldselectstart = oldselectstart + title.length;
    setSelRange(oldselectstart, oldselectstart);
    closeO('.face-tab-f');
    isclose = true;
}

//表情
function selectemo(id) {
    var oldselectstart = selectstart;
    if (checkmsiever()) {
        oldselectstart = getselstartpos;
    }
    var title = wpsmiliestrans_emoji[id][0];
    insertcontent(title);
    openpreview(1);
    oldselectstart = oldselectstart + title.length;
    setSelRange(oldselectstart, oldselectstart);
    closeO('.face-tab-f');
    isclose = true;

}

//针对火狐
function foxpastehtml(event) {
    //if (getOs() == "Firefox") {
    if (event.keyCode == 86) {
        savepasteselectblock();
        if (!isselected) {
            saveselectfocus();
        }
        pastehtmltodiv.focus();
        rungetpastehtml();
    }
    //}
}
function pastehtml() {
    savepasteselectblock();
    if (!isselected) {
        saveselectfocus();
    }

    pastehtmltodiv.focus();

    rungetpastehtml();
}
function rungetpastehtml() {
    setTimeout(function () { getpastehtml(); }, 300);
}
//取光标前后字符
function beforeafterdata() {
    var t = gettextareaid();
    var beforestr = "";
    var afterstr = "";
    beforestr = t.value.slice(0, selectstart);
    afterstr = t.value.slice(selectstart, t.value.length);
    return { x: beforestr, y: afterstr };
}
//是否要执行格式化,true执行
function isrunformat() {
    var getbastr = beforeafterdata();
    var lbeforestr = getbastr.x.substring(getbastr.x.length - 1, getbastr.x.length);
    var lafterstr = getbastr.y.substring(0, 1);
    var isrunformat = false;
    var isbrow = lbeforestr.split("\n");
    var isarow = lafterstr.split("\n");
    if (isbrow.length > 1 && isarow.length > 1) {
        isrunformat = true;
    }
    if (lbeforestr == "" && lafterstr == "") {
        isrunformat = true;
    }
    if (isbrow.length > 1 && lafterstr == "") {
        isrunformat = true;
    }
    return isrunformat;
}
function getpastehtml() {
    var t = gettextareaid();
    t.focus();

    var gethtml = document.getElementById("pastehtmltodiv").innerHTML;
    //alert("1111");
    if (gethtml != "") {
        var ishtml = isrunformat();
        gethtml = clearimghtml(gethtml);
        gethtml = getpasteimg(gethtml);
        gethtml = clearpastehtml(gethtml);
        if (ishtml) {
            gethtml = formatdata(gethtml); //格式化数据
        }
        try {

            if (!isselected) {
                var oldselectstart = selectstart;
                if (checkmsiever()) {
                    oldselectstart = getselstartpos;
                }
                insertcontent(gethtml); //光标处插入
                oldselectstart = oldselectstart + gethtml.length;
                isselected = false;

                openpreview(1);
                setSelRange(oldselectstart, oldselectstart);
            }
            else {
                replacepasteandinsert(gethtml, ''); //替换插入

                isselected = false;
                var oldselectstart = selectstart;
                if (checkmsiever()) {
                    oldselectstart = getselstartpos;
                }
                var selend = oldselectstart + gethtml.length;
                openpreview(1);
                selstartandend(gettextareaid(), oldselectstart, selend);
            }

            document.getElementById("pastehtmltodiv").innerHTML = "";
            //确保隐藏
            document.getElementById("pastehtmltodiv").style.width = "1px;";
            document.getElementById("pastehtmltodiv").style.height = "1px;";
        } catch (e) { }
    }
}
function ispasterhtml(shtml) {
    var ishtml = false;
    var htmlre = /<.*?>/ig;
    try {
        var htmlr = shtml.match(htmlre);
        if (htmlr != null) {
            ishtml = true;
        }
    } catch (e) { }
    return ishtml;
}
function getOs() {
    var OsObject = "";
    if (navigator.userAgent.indexOf("Chrome") > 0) {
        return "Chrome";
    }
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        return "MSIE";
    }
    if (navigator.userAgent.indexOf("Firefox") > 0) {
        return "Firefox";
    }
    if (navigator.userAgent.indexOf("Safari") > 0) {
        return "Safari";
    }
    if (navigator.userAgent.indexOf("Camino") > 0) {
        return "Camino";
    }
    if (navigator.userAgent.indexOf("Gecko/") > 0) {
        return "Gecko";
    }
}
//将光标移到最后
function moveEnd(obj) {
    obj.focus();
    var len = obj.value.length;
    if (document.selection) {
        var sel = obj.createTextRange();
        sel.moveStart('character', len);
        sel.collapse();
        sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
        obj.selectionStart = obj.selectionEnd = len;
    }
}
//将光标移到指定的位置
function movefocuspos(obj, len) {
    obj.focus();
    if (document.selection) {
        var sel = obj.createTextRange();
        sel.moveStart('character', len);
        sel.collapse();
        sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
        obj.selectionStart = obj.selectionEnd = len;
    }
}
//取html图片
function getpasteimg(pastecontents) {
    var imgre = /<img(\s+[^>]*?)\/?>/ig;
    try {
        var imgr = pastecontents.match(imgre);
        if (imgr != null) {
            for (var i = 0; i < imgr.length; i++) {
                var t = imgr[i];
                var exstr = /src=("|'|)(.*?)("|'|\\s)/ig;
                try {
                    var liststr = exstr.exec(t); //分组

                    var links = liststr[2].replace(/\s+/g, "").replace(/'/g, "").replace(/"/g, ""); //替换所有空格
                    if (links != "") {
                        pastecontents = pastecontents.replace(t, "[img]" + links + "[/img]");
                    }
                } catch (e) { }
            }
        }
    } catch (e) { }
    return pastecontents;
}
function clearimghtml(shtml) {
	    shtml = shtml.replace(/<img(.*?)src=(["|'|].*?["|'|]).*?></ig, '<img src=$2 /><');
    shtml = shtml.replace(/<img(.*?)src=(["|'|].*?["|'|]).*?["|'|\/|]>/ig, '<img src=$2 />');
    //shtml = shtml.replace(/<img(.*?)src=/ig, '<img src=');
    shtml = shtml.replace(/<a(.*?)href=/ig, '<a href=');
    shtml = shtml.replace(/<!--(.*?)-->/ig, '');
    return shtml;
}
//清除所有html
function clearpastehtml(shtml) {
    shtml = shtml.replace(/\t/ig, "");
    shtml = shtml.replace(/\s/ig, " ");
    //shtml = shtml.replace(/<\s+>/ig, '');
    shtml = shtml.replace(/<br(\s+[^>]*)?\/?>/ig, "\n");
    shtml = shtml.replace(/<\/p>/ig, "\n");
    shtml = shtml.replace(/<\/td>/ig, "\n");
    shtml = shtml.replace(/<\/tr>/ig, "\n");
    shtml = shtml.replace(/<\/table>/ig, "\n");
    shtml = shtml.replace(/<\/li>/ig, "\n");
    shtml = shtml.replace(/<\/ul>/ig, "\n");
    shtml = shtml.replace(/<\/div>/ig, "\n");
    shtml = shtml.replace(/&nbsp;/ig, " ");
	shtml = shtml.replace(/<style.*?<\/style>/ig, "");
	shtml = shtml.replace(/<script.*?<\/script>/ig, "");
    shtml = shtml.replace(/<!.*?->/g, "");
    shtml = shtml.replace(/&gt;/ig, "");
    shtml = shtml.replace(/&lt;/ig, "");

    shtml = shtml.replace(/<.*?>/g, "");
    shtml = shtml.replace(/&amp;/ig, '&');
    return shtml;
}

//获取光标位置
function getCursorPosition(t) {
    return t.selectionStart;
}
function showvideo(obj, id) {
    obj.style.display = "none";
    document.getElementById("video" + id).style.display = "";
    $("#msgShow").animate({ scrollTop: obj.top + 100000 }, 1000);
}
//textarea内容预览
var showcontents = "";
var testi = 0;
//定位开始 插入标签<span id='cposition'></span>
function insertlabel(selstartpos, cpos, tempreplacehtml, textareacontents) {
    if (document.selection) {
        if (selstartpos == 0 || selstartpos == "undefined" || selstartpos == null) {
            textareacontents = textareacontents + tempreplacehtml;
            //alert(textareacontents+"======"+tempreplacehtml);
        }
        else {
            textareacontents = textareacontents.slice(0, selstartpos) + tempreplacehtml + textareacontents.slice(selstartpos, textareacontents.length);
        }
    } else {
        selectend = selstartpos;
        var ubbLength = textareacontents.length;
        var seltxt = textareacontents.slice(selstartpos, selectend)
        tempreplacehtml = tempreplacehtml + seltxt;
        textareacontents = textareacontents.slice(0, selstartpos) + tempreplacehtml + textareacontents.slice(selstartpos, ubbLength);
    }
    return textareacontents;
}
function modinsertlabel(tempreplacehtml, replacehtml) {
    //如果发现定位符
    var istemprehtml = replacehtml.split(tempreplacehtml);
    if (istemprehtml.length > 1) {
        replacehtml = replacehtml.replace(tempreplacehtml, "");
        replacehtml = replacehtml + tempreplacehtml;
    }
    return replacehtml;
}
//光标不在编辑器时，隐藏预览
var ishowbaidu = false;
var slclientheight = 0;
function sprecontents() {
    if (cookiename == "replycookieopenorclose") {
        document.getElementById("showprecontents").style.display = "";
        if (!ishowbaidu) {
            slclientheight = document.body.scrollHeight + 30;
            ishowbaidu = true;
            try {
                //alert(document.body.scrollHeight);
                if (ispparent == 0) {
                    getparentobj().getElementById("baidu").height = document.body.scrollHeight + 30 + "px";
                }
                else {
                    getparentobj().getElementById("baidu").height = document.body.scrollHeight + 30 + "px";
                    getpparentobj().getElementById("baidu").height = document.body.scrollHeight + 30 + "px";
                }
            } catch (e) { }
        }
    }
}
function hiddenprehtml() {
    if (document.getElementById("getcontents").style.display == "none") {
        try {
            //alert("1111");
            getparentobj().getElementById("baidu").height = 480;
            try {
                //alert("22222");
                getpparentobj().getElementById("baidu").height = 480;
            } catch (e) { }
            //alert("3333");
        }
        catch (e) { }
    }
}
var showwintop = 0;
var isshowpreview = false;
function setupshowprecontents() {
    if (!isshowpreview) {
        isshowpreview = true;
        //var preobj = document.getElementById("getcontents").style.display;
        //if (preobj == "") {
        document.getElementById("getcontents").style.display = "";
        showwintop = document.getElementById("getcontents").clientHeight;
        try {
            setbodyscrolltop();
        } catch (e) { }
        try {
            if (ispparent == 0) {
                getparentobj().getElementById("baidu").height = document.body.scrollHeight;
            }
            else {
                getparentobj().getElementById("baidu").height = document.body.scrollHeight;
                getpparentobj().getElementById("baidu").height = document.body.scrollHeight;
            }
        } catch (e) { }
        //}
    }
}
//设置滚动条
function setbodyscrolltop() {
    if (getOs() == "Chrome") {
        if (ispparent == 0) {
            getparentobj().body.scrollTop = getparentobj().body.scrollTop + document.getElementById("showprecontents").clientHeight;
        }
        else {
            getparentobj().body.scrollTop = getparentobj().body.scrollTop + document.getElementById("showprecontents").clientHeight;
            getpparentobj().body.scrollTop = getpparentobj().body.scrollTop + document.getElementById("showprecontents").clientHeight;
        }
    }
    else {
        if (ispparent == 0) {
            getparentobj().documentElement.scrollTop = getparentobj().documentElement.scrollTop + document.getElementById("showprecontents").clientHeight;
        }
        else {
            getparentobj().documentElement.scrollTop = getparentobj().documentElement.scrollTop + document.getElementById("showprecontents").clientHeight;
            getpparentobj().documentElement.scrollTop = getpparentobj().documentElement.scrollTop + document.getElementById("showprecontents").clientHeight;
        }
    }
}
function delbodyscrolltop() {
    try {
        if (slclientheight > 0) {
            if (ispparent == 0) {
                getparentobj().getElementById("baidu").height = slclientheight;
            }
            else {
                getparentobj().getElementById("baidu").height = slclientheight;
                getpparentobj().getElementById("baidu").height = slclientheight;
            }
        }
    } catch (e) { }

}

function setuptextareascroll() {
    document.getElementById("body").scrollTop = document.getElementById("body").scrollHeight - document.getElementById("body").scrollTop;
}
var selstartpos = 0;
function openpreview(otype) {
    //保存转换的数据
	//alert("qq"+webcookies.getCookie(cookiename));

    sprecontents();
    chicktextareaeditor = 1;
    try
	{
    if(yinyong_content=="")
    {
    loadopenorclose();
    }
	}catch(e){loadopenorclose();}
    var bodybtm = gettextareaid();
    var textareacontents = bodybtm.value;
    document.getElementById("showinputcounts").innerHTML = textareacontents.length; //统计字数
    //showprecontents();
    //alert(textareacontents);
    //字数提示
    //if (textareacontents.length > 0) {
    //    document.getElementById("textareaMsg").style.display = "none";
    //}
    //else {
    //    document.getElementById("textareaMsg").style.display = "";
    //}
    if (checkmsiever()) {
        selstartpos = getPos(bodybtm).s;
    }
    else {
        selstartpos = getCursorPosition(bodybtm);
    }
    if (otype != 1) {
        selectstart = selstartpos;
    }
    if (closepreview) {
        return;
    }
    if (closepreview) {
        var preobj = document.getElementById("getcontents").style.display;
        if (preobj == "none") {
            try {
                delbodyscrolltop();
            } catch (e) { }
        }
        return;
    }

    var preobj = document.getElementById("getcontents").style.display;
    if (preobj != "none") {
        try {
            //alert(getparentobj().getElementById("baidu").height);
            if (ispparent == 0) {
                if (getparentobj().getElementById("baidu").height < 780) {
                    getparentobj().getElementById("baidu").height = 780;
                }
            }
            else {
                if (getparentobj().getElementById("baidu").height < 780) {
                    getparentobj().getElementById("baidu").height = 780;
                }
                if (getpparentobj().getElementById("baidu").height < 780) {
                    getpparentobj().getElementById("baidu").height = 780;
                }
            }
        } catch (e) { }
    }

    //alert("ddss");
    //定位开始 插入标签<span id='cposition'></span>
    var cpos = "<img id='cposition' src='http://qc-static.kdnet.net/webset/upfile/images/subject.gif'/>";
    var tempreplacehtml = "{}";
    textareacontents = insertlabel(selectstart, cpos, tempreplacehtml, textareacontents);
    //end定位
    var aftertext = ubbtohtml(textareacontents, tempreplacehtml);
    //替换定位符
    aftertext = aftertext.replace(tempreplacehtml, cpos);
    try {
        //getparentobj().getElementById("club_dispbbs_l_3").innerHTML = aftertext;
        if (yinyong_content != "") {
            document.getElementById("getcontents").innerHTML = yinyong_content + aftertext;
        }
        else {
            document.getElementById("getcontents").innerHTML = aftertext + "<br/>";
        }
    }
    catch (e) { }

    var scrollgetcontents = document.getElementById("getcontents");
    var scrollcposition = document.getElementById("cposition");

    //滚动条始终在最下方
    try {
        var getscrtop = parseInt(scrollcposition.offsetTop) - parseInt(scrollgetcontents.offsetTop) - parseInt(scrollgetcontents.clientHeight / 2);
        document.getElementById("getcontents").scrollTop = getscrtop + 10;
        //getparentobj().getElementById("club_dispbbs_l_3").scrollTop = getscrtop;
    }
    catch (e) { }
}
/*if(yinyong_content!="")
{

autoopenbig();
}*/
function autoopenbig() {
    try {
        getparentobj().getElementById("baidu").height = 780;
    } catch (e) { }
    try {
        getpparentobj().getElementById("baidu").height = 780;
    } catch (e) { }

}
//自动排版
function autoformat() {
    var t = gettextareaid();
    var sHtml = t.value;
    var formatedhtml = formatdata(sHtml);
    t.value = formatedhtml;
}
function formatdata(sHtml) {
    var formatedhtml = sHtml;
    var allrows = sHtml.split("\n");
    if (allrows != null) {
        for (var i = 0; i < allrows.length; i++) {
            if (i == 0) {
                formatedhtml = "";
            }
            var rowscontents = allrows[i];
            var clearrowscon = rowscontents.replace(/\t/ig, "");
            clearrowscon = clearrowscon.replace(/\s/ig, "");
            if (clearrowscon == "") {
                continue;
            }
            //去掉开头的所有空格
            var clearspacecontents = rowscontents;

            var k = 0;
            for (var j = 0; j < rowscontents.length; j++) {
                var sf = rowscontents[j];
                if (rowscontents[j] != " ") {
                    k = j;
                    break;
                }
            }

            if (k > 0) {
                clearspacecontents = clearspacecontents.substring(k, clearspacecontents.length);
            }
            var m = 0
            for (var n = 0; n < clearspacecontents.length; n++) {
                var sf = clearspacecontents[n];
                if (clearspacecontents[n] != "　") {
                    m = n;
                    break;
                }
            }
            if (m > 0) {
                clearspacecontents = clearspacecontents.substring(m, clearspacecontents.length);
            }

            if (i == (allrows.length - 1)) {
                formatedhtml += "    " + clearspacecontents;
            }
            else {
                formatedhtml += "    " + clearspacecontents + "\n\n";
            }
        }
    }
    return formatedhtml;
}

function ubbtohtml(subb, tempreplacehtml) {
    var sHtml = String(subb)
    var spacestr = "{shtmlreplacespace}";
    sHtml = sHtml.replace(/[<>&"]/g, function (c) { return { '<': '&lt;', '>': '&gt;', '&': '&amp;', '"': '&quot;'}[c]; });
    sHtml = sHtml.replace(/\r?\n/g, "<br/>");

    //替换@功能
    var atnamere = /\@(([\u4e00-\u9fa5a-zA-Z0-9_-]+\s)\.?)/gi;
    var atnamer = sHtml.match(atnamere);
    if (atnamer != null) {
        for (var i = 0; i < atnamer.length; i++) {
            var atname = atnamer[i];
            var namestr = atname.replace("@", "");
            var istruename = namestr.indexOf(".");
            if (istruename < 0) {
                namestr = namestr.replace(/\s+/g, '');
                var nameafterspace = atname.replace(namestr, "");
                nameafterspace = nameafterspace.replace("@", "");
                var ahref = "<span" + spacestr + "class=\"name" + spacestr + "c-main\"><a" + spacestr + "target=\"_blank\"" + spacestr + "href=\"http://user.kdnet.net/?username=" + namestr + "\"" + spacestr + "class=\"tips\"" + spacestr + "title=\"" + namestr + "\"" + spacestr + "onmouseover=\"mouseover(this);\"" + spacestr + "onmouseout=\"mouseout(this);\">@" + namestr + "</a>" + nameafterspace + "</span>";

                sHtml = sHtml.replace(atname, ahref);
            }
        }
    }

    sHtml = sHtml.replace(/\s/g, "&nbsp;");
    sHtml = sHtml.replace(/{shtmlreplacespace}/g, " ");

    //确保定位符不在标签中
    var temphtmle = /\[.*?[^\]]\]/ig;
    var alltemphtml = sHtml.match(temphtmle);
    if (alltemphtml != null) {
        for (var i = 0; i < alltemphtml.length; i++) {
            var t = alltemphtml[i];
            try {
                var tempt = modinsertlabel(tempreplacehtml, t);
                if (t != tempt) {
                    sHtml = sHtml.replace(t, tempt);
                    break;
                }
            }
            catch (e)
            { }
        }
    }

    sHtml = sHtml.replace(/\[font=宋体\](.*?)\[\/font\]/ig, '<span style="font-family:SimSun;">$1</span>');
    sHtml = sHtml.replace(/\[font=新宋体\](.*?)\[\/font\]/ig, '<span style="font-family:NSimSun;">$1</span>');
    sHtml = sHtml.replace(/\[font=仿宋\](.*?)\[\/font\]/ig, '<span style="font-family:FangSong_GB2312;">$1</span>');
    sHtml = sHtml.replace(/\[font=楷体\](.*?)\[\/font\]/ig, '<span style="font-family:KaiTi_GB2312;">$1</span>');
    sHtml = sHtml.replace(/\[font=黑体\](.*?)\[\/font\]/ig, '<span style="font-family:SimHei;">$1</span>');
    sHtml = sHtml.replace(/\[font=微软雅黑\](.*?)\[\/font\]/ig, '<span style="font-family:Microsoft YaHei;">$1</span>');
    sHtml = sHtml.replace(/\[font=Arial\](.*?)\[\/font\]/ig, '<span style="font-family:Arial;">$1</span>');
    sHtml = sHtml.replace(/\[font=ArialBlack\](.*?)\[\/font\]/ig, '<span style="font-family:Arial Black;">$1</span>');
    sHtml = sHtml.replace(/\[font=TimesNewRoman\](.*?)\[\/font\]/ig, '<span style="font-family:Times New Roman;">$1</span>');
    sHtml = sHtml.replace(/\[font=CourierNew\](.*?)\[\/font\]/ig, '<span style="font-family:Courier New;">$1</span>');
    sHtml = sHtml.replace(/\[font=Tahoma\](.*?)\[\/font\]/ig, '<span style="font-family:Tahoma;">$1</span>');
    sHtml = sHtml.replace(/\[font=Verdana\](.*?)\[\/font\]/ig, '<span style="font-family:Verdana;">$1</span>');

    //sHtml = sHtml.replace(/\[(\/?)(strong|b|u|i|s|sup|sub|span)\]/ig, '<$1$2>');
    sHtml = sHtml.replace(/\[b\](.*?)\[\/b\]/ig, '<b>$1</b>');
    sHtml = sHtml.replace(/\[i\](.*?)\[\/i\]/ig, '<i>$1</i>');
    sHtml = sHtml.replace(/\[u\](.*?)\[\/u\]/ig, '<u>$1</u>');
    sHtml = sHtml.replace(/\[strong\](.*?)\[\/strong\]/ig, '<strong>$1</strong>');

    sHtml = sHtml.replace(/\[quote-title\]/ig, '[span class="quote-title"]');
    sHtml = sHtml.replace(/\[span\](.*?)\[\/span\]/ig, '<span>$1</span>');
    sHtml = sHtml.replace(/\[span class=\"quote-title\"\](.*?)\[\/span\]/ig, '<span class="quote-title">$1</span>');


    sHtml = sHtml.replace(/\[color\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\](.*?)\[\/color\]/ig, '<font color="$1">$2</font>');
    sHtml = sHtml.replace(/\[size\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\](.*?)\[\/size\]/ig, '<font style="font-size:$1px;">$2</font>');
    //sHtml = sHtml.replace(/\[\/(color|size)\]/ig, '</font>');

    //sHtml = sHtml.replace(/\[(left|center|right)\]/ig, '<p align=$1>');
    //sHtml = sHtml.replace(/\[\/(left|center|right)\]/ig, '</p>');
    sHtml = sHtml.replace(/\[left\](.*?)\[\/left\]/ig, '<p align="left">$1</p>');
    sHtml = sHtml.replace(/\[center\](.*?)\[\/center\]/ig, '<p align="center">$1</p>');
    sHtml = sHtml.replace(/\[right\](.*?)\[\/right\]/ig, '<p align="right">$1</p>');


    sHtml = sHtml.replace(/\[quote\]/ig, '<span class="quote-cont-box"><span class="quote-cont2">');
    sHtml = sHtml.replace(/\[\/quote\]/ig, '</span></span>');


    //替换图片
    var imgre = /\[img\](.*?[^\[]?)\[\/img\]/ig;
    var imgr = sHtml.match(imgre);
    if (imgr != null) {
        for (var i = 0; i < imgr.length; i++) {
            var t = imgr[i];
            var exstr = /\[img\](.*[^\[]?)\[\/img\]/ig;
            var liststr = exstr.exec(t); //分组

            var links = liststr[1].replace(/\s/g, ""); //替换所有空格
            var ahref = "<img src=\"" + links + "\"  border='0' />";
            //如果发现定位符
            ahref = modinsertlabel(tempreplacehtml, ahref);
            sHtml = sHtml.replace(t, ahref);
        }
    }

    sHtml = sHtml.replace(/\[url\s*=\s*([^\]"]+?)(?:"[^\]]*?)?\s*\]\s*([\s\S]*?)\s*\[\/url\]/ig, '<a href="$1" target="_blank">$2</a>');

    sHtml = sHtml.replace(/\[hr\/\]/ig, '<hr />');

    //多媒体替换
    // var re = /\[video=([0-9]*),([0-9]*)\](.*?[^\[]?)\[\/video\]/ig;
    var re = /\[video2\](.*?[^\[]?)\[\/video2\]/ig;
    var r = sHtml.match(re);
    if (r != null) {
        for (var i = 0; i < r.length; i++) {
            var t = r[i];
            t = t.replace(/\s/g, ""); //替换所有空格 
            // var exstr = /\[video=([0-9]*),([0-9]*)\](.*[^\[]?)\[\/video\]/ig;
            var exstr = /\[video2\](.*?[^\[]?)\[\/video2\]/ig;
            var liststr = exstr.exec(t); //分组
            if (liststr.length > 1) {
                var furl = liststr[1];
                var replacehtml = '<iframe class="videoFrame" frameborder="0" allowfullscreen src="'+furl+'"></iframe>';
                replacehtml = "<br/>" + replacehtml +"<br/>";
                //如果发现定位符
                replacehtml = modinsertlabel(tempreplacehtml, replacehtml);
                sHtml = sHtml.replace(t, replacehtml);


                // return;
                // var furl = liststr[3];
                // var fwidth = liststr[1];
                // var fheight = liststr[2];
                // var formatstart = furl.lastIndexOf('.');
                // var filetype = furl.substring(formatstart + 1, formatstart + 4).toLowerCase();
                // var replacehtml = "";
                // var videoid = i;
                // var showimgstr = "<img onclick=\"showvideo(this," + videoid + ");\" src=\"images/video_play.gif\"/>";
                // switch (filetype) {
                //     case "swf":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\" src=\"" + furl + "\" type=\"application/x-shockwave-flash\" allowFullScreen=\"true\" width=\"" + fwidth + "\" height=\"" + fheight + "\" allowNetworking=\"all\" wmode=\"opaque\" allowScriptAccess=\"always\"></embed>";
                //         break;
                //     case "flv":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\" src=\"" + furl + "\" type=\"application/x-shockwave-flash\" allowFullScreen=\"true\" width=\"" + fwidth + "\" height=\"" + fheight + "\" allowNetworking=\"all\" wmode=\"opaque\" allowScriptAccess=\"always\"></embed>";
                //         break;
                //     case "mp3":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break; //swf,flv,mp3,wav,wma,mid,avi,mpg,asf,rm,rmvb
                //     case "wav":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     case "wma":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     case "mid":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     case "avi":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     case "mpg":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     case "rm":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"audio/x-pn-realaudio-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     case "rmvb":
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"audio/x-pn-realaudio-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                //     default:
                //         replacehtml = "<embed style=\"display:none;\"  id=\"video" + videoid + "\"  src=\"" + furl + "\" type=\"video/x-ms-asf-plugin\" width=\"" + fwidth + "\" height=\"" + fheight + "\" quality=\"high\" />";
                //         break;
                // }
                // replacehtml = "<br/>" + replacehtml + showimgstr + "<br/>";
                //如果发现定位符
                replacehtml = modinsertlabel(tempreplacehtml, replacehtml);
                sHtml = sHtml.replace(t, replacehtml);
            }
        }
    }


    //表情
    var emore = /\[.*?[^\]]\]/ig;
    var allemo = sHtml.match(emore);
    if (allemo != null) {
        for (var i = 0; i < allemo.length; i++) {
            try {
                var t = allemo[i];
                var liststr = t.replace(/\s/g, "");

                var emimgurl = "";
                //查找表情
                for (var p = 0; p < wpsmiliestrans.length; p++) {
                    if (liststr == wpsmiliestrans[p][0]) {
                        emimgurl = "http://imgcdn.kdnet.net/resource/emotions/HD/" + wpsmiliestrans[p][1];
                        break;
                    }
                }
                if (emimgurl == "") {
                    for (var pem = 0; pem < wpsmiliestrans_emoji.length; pem++) {
                        if (liststr == wpsmiliestrans_emoji[pem][0]) {
                            emimgurl = "http://imgcdn.kdnet.net/resource/emotions/HD/" + wpsmiliestrans_emoji[pem][1];
                            break;
                        }
                    }
                }
                if (emimgurl != "") {
                    var r = emimgurl.match(/_(\d+)x(\d+)\./);
                    var ahref = "<img border='0' src='" + emimgurl + "' style=\"width:" + r[1] +"px;height:" + r[2] +  "px;\" />";
                    sHtml = sHtml.replace(t, ahref);
                }
            }
            catch (e)
            { }
        }
    }

    return sHtml;
}
function curbrower() {
    var db = document.body,
    dd = document.documentElement,
    top = db.scrollTop + dd.scrollTop;
    left = db.scrollLeft + dd.scrollLeft;
    return { 'top': top, 'left': left };
}
function runEx(contents) {
    if (contents != "") {
        var newwin = window.open('', '', '');
        newwin.opener = null
        newwin.document.write(contents);
        newwin.document.close();
    }
}
//HTML过滤函数
function HTMLEncode(text) {
    text = text.replace(/"/g, "&quot;");
    text = text.replace(/</g, "&lt;");
    text = text.replace(/>/g, "&gt;");
    text = text.replace(/'/g, "&#146;");

    return text;
}
function checkhHtml5() {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        return true;
    }
    return false;
}

if (!checkhHtml5()) {
    try {
        document.getElementById("upload").style.display = "none";
    }
    catch (e) { }
}

//获得coolie 的值      
function getCookie(name) {
    var cookieArray = document.cookie.split(";"); //得到分割的cookie名值对      
    var cookie = new Object();
    for (var i = 0; i < cookieArray.length; i++) {
        var arr = cookieArray[i].split("=");       //将名和值分开      
        if (arr[0] == name) return unescape(arr[1]); //如果是指定的cookie，则返回它的值      
    }
    return "";
}
function addCookie(objName, objValue, objHours) {      //添加cookie  
    var str = objName + "=" + escape(objValue);
    if (objHours > 0) {                               //为时不设定过期时间，浏览器关闭时cookie自动消失  
        var date = new Date();
        var ms = objHours * 3600 * 1000;
        date.setTime(date.getTime() + ms);
        str += "; expires=" + date.toGMTString();
    }
    document.cookie = str;
}
function delCookie(name)//删除cookie   
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}
var selecttxt = "";
function gettitle(gettitletype, obj) {
    if (gettitletype == 0) {
        selecttxt = obj.innerHTML;
		document.getElementById("font1").value = selecttxt;
    }
    if (gettitletype == 2) {
        selecttxt = "";
    }
	if(selecttxt!="")
	{
    document.getElementById("font1").value = selecttxt;
	}
    var titles = document.getElementById("topic").value;
    //检查标题字符数
    var setuptitlecounts = 48; //预设26个字符
    document.getElementById("limittitlecounts").innerHTML = setuptitlecounts;
    titlecounts = titles.length;

var l = titles.length; 
titlecounts = 0; 
for(i=0; i<l; i++) { 
if ((titles.charCodeAt(i) & 0xff00) != 0) { 
titlecounts ++; 
} 
titlecounts ++; 
}


    document.getElementById("mtitlecounts").innerHTML = titlecounts - setuptitlecounts;
    if (titlecounts > setuptitlecounts) {
        document.getElementById("titleLarm").style.display = "";
    }
    else {
        document.getElementById("titleLarm").style.display = "none";
    }
    var andtitle = selecttxt + titles;
    if (andtitle == "") {
        andtitle = "&nbsp;";
    }
    document.getElementById("showpretitle").innerHTML = andtitle;
}
function getselectvalue(gettitletype, obj, getobj) {
    if (gettitletype == 2) {
        var oselecttxt = "";
        document.getElementById(getobj).value = oselecttxt;
    }
    else {
        var oselecttxt = obj.title;
        //alert(oselecttxt);
        document.getElementById(getobj).value = oselecttxt;
    }
}
function strlen(str) {
    var strlength = 0;
    for (i = 0; i < str.length; i++) {
        if (isChinese(str.charAt(i)) == false) {
            strlength = strlength + 2;
        }
        else {
            strlength = strlength + 1;
        }
    }
    return strlength;
}
function isChinese(str) {
    var lst = /[u00-uFF]/;
    return !lst.test(str);
}
/*
function showdraguploadimg() {
    if (checkhHtml5()) {
        document.getElementById("addCont").style.display = "";
    }
}*/
/*
(function () {

    // getElementById
    function $id(id) {
        return document.getElementById(id);
    }


    // output information
    function Output(e, upfilename, dragimgurl, progressid) {
        var m = $id("showmessages");
        var progress = m.appendChild(document.createElement("span"));
        progress.id = "span" + progressid;
        try {
            findDimensions();
            //			$id("postInputL").style.height=($id("postInputL").style.height+60)+"px"

        } catch (e) { }
        //progress.innerHTML= '<em title="删除" onClick="delPhoto(this,'+progressid+');"></em><img id="' + upfilename + '"  alt="' + dragimgurl + upfilename + '" onDblClick="selectimg(this);" title="双击插入图片" src="' + e.target.result + '" /><b class="upload-f" id="bprogress'+progressid+'"><i class="upload-line" id="progress'+progressid+'"></i></b>';
        progress.innerHTML = '<em title="删除" onClick="delPhoto(this,' + progressid + ');"></em><img id="' + upfilename + '"  alt="' + dragimgurl + upfilename + '" onDblClick="selectimg(this);" title="双击插入图片" src="' + e.target.result + '" />';
    }

    function RndNum(n) {
        var rnd = "";
        for (var i = 0; i < n; i++) {
            rnd += Math.floor(Math.random() * 10);
        }
        return rnd;
    }

    // file drag hover
    function FileDragHover(e) {
        //保存光标位置
        //if(e.dataTransfer.files.length>0)
        //{
        saveselectfocus();

        $id("showmessages").style.display = "";

        e.stopPropagation();
        e.preventDefault();
        //e.target.className = (e.type == "dragover" ? "hover" : "");
        //}
    }

    var k = 0;
    var uploadcounts = 0; //确保进度条消失
    // file selection
    function FileSelectHandler(e) {
        // cancel event and hover styling
        FileDragHover(e);

        // fetch FileList object
        var files = e.target.files || e.dataTransfer.files;
        // process all File objects
        for (var i = 0, f; f = files[i]; i++) {
            if (k >= 10) {
                alert("最多只能上传10张图片！");
                break;
            }
            var extfiletype = "";
            var filetype = ".jpg";
            var extfname = f.name.split(".");
            if (extfname.length > 0) {
                extfiletype = "." + extfname[1];
                filetype = extfname[1];
            }

            var dateformat = new Date();
            var fyear = post_year;
            var fmonth = post_month;
            var fdate = post_day;
            //var fyear=dateformat.getFullYear().toString();
            //var getmonth=parseInt(dateformat.getMonth())+1;
            //var fmonth=getmonth;
            //var getdate=parseInt(dateformat.getDate());
            //var fdate=getdate;
            //if(getmonth<10)
            //{
            //    fmonth="0"+getmonth;
            //}
            //if(getdate<10)
            //{
            //    fdate="0"+getdate;
            //}
            dragimgurl = "/Upload/" + fyear + "/" + fmonth + "/" + fdate + "/";


            var upfilename = fyear + fmonth + fdate + dateformat.getHours().toString() + dateformat.getMinutes().toString() + dateformat.getMilliseconds().toString() + i.toString() + RndNum(10) + k.toString() + extfiletype;
            var isftype = false;
            if (filetype == "jpg" || filetype == "png" || filetype == "gif" || filetype == "jpeg" || filetype == "bmp") {
                isftype = true;
            }
            if (!isftype) {
                alert("上传图片格式不正确！只支持.jpg|.png|.gif|.jpeg|.bmp格式。");
                continue;
            }
            if (f.size > 10240000) {
                //alert(f.size+"---"+$id("MAX_FILE_SIZE").value);

                alert(f.name + "，只能上传小于10M的图片！");
                continue;
            }

            //alert(upfilename);
            //ParseFile(f, upfilename,k);
            UploadFile(f, upfilename, k);

            //插入图片
            var insertdragimg = "[img]" + dragimgurl + upfilename + "[/img]";
            insertcontent(insertdragimg);
            openpreview(1);
            setSelRange(selectstart, selectstart);

            k++;
        }

    }
    // output file information
    function ParseFile(file, upfilename, progressid) {


        // display an image

        if (file.type.indexOf("image") == 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                //alert(upfilename);
                Output(e, upfilename, dragimgurl, progressid);
                //	'<span><em title="删除" onClick="delPhoto(this);"></em><img id="' + upfilename + '"  alt="' + dragimgurl + upfilename + '" onDblClick="selectimg(this);" title="双击插入图片" src="' + e.target.result + '" /></span>'
                //);
            }
            reader.readAsDataURL(file);
        }

    }


    // upload JPEG files
    function UploadFile(file, upfilename, progressid) {
        //alert(upfilename);
        // following line is not necessary: prevents running on SitePoint servers
        if (location.host.indexOf("sitepointstatic") >= 0) return

        var xhr = new XMLHttpRequest();
        if (xhr.upload && file.size <= 10240000) {

            //var progress = $id("progress"+progressid);
            // progress bar
            //xhr.upload.addEventListener("progress"+progressid, function (e) {
            //    var pc = parseInt(100 - (e.loaded / e.total * 100));
            //    progress.style.width = pc + "%";
            //}, false);

            // file received/failed
            xhr.onreadystatechange = function (e) {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        ParseFile(file, upfilename, progressid);
                        openpreview(1);
                        //document.getElementById("bprogress"+progressid).style.display="none";
                        //progress.className = "success";
                    }
                    else {
                        //document.getElementById(upfilename).alt=xhr.responseText;
                    }
                }
            };
            // start upload
            //alert(dragimgurl);
            xhr.open("POST", $id("upload").action + "?filename=" + upfilename + "&dragimgurl=" + dragimgurl + "", true);
            xhr.setRequestHeader("X_FILENAME", file.name);
            xhr.send(file);
            uploadcounts++;
            //if(uploadcounts>=9)
            //{
            //    setTimeout(function () { 
            //        for(var j=0;j<uploadcounts;j++)
            ///        {
            //            try
            //            {
            //                document.getElementById("bprogress"+j).style.display="none";
            //            }catch(e){}
            //       }
            //   }, 300);
            //}
        }
    }


    // initialize
    function Init() {

        //document.getElementById("showuploadtipinfo").style.display = "";

        // var filedrag = $id("filedrag");
        var bodydrag = $id("body");
        if (getOs() == "Firefox") {
            bodydrag = $id("filedraguploadimg");
            $id("showdragtip").innerHTML = "支持文件批量拖拽，请将文件拖拽到菜单栏，释放鼠标。";
        }
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {

            // file drop
            //bodydrag.addEventListener("dragover", FileDragHover, false);
            bodydrag.addEventListener("dragover", FileDragHover, false);
            bodydrag.addEventListener("dragleave", FileDragHover, false);
            bodydrag.addEventListener("drop", FileSelectHandler, false);
            //filedrag.style.display = "block";

        }

    }


    // call initialization file
    if (checkhHtml5()) {
        if (window.File && window.FileList && window.FileReader) {
            Init();
        }
    }
})();
*/