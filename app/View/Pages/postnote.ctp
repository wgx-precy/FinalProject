<?php $this->Html->css('default', null, array('inline' => false)); ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<head>
	<title>PostNote</title>
<?php $this->Html->css('style_tagPages',null,array('inline'=>false));?>

<!--date script-->
<script type="text/javascript">
function HS_DateAdd(interval,number,date){
	number = parseInt(number);
	if (typeof(date)=="string"){var date = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2])}
	if (typeof(date)=="object"){var date = date}
	switch(interval){
	case "y":return new Date(date.getFullYear()+number,date.getMonth(),date.getDate()); break;
	case "m":return new Date(date.getFullYear(),date.getMonth()+number,checkDate(date.getFullYear(),date.getMonth()+number,date.getDate())); break;
	case "d":return new Date(date.getFullYear(),date.getMonth(),date.getDate()+number); break;
	case "w":return new Date(date.getFullYear(),date.getMonth(),7*number+date.getDate()); break;
	}
}
function checkDate(year,month,date){
	var enddate = ["31","28","31","30","31","30","31","31","30","31","30","31"];
	var returnDate = "";
	if (year%4==0){enddate[1]="29"}
	if (date>enddate[month]){returnDate = enddate[month]}else{returnDate = date}
	return returnDate;
}

function WeekDay(date){
	var theDate;
	if (typeof(date)=="string"){theDate = new Date(date.split("-")[0],date.split("-")[1],date.split("-")[2]);}
	if (typeof(date)=="object"){theDate = date}
	return theDate.getDay();
}
function HS_calender(){
	var lis = "";
	var style = "";
	style +="<style type='text/css'>";
	style +=".calender { width:270px; height:auto; font-size:12px; margin-right:14px; background:url(calenderbg.gif) no-repeat right center #fff; border:1px solid #397EAE; padding:1px;color:black}";
	style +=".calender ul {list-style-type:none; margin:0; padding:0;}";
	style +=".calender .day { background-color:#EDF5FF; height:20px;color:black}";
	style +=".calender .day li,.calender .date li{ float:left; width:4%; height:20px; line-height:20px; text-align:center}";
	style +=".calender li a { text-decoration:none; font-family:Tahoma; font-size:11px; color:#333}";
	style +=".calender li a:hover { color:#f30; text-decoration:underline}";
	style +=".calender li a.hasArticle {font-weight:bold; color:#f60 !important}";
	style +=".lastMonthDate, .nextMonthDate {color:#bbb;font-size:11px}";
	style +=".selectThisYear a, .selectThisMonth a{text-decoration:none; margin:0 2px; color:#000; font-weight:bold}";
	style +=".calender .LastMonth, .calender .NextMonth{ text-decoration:none; color:#000; font-size:18px; font-weight:bold; line-height:16px;}";
	style +=".calender .LastMonth { float:left;}";
	style +=".calender .NextMonth { float:right;}";
	style +=".calenderBody {clear:both}";
	style +=".calenderTitle {text-align:center;height:20px; line-height:20px; clear:both}";
	style +=".today { background-color:#ffffaa;border:1px solid #f60; padding:2px}";
	style +=".today a { color:#f30; }";
	style +=".calenderBottom {clear:both; border-top:1px solid #ddd; padding: 3px 0; text-align:left}";
	style +=".calenderBottom a {text-decoration:none; margin:2px !important; font-weight:bold; color:#000}";
	style +=".calenderBottom a.closeCalender{float:right}";
	style +=".closeCalenderBox {float:right; border:1px solid #000; background:#fff; font-size:9px; width:11px; height:11px; line-height:11px; text-align:center;overflow:hidden; font-weight:normal !important}";
	style +="</style>";

	var now;
	if (typeof(arguments[0])=="string"){
		selectDate = arguments[0].split("-");
		var year = selectDate[0];
		var month = parseInt(selectDate[1])-1+"";
		var date = selectDate[2];
		now = new Date(year,month,date);
	}else if (typeof(arguments[0])=="object"){
		now = arguments[0];
	}
	var lastMonthEndDate = HS_DateAdd("d","-1",now.getFullYear()+"-"+now.getMonth()+"-01").getDate();
	var lastMonthDate = WeekDay(now.getFullYear()+"-"+now.getMonth()+"-01");
	var thisMonthLastDate = HS_DateAdd("d","-1",now.getFullYear()+"-"+(parseInt(now.getMonth())+1).toString()+"-01");
	var thisMonthEndDate = thisMonthLastDate.getDate();
	var thisMonthEndDay = thisMonthLastDate.getDay();
	var todayObj = new Date();
	today = todayObj.getFullYear()+"-"+todayObj.getMonth()+"-"+todayObj.getDate();
	
	for (i=0; i<lastMonthDate; i++){  // Last Month's Date
		lis = "<li class='lastMonthDate'>"+lastMonthEndDate+"</li>" + lis;
		lastMonthEndDate--;
	}
	for (i=1; i<=thisMonthEndDate; i++){ // Current Month's Date

		if(today == now.getFullYear()+"-"+now.getMonth()+"-"+i){
			var todayString = now.getFullYear()+"-"+(parseInt(now.getMonth())+1).toString()+"-"+i;
			lis += "<li><a href=javascript:void(0) class='today' onclick='_selectThisDay(this)' title='"+now.getFullYear()+"-"+(parseInt(now.getMonth())+1)+"-"+i+"'>"+i+"</a></li>";
		}else{
			lis += "<li><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+now.getFullYear()+"-"+(parseInt(now.getMonth())+1)+"-"+i+"'>"+i+"</a></li>";
		}
		
	}
	var j=1;
	for (i=thisMonthEndDay; i<6; i++){  // Next Month's Date
		lis += "<li class='nextMonthDate'>"+j+"</li>";
		j++;
	}
	lis += style;

	var CalenderTitle = "<a href='javascript:void(0)' class='NextMonth' onclick=HS_calender(HS_DateAdd('m',1,'"+now.getFullYear()+"-"+now.getMonth()+"-"+now.getDate()+"'),this) title='Next Month'>&raquo;</a>";
	CalenderTitle += "<a href='javascript:void(0)' class='LastMonth' onclick=HS_calender(HS_DateAdd('m',-1,'"+now.getFullYear()+"-"+now.getMonth()+"-"+now.getDate()+"'),this) title='Previous Month'>&laquo;</a>";
	CalenderTitle += "YEAR<span class='selectThisYear'><a href='javascript:void(0)' onclick='CalenderselectYear(this)' title='Click here to select other year' >"+now.getFullYear()+"</a></span>&nbspMONTH<span class='selectThisMonth'><a href='javascript:void(0)' onclick='CalenderselectMonth(this)' title='Click here to select other month'>"+(parseInt(now.getMonth())+1).toString()+"</a></span>"; 

	if (arguments.length>1){
		arguments[1].parentNode.parentNode.getElementsByTagName("ul")[1].innerHTML = lis;
		arguments[1].parentNode.innerHTML = CalenderTitle;

	}else{
		var CalenderBox = style+"<div class='calender'><div class='calenderTitle'>"+CalenderTitle+"</div><div class='calenderBody'><ul class='day'><li>SUN</li><li>MON</li><li>TUE</li><li>WED</li><li>THU</li><li>FRI</li><li>SAT</li></ul><ul class='date' id='thisMonthDate'>"+lis+"</ul></div><div class='calenderBottom'><a href='javascript:void(0)' class='closeCalender' onclick='closeCalender(this)'>×</a><span><span><a href=javascript:void(0) onclick='_selectThisDay(this)' title='"+todayString+"'>Today</a></span></span></div></div>";
		return CalenderBox;
	}
}
function _selectThisDay(d){
	var boxObj = d.parentNode.parentNode.parentNode.parentNode.parentNode;
		boxObj.targetObj.value = d.title;
		boxObj.parentNode.removeChild(boxObj);
}
function closeCalender(d){
	var boxObj = d.parentNode.parentNode.parentNode;
		boxObj.parentNode.removeChild(boxObj);
}

