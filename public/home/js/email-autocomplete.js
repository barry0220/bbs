!function(e){var o={domains:["qq.com","163.com","gmail.com","126.com","sina.com","139.com","hotmail.com","outlook.com","sohu.com","128.com","136.com","live.com"]};e.fn.emailautocomplete=function(t){var n=e.extend(!0,{},o,t);return this.each(function(){function o(){var o=d.val(),l=o.indexOf("@"),s=o.split("@")[0]+"@",a=o.substring(l+1),c=n.domains,m=c.length,r="";if(l>0&&l<=o.length-1){for(var u=0;m>u;u++)0==c[u].indexOf(a)&&c[u]!=a&&(r+="<li>"+s+c[u]+"</li>");if(""!=r){if(r="<ul class='dropdown-menu'>"+r+"</ul>",t(),i.append(r),!-[1]&&!window.XMLHttpRequest){var p=e(".dropdown-menu",i),h=e("<iframe id='ie6hiddeniframe' style='position:absolute;top:33px;left:0;width:100%;height:100%;filter:alpha(opacity=0);'></iframe>");h.css({top:p.position().top+"px",width:p.width()+2+"px",height:p.height()+1+"px"}),i.append(h)}}else t()}else t()}function t(){e(".dropdown-menu",i).remove(),-[1]||window.XMLHttpRequest||e("#ie6hiddeniframe",i).remove()}var d=e(this),i=d.parent();d.focus(function(){o()}),d.keyup(function(t){var n=e(".dropdown-menu li.selected",i);return 13==t.which?(n.length>0&&n.mousedown(),!1):38==t.which?(n.removeClass("selected"),0==n.length||0==n.index()?e(".dropdown-menu li:last",i).addClass("selected"):n.prev().addClass("selected"),e(".dropdown-menu li.selected",i).text().length>0&&d.val(e(".dropdown-menu li.selected",i).text()),!1):40==t.which?(n.removeClass("selected"),0==n.length||n.index()==e(".dropdown-menu li",i).length-1?e(".dropdown-menu li:first",i).addClass("selected"):n.next().addClass("selected"),e(".dropdown-menu li.selected",i).text().length>0&&d.val(e(".dropdown-menu li.selected",i).text()),!1):void o()}),d.keypress(function(e){return 13==e.which?!1:void 0}),i.on("mouseenter",".dropdown-menu li",function(){e(".dropdown-menu li.selected",i).removeClass("selected"),e(this).addClass("selected")}),i.on("mousedown",".dropdown-menu li",function(){d.val(e(this).text()),t()})})},e.fn.emailautocomplete.defaults=o}(jQuery);