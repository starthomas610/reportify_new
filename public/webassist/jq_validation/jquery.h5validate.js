// version 2.02
if (!window.jqh5validateLoaded) {
/*
* jQuery throttle / debounce - v1.1 - 3/7/2010
* http://benalman.com/projects/jquery-throttle-debounce-plugin/
*
* Copyright (c) 2010 "Cowboy" Ben Alman
* Dual licensed under the MIT and GPL licenses.
* http://benalman.com/about/license/
*/
(function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
/**
* Version: 1.1
* Build Date: 13-Nov-2007
* Copyright (c) 2006-2007, Coolite Inc. (http://www.coolite.com/). All rights reserved.
* License: Licensed under The MIT License. See license.txt and http://www.datejs.com/license/.
* Website: http://www.datejs.com/ or http://www.coolite.com/datejs/
*/
Date.CultureInfo={name:"en-US",englishName:"English (United States)",nativeName:"English (United States)",dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],abbreviatedDayNames:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],shortestDayNames:["Su","Mo","Tu","We","Th","Fr","Sa"],firstLetterDayNames:["S","M","T","W","T","F","S"],monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],abbreviatedMonthNames:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],amDesignator:"AM",pmDesignator:"PM",firstDayOfWeek:0,twoDigitYearMax:2029,dateElementOrder:"mdy",formatPatterns:{shortDate:"M/d/yyyy",longDate:"dddd, MMMM dd, yyyy",shortTime:"h:mm tt",longTime:"h:mm:ss tt",fullDateTime:"dddd, MMMM dd, yyyy h:mm:ss tt",sortableDateTime:"yyyy-MM-ddTHH:mm:ss",universalSortableDateTime:"yyyy-MM-dd HH:mm:ssZ",rfc1123:"ddd, dd MMM yyyy HH:mm:ss GMT",monthDay:"MMMM dd",yearMonth:"MMMM, yyyy"},regexPatterns:{jan:/^jan(uary)?/i,feb:/^feb(ruary)?/i,mar:/^mar(ch)?/i,apr:/^apr(il)?/i,may:/^may/i,jun:/^jun(e)?/i,jul:/^jul(y)?/i,aug:/^aug(ust)?/i,sep:/^sep(t(ember)?)?/i,oct:/^oct(ober)?/i,nov:/^nov(ember)?/i,dec:/^dec(ember)?/i,sun:/^su(n(day)?)?/i,mon:/^mo(n(day)?)?/i,tue:/^tu(e(s(day)?)?)?/i,wed:/^we(d(nesday)?)?/i,thu:/^th(u(r(s(day)?)?)?)?/i,fri:/^fr(i(day)?)?/i,sat:/^sa(t(urday)?)?/i,future:/^next/i,past:/^last|past|prev(ious)?/i,add:/^(\+|after|from)/i,subtract:/^(\-|before|ago)/i,yesterday:/^yesterday/i,today:/^t(oday)?/i,tomorrow:/^tomorrow/i,now:/^n(ow)?/i,millisecond:/^ms|milli(second)?s?/i,second:/^sec(ond)?s?/i,minute:/^min(ute)?s?/i,hour:/^h(ou)?rs?/i,week:/^w(ee)?k/i,month:/^m(o(nth)?s?)?/i,day:/^d(ays?)?/i,year:/^y((ea)?rs?)?/i,shortMeridian:/^(a|p)/i,longMeridian:/^(a\.?m?\.?|p\.?m?\.?)/i,timezone:/^((e(s|d)t|c(s|d)t|m(s|d)t|p(s|d)t)|((gmt)?\s*(\+|\-)\s*\d\d\d\d?)|gmt)/i,ordinalSuffix:/^\s*(st|nd|rd|th)/i,timeContext:/^\s*(\:|a|p)/i},abbreviatedTimeZoneStandard:{GMT:"-000",EST:"-0400",CST:"-0500",MST:"-0600",PST:"-0700"},abbreviatedTimeZoneDST:{GMT:"-000",EDT:"-0500",CDT:"-0600",MDT:"-0700",PDT:"-0800"}};
Date.getMonthNumberFromName=function(name){var n=Date.CultureInfo.monthNames,m=Date.CultureInfo.abbreviatedMonthNames,s=name.toLowerCase();for(var i=0;i<n.length;i++){if(n[i].toLowerCase()==s||m[i].toLowerCase()==s){return i;}}
return-1;};Date.getDayNumberFromName=function(name){var n=Date.CultureInfo.dayNames,m=Date.CultureInfo.abbreviatedDayNames,o=Date.CultureInfo.shortestDayNames,s=name.toLowerCase();for(var i=0;i<n.length;i++){if(n[i].toLowerCase()==s||m[i].toLowerCase()==s){return i;}}
return-1;};Date.isLeapYear=function(year){return(((year%4===0)&&(year%100!==0))||(year%400===0));};Date.getDaysInMonth=function(year,month){return[31,(Date.isLeapYear(year)?29:28),31,30,31,30,31,31,30,31,30,31][month];};Date.getTimezoneOffset=function(s,dst){return(dst||false)?Date.CultureInfo.abbreviatedTimeZoneDST[s.toUpperCase()]:Date.CultureInfo.abbreviatedTimeZoneStandard[s.toUpperCase()];};Date.getTimezoneAbbreviation=function(offset,dst){var n=(dst||false)?Date.CultureInfo.abbreviatedTimeZoneDST:Date.CultureInfo.abbreviatedTimeZoneStandard,p;for(p in n){if(n[p]===offset){return p;}}
return null;};Date.prototype.clone=function(){return new Date(this.getTime());};Date.prototype.compareTo=function(date){if(isNaN(this)){throw new Error(this);}
if(date instanceof Date&&!isNaN(date)){return(this>date)?1:(this<date)?-1:0;}else{throw new TypeError(date);}};Date.prototype.equals=function(date){return(this.compareTo(date)===0);};Date.prototype.between=function(start,end){var t=this.getTime();return t>=start.getTime()&&t<=end.getTime();};Date.prototype.addMilliseconds=function(value){this.setMilliseconds(this.getMilliseconds()+value);return this;};Date.prototype.addSeconds=function(value){return this.addMilliseconds(value*1000);};Date.prototype.addMinutes=function(value){return this.addMilliseconds(value*60000);};Date.prototype.addHours=function(value){return this.addMilliseconds(value*3600000);};Date.prototype.addDays=function(value){return this.addMilliseconds(value*86400000);};Date.prototype.addWeeks=function(value){return this.addMilliseconds(value*604800000);};Date.prototype.addMonths=function(value){var n=this.getDate();this.setDate(1);this.setMonth(this.getMonth()+value);this.setDate(Math.min(n,this.getDaysInMonth()));return this;};Date.prototype.addYears=function(value){return this.addMonths(value*12);};Date.prototype.add=function(config){if(typeof config=="number"){this._orient=config;return this;}
var x=config;if(x.millisecond||x.milliseconds){this.addMilliseconds(x.millisecond||x.milliseconds);}
if(x.second||x.seconds){this.addSeconds(x.second||x.seconds);}
if(x.minute||x.minutes){this.addMinutes(x.minute||x.minutes);}
if(x.hour||x.hours){this.addHours(x.hour||x.hours);}
if(x.month||x.months){this.addMonths(x.month||x.months);}
if(x.year||x.years){this.addYears(x.year||x.years);}
if(x.day||x.days){this.addDays(x.day||x.days);}
return this;};Date._validate=function(value,min,max,name){if(typeof value!="number"){throw new TypeError(value+" is not a Number.");}else if(value<min||value>max){throw new RangeError(value+" is not a valid value for "+name+".");}
return true;};Date.validateMillisecond=function(n){return Date._validate(n,0,999,"milliseconds");};Date.validateSecond=function(n){return Date._validate(n,0,59,"seconds");};Date.validateMinute=function(n){return Date._validate(n,0,59,"minutes");};Date.validateHour=function(n){return Date._validate(n,0,23,"hours");};Date.validateDay=function(n,year,month){return Date._validate(n,1,Date.getDaysInMonth(year,month),"days");};Date.validateMonth=function(n){return Date._validate(n,0,11,"months");};Date.validateYear=function(n){return Date._validate(n,1,9999,"seconds");};Date.prototype.set=function(config){var x=config;if(!x.millisecond&&x.millisecond!==0){x.millisecond=-1;}
if(!x.second&&x.second!==0){x.second=-1;}
if(!x.minute&&x.minute!==0){x.minute=-1;}
if(!x.hour&&x.hour!==0){x.hour=-1;}
if(!x.day&&x.day!==0){x.day=-1;}
if(!x.month&&x.month!==0){x.month=-1;}
if(!x.year&&x.year!==0){x.year=-1;}
if(x.millisecond!=-1&&Date.validateMillisecond(x.millisecond)){this.addMilliseconds(x.millisecond-this.getMilliseconds());}
if(x.second!=-1&&Date.validateSecond(x.second)){this.addSeconds(x.second-this.getSeconds());}
if(x.minute!=-1&&Date.validateMinute(x.minute)){this.addMinutes(x.minute-this.getMinutes());}
if(x.hour!=-1&&Date.validateHour(x.hour)){this.addHours(x.hour-this.getHours());}
if(x.month!==-1&&Date.validateMonth(x.month)){this.addMonths(x.month-this.getMonth());}
if(x.year!=-1&&Date.validateYear(x.year)){this.addYears(x.year-this.getFullYear());}
if(x.day!=-1&&Date.validateDay(x.day,this.getFullYear(),this.getMonth())){this.addDays(x.day-this.getDate());}
if(x.timezone){this.setTimezone(x.timezone);}
if(x.timezoneOffset){this.setTimezoneOffset(x.timezoneOffset);}
return this;};Date.prototype.clearTime=function(){this.setHours(0);this.setMinutes(0);this.setSeconds(0);this.setMilliseconds(0);return this;};Date.prototype.isLeapYear=function(){var y=this.getFullYear();return(((y%4===0)&&(y%100!==0))||(y%400===0));};Date.prototype.isWeekday=function(){return!(this.is().sat()||this.is().sun());};Date.prototype.getDaysInMonth=function(){return Date.getDaysInMonth(this.getFullYear(),this.getMonth());};Date.prototype.moveToFirstDayOfMonth=function(){return this.set({day:1});};Date.prototype.moveToLastDayOfMonth=function(){return this.set({day:this.getDaysInMonth()});};Date.prototype.moveToDayOfWeek=function(day,orient){var diff=(day-this.getDay()+7*(orient||+1))%7;return this.addDays((diff===0)?diff+=7*(orient||+1):diff);};Date.prototype.moveToMonth=function(month,orient){var diff=(month-this.getMonth()+12*(orient||+1))%12;return this.addMonths((diff===0)?diff+=12*(orient||+1):diff);};Date.prototype.getDayOfYear=function(){return Math.floor((this-new Date(this.getFullYear(),0,1))/86400000);};Date.prototype.getWeekOfYear=function(firstDayOfWeek){var y=this.getFullYear(),m=this.getMonth(),d=this.getDate();var dow=firstDayOfWeek||Date.CultureInfo.firstDayOfWeek;var offset=7+1-new Date(y,0,1).getDay();if(offset==8){offset=1;}
var daynum=((Date.UTC(y,m,d,0,0,0)-Date.UTC(y,0,1,0,0,0))/86400000)+1;var w=Math.floor((daynum-offset+7)/7);if(w===dow){y--;var prevOffset=7+1-new Date(y,0,1).getDay();if(prevOffset==2||prevOffset==8){w=53;}else{w=52;}}
return w;};Date.prototype.isDST=function(){console.log('isDST');return this.toString().match(/(E|C|M|P)(S|D)T/)[2]=="D";};Date.prototype.getTimezone=function(){return Date.getTimezoneAbbreviation(this.getUTCOffset,this.isDST());};Date.prototype.setTimezoneOffset=function(s){var here=this.getTimezoneOffset(),there=Number(s)*-6/10;this.addMinutes(there-here);return this;};Date.prototype.setTimezone=function(s){return this.setTimezoneOffset(Date.getTimezoneOffset(s));};Date.prototype.getUTCOffset=function(){var n=this.getTimezoneOffset()*-10/6,r;if(n<0){r=(n-10000).toString();return r[0]+r.substr(2);}else{r=(n+10000).toString();return"+"+r.substr(1);}};Date.prototype.getDayName=function(abbrev){return abbrev?Date.CultureInfo.abbreviatedDayNames[this.getDay()]:Date.CultureInfo.dayNames[this.getDay()];};Date.prototype.getMonthName=function(abbrev){return abbrev?Date.CultureInfo.abbreviatedMonthNames[this.getMonth()]:Date.CultureInfo.monthNames[this.getMonth()];};Date.prototype._toString=Date.prototype.toString;Date.prototype.toString=function(format){var self=this;var p=function p(s){return(s.toString().length==1)?"0"+s:s;};return format?format.replace(/dd?d?d?|MM?M?M?|yy?y?y?|hh?|HH?|mm?|ss?|tt?|zz?z?/g,function(format){switch(format){case"hh":return p(self.getHours()<13?self.getHours():(self.getHours()-12));case"h":return self.getHours()<13?self.getHours():(self.getHours()-12);case"HH":return p(self.getHours());case"H":return self.getHours();case"mm":return p(self.getMinutes());case"m":return self.getMinutes();case"ss":return p(self.getSeconds());case"s":return self.getSeconds();case"yyyy":return self.getFullYear();case"yy":return self.getFullYear().toString().substring(2,4);case"dddd":return self.getDayName();case"ddd":return self.getDayName(true);case"dd":return p(self.getDate());case"d":return self.getDate().toString();case"MMMM":return self.getMonthName();case"MMM":return self.getMonthName(true);case"MM":return p((self.getMonth()+1));case"M":return self.getMonth()+1;case"t":return self.getHours()<12?Date.CultureInfo.amDesignator.substring(0,1):Date.CultureInfo.pmDesignator.substring(0,1);case"tt":return self.getHours()<12?Date.CultureInfo.amDesignator:Date.CultureInfo.pmDesignator;case"zzz":case"zz":case"z":return"";}}):this._toString();};
Date.now=function(){return new Date();};Date.today=function(){return Date.now().clearTime();};Date.prototype._orient=+1;Date.prototype.next=function(){this._orient=+1;return this;};Date.prototype.last=Date.prototype.prev=Date.prototype.previous=function(){this._orient=-1;return this;};Date.prototype._is=false;Date.prototype.is=function(){this._is=true;return this;};Number.prototype._dateElement="day";Number.prototype.fromNow=function(){var c={};c[this._dateElement]=this;return Date.now().add(c);};Number.prototype.ago=function(){var c={};c[this._dateElement]=this*-1;return Date.now().add(c);};(function(){var $D=Date.prototype,$N=Number.prototype;var dx=("sunday monday tuesday wednesday thursday friday saturday").split(/\s/),mx=("january february march april may june july august september october november december").split(/\s/),px=("Millisecond Second Minute Hour Day Week Month Year").split(/\s/),de;var df=function(n){return function(){if(this._is){this._is=false;return this.getDay()==n;}
return this.moveToDayOfWeek(n,this._orient);};};for(var i=0;i<dx.length;i++){$D[dx[i]]=$D[dx[i].substring(0,3)]=df(i);}
var mf=function(n){return function(){if(this._is){this._is=false;return this.getMonth()===n;}
return this.moveToMonth(n,this._orient);};};for(var j=0;j<mx.length;j++){$D[mx[j]]=$D[mx[j].substring(0,3)]=mf(j);}
var ef=function(j){return function(){if(j.substring(j.length-1)!="s"){j+="s";}
return this["add"+j](this._orient);};};var nf=function(n){return function(){this._dateElement=n;return this;};};for(var k=0;k<px.length;k++){de=px[k].toLowerCase();$D[de]=$D[de+"s"]=ef(px[k]);$N[de]=$N[de+"s"]=nf(de);}}());Date.prototype.toJSONString=function(){return this.toString("yyyy-MM-ddThh:mm:ssZ");};Date.prototype.toShortDateString=function(){return this.toString(Date.CultureInfo.formatPatterns.shortDatePattern);};Date.prototype.toLongDateString=function(){return this.toString(Date.CultureInfo.formatPatterns.longDatePattern);};Date.prototype.toShortTimeString=function(){return this.toString(Date.CultureInfo.formatPatterns.shortTimePattern);};Date.prototype.toLongTimeString=function(){return this.toString(Date.CultureInfo.formatPatterns.longTimePattern);};Date.prototype.getOrdinal=function(){switch(this.getDate()){case 1:case 21:case 31:return"st";case 2:case 22:return"nd";case 3:case 23:return"rd";default:return"th";}};
(function(){Date.Parsing={Exception:function(s){this.message="Parse error at '"+s.substring(0,10)+" ...'";}};var $P=Date.Parsing;var _=$P.Operators={rtoken:function(r){return function(s){var mx=s.match(r);if(mx){return([mx[0],s.substring(mx[0].length)]);}else{throw new $P.Exception(s);}};},token:function(s){return function(s){return _.rtoken(new RegExp("^\s*"+s+"\s*"))(s);};},stoken:function(s){return _.rtoken(new RegExp("^"+s));},until:function(p){return function(s){var qx=[],rx=null;while(s.length){try{rx=p.call(this,s);}catch(e){qx.push(rx[0]);s=rx[1];continue;}
break;}
return[qx,s];};},many:function(p){return function(s){var rx=[],r=null;while(s.length){try{r=p.call(this,s);}catch(e){return[rx,s];}
rx.push(r[0]);s=r[1];}
return[rx,s];};},optional:function(p){return function(s){var r=null;try{r=p.call(this,s);}catch(e){return[null,s];}
return[r[0],r[1]];};},not:function(p){return function(s){try{p.call(this,s);}catch(e){return[null,s];}
throw new $P.Exception(s);};},ignore:function(p){return p?function(s){var r=null;r=p.call(this,s);return[null,r[1]];}:null;},product:function(){var px=arguments[0],qx=Array.prototype.slice.call(arguments,1),rx=[];for(var i=0;i<px.length;i++){rx.push(_.each(px[i],qx));}
return rx;},cache:function(rule){var cache={},r=null;return function(s){try{r=cache[s]=(cache[s]||rule.call(this,s));}catch(e){r=cache[s]=e;}
if(r instanceof $P.Exception){throw r;}else{return r;}};},any:function(){var px=arguments;return function(s){var r=null;for(var i=0;i<px.length;i++){if(px[i]==null){continue;}
try{r=(px[i].call(this,s));}catch(e){r=null;}
if(r){return r;}}
throw new $P.Exception(s);};},each:function(){var px=arguments;return function(s){var rx=[],r=null;for(var i=0;i<px.length;i++){if(px[i]==null){continue;}
try{r=(px[i].call(this,s));}catch(e){throw new $P.Exception(s);}
rx.push(r[0]);s=r[1];}
return[rx,s];};},all:function(){var px=arguments,_=_;return _.each(_.optional(px));},sequence:function(px,d,c){d=d||_.rtoken(/^\s*/);c=c||null;if(px.length==1){return px[0];}
return function(s){var r=null,q=null;var rx=[];for(var i=0;i<px.length;i++){try{r=px[i].call(this,s);}catch(e){break;}
rx.push(r[0]);try{q=d.call(this,r[1]);}catch(ex){q=null;break;}
s=q[1];}
if(!r){throw new $P.Exception(s);}
if(q){throw new $P.Exception(q[1]);}
if(c){try{r=c.call(this,r[1]);}catch(ey){throw new $P.Exception(r[1]);}}
return[rx,(r?r[1]:s)];};},between:function(d1,p,d2){d2=d2||d1;var _fn=_.each(_.ignore(d1),p,_.ignore(d2));return function(s){var rx=_fn.call(this,s);return[[rx[0][0],r[0][2]],rx[1]];};},list:function(p,d,c){d=d||_.rtoken(/^\s*/);c=c||null;return(p instanceof Array?_.each(_.product(p.slice(0,-1),_.ignore(d)),p.slice(-1),_.ignore(c)):_.each(_.many(_.each(p,_.ignore(d))),px,_.ignore(c)));},set:function(px,d,c){d=d||_.rtoken(/^\s*/);c=c||null;return function(s){var r=null,p=null,q=null,rx=null,best=[[],s],last=false;for(var i=0;i<px.length;i++){q=null;p=null;r=null;last=(px.length==1);try{r=px[i].call(this,s);}catch(e){continue;}
rx=[[r[0]],r[1]];if(r[1].length>0&&!last){try{q=d.call(this,r[1]);}catch(ex){last=true;}}else{last=true;}
if(!last&&q[1].length===0){last=true;}
if(!last){var qx=[];for(var j=0;j<px.length;j++){if(i!=j){qx.push(px[j]);}}
p=_.set(qx,d).call(this,q[1]);if(p[0].length>0){rx[0]=rx[0].concat(p[0]);rx[1]=p[1];}}
if(rx[1].length<best[1].length){best=rx;}
if(best[1].length===0){break;}}
if(best[0].length===0){return best;}
if(c){try{q=c.call(this,best[1]);}catch(ey){throw new $P.Exception(best[1]);}
best[1]=q[1];}
return best;};},forward:function(gr,fname){return function(s){return gr[fname].call(this,s);};},replace:function(rule,repl){return function(s){var r=rule.call(this,s);return[repl,r[1]];};},process:function(rule,fn){return function(s){var r=rule.call(this,s);return[fn.call(this,r[0]),r[1]];};},min:function(min,rule){return function(s){var rx=rule.call(this,s);if(rx[0].length<min){throw new $P.Exception(s);}
return rx;};}};var _generator=function(op){return function(){var args=null,rx=[];if(arguments.length>1){args=Array.prototype.slice.call(arguments);}else if(arguments[0]instanceof Array){args=arguments[0];}
if(args){for(var i=0,px=args.shift();i<px.length;i++){args.unshift(px[i]);rx.push(op.apply(null,args));args.shift();return rx;}}else{return op.apply(null,arguments);}};};var gx="optional not ignore cache".split(/\s/);for(var i=0;i<gx.length;i++){_[gx[i]]=_generator(_[gx[i]]);}
var _vector=function(op){return function(){if(arguments[0]instanceof Array){return op.apply(null,arguments[0]);}else{return op.apply(null,arguments);}};};var vx="each any all".split(/\s/);for(var j=0;j<vx.length;j++){_[vx[j]]=_vector(_[vx[j]]);}}());(function(){var flattenAndCompact=function(ax){var rx=[];for(var i=0;i<ax.length;i++){if(ax[i]instanceof Array){rx=rx.concat(flattenAndCompact(ax[i]));}else{if(ax[i]){rx.push(ax[i]);}}}
return rx;};Date.Grammar={};Date.Translator={hour:function(s){return function(){this.hour=Number(s);};},minute:function(s){return function(){this.minute=Number(s);};},second:function(s){return function(){this.second=Number(s);};},meridian:function(s){return function(){this.meridian=s.slice(0,1).toLowerCase();};},timezone:function(s){return function(){var n=s.replace(/[^\d\+\-]/g,"");if(n.length){this.timezoneOffset=Number(n);}else{this.timezone=s.toLowerCase();}};},day:function(x){var s=x[0];return function(){this.day=Number(s.match(/\d+/)[0]);};},month:function(s){return function(){this.month=((s.length==3)?Date.getMonthNumberFromName(s):(Number(s)-1));};},year:function(s){return function(){var n=Number(s);this.year=((s.length>2)?n:(n+(((n+2000)<Date.CultureInfo.twoDigitYearMax)?2000:1900)));};},rday:function(s){return function(){switch(s){case"yesterday":this.days=-1;break;case"tomorrow":this.days=1;break;case"today":this.days=0;break;case"now":this.days=0;this.now=true;break;}};},finishExact:function(x){x=(x instanceof Array)?x:[x];var now=new Date();this.year=now.getFullYear();this.month=now.getMonth();this.day=1;this.hour=0;this.minute=0;this.second=0;for(var i=0;i<x.length;i++){if(x[i]){x[i].call(this);}}
this.hour=(this.meridian=="p"&&this.hour<13)?this.hour+12:this.hour;if(this.day>Date.getDaysInMonth(this.year,this.month)){throw new RangeError(this.day+" is not a valid value for days.");}
var r=new Date(this.year,this.month,this.day,this.hour,this.minute,this.second);if(this.timezone){r.set({timezone:this.timezone});}else if(this.timezoneOffset){r.set({timezoneOffset:this.timezoneOffset});}
return r;},finish:function(x){x=(x instanceof Array)?flattenAndCompact(x):[x];if(x.length===0){return null;}
for(var i=0;i<x.length;i++){if(typeof x[i]=="function"){x[i].call(this);}}
if(this.now){return new Date();}
var today=Date.today();var method=null;var expression=!!(this.days!=null||this.orient||this.operator);if(expression){var gap,mod,orient;orient=((this.orient=="past"||this.operator=="subtract")?-1:1);if(this.weekday){this.unit="day";gap=(Date.getDayNumberFromName(this.weekday)-today.getDay());mod=7;this.days=gap?((gap+(orient*mod))%mod):(orient*mod);}
if(this.month){this.unit="month";gap=(this.month-today.getMonth());mod=12;this.months=gap?((gap+(orient*mod))%mod):(orient*mod);this.month=null;}
if(!this.unit){this.unit="day";}
if(this[this.unit+"s"]==null||this.operator!=null){if(!this.value){this.value=1;}
if(this.unit=="week"){this.unit="day";this.value=this.value*7;}
this[this.unit+"s"]=this.value*orient;}
return today.add(this);}else{if(this.meridian&&this.hour){this.hour=(this.hour<13&&this.meridian=="p")?this.hour+12:this.hour;}
if(this.weekday&&!this.day){this.day=(today.addDays((Date.getDayNumberFromName(this.weekday)-today.getDay()))).getDate();}
if(this.month&&!this.day){this.day=1;}
return today.set(this);}}};var _=Date.Parsing.Operators,g=Date.Grammar,t=Date.Translator,_fn;g.datePartDelimiter=_.rtoken(/^([\s\-\.\,\/\x27]+)/);g.timePartDelimiter=_.stoken(":");g.whiteSpace=_.rtoken(/^\s*/);g.generalDelimiter=_.rtoken(/^(([\s\,]|at|on)+)/);var _C={};g.ctoken=function(keys){var fn=_C[keys];if(!fn){var c=Date.CultureInfo.regexPatterns;var kx=keys.split(/\s+/),px=[];for(var i=0;i<kx.length;i++){px.push(_.replace(_.rtoken(c[kx[i]]),kx[i]));}
fn=_C[keys]=_.any.apply(null,px);}
return fn;};g.ctoken2=function(key){return _.rtoken(Date.CultureInfo.regexPatterns[key]);};g.h=_.cache(_.process(_.rtoken(/^(0[0-9]|1[0-2]|[1-9])/),t.hour));g.hh=_.cache(_.process(_.rtoken(/^(0[0-9]|1[0-2])/),t.hour));g.H=_.cache(_.process(_.rtoken(/^([0-1][0-9]|2[0-3]|[0-9])/),t.hour));g.HH=_.cache(_.process(_.rtoken(/^([0-1][0-9]|2[0-3])/),t.hour));g.m=_.cache(_.process(_.rtoken(/^([0-5][0-9]|[0-9])/),t.minute));g.mm=_.cache(_.process(_.rtoken(/^[0-5][0-9]/),t.minute));g.s=_.cache(_.process(_.rtoken(/^([0-5][0-9]|[0-9])/),t.second));g.ss=_.cache(_.process(_.rtoken(/^[0-5][0-9]/),t.second));g.hms=_.cache(_.sequence([g.H,g.mm,g.ss],g.timePartDelimiter));g.t=_.cache(_.process(g.ctoken2("shortMeridian"),t.meridian));g.tt=_.cache(_.process(g.ctoken2("longMeridian"),t.meridian));g.z=_.cache(_.process(_.rtoken(/^(\+|\-)?\s*\d\d\d\d?/),t.timezone));g.zz=_.cache(_.process(_.rtoken(/^(\+|\-)\s*\d\d\d\d/),t.timezone));g.zzz=_.cache(_.process(g.ctoken2("timezone"),t.timezone));g.timeSuffix=_.each(_.ignore(g.whiteSpace),_.set([g.tt,g.zzz]));g.time=_.each(_.optional(_.ignore(_.stoken("T"))),g.hms,g.timeSuffix);g.d=_.cache(_.process(_.each(_.rtoken(/^([0-2]\d|3[0-1]|\d)/),_.optional(g.ctoken2("ordinalSuffix"))),t.day));g.dd=_.cache(_.process(_.each(_.rtoken(/^([0-2]\d|3[0-1])/),_.optional(g.ctoken2("ordinalSuffix"))),t.day));g.ddd=g.dddd=_.cache(_.process(g.ctoken("sun mon tue wed thu fri sat"),function(s){return function(){this.weekday=s;};}));g.M=_.cache(_.process(_.rtoken(/^(1[0-2]|0\d|\d)/),t.month));g.MM=_.cache(_.process(_.rtoken(/^(1[0-2]|0\d)/),t.month));g.MMM=g.MMMM=_.cache(_.process(g.ctoken("jan feb mar apr may jun jul aug sep oct nov dec"),t.month));g.y=_.cache(_.process(_.rtoken(/^(\d\d?)/),t.year));g.yy=_.cache(_.process(_.rtoken(/^(\d\d)/),t.year));g.yyy=_.cache(_.process(_.rtoken(/^(\d\d?\d?\d?)/),t.year));g.yyyy=_.cache(_.process(_.rtoken(/^(\d\d\d\d)/),t.year));_fn=function(){return _.each(_.any.apply(null,arguments),_.not(g.ctoken2("timeContext")));};g.day=_fn(g.d,g.dd);g.month=_fn(g.M,g.MMM);g.year=_fn(g.yyyy,g.yy);g.orientation=_.process(g.ctoken("past future"),function(s){return function(){this.orient=s;};});g.operator=_.process(g.ctoken("add subtract"),function(s){return function(){this.operator=s;};});g.rday=_.process(g.ctoken("yesterday tomorrow today now"),t.rday);g.unit=_.process(g.ctoken("minute hour day week month year"),function(s){return function(){this.unit=s;};});g.value=_.process(_.rtoken(/^\d\d?(st|nd|rd|th)?/),function(s){return function(){this.value=s.replace(/\D/g,"");};});g.expression=_.set([g.rday,g.operator,g.value,g.unit,g.orientation,g.ddd,g.MMM]);_fn=function(){return _.set(arguments,g.datePartDelimiter);};g.mdy=_fn(g.ddd,g.month,g.day,g.year);g.ymd=_fn(g.ddd,g.year,g.month,g.day);g.dmy=_fn(g.ddd,g.day,g.month,g.year);g.date=function(s){return((g[Date.CultureInfo.dateElementOrder]||g.mdy).call(this,s));};g.format=_.process(_.many(_.any(_.process(_.rtoken(/^(dd?d?d?|MM?M?M?|yy?y?y?|hh?|HH?|mm?|ss?|tt?|zz?z?)/),function(fmt){if(g[fmt]){return g[fmt];}else{throw Date.Parsing.Exception(fmt);}}),_.process(_.rtoken(/^[^dMyhHmstz]+/),function(s){return _.ignore(_.stoken(s));}))),function(rules){return _.process(_.each.apply(null,rules),t.finishExact);});var _F={};var _get=function(f){return _F[f]=(_F[f]||g.format(f)[0]);};g.formats=function(fx){if(fx instanceof Array){var rx=[];for(var i=0;i<fx.length;i++){rx.push(_get(fx[i]));}
return _.any.apply(null,rx);}else{return _get(fx);}};g._formats=g.formats(["yyyy-MM-ddTHH:mm:ss","ddd, MMM dd, yyyy H:mm:ss tt","ddd MMM d yyyy HH:mm:ss zzz","d"]);g._start=_.process(_.set([g.date,g.time,g.expression],g.generalDelimiter,g.whiteSpace),t.finish);g.start=function(s){try{var r=g._formats.call({},s);if(r[1].length===0){return r;}}catch(e){}
return g._start.call({},s);};}());Date._parse=Date.parse;Date.parse=function(s){var r=null;if(!s){return null;}
try{r=Date.Grammar.start.call({},s);}catch(e){return null;}
return((r[1].length===0)?r[0]:null);};Date.getParseFunction=function(fx){var fn=Date.Grammar.formats(fx);return function(s){var r=null;try{r=fn.call({},s);}catch(e){return null;}
return((r[1].length===0)?r[0]:null);};};Date.parseExact=function(s,fx){return Date.getParseFunction(fx)(s);};
/**
* h5Validate
* @version v0.9.0
* Using semantic versioning: http://semver.org/
* @author Eric Hamilton http://ericleads.com/
* @copyright 2010 - 2012 Eric Hamilton
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*
* Developed under the sponsorship of RootMusic, Zumba Fitness, LLC, and Rese Property Management
*/
/*global jQuery, window, console */
(function ($) {
'use strict';
var console = window.console || function () {},
h5 = { // Public API
defaults : {
debug: false,
RODom: false,
// HTML5-compatible validation pattern library that can be extended and/or overriden.
patternLibrary : { //** TODO: Test the new regex patterns. Should I apply these to the new input types?
// **TODO: password
phone: /([\+][0-9]{1,3}([ \.\-])?)?([\(]{1}[0-9]{3}[\)])?([0-9A-Z \.\-]{1,32})((x|ext|extension)?[0-9]{1,4}?)/,
// Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
email: /((([a-zA-Z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-zA-Z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?/,
// Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/iri/
url: /(https?|ftp):\/\/(((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-zA-Z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?/,
// Number, including positive, negative, and floating decimal. Credit: bassistance
number: /-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?/,
// Date in ISO format. Credit: bassistance
dateISO: /\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/,
alpha: /[a-zA-Z]+/,
alphaNumeric: /\w+/,
integer: /-?\d+/
},
// The prefix to use for dynamically-created class names.
classPrefix: 'h5-',
errorClass: 'ui-state-error', // No prefix for these.
popupClass: '', // No default class.
validClass: 'ui-state-valid', // "
activeClass: 'active', // Prefix will get prepended.
requiredClass: 'required',
requiredAttribute: 'required',
patternAttribute: 'pattern',
// Attribute which stores the ID of the error container element (without the hash).
errorAttribute: 'data-h5-errorid',
// Events API
customEvents: {
'validate': true
},
// Setup KB event delegation.
kbSelectors: ':input:not(:button):not(:disabled):not(.novalidate)',
focusout: true,
focusin: false,
change: true,
keyup: false,
activeKeyup: true,
// Setup mouse event delegation.
mSelectors: ':radio:not(:disabled):not(.novalidate), :checkbox:not(:disabled):not(.novalidate)',
sSelectors: '[type="range"]:not(:disabled):not(.novalidate), select:not(:disabled):not(.novalidate), option:not(:disabled):not(.novalidate)',
click: true,
// What do we name the required .data variable?
requiredVar: 'h5-required',
// What do we name the pattern .data variable?
patternVar: 'h5-pattern',
stripMarkup: true,
// Run submit related checks and prevent form submission if any fields are invalid?
submit: true,
// Move focus to the first invalid field on submit?
focusFirstInvalidElementOnSubmit: true,
// When submitting, validate elements that haven't been validated yet?
validateOnSubmit: true,
// Callback stubs
invalidCallback: function () {},
validCallback: function () {},
// Elements to validate with allValid (only validating visible elements)
allValidSelectors: ':input:visible:not(:button):not(:disabled):not(.novalidate), .cke_validated',
// Mark field invalid.
// ** TODO: Highlight labels
// ** TODO: Implement setCustomValidity as per the spec:
// http://www.whatwg.org/specs/web-apps/current-work/multipage/association-of-controls-and-forms.html#dom-cva-setcustomvalidity
markInvalid: function markInvalid(options) {
var $element = $(options.element);
var errorName = "";
if (!options.errorID || !$(options.errorID).length) {
if (!options.errorID) {
var identifier = ($element.attr('id')?$element.attr('id'):$element.attr('name'));
if (!identifier) identifier = "";
identifier = identifier.replace(/[^a-z0-9_]/gi,"_");
errorName = identifier + "_waerror";
options.errorID = "#" + errorName;
} else {
errorName = options.errorID.substring(1);
}
if (!document.getElementById(errorName+"_errorMsg")) {
this.makePopup($element,errorName,options);
} else {
var titleVal = false;
if ($element.attr('message') && window[$element.attr('message')]) {
  eval("titleVal = " + $element.attr('message') + "($element,options.validity)");
}
if (!titleVal && options && options.validity && options.validity.customError) {
  titleVal = options.validity.customError;
}
if (!titleVal && $element.attr('validation_msg')) {
  titleVal = $element.attr('validation_msg');
}
if (!titleVal && $element.attr('title')) {
  titleVal = $element.attr('title');
}
if (!titleVal) titleVal = "This field is required";
  $("#"+errorName + "_title").html(titleVal);
}
}
var $errorID = $("#"+errorName + "_errorMsg");
var $errorID_wrapper = $("#"+errorName + "_errorMsg_wrapper");
$element.addClass(options.errorClass).removeClass(options.validClass);
// User needs help. Enable active validation.
$element.addClass(options.settings.activeClass);
if ($errorID.length) { // These ifs are technically not needed, but improve server-side performance
$errorID_wrapper.show();
  
  repositionValidation(errorName,$element,options);
  
//reposition Validation($("#"+errorName + "_errorMsg_wrapper"),$("#"+errorName + "_errorMsg_before"),$element,options.orientation,options.direction,options.pointedAt,options.offset,options.fieldOffset,options.fieldMargin);
}
$element.data('valid', false);
options.settings.invalidCallback.call(options.element, options.validity);
return $element;
},

makePopup: function(element,errorName,options) {
var t = $('<div id="' + errorName + "_errorMsg_wrapper" +'" class="'+options.popupClass+'-wrapper"><span id="' + errorName + "_errorMsg" +'" class="'+options.popupClass+'" pointer="20" style="display:none"></span></div>');
$('body').append(t);
var titleVal = "";
if (element.attr('title')) element.attr('validation_msg',element.attr('title'));
if (element.attr('message') && window[element.attr('message')]) {
  eval("titleVal = " + element.attr('message') + "(element,options.validity)");
}
if (!titleVal && options && options.validity && options.validity.customError) {
  titleVal = options.validity.customError;
}
if (!titleVal && element.attr('validation_msg')) {
  titleVal = element.attr('validation_msg');
}
if (!titleVal) titleVal = "This field is required";
element.attr('title',"");
var errorEl = $('#' + element.attr('data-h5-errorid'));
titleVal = '<div id="' + errorName + "_close" +'" class="validation-close">'+options.closeText+'</div><span id="' + errorName + '_title">' + titleVal + '</span>';
$("#"+errorName + "_errorMsg").html(titleVal);
$("#"+errorName + "_close").click(function() {
wa_hideVal(this.parentNode.id);
});
buttonDims(errorName + "_errorMsg",options,element);
},
// Mark field valid.
markValid: function markValid(options,skip) {
var $element = $(options.element),
$errorID = $(options.errorID);
if (!skip) {
$element.addClass(options.validClass).removeClass(options.errorClass);
if ($errorID.length) {
 $errorID.hide();
}
}
var identifier = ($element.attr('id')?$element.attr('id'):$element.attr('name'));
if (!identifier) identifier = "";
identifier = identifier.replace(/[^a-z0-9_]/gi,"_");
var errorName = identifier + "_waerror_errorMsg";
if (!skip) wa_hideVal(errorName);
$element.data('valid', true);
options.settings.validCallback.call(options.element, options.validity);
return $element;
},
// Unmark field
unmark: function unmark(options) {
var $element = $(options.element);
$element.removeClass(options.errorClass).removeClass(options.validClass);
$element.form.find("#" + options.element.id).removeClass(options.errorClass).removeClass(options.validClass);
return $element;
}
}
},
// Aliases
defaults = h5.defaults,
patternLibrary = defaults.patternLibrary,
createValidity = function createValidity(validity) {
return $.extend({
customError: validity.customError || false,
patternMismatch: validity.patternMismatch || false,
rangeOverflow: validity.rangeOverflow || false,
rangeUnderflow: validity.rangeUnderflow || false,
stepMismatch: validity.stepMismatch || false,
tooLong: validity.tooLong || false,
typeMismatch: validity.typeMismatch || false,
valid: validity.valid || true,
valueMissing: validity.valueMissing || false
}, validity);
},
methods = {
/**
* Check the validity of the current field
* @param {object} settings instance settings
* @param {object} options
* .revalidate - trigger validation function first?
* @return {Boolean}
*/
isValid: function (settings, options) {
var $this = $(this);
options = (settings && options) || {};
// Revalidate defaults to true
if (options.revalidate !== false) {
$this.trigger('validate');
}
return $this.data('valid'); // get the validation result
},
allValid: function (config, options) {
var valid = true,
formValidity = [],
$this = $(this),
$allFields,
$filteredFields,
radioNames = [],
getValidity = function getValidity(e, data) {
data.e = e;
formValidity.push(data);
},
settings = $.extend({}, config, options); // allow options to override settings
options = options || {};
$this.trigger('formValidate', {settings: $.extend(true, {}, settings)});
// Make sure we're not triggering handlers more than we need to.
$this.undelegate(settings.allValidSelectors,
'.allValid', getValidity);
$this.delegate(settings.allValidSelectors,
'validated.allValid', getValidity);
$allFields = $this.find(settings.allValidSelectors);
// Filter radio buttons with the same name and keep only one,
// since they will be checked as a group by isValid()
$filteredFields = $allFields.filter(function(index) {
var name;
if(this.tagName === "INPUT"
&& this.type === "radio") {
name = this.name;
if(radioNames[name] === true) {
return false;
}
radioNames[name] = true;
}
return true;
});
$filteredFields.each(function () {
if (valid || !settings.stopOnError) {
var $this = $(this);
valid = $this.h5Validate('isValid', options) && valid;
}
});
$this.trigger('formValidated', {valid: valid, elements: formValidity});
return valid;
},
clearValidation: function (config, options) {
var valid = true,
formValidity = [],
$this = $(this),
$allFields,
$filteredFields,
radioNames = [],
getValidity = function getValidity(e, data) {
data.e = e;
formValidity.push(data);
},
settings = $.extend({}, config, options); // allow options to override settings
options = options || {};
$allFields = $this.find(settings.allValidSelectors);
// Filter radio buttons with the same name and keep only one,
// since they will be checked as a group by isValid()
$allFields.each(function () {
if (valid || !settings.stopOnError) {
var $this = $(this);
	if (document.getElementById(this.id+ "_waerror_errorMsg_wrapper")) document.getElementById(this.id+ "_waerror_errorMsg_wrapper").style.display='none';
}
});
},
validate: function (settings) {
// Get the HTML5 pattern attribute if it exists.
// ** TODO: If a pattern class exists, grab the pattern from the patternLibrary, but the pattern attrib should override that value.
var pattern = ($(this).filter('[pattern]')[0] ? $(this).attr('pattern') : false);
var patternModifier = "";
if (pattern && pattern.indexOf("/") == 0 && pattern.charAt(1) != "/") {
	patternModifier = pattern.substring(pattern.lastIndexOf("/")+1);
	pattern = pattern.substring(pattern.indexOf("/")+1,pattern.lastIndexOf("/"));
} else if (pattern) {
// The pattern attribute must match the whole value, not just a subset:
// "...as if it implied a ^(?: at the start of the pattern and a )$ at the end."
	pattern = '^(?:' + pattern + ')$';
}
if (this.getAttribute("onblur")) eval(this.getAttribute("onblur"));
if ($(this).hasClass("cke_validated")) $(this).prop('required',true);
var $this = $(this),
re = new RegExp(pattern,patternModifier),
$radiosWithSameName = ($this.is('[type=checkbox]') || $this.is('[type=radio]'))?$this.parents('form').find('input[name="' + $this.attr('name') + '"]'):null,
value = (($this.hasClass("cke_validated") && CKEDITOR) ?
CKEDITOR.instances[$this.prop("id")].getData() : ($this.is('[type=checkbox]')) ?
$this.is(':checked') : ($this.is('[type=radio]') ?
// Cache all radio buttons (in the same form) with the same name as this one
$radiosWithSameName.filter(':checked').length > 0 : $this.val())),
errorClass = settings.errorClass,
popupClass = settings.popupClass,
position = settings.position,
direction = settings.direction,
border = settings.border,
offset = settings.offset,
percentWidth = settings.percentWidth,
pointedAt = settings.pointedAt,
fieldOffset = settings.fieldOffset,
fieldMargin = settings.fieldMargin,
	//validity.customError = "test";
minVal = $this.attr('min'),
maxVal = $this.attr('max'),
step = $this.attr('step'),
type = $this.attr('type'),
confirmField = $this.attr('confirm'),
customValidation = $this.attr('validation'),
closeText = settings.closeText,
orientation = settings.orientation,
validClass = settings.validClass,
errorIDbare = $this.attr(settings.errorAttribute) || false, // Get the ID of the error element.
errorID = errorIDbare ? '#' + errorIDbare.replace(/(:|\.|\[|\])/g,'\\$1') : false, // Add the hash for convenience. This is done in two steps to avoid two attribute lookups.
required = false,
validity = createValidity({element: this, valid: true}),
$checkRequired = $('<input required>'),
maxlength;
 
/* If the required attribute exists, set it required to true, unless it's set 'false'.
* This is a minor deviation from the spec, but it seems some browsers have falsey
* required values if the attribute is empty (should be true). The more conformant
* version of this failed sanity checking in the browser environment.
* This plugin is meant to be practical, not ideologically married to the spec.
*/
if ($this.attr("onblur")) eval($this.attr("onblur"));
// Feature fork
if ($checkRequired.filter('[required]') && $checkRequired.filter('[required]').length) {
required = ($this.filter('[required]').length && $this.attr('required') !== 'false');
} else {
required = ($this.attr('required') !== undefined);
}
if (settings.debug && window.console) {
console.log('Validate called on "' + value + '" with regex "' + re + '". Required: ' + required); // **DEBUG
console.log('Regex test: ' + re.test(value) + ', Pattern: ' + pattern); // **DEBUG
}
if (this.validity && this.validity.badInput) {
  validity.valid = false;	
  validity.badInput = this.validity.badInput;	
}
if (required || value !="") {
if (customValidation && window[customValidation]) {
     eval("validity.valid = " + customValidation + "($this,value)");
	 if (validity.valid === "" || validity.valid === false) {
		 validity.valid = false;
	 } else if (validity.valid !== true) {
	    validity.customError = validity.valid;
		  validity.valid = false;
	 }
}
maxlength = parseInt($this.attr('maxlength'), 10);
if (!isNaN(maxlength) && value.length > maxlength) {
validity.valid = false;
validity.tooLong = true;
}
if (confirmField && value != $('#'+confirmField).val())  {
validity.valid = false;
validity.confirmFail = true;	
}
// check format
if (type=="color") {
if (value.search(/^#[A-Fa-f0-9]{6}$/) < 0) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="date") {
var DateVal = (Date.parse(value));
if (!DateVal) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="datetime") {
var DateVal = (Date.parse(value));
if (!DateVal) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="datetime-local") {
var DateVal = (Date.parse(value));
if (!DateVal) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="email" && !pattern) {
if (value.search(defaults.patternLibrary.email) < 0) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="month") {
var DateVal = (Date.parse(value));
if (!DateVal) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="number") {
var trimVal = String(value);
while (trimVal.indexOf(".") >= 0 && (trimVal.lastIndexOf("0") == trimVal.length-1 || trimVal.lastIndexOf(".") == trimVal.length-1)) {
	trimVal = trimVal.substring(0,trimVal.length-1);
}
if (isNaN(parseInt(trimVal)) || String(trimVal) != String(parseFloat(trimVal))) {
validity.valid = false;
validity.wrongFormat = true;
} else if (step) {
	if (step.toLowerCase() != "any") {
		var checkVal = parseFloat(value);
		var checkStep = parseFloat(step);
		while (String(checkVal).indexOf(".") != -1 || String(checkStep).indexOf(".") != -1 ) {
			checkVal *= 10;
			checkStep *= 10;
		}
		if (parseFloat(checkVal) % parseFloat(checkStep) != 0) {
validity.valid = false;
validity.wrongFormat = true;
		}
	}
} else if (String(value) != String(parseFloat(value))){
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="range") {
if (isNaN(parseFloat(value)) || String(value) != String(parseFloat(value))) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="tel") {
if (value.search(/^[0-9\.\-\(\) ]+$/) == -1) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="time") {
if (isNaN(parseFloat(value)) || String(value) != String(parseFloat(value))) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="url") {
if (value.search(/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/) == -1) {
validity.valid = false;
validity.wrongFormat = true;
}
}
if (type=="week") {
if (isNaN(parseFloat(value)) || String(value) != String(parseFloat(value))) {
validity.valid = false;
validity.wrongFormat = true;
}
}

var skipMessage = false;
// end format
// check min val
if (minVal) {
if (type=="number") {
if (parseFloat(value) < parseFloat(minVal)) {
validity.valid = false;
validity.tooSmall = true;
}
} else if (type=="checkbox") {
    var numChecked = (($this.parents('form').find('input[name="' + $this.attr('name') + '"]')).filter(':checked').length);
	if (numChecked >= minVal) {
	  required = false;
	} else {
	  var first = (($this.parents('form').find('input[name="' + $this.attr('name') + '"]')).filter(':not(:checked)'));
	  if (first.length > 0) {
		if (first[0] != $this.get(0)) {
			required = false;
			skipMessage = true;
		}
	  } else {
		if (($this.parents('form').find('input[name="' + $this.attr('name') + '"]')).filter(':checked').get(0) != $this.get(0)) {
			required = false;
			skipMessage = true;
		}
	  }
	}
} else {
if (value.length < parseFloat(minVal)) {
validity.valid = false;
validity.tooSmall = true;
}
}
}
// end min val
// check max
if (maxVal) {
if (type=="number") {
if (parseFloat(value) > parseFloat(maxVal)) {
validity.valid = false;
validity.tooLarge = true;
}
} else if (type=="checkbox") {
    var numChecked = (($this.parents('form').find('input[name="' + $this.attr('name') + '"]')).filter(':checked').length);
	if (numChecked <= maxVal) {
	  required = false;
	} else {
	  var first = (($this.parents('form').find('input[name="' + $this.attr('name') + '"]')).filter(':not(:checked)'));
	  if (first.length > 0) {
		if (first[0] != $this.get(0)) {
			required = false;
			skipMessage = true;
		}
	  } else {
		if (($this.parents('form').find('input[name="' + $this.attr('name') + '"]')).filter(':checked').get(0) != $this.get(0)) {
			required = false;
			skipMessage = true;
		}
	  }
	}
} else {
if (value.length > parseFloat(maxVal)) {
validity.valid = false;
validity.tooSmall = true;
}
}
}
}
// end max
if (required && !value) {
validity.valid = false;
validity.valueMissing = true;
} else if (pattern && !re.test(value) && value) {
validity.valid = false;
validity.patternMismatch = true;
} else {
if (!settings.RODom) {
settings.markValid({
element: this,
validity: validity,
errorClass: errorClass,
popupClass: popupClass,
position: position,
direction: direction,
border: border,
offset: offset,
percentWidth: percentWidth,
pointedAt: pointedAt,
fieldOffset: fieldOffset,
fieldMargin: fieldMargin,
closeText: closeText,
orientation: orientation,
validClass: validClass,
errorID: errorID,
settings: settings
},skipMessage);
}
}

if (!validity.valid) {
if (!settings.RODom) {
settings.markInvalid({
element: this,
validity: validity,
errorClass: errorClass,
popupClass: popupClass,
position: position,
direction: direction,
border: border,
offset: offset,
percentWidth: percentWidth,
pointedAt: pointedAt,
fieldOffset: fieldOffset,
fieldMargin: fieldMargin,
closeText: closeText,
orientation: orientation,
validClass: validClass,
errorID: errorID,
settings: settings
});
}
}
$this.trigger('validated', validity);
// If it's a radio button, also validate the other radio buttons with the same name
// (while making sure the call is not recursive)
if($radiosWithSameName !== null
&& settings.alreadyCheckingRelatedRadioButtons !== true) {
settings.alreadyCheckingRelatedRadioButtons = true;
$radiosWithSameName
.not($this)
.trigger('validate');
settings.alreadyCheckingRelatedRadioButtons = false;
}
},
/**
* Take the event preferences and delegate the events to selected
* objects.
*
* @param {object} eventFlags The object containing event flags.
*
* @returns {element} The passed element (for method chaining).
*/
delegateEvents: function (selectors, eventFlags, element, settings) {
var events = {},
key = 0,
validate = function () {
settings.validate.call(this, settings);
};
$.each(eventFlags, function (key, value) {
if (value) {
events[key] = key;
}
});
// key = 0;
for (key in events) {
if (events.hasOwnProperty(key)) {
$(element).delegate(selectors, events[key] + '.h5Validate', validate);
}
}
return element;
},
/**
* Prepare for event delegation.
*
* @param {object} settings The full plugin state, including
* options.
*
* @returns {object} jQuery object for chaining.
*/
bindDelegation: function (settings) {
var $this = $(this),
$forms;
// Attach patterns from the library to elements.
// **TODO: pattern / validation method matching should
// take place inside the validate action.
$.each(patternLibrary, function (key, value) {

var pattern = value.toString();
pattern = pattern.substring(1, pattern.length - 1);
$('.' + settings.classPrefix + key).attr('pattern', pattern);
});
$forms = $this.filter('form')
.add($this.find('form'))
.add($this.parents('form'));
$forms
.attr('novalidate', 'novalidate')
.submit(checkValidityOnSubmitHandler);
$forms.find("input[formnovalidate][type='submit']").click(function(){
$(this).closest("form").unbind('submit', checkValidityOnSubmitHandler);
});
return this.each(function () {
var kbEvents = {
focusout: settings.focusout,
focusin: settings.focusin,
change: settings.change,
keyup: settings.keyup
},
mEvents = {
click: settings.click
},
sEvents = {
change: settings.click
},
activeEvents = {
keyup: settings.activeKeyup
};
settings.delegateEvents(':input', settings.customEvents, this, settings);
settings.delegateEvents(settings.kbSelectors, kbEvents, this, settings);
settings.delegateEvents(settings.mSelectors, mEvents, this, settings);
settings.delegateEvents(settings.sSelectors, sEvents, this, settings);
$(this).delegate('input[type="color"]:not(:disabled):not(.novalidate), input[type="date"]:not(:disabled):not(.novalidate), input[type="datetime"]:not(:disabled):not(.novalidate), input[type="datetime-local"]:not(:disabled):not(.novalidate), input[type="email"]:not(:disabled):not(.novalidate), input[type="month"]:not(:disabled):not(.novalidate), input[type="number"]:not(:disabled):not(.novalidate), input[type="range"]:not(:disabled):not(.novalidate), input[type="search"]:not(:disabled):not(.novalidate), input[type="time"]:not(:disabled):not(.novalidate), input[type="text"]:not(:disabled):not(.novalidate), input[type="tel"]:not(:disabled):not(.novalidate), input[type="url"]:not(:disabled):not(.novalidate), input[type="week"]:not(:disabled):not(.novalidate)', 'blur' + '.h5Validate', html5reformat);
settings.delegateEvents(settings.activeClassSelector, activeEvents, this, settings);
settings.delegateEvents('textarea[maxlength]', {keyup: true}, this, settings);
});
}
},
/**
* Event handler for the form submit event.
* When settings.submit is enabled:
* - prevents submission if any invalid fields are found.
* - Optionally validates all fields.
* - Optionally moves focus to the first invalid field.
*
* @param {object} evt The jQuery Event object as from the submit event.
*
* @returns {object} undefined if no validation was done, true if validation passed, false if validation didn't.
*/
checkValidityOnSubmitHandler = function(evt) {
var $this,
settings = getInstance.call(this),
allValid;
if(settings.submit !== true) {
return;
}
$this = $(this);
allValid = $this.h5Validate('allValid', { revalidate: settings.validateOnSubmit === true });
if(allValid !== true) {
evt.preventDefault();
if(settings.focusFirstInvalidElementOnSubmit === true){
var $invalid = $(settings.allValidSelectors, $this)
.filter(function(index){
return $(this).h5Validate('isValid', { revalidate: false }) !== true;
});
$invalid.first().focus();
}
}
return allValid;
},
instances = [],
buildSettings = function buildSettings(options) {
// Combine defaults and options to get current settings.
var settings = $.extend({}, defaults, options, methods),
activeClass = settings.classPrefix + settings.activeClass;
return $.extend(settings, {
activeClass: activeClass,
activeClassSelector: '.' + activeClass,
requiredClass: settings.classPrefix + settings.requiredClass,
el: this
});
},
getInstance = function getInstance() {
var $parent = $(this).closest('[data-h5-instanceId]');
return instances[$parent.attr('data-h5-instanceId')];
},
setInstance = function setInstance(settings) {
var instanceId = instances.push(settings) - 1;
if (settings.RODom !== true) {
$(this).attr('data-h5-instanceId', instanceId);
}
$(this).trigger('instance', { 'data-h5-instanceId': instanceId });
};
$.h5Validate = {
/**
* Take a map of pattern names and HTML5-compatible regular
* expressions, and add them to the patternLibrary. Patterns in
* the library are automatically assigned to HTML element pattern
* attributes for validation.
*
* @param {Object} patterns A map of pattern names and HTML5 compatible
* regular expressions.
*
* @returns {Object} patternLibrary The modified pattern library
*/
addPatterns: function (patterns) {
var patternLibrary = defaults.patternLibrary,
key;
for (key in patterns) {
if (patterns.hasOwnProperty(key)) {
patternLibrary[key] = patterns[key];
}
}
return patternLibrary;
},
/**
* Take a valid jQuery selector, and a list of valid values to
* validate against.
* If the user input isn't in the list, validation fails.
*
* @param {String} selector Any valid jQuery selector.
*
* @param {Array} values A list of valid values to validate selected
* fields against.
*/
validValues: function (selector, values) {
var i = 0,
ln = values.length,
pattern = '',
re;
// Build regex pattern
for (i = 0; i < ln; i += 1) {
pattern = pattern ? pattern + '|' + values[i] : values[i];
}
re = new RegExp('^(?:' + pattern + ')$');
$(selector).data('regex', re);
}
};
$.fn.h5Validate = function h5Validate(options) {
var action,
args,
settings;
if (typeof options === 'string' && typeof methods[options] === 'function') {
// Whoah, hold on there! First we need to get the instance:
settings = getInstance.call(this);
if (!settings) return true;
args = [].slice.call(arguments, 0);
action = options;
args.shift();
args = $.merge([settings], args);
// Use settings here so we can plug methods into the instance dynamically?
return settings[action].apply(this, args);
}
settings = buildSettings.call(this, options);
setInstance.call(this, settings);

$(window).resize($.debounce( 250, function() {
jQuery.each($(settings.allValidSelectors),function(i,el) {
var identifier = ($(this).attr('id')?$(this).attr('id'):$(this).attr('name'));
if (!identifier) identifier = "";
identifier = identifier.replace(/[^a-z0-9_]/gi,"_");
var errorName = identifier + "_waerror_errorMsg";
if (document.getElementById(errorName) && $("#"+errorName).css('display') == 'block') {
var wrapper = $("#"+errorName+"_wrapper");
var before = $("#"+errorName+"_before");
repositionValidation(errorName, $(this), settings);
//reposition Validation(wrapper,before,$(this),settings.orientation,settings.direction,settings.pointedAt,settings.offset,settings.fieldOffset,settings.fieldMargin);
}
});
}));
$(window).scroll($.debounce( 250, function() {
jQuery.each($(settings.allValidSelectors),function(i,el) {
var identifier = ($(this).attr('id')?$(this).attr('id'):$(this).attr('name'));
if (!identifier) identifier = "";
identifier = identifier.replace(/[^a-z0-9_]/gi,"_");
var errorName = identifier + "_waerror_errorMsg";
if (document.getElementById(errorName) && $("#"+errorName).css('display') == 'block') {
var wrapper = $("#"+errorName+"_wrapper");
var before = $("#"+errorName+"_before");
repositionValidation(errorName, $(this), settings);
//reposition Validation(wrapper,before,$(this),settings.orientation,settings.direction,settings.pointedAt,settings.offset,settings.fieldOffset,settings.fieldMargin);
}
});
}));
// Returning the jQuery object allows for method chaining.
return methods.bindDelegation.call(this, settings);
};
}(jQuery));
function html5reformat() {
var type = $(this).attr('type');
var value = $(this).val();
if (type=="date") {
var DateVal = (Date.parse(value));
if (DateVal) {
$(this).val(DateVal.toString("yyyy-MM-dd"));
}
}
if (type=="datetime") {
var DateVal = (Date.parse(value));
if (DateVal) {
$(this).val(DateVal.toISOString());
}
}
if (type=="datetime-local") {
var DateVal = (Date.parse(value));
if (DateVal) {
$(this).val(DateVal.toString("yyyy-MM-dd"));
}
}
}
function wa_hideVal(id) {
if (!document.getElementById(id)) return;
var identifier = ($("#"+id).attr('id')?$("#"+id).attr('id'):$("#"+id).attr('name'));
if (!identifier) alert(id)
identifier = identifier.replace(/[^a-z0-9_]/gi,"_");
if (document.getElementById(identifier+ "_wrapper")) document.getElementById(identifier+ "_wrapper").style.display='none';
}
function ConvertServerErrors(opts) {
  jQuery.each($(':input:visible:not(:button):not(:disabled):not(.novalidate)'),function(i,el) {
	  if (document.getElementById($(this).attr('id')+"_ServerError")) {
		  var identifier = ($(this).attr('id')?$(this).attr('id'):$(this).attr('name'));
		  if (!identifier) identifier = "";
		  identifier = identifier.replace(/[^a-z0-9_]/gi,"_");
		  var errorName = identifier + "_waerror";
		  var t = $('<div id="' + errorName + "_errorMsg_wrapper" +'" class="'+opts.popupClass+'-wrapper"><span id="' + errorName + "_errorMsg" +'" class="'+opts.popupClass+'" pointer="20" style="display:none"></span></div>');
		  $('body').append(t);
		  var titleVal = document.getElementById($(this).attr('id')+"_ServerError").innerHTML;
		  
		  var element = document.getElementById($(this).attr('id')+"_ServerError");
          element.parentNode.removeChild(element);
		  
		  var errorEl = $('#' + $(this).attr('data-h5-errorid'));
		  titleVal = '<div id="' + errorName + "_close" +'" class="validation-close">'+opts.closeText+'</div>' + titleVal + '';
		  $("#"+errorName + "_errorMsg").html(titleVal);
		  $("#"+errorName + "_close").click(function() {
		  wa_hideVal(this.parentNode.id);
		  });
		  buttonDims(errorName + "_errorMsg",opts,$(this));
		  var $errorID = $("#"+errorName + "_errorMsg");
		  var $errorID_wrapper = $("#"+errorName + "_errorMsg_wrapper");
		  $(this).addClass(opts.errorClass).removeClass(opts.validClass);
		  $errorID_wrapper.show();
      repositionValidation(errorName, $(this), opts);
		  //reposition Validation($("#"+errorName + "_errorMsg_wrapper"),$("#"+errorName + "_errorMsg_before"),$(this),opts.orientation,opts.direction,opts.pointedAt,opts.offset,opts.fieldOffset,opts.fieldMargin);
	  }
  });
}

function buttonDims(id,options,field) {
var position = options.position;
var direction = options.direction;
var border = options.border;
var offset = options.offset;
var percentWidth = options.percentWidth;
var orientation = options.orientation;
var pointedAt = options.pointedAt;
var fieldOffset = options.fieldOffset;
var fieldMargin = options.fieldMargin;
var closeText = options.closeText;
var theBut = $("#"+id);
var theWrapper = $("#"+id+"_wrapper");
var theBefore = $("#"+id+"_before");
var theAfter = $("#"+id+"_after");

if (!document.getElementById(id+"_before")) {
  theBut.after('<span id="'+id+'_after" class="'+options.popupClass+'-after"></span>');
  if (border == 0) {
  theBut.after('<span id="'+id+'_before" class="'+options.popupClass+'-before"></span>');
  } else {
  theBut.before('<span id="'+id+'_before" class="'+options.popupClass+'-before"></span>');
  }
}
var theBefore = $("#"+id+"_before");
var theAfter = $("#"+id+"_after");
  
theBut.css("display","block");
var pos = theBut.position();
var theButMargin = (-1*pos.left);
if (orientation=="left") {
theButMargin += theBefore.outerWidth() - border;
}
var theButTop = (-1*pos.top);
var theBorder = theBut.css("border-top-width");
if (orientation == "top") {
theButTop += theBefore.outerHeight() - parseFloat(theBorder);
}
theBut.css("left",theButMargin+"px");
theBut.css("top",theButTop+"px");
var theButPos = theBut.position();
if (theBorder) theBorder = parseFloat(theBorder);
if (orientation == "top" || orientation == "bottom") {
if (position == "center") {
theBefore.css("left",(theButPos.left + offset + (theBut.outerWidth()/2) - (theBefore.outerWidth()/2)) +"px");
}
if (position == "right") {
theBefore.css("left",(theButPos.left - offset + theBut.outerWidth() - theBefore.outerWidth()) +"px");
}
if (position == "left") {
theBefore.css("left",(theButPos.left + offset) +"px");
}
} else if (orientation == "right") {
theBefore.css("left",(theButPos.left + theBut.outerWidth() - theBorder) +"px");
} else { // orientation left
theBefore.css("left",(0) +"px");
}
if (orientation == "top") {
theBefore.css("top",(theButPos.top-theBefore.outerHeight()+theBorder)+"px");
theAfter.css("top",(theButPos.top-theAfter.outerHeight()+theBorder)+"px");
} else if (orientation == "right" || orientation == "left") {
if (position == "top") theBefore.css("top",theButPos.top + offset+"px");
if (position == "middle") theBefore.css("top",(theButPos.top+theBut.outerHeight()/2-theBefore.outerHeight()/2+ offset)+"px");
if (position == "bottom") theBefore.css("top",(theButPos.top+theBut.outerHeight()-theBefore.outerHeight()- offset)+"px");
theBeforePos = theBefore.position();
if (percentWidth!=100) {
if (direction == "top") {
theAfter.css("top",theBeforePos.top+"px");
} else {
theAfter.css("top",(theBeforePos.top + theBefore.outerHeight() - theAfter.outerHeight()) +"px");
}
} else if (direction == "middle") {
theAfter.css("top",(theBeforePos.top+(theBefore.outerHeight()/2)-(theAfter.outerHeight()/2))+"px");
} else if (direction == "top") {
theAfter.css("top",(theBeforePos.top + theBorder)+"px");
} else if (direction == "bottom") {
theAfter.css("top",(theBeforePos.top + theBefore.outerHeight() - theBorder - theAfter.outerHeight())+"px");
}
} else { // bottom
theBefore.css("top",(theButPos.top + theBut.outerHeight()-theBorder)+"px");
theAfter.css("top",(theButPos.top + theBut.outerHeight()-theBorder)+"px");
}
var beforePos = theBefore.position();
if (direction != "center") {
if (percentWidth != 100) {
if (direction=="left") {
theAfter.css("left",beforePos.left +"px");
} else if (direction=="top") {
theAfter.css("left",beforePos.left +"px");
} else if (direction=="bottom") {
theAfter.css("left",beforePos.left +"px");
} else {
theAfter.css("left",(beforePos.left + (theBefore.outerWidth()) - (theAfter.outerWidth())) +"px");
}
} else if (direction == "left") {
theAfter.css("left",(beforePos.left + border) +"px");
} else if (direction == "top" || direction == "middle" || direction == "bottom") {
if (orientation == "left") {
theAfter.css("left",beforePos.left + theBefore.outerWidth() - theAfter.outerWidth() +"px");
} else { // right
theAfter.css("left",beforePos.left +"px");
}
} else {
theAfter.css("left",(beforePos.left + (theBefore.outerWidth() - theAfter.outerWidth() - border)) +"px");
}
} else { // right direction
if (orientation == "right") {
theAfter.css("left",beforePos.left +"px");
} else {
theAfter.css("left",(beforePos.left + (theBefore.outerWidth()/2) - (theAfter.outerWidth()/2)) +"px");
}
}
}
function repositionValidation(name,field,opts) {
  var wrapper = $("#"+name + "_errorMsg_wrapper")
  var before = $("#"+name + "_errorMsg_before")
	var orientation = opts.orientation;
	var direction = opts.direction;
	var position = opts.pointedAt;
	var offset = opts.offset;
	var fieldOffset = opts.fieldOffset;
	var margin = opts.fieldMargin;
  buttonDims(name + "_errorMsg",opts,field);
  if (field.hasClass("cke_validated")) {
    field = $("#cke_"+field.prop("id")).find(".cke_contents");
  }
  var fieldPos = field.offset();
  var beforePos = before.offset();
  if (orientation == "top" || orientation == "bottom") {
    if (orientation == "top") {
      var fieldBottom = parseFloat(fieldPos.top) + field.outerHeight() + margin;
      var pointerTop = parseFloat(beforePos.top);
      var diff = fieldBottom - pointerTop;
    } else { // bottom
      var fieldTop = parseFloat(fieldPos.top);
      var pointerBottom = parseFloat(beforePos.top) + before.outerHeight() + margin;
      var diff = fieldTop - pointerBottom;
    }
    if (diff != 0) {
	  var newPos = parseFloat(wrapper.css("top")) + diff;
	  if (newPos<0) newPos = 0;
      wrapper.css("top",Math.round(newPos)+ "px");
    }
    if (direction=="left") {
      var pointerDot = parseFloat(beforePos.left);
    }
    if (direction=="center") {
      var pointerDot = parseFloat(beforePos.left) + (before.outerWidth()/2);
    }
    if (direction=="right") {
      var pointerDot = parseFloat(beforePos.left) + before.outerWidth();
    }
    if (position == "left") {
      var fieldPlace = parseFloat(fieldPos.left) + fieldOffset;
    }
    if (position == "center") {
      var fieldPlace = parseFloat(fieldPos.left) + (field.outerWidth()/2) + fieldOffset;
    }
    if (position == "right") {
      var fieldPlace = parseFloat(fieldPos.left) + field.outerWidth() - fieldOffset;
    }
    var diff = fieldPlace - pointerDot;
    if (diff != 0) {
	  var newPos = parseFloat(wrapper.css("left")) + diff;
	  if (newPos<0) newPos = 0;
      wrapper.css("left",newPos + "px");
    }
  } else if (orientation == "left" || orientation == "right") {
    if (orientation == "left") {
      var pointerLeft = parseFloat(beforePos.left) + margin;
      var fieldRight = parseFloat(fieldPos.left) + field.outerWidth();
      var diff = fieldRight - pointerLeft;
    } else {
      var pointerRight = parseFloat(beforePos.left) + before.outerWidth();
      var fieldLeft = parseFloat(fieldPos.left) + margin;
      var diff = fieldLeft - pointerRight;
    }
    if (diff != 0) {
	  var newPos = parseFloat(wrapper.css("left")) + diff;
	  if (newPos<0) newPos = 0;
      wrapper.css("left",newPos + "px");
    }
    if (direction=="top") {
      var pointerDot = parseFloat(beforePos.top);
    }
    if (direction=="middle") {
      var pointerDot = parseFloat(beforePos.top) + (before.outerHeight()/2);
    }
    if (direction=="bottom") {
      var pointerDot = parseFloat(beforePos.top) + before.outerHeight();
    }
    if (position == "top") {
      var fieldPlace = parseFloat(fieldPos.top) + offset + fieldOffset;
    }
    if (position == "middle") {
      var fieldPlace = parseFloat(fieldPos.top) + (field.outerHeight()/2) + offset + fieldOffset;
    }
    if (position == "bottom") {
      var fieldPlace = parseFloat(fieldPos.top) + field.outerHeight() - offset - fieldOffset;
    }
    var diff = fieldPlace - pointerDot;
    if (diff != 0) {
	  var newPos = parseFloat(wrapper.css("top")) + diff;
	  if (newPos<0) newPos = 0;
      wrapper.css("top",newPos + "px");
    }
  }
  if (wrapper.offset().left != 0 && (wrapper.offset().left + before.next().outerWidth()) > $(window).width()) {
    var newPos = $(window).width() - before.next().outerWidth();
    if (newPos<0) newPos = 0;
    wrapper.css("left",newPos + "px");
  }
}
	
}
var jqh5validateLoaded = true;