function CalenderselectYear(obj){
		var opt = "";
		var thisYear = obj.innerHTML;
		for (i=1970; i<=2020; i++){
			if (i==thisYear){
				opt += "<option value="+i+" selected>"+i+"</option>";
			}else{
				opt += "<option value="+i+">"+i+"</option>";
			}
		}
		opt = "<select onblur='selectThisYear(this)' onchange='selectThisYear(this)' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}

function selectThisYear(obj){
	HS_calender(obj.value+"-"+obj.parentNode.parentNode.getElementsByTagName("span")[1].getElementsByTagName("a")[0].innerHTML+"-1",obj.parentNode);
}

function CalenderselectMonth(obj){
		var opt = "";
		var thisMonth = obj.innerHTML;
		for (i=1; i<=12; i++){
			if (i==thisMonth){
				opt += "<option value="+i+" selected>"+i+"</option>";
			}else{
				opt += "<option value="+i+">"+i+"</option>";
			}
		}
		opt = "<select onblur='selectThisMonth(this)' onchange='selectThisMonth(this)' style='font-size:11px'>"+opt+"</select>";
		obj.parentNode.innerHTML = opt;
}
function selectThisMonth(obj){
	HS_calender(obj.parentNode.parentNode.getElementsByTagName("span")[0].getElementsByTagName("a")[0].innerHTML+"-"+obj.value+"-1",obj.parentNode);
}
function HS_setDate(inputObj){
	var calenderObj = document.createElement("span");
	calenderObj.innerHTML = HS_calender(new Date());
	calenderObj.style.position = "absolute";
	calenderObj.targetObj = inputObj;
	inputObj.parentNode.insertBefore(calenderObj,inputObj.nextSibling);
}
  </script>

</head>

<body>
	<div>
		<header>
			<nav>
				<ul id="menu">
					<li><a href="profile">Profile</a></li>
					<li><a href="filter">Filter</a></li>
					<li><a href="search">Search</a></li>
					<li><a href="note_map">NoteMap</a></li>
					<li id="menu_active"><a href="postnote">PostNote</a></li>
					<li><a href="friends">Friends</a></li>
					<li><a href="requests">Requests</a></li>
				</ul>
			</nav>
		</header>
	</div>

<div id="newNote">
		<form action="/FinalProject/Pages/postnote" method="post">
			<p>Wanna share your idear with other people?</p>
			<p>Just post what you wanna show up here!</p>

			<p>Your current location is: latitude:<?=$latitude;?> longitude:<?=$longitude;?></p>
			
			</br>State:&nbsp
				<select name="state">
					<option value="atHome">at home</option>
					<option value="atWork">at work</option>
					<option value="lunchTime">lunch time</option>
					<option value="shopping">shopping</option>
				</select>

			<pre>Note: <input type="text" name="noteContent"></pre>
			<pre>Tags: <input type="text" name="noteTags"></pre>
			Who can see your idear:&nbsp
				<select name="visibility">
					<option value="public">public</option>
					<option value="followed">followed</option>
					<option value="friends">friends</option>
				</select>
			


			</br>EffectiveRange: <input type="text" name="range" id="range">(meters)</br></br>
<!--
			<b>Repeat method: &nbsp</b>
			<select name="users" onchange="showUser(this.value)">
			<option value="">Select a method:</option>
			<option value="date">date</option>
			<option value="week">week</option>
			</select>
dynamic selection ,but we decide to give up this method-->	
			
			<div>
			<ul class="timeChoice">
				<li><input type="radio" name="noteTimeType" value="date" id="noteTimeType1">by date</li>
				<li><input type="radio" name="noteTimeType" value="week" id="noteTimeType2">by week</li>
			</ul>
			</div></br></br>		

			<script>
				$(document).ready(function(){
					$("#noteTimeType1").click(function(){
						$("#noteByDate").css("display","block");
						$("#noteByWeek").css("display","none");
						$("#noteTime").css("display","block");
						$("#noteSubmit").css("display","block")
					});
					$("#noteTimeType2").click(function(){
						$("#noteByDate").css("display","none");
						$("#noteByWeek").css("display","block");
						$("#noteTime").css("display","block");
						$("#noteSubmit").css("display","block");
					});
				});
			</script>

			<div id='noteByDate' style='display:none'>		
				<span>StartDate</span>		
  				<input type="text" name="startDate" id="startDate" style="width:70px;font-size:12px" onfocus="HS_setDate(this)">
  				<span>EndDate</span>
  				<input type="text" name="endDate" id="endDate" style="width:70px;font-size:12px" onfocus="HS_setDate(this)">
  			</div>

			<div id='noteByWeek' style='display:none'>
  				<span>StartDayofWeek</span>
  				<select name="startWeek" id="startWeek">
  					<option value="0">--</option>
  					<option value="1">SUN</option>
  					<option value="2">MON</option>
  					<option value="3">TUE</option>
  					<option value="4">WED</option>
  					<option value="5">THU</option>
  					<option value="6">FRI</option>
  					<option value="7">SAT</option>
  				</select>&nbsp&nbsp&nbsp
				<span>EndDayOfWeek</span>
				<select name="endWeek" id="endWeek">
					<option value="0">--</option>
  					<option value="1">SUN</option>
  					<option value="2">MON</option>
  					<option value="3">TUE</option>
  					<option value="4">WED</option>
  					<option value="5">THU</option>
  					<option value="6">FRI</option>
  					<option value="7">SAT</option>
  				</select>
			</div>

			<div id='noteTime' style='display:none'>
				<span>StartTime&nbsp</span></br>
				hour:&nbsp
				<select name="startHour" id="startHour">
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
				</select>
				minute:&nbsp
				<input type="text" name="startMinute" id="startMinute" style="width:70px;font-size:12px"></br>
				<span>EndTime</span></br>
				hour:&nbsp
				<select name="endHour" id="endHour">
					<option value="01">01</option>
					<option value="02">02</option>
					<option value="03">03</option>
					<option value="04">04</option>
					<option value="05">05</option>
					<option value="06">06</option>
					<option value="07">07</option>
					<option value="08">08</option>
					<option value="09">09</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
				</select>
				minute:&nbsp
				<input type="text" name="endMinute" id="endMinute" style="width:70px;font-size:12px">
			</div>


			</br>
			
			<input type="submit" name="noteSubmit" value="PostNote" id="noteSubmit" style='display:none'>
		</form>
	</div>
	
</body>