
function ltencode(str)
{
  var ret = encodeURIComponent(str);
  
  ret = ret.replace(new RegExp("%","gm"),"#")
  
  return ret;
}

function GetCookieVal(offset){
  var endstr = document.cookie.indexOf (";", offset);
  if (endstr == -1)
  endstr = document.cookie.length;
  return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie(strName){
  var cookiesArr = document.cookie.split(";");
  for(var i = 0; i < cookiesArr.length; i++){
    var ck = cookiesArr[i].toString().Trim();
    if(ck.indexOf("=") > 0){
      var ckName = ck.substring(0, ck.indexOf("="));
      if(strName == ckName){
          return ck.substring(ck.indexOf("=") + 1);
      }
    }
  }
  return "";
}

function SetCookie(name, value){
  var expdate = new Date();
  var argv = SetCookie.arguments;
  var argc = SetCookie.arguments.length;
  var expires = 2592000;
  var path = (argc > 3) ? argv[3] : null;
  var domain = (argc > 4) ? argv[4] : ".lietou.com";
  var secure = (argc > 5) ? argv[5] : false;
  if(expires!=null) expdate.setTime(expdate.getTime() + ( expires * 1000 ));
  document.cookie = name + "=" + escape (value) +((expires == null) ? "" : ("; expires="+ expdate.toGMTString()))
  +((path == null) ? "" : ("; path=" + path)) +((domain == null) ? "" : ("; domain=" + domain))
  +((secure == true) ? "; secure" : "");
}
function DelCookie(name){
  var exp = new Date();
  exp.setTime (exp.getTime() - 1);
  var cval = GetCookie (name);
  document.cookie = name + "=" + cval + "; expires="+ exp.toGMTString();
}
function omit(str, len){
  if(str.length > len){
    return str.substring(0, len) + "...";
  }else{
    return str
  }
}
function GetCookie(name){
  var arg = name + "=";
  var alen = arg.length;
  var clen = document.cookie.length;
  var i = 0;
  while (i < clen)
  {
  var j = i + alen;
  if (document.cookie.substring(i, j) == arg)
  return GetCookieVal (j);
  i = document.cookie.indexOf(" ", i) + 1;
  if (i == 0) break;
  }
  return null;
}
function ReadCookie(name){
  var mycookie = document.cookie; 
  var start1 = mycookie.indexOf(name + "=");
  if (start1== -1)
    return "";
  else{
    start=mycookie.indexOf("=",start1)+1;
    var end = mycookie.indexOf(";",start);
    if (end==-1){
      end=mycookie.length;
    }
    var value=unescape(mycookie.substring(start,end));
    if (value==null){
      return "";
    }else{
      return value;
    }
  }
}


function validForm1(){
  var frm = document.forms[0];
  return validForm(frm);
}
function validForm2(frmName){
  var frm = document.forms[frmName];
  return validForm(frm);
}
function validForm(frm){
  for (var i = 0 ; i <= frm.elements.length; i++){
    var ret = validocx(frm.elements[i]);
    if(ret != ""){
      document.getElementById("__message").innerHTML = ret;
      try{
        frm.elements[i].focus();
      }catch(e){}
      return false;
    }
  }
  return true;
}

function validocx(ocx){
  if ((typeof ocx) != "object"){
    return "";
  }
  var str = ocx.getAttribute("validstr");
  if(str + "" == "null"){
    return "";
  }
  if(str.indexOf("null") >= 0){
    var tmp = str.substring(str.indexOf("null"));
    var ret = nullProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("type") >= 0){
    var tmp = str.substring(str.indexOf("type"));
    var ret = typeProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("minlen") >= 0){
    var tmp = str.substring(str.indexOf("minlen"));
    var ret = minlenProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("maxlen") >= 0){
    var tmp = str.substring(str.indexOf("maxlen"));
    var ret = maxlenProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("minval") >= 0){
    var tmp = str.substring(str.indexOf("minval"));
    var ret = minvalProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("maxval") >= 0){
    var tmp = str.substring(str.indexOf("maxval"));
    var ret = maxvalProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("email") >= 0){
    var tmp = str.substring(str.indexOf("email"));
    var ret = emailProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("ip") >= 0){
    var tmp = str.substring(str.indexOf("ip"));
    var ret = ipProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("sfz") >= 0){
    var tmp = str.substring(str.indexOf("sfz"));
    var ret = sfzProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("phone") >= 0){
    var tmp = str.substring(str.indexOf("phone"));
    var ret = phoneProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("ltcomp") >= 0){
    var tmp = str.substring(str.indexOf("ltcomp"));
    var ret = ltcompProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  if(str.indexOf("same") >= 0){
    var tmp = str.substring(str.indexOf("same"));
    var ret = sameProc(tmp, ocx);
    if(ret != ""){
      return ret;
    }
  }
  return "";
}

function nullProc(str, ele)
{
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    
    var objectType = ele.type.toLowerCase();
    if(objectType == "select-one"){
      if(tmp == "false"){
        for(j = 0; j < ele.options.length; j++){
          if(ele.options[j].selected == true && ele.options[j].value == ""){
            var name = ele.getAttribute("alt");
            if(name + "" == "null"){
                name = ele.getAttribute("title");
            }
            return name + "不能为空！";
          }
        }
      }
    }
    else
    {
        if(tmp == "false" && isEmpty(ele.value)){
           var name = ele.getAttribute("alt");
           if(name + "" == "null"){
             name = ele.getAttribute("title");
           }
           return name + "不能为空！";
        }
    }
    return "";
}
function typeProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(tmp == "string")
    {
        return "";
    }
    else if(tmp == "int")
    {
        if(isInteger(ele.value))
        {
            return "";
        }else{
            return ele.alt + "必须为整数！";
        }
    }
    else if(tmp == "double")
    {
        if(isDouble(ele.value))
        {
            return "";
        }else{
            return ele.alt + "必须为数值型！";
        }
    }
    return "";
}
function minlenProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(ele.value.Trim().length < tmp)
    {
        var name = ele.getAttribute("alt");
        if(name + "" == "null")
        {
           name = ele.getAttribute("title");
        }
        return name + "的长度不能少于" + tmp + "个字符！";
    }
    return "";
}
function maxlenProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(ele.value.Trim().length > tmp)
    {
        var name = ele.getAttribute("alt");
        if(name + "" == "null")
        {
           name = ele.getAttribute("title");
        }
        return name + "的长度不能多于" + tmp + "个字符！";
    }
    return "";
}
function minvalProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    var v1 = parseFloat(ele.value);
    var v2 = parseFloat(tmp);
    if(v1 < v2)
    {
        var name = ele.getAttribute("alt");
        if(name + "" == "null")
        {
           name = ele.getAttribute("title");
        }
        return name + "的值必须大于等于" + tmp + "！";
    }
    return "";
}
function maxvalProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    var v1 = parseFloat(ele.value);
    var v2 = parseFloat(tmp);
    if(v1 > v2)
    {
        var name = ele.getAttribute("alt");
        if(name + "" == "null")
        {
           name = ele.getAttribute("title");
        }
        return name + "的值必须小于等于" + tmp + "！";
    }
    return "";
}

function emailProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(tmp == "true" && !isEmail(ele.value.Trim()))
    {
        return "电子邮件格式不正确！";
    }
    return "";
}
function sfzProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(tmp == "true" && !isSFZ(ele.value))
    {
        return "身份证格式不正确！";
    }
    return "";
}
function phoneProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(tmp == "true" && !isPhone(ele.value))
    {
        return "电话号码格式不正确！";
    }
    return "";
}
function ipProc(str, ele)
{
    if(isEmpty(ele.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    if(tmp == "true" && !isIP(ele.value))
    {
        return "IP地址格式不正确！";
    }
    return "";
}

function ltcompProc(str, ele1)
{
    if(isEmpty(ele1.value))
    {
        return "";
    }
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    //var ele2 = frm[tmp];
    var ele2 = document.getElementsByName(tmp)[0];
    val1 = parseFloat(ele1.value);
    val2 = parseFloat(ele2.value);
    
    if(val1 > val2)
    {
        return ele1.alt + "的值必须小于" + ele2.alt + "的值！";
    }
    return "";
}
function sameProc(str, ele1)
{
    var start = str.indexOf("[");
    var end = str.indexOf("]");
    var tmp = str.substring(start + 1, end);
    //var ele2 = frm[tmp];
    var ele2 = document.getElementsByName(tmp)[0];
    if(ele1.value != ele2.value)
    {
        return "两次输入的密码不一致！";
    }
    return "";
}

function isDouble(inputVal)
{
    inputStr = inputVal.toString().Trim();
    oneDecimal = false
    for (var i = 0;i < inputStr.length;i++)
    {
        var oneChar = inputStr.charAt(i)
        if (oneChar == "." && !oneDecimal)
        {
            oneDecimal = true
            continue
        }
        if (oneChar < "0" || oneChar > "9")
        {
            return false
        }
    }
    return true
}
function isInteger(inputVal)
{
    inputStr = inputVal.toString().Trim();
    for (var i = 0;i < inputStr.length;i++)
    {
        var oneChar = inputStr.charAt(i)
        if (oneChar < "0" || oneChar > "9")
        {
            return false
        }
    }
    return true
}
function isEmpty(inputStr)
{
    inputStr=inputStr.Trim();
    if (inputStr.length == 0)
    {
        return true
    }
    return false
}
function isEmail(email)
{
    email = email.Trim();
    
    var accessemail = '';
    var censoremail = '';
    
    var accessexp = accessemail != '' ? /()$/i : null;
    var censorexp = censoremail != '' ? /()$/i : null;

    illegalemail = !(/^[\-\.\w]+@[\-\w]+(\.\w+)+$/.test(email));
    invalidemail = accessemail != '' ? !accessexp.test(email) : censoremail != '' && censorexp.test(email);
    if(illegalemail || invalidemail) {
        return false;
    }
    else
    {
        return true;
    }
}

function isSFZ(code)
{
    code = code.Trim();
    var flag = code.search(/^\d{15}$|^\d{18}$|^\d{17}[X|x]$/); 

    if (flag == 0) 
    {
        return true;
    }
    return false;
}
function isPhone(ph)
{
   ph = ph.Trim();
   // var flag = ph.search(/^\(?\d{3,4}\)? {0,2}-? {0,2}\d{4,}$/); 
    
    var flag = ph.search(/^[\d\- \(\)]*$/);
    if (flag == 0) //????????
    {
        return true;
    }
    return false;
}
function isIP(strIP) 
{
  strIP = strIP.Trim();
    if (isEmpty(strIP)) return false;
    var re=/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/g //匹配IP地址的正则表达式
    if(re.test(strIP))
    {
        if( RegExp.$1 <256 && RegExp.$2<256 && RegExp.$3<256 && RegExp.$4<256) return true;
    }
    return false;
}



String.prototype.Trim = function()
{
    return this.replace(/(^\s*)|(\s*$)/g, "");
}
String.prototype.LTrim = function()
{
    return this.replace(/(^\s*)/g, "");
}
String.prototype.Rtrim = function()
{
    return this.replace(/(\s*$)/g, "");
}

function showPrompt(ocx, promptText)
{
    try{
        document.getElementById("sp_" + ocx.name).innerHTML = "<font color='gray'>" + promptText + "</font>";
    }
    catch(e){}
}

function check(el){
    try{
        var ret = validocx(el);
        if(ret == ""){
        	 document.getElementById(el).className = "input-boder";
           return true;
        }else{
        	  document.getElementById(el).className = "input-boder-on";
            document.getElementById("__message").innerHTML = ret;
            return false;
        }
    } catch(e){return true;}
}
