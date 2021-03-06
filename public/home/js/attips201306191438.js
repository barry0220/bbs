

(function () {
    //初始化数据
    //getusers(atuserid);
    // 基本设置
    var config = {
        boxID: "autoTalkBox",
        //valuepWrap:'autoTalkText',
        wrap: 'recipientsTips',
        listWrap: "autoTipsUserList",
        beforeposition: 'beforecontents',
        atposition: 'atstr',
        afterposition: 'aftercontents',
        positionBeforeHTML: '<span id="beforecontents" style="padding:0px;margin:0;border: 0px solid #444;white-space:pre-wrap; background: #FFF;text-align: left;font-size:14px; line-height:20px;">$before</span>',
        positionAtHTML: '<span id="atstr">$at</span>',
        positionAfterHTML: '<span id="aftercontents" style="padding:0px;margin:0;border: 0px solid #444;white-space:pre-wrap; background: #FFF;text-align: left;font-size:14px; line-height:20px;">$after</span>',
        className: 'on'
    };
    //测试用 overflow-y: auto; overflow-x: hidden; outline: none;
    var testhtml = '<div id="recipientsTips" class="tips-input c-main" style="position:absolute;display:none;"><div id="showtiptype" class="suggest_title c-sub">选择最近@的朋友帐号，或直接输入</div><ul id="autoTipsUserList"></ul></div>';
    var html = '<div id="autoTalkBox" style="z-index:-2000;top:$top$px;left:$left$px;width:$width$px;height:$height$px;z-index:1;position:absolute;scroll-top:$SCTOP$px;white-space:pre;overflow-y:auto;overflow-x: hidden; outline: none;visibility:hidden;word-break:break-all;word-wrap:break-word;padding:0; margin:0;border: 0px solid #444; text-align: left;font-size:14px; line-height:20px;"></div>' + testhtml;
    var listHTML = '<li><a title="$ACCOUNT$" rel="$ID$" >$NAME$</a></li>';


    /*
    * D 基本DOM操作
    */
    var D = {
        $: function (ID) {
            //if (document.getElementById(ID) == null) {
            //兼容iframe
            //    return parent.document.getElementById(ID);
            //}
            return document.getElementById(ID)
        },
        DC: function (tn) {
            return document.createElement(tn);
        },
        EA: function (a, b, c, e) {
            if (a.addEventListener) {
                if (b == "mousewheel") b = "DOMMouseScroll";
                a.addEventListener(b, c, e);
                return true
            } else return a.attachEvent ? a.attachEvent("on" + b, c) : false
        },
        ER: function (a, b, c) {////添加或删除事件
            if (a.removeEventListener) {
                a.removeEventListener(b, c, false);
                return true
            } else return a.detachEvent ? a.detachEvent("on" + b, c) : false
        },
        BS: function () {
            var db = document.body,
			dd = document.documentElement,
			top = db.scrollTop + dd.scrollTop;
            left = db.scrollLeft + dd.scrollLeft;
            return { 'top': top, 'left': left };
        },

        FF: (function () {
            var ua = navigator.userAgent.toLowerCase();
            return /firefox\/([\d\.]+)/.test(ua);
        })()
    };

    var TT = {

        info: function (t) {
            var o = t.getBoundingClientRect();
            var w = t.offsetWidth;
            var h = t.offsetHeight;
            return { top: o.top, left: o.left, width: w, height: h };
        },

        /*
        * 获取光标位置
        */
        getCursorPosition: function (t) {
            //document.getElementById("showisselected").innerHTML = t; //测试用
            if (document.selection) {
                t.focus();
                var ds = document.selection;
                var range = ds.createRange();
                var stored_range = range.duplicate();
                stored_range.moveToElementText(t);
                stored_range.setEndPoint("EndToEnd", range);
                t.selectionStart = stored_range.text.length - range.text.length;
                t.selectionEnd = t.selectionStart + range.text.length;
                return t.selectionStart;
            } else {
                return t.selectionStart
            }
            return t.selectionStart
        },


        /*
        * 设置光标位置
        */
        setCursorPosition: function (t, p) {
            this.sel(t, p, p);
        },

        /*
        * 插入到光标后面
        */
        add: function (t, txt,key) {
            var val = t.value;
            selectstart=selectstart-key.length;
        var oldselectstart = selectstart + txt.length;
    if (checkmsiever()) {
        oldselectstart = getselstartpos + txt.length;
    }
    if (document.selection) {
        t.focus();
        var endstr=t.value.slice(selectstart+key.length, t.value.length);
        t.value  = t.value.slice(0, selectstart) + txt + endstr;
    } else {
        selectend = selectstart;
        var ubbLength = t.value.length;
        var seltxt = t.value.slice(selectstart, selectend)
        txt = txt + seltxt;
        t.value = t.value.slice(0, selectstart) + txt + t.value.slice(selectstart+key.length, ubbLength);
    };

    setSelRange(oldselectstart, oldselectstart);

        },

        sel: function (t, s, z) {
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

        },


        /*
        * 选中一个字符串
        */
        selString: function (t, s) {
            var index = t.value.indexOf(s);
            index != -1 ? this.sel(t, index, index + s.length) : false;
        }

    }


    /*
    * DS 数据查找
    * inquiry(data, str, num) 数据, 关键词, 个数
    * 
    */

    var DS = {
        inquiry: function (data, str, num) {
            //document.getElementById("showsubstr").innerHTML = friendsData;

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
            sd = DS.bubbleSort(sd, str);

            return sd;
        },

        //冒泡排序
        bubbleSort: function (array, str) {
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
        },
        strlen:function(str){
            var strlength=0;
            for (i=0;i<str.length;i++)
            {
                if (DS.isChinese(str.charAt(i))==true)
                {
                    strlength=strlength + 2;
                }
                else
                {
                    strlength=strlength + 1;
                }
            }
            return strlength;
        },
        isChinese:function(str)
        {
            var lst = /[u00-uFF]/;       
            return !lst.test(str);      
        }
    }

    var selectList = {
        _this: null,
        index: -1,
        list: null,
        selectIndex: function (code) {
            if (D.$(config.wrap).style.display == 'none') return true;
            var i = selectList.index;
            switch (code) {
                case 40:
                    i = i + 1;
                    break
                case 38:
                    i = i - 1;
                    break
                case 13:
                    return selectList._this.enter();
                    break
            }

            i = i >= selectList.list.length ? 0 : i < 0 ? selectList.list.length - 1 : i;
            return selectList.setSelected(i);
        },
        setSelected: function (ind) {
            if (selectList.index >= 0) selectList.list[selectList.index].className = '';
            if(selectList.list.length>0)
            {
            selectList.list[ind].className = config.className;
            selectList.index = ind;
            }
            return false;
        }

    }

    var AutoTips = function (A) {
        var elem = A.id ? D.$(A.id) : A.elem;
        var checkLength = 14;
        var _this = {};
        var key = '';

        _this.start = function () {
            var isexist = D.$(config.boxID);
            if (!D.$(config.boxID)) {
                var h = html.slice();
                var info = TT.info(elem);
                var div = D.DC('DIV');
                var bs = D.BS();
                h = h.replace('$top$', (info.top + 20 + bs.top)).
					replace('$left$', (info.left + 3 + bs.left)).
					replace('$width$', (info.width - 15)).
					replace('$height$', (info.height - 25)).
					replace('$SCTOP$', '0');
                div.innerHTML = h;
                document.body.appendChild(div);
            } else {
                _this.updatePosstion();
            }
        }

        _this.keyupFn = function (e) {
                   // document.getElementById("Span1").innerHTML=parseInt(document.getElementById("Span1").innerHTML)+1;

            var fcp = getCursorPosition(document.getElementById("body"));

            var cp;
            if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {
                cp = TT.getCursorPosition(elem);
                openpreview(0); //实时刷新显示文档
            }
           else if (navigator.userAgent.indexOf("MSIE 8.0") > 0||navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                cp = TT.getCursorPosition(elem);
                selstartpos=cp;
                openpreview(0); //实时刷新显示文档
            }
            else {
                cp = fcp;
                openpreview(0); //实时刷新显示文档
            }
            if(cp==undefined)
            {
                cp = TT.getCursorPosition(elem);
                selstartpos=cp;
                openpreview(0); //实时刷新显示文档
            }
            var e = e || window.event;
            var code = e.keyCode;
            var keytype=e.type;
            if (code == 38 || code == 40 || code == 13) {
                if (code == 13 && D.$(config.wrap).style.display != 'none') {
                    _this.enter();
                }
                return false;
            }
            var checkexistat=false;
            if(code==16)
            {
                checkexistat=true;
            }
            if(code==37)
            {
                checkexistat=true;
            }
            if(code==39)
            {
                checkexistat=true;
            }
            if(keytype=="click")
            {
                checkexistat=true;
            }

//            if(!checkexistat)
//            {
//                if (code == 13 && D.$(config.wrap).style.display != 'none') {
//                    _this.enter();
//                }
//                return false;
//            }

            if (!cp) {
                return _this.hide();
            }
            if (atuserid <= 0) {
                return;
            }


            var valuep = elem.value.slice(0, cp);

	        if (friendsData == null) {
                getusers(atuserid);
            }

            if (friendsData == null) {
                return false;
            }

            var val = valuep.slice(-checkLength);

            var isexistat = val.indexOf("@");
            if (isexistat == -1) {
                return _this.hide();
            }


            var endatstr = val.lastIndexOf("@");
            if (endatstr != -1) {
                var sva1l = val.substring(0, endatstr);
                val = val.substring(endatstr, val.length);
            }


            //从@中分开，如果@后有空格，则return
            var atlist = val.split('@');

            var afterchar = atlist[1].toString() ? atlist[1].toString() : ''; //@之后的

            var atafterstr = atlist[1]

            if (afterchar != "") {
                //判断是否空格
                var existspace = 0;
                for (var i = 0; i < afterchar.length; i++) {
                    var cutchar = afterchar.substring(i, 1);
                    if (cutchar == " " || cutchar == "　") {
                        existspace = 1;
                        break;
                    }
                }

                if (existspace == 1) {
                    return _this.hide();
                }
            }

            var atbalist = valuep.lastIndexOf('@');

            var schar = valuep.substring(0, atbalist);

            var atbalist = val.split('@');
            var char = atbalist[1].toString() ? atbalist[1].toString() : ''; //用于搜索 @之后的

            var atafterstr = char + elem.value.slice(cp, elem.value.length);

            var beforestr = schar.replace(/</g, "《").replace(/>/g, "]").replace(/'/g, "‘").replace(/\n/g, '<br/>').replace(/\s/g, '&nbsp;');

            var atstr = "@";

            var afterstr = atafterstr.replace(/</g, "《").replace(/>/g, "]").replace(/'/g, "‘").replace(/\n/g, '<br/>').replace(/\s/g, '&nbsp;');

            D.$(config.boxID).innerHTML = config.positionBeforeHTML.replace("$before", beforestr) + config.positionAtHTML.replace("$at", '@') + config.positionAfterHTML.replace("$after", afterstr);
            char = char.replace(/\\/g, "＼").replace(/\[/g, "【").replace(/\]/g, "】");

            if(char.indexOf(" ")>0||char.indexOf(" ")>0||char.indexOf("　")>0||char.indexOf("　")>0)
            {
                //isspace=true;
                return _this.hide();
            }
            var isnchar=char.replace(/\n/g, '[]');
            if(isnchar.indexOf("[]")>=0)
            {
                return _this.hide();
            }
            var atnamere = /([\u4e00-\u9fa5a-zA-Z0-9_-]+)/gi;
            var atnamer = char.match(atnamere);
            if(atnamer!=null)
            {
            try
            {
                if (atnamer.length>1) {
                    return _this.hide();
                }
                if (atnamer.length==1) {
                    if(char!=atnamer[0])
                    {
                        return _this.hide();
                    }
                }

                }catch(e){}
            }
            var charlength=DS.strlen(char);//计算长度
            if(charlength>checkLength)
            {
                return _this.hide();
            }
            _this.showList(char);
        }
        _this.showList = function (char) {
            key = char;
            var data = DS.inquiry(friendsData, char, 5);
            var html = listHTML.slice();
            var h = '';
            var len = data.length;

            if(len>0)
            {
                document.getElementById("showtiptype").innerHTML="选择最近@的朋友帐号，或直接输入";
                document.getElementById("autoTipsUserList").style.display="";
                var reg = new RegExp(char);
                var em = '<em>' + char + '</em>';
                for (var i = 0; i < len; i++) {
                    var hm = data[i]['user'].replace(reg, em);
                    h += html.replace(/\$ACCOUNT\$|\$NAME\$/g, data[i]['name']).
						replace('$SACCOUNT$', hm).replace('$ID$', data[i]['name']);
                }
            }
            if(len==0)
            {
                document.getElementById("showtiptype").innerHTML="轻敲空格完成输入";
                document.getElementById("autoTipsUserList").style.display="none";
            }


           _this.updatePosstion(); //每次重新设置隐藏层的滚动条
            var p = D.$(config.atposition).getBoundingClientRect(); //获取页面元素的位置 
            var bs = D.BS();
            var d = D.$(config.wrap).style;

            d.top = p.top + bs.top+20 + 'px';

            var dw = 210;
            var leftt = document.getElementById(A.id);
            var lw = leftt.offsetWidth;
            var lh = leftt.offsetHeight;

            var divleft = p.left;

            if ((divleft + dw) > lw) {
                divleft = divleft - dw;
            }

            d.left = divleft + 'px';
            D.$(config.listWrap).innerHTML = h;
            _this.show();

        }


        var mm = 0;
        _this.KeyDown = function (e) {
            mm++;
            var e = e || window.event;
            var code = e.keyCode;
            if (code == 38 || code == 40 || code == 13) {
                return selectList.selectIndex(code);
            }
            return true;
        }

        _this.updatePosstion = function () {
            var p = TT.info(elem);
            var bs = D.BS();
            var d = D.$(config.boxID).style;
            d.top = p.top + bs.top + 'px';
            d.left = (p.left + bs.left) + 'px';
            d.width = p.width + 'px';
            d.height = p.height+ 'px';
            D.$(config.boxID).scrollTop = elem.scrollTop;
        }

        _this.show = function () {
            selectList.list = D.$(config.listWrap).getElementsByTagName('li');
            selectList.index = -1;
            selectList._this = _this;
            _this.cursorSelect(selectList.list);
            elem.onkeydown = _this.KeyDown;
            D.$(config.wrap).style.display = 'block';
        }

        _this.cursorSelect = function (list) {
            for (var i = 0; i < list.length; i++) {
                list[i].onmouseover = (function (i) {
                    return function () { selectList.setSelected(i) };
                })(i);
                list[i].onclick = _this.enter;
            }
        }
        var st = 0;
        _this.hide = function () {
            selectList.list = null;
            selectList.index = -1;
            selectList._this = null;
            D.ER(elem, 'keydown', _this.KeyDown); //添加或删除事件
            D.$(config.wrap).style.display = 'none';
        }

        _this.bind = function () {
            var e = e || window.event;

            elem.onkeyup = _this.keyupFn;
            elem.onclick = _this.keyupFn;
            //elem.onmouseup = _this.keyupFn;
            elem.onblur = function () {setTimeout(_this.hide, 500);}
            var e2 = e || window.event;
        }
        //onbeforepaste="pastehtml();" onpaste="pastehtml();"  onkeydown="foxpastehtml(event);"
        _this.enter = function () {
            if (selectList.index >= 0) {
                TT.add(elem, selectList.list[selectList.index].getElementsByTagName('A')[0].rel + ' ',key);
            }
            _this.hide();
            return false;
        }
        return _this;

    }


    window.userAutoTips = function (args) {

        var a = AutoTips(args);
        a.start();
        a.bind();
    }

})()
