<?php
session_start();

?>
<!DOCTYPE html>
<html>
 <head>
  <title>TIME TELLER EVENTS</title>
  
  <link rel="stylesheet" href="fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <link rel="stylesheet" type="text/css"href="cal.css">
  <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next,today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
		
       }
      })
     }
	 else
	 {confirm("You have not Enter any Event");}
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
   
  

  });
   
  </script>
 </head>
 <body>
 <!-- It's a video-->
 <div class = "section">
 
 <div class = "video_container">
 
 <div class = "color_on"></div>
 <video autoplay muted loop id="myVideo">
  <source src="back_video3.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
  </video>
  
</div>

 <!--finish-->
 <!--For content on the video-->
 
 <!--It's a heading
 <div class = "Heading"></div>
 -->
 
  <div class="content">
<!-- It's  side bars-->  
  
  <div id="myNav1" class="overlay">
  <p style = "font-family:Quicksand;font-size:35px;color:white;text-align:center;margin-top:50px;">Alarm Teller</p>
  
  <!--For a reference of an analog alarm clock-->
     <div class="clock" style = "font-size: 50px; border-style: ridge; border-width:5px;width:16%;margin-top:20px;border-radius:3px;
margin-left:570px;padding:20px; background-color:rgb(250,250,251,0.29);color:black;font-family:Quicksand text-align:justify;position:relative;"></div>
 
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">&times;</a>
  
  
  
  <!-- Finish--->
  
  <!--Alarm Clock -->
        <div 
		style ="position:absolute;margin-left :30px;margin-top:50px;font-style:Quicksand;color:white;
		">
		<input type="datetime-local" id = "alarmTime" style = "border-color:white;border-radius:5px; background-color:rgb(250,250,251,0.29); color:black;border-width:2px;"/> <b>Enter Date and Time</b><br><br>
        <textarea id = "speak-text" rows = "5" cols = "40" style = "border-color: white ;border-radius:5px; font-family:Quicksand; background-color:rgb(250,250,251,0.29);border-width:1px; color:black;"></textarea> <b>Enter Task</b><br><br>
        <button onclick = "setAlarm(this)" id = "alarmButton" style = "border-radius:5px;width:250px;background-color:rgb(47,31,80,1);color:white;">SET ALARM</button><br><br>

        <div id = "alarmOptions" style = "display:none;">
           <button onclick = "snooze();" style = "border-radius:5px;width:250px;background-color:rgb(47,31,80,1);color:white;">SNOOZE MINUTES -</button><input type = "number" id = "snooze" style = "border-radius:5px; width:50px;background-color:rgb(250,250,251,0.29);color:black;"> 
	       <button onclick = "stopAlarm();" style = "border-radius:5px;width:130px;background-color:rgb(183,37,26,0.61);color:white;">STOP ALARM </button>

        </div>
           <input onclick="speech()" type='button' value='🔊 Play' class = "button2 redColor" style = "display:none;"/>
		</div> 	
		   <!-- JavaScript Code -->
           <script type = text/javascript>
		   <!-- For analog clock-->
		   function clock() {// We create a new Date object and assign it to a variable called "time".
           var time = new Date(),
    
           // Access the "getHours" method on the Date object with the dot accessor.
           hours = time.getHours(),
    
           // Access the "getMinutes" method with the dot accessor.
           minutes = time.getMinutes(),
    
    
           seconds = time.getSeconds();

           document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
  
           function harold(standIn) {
            if (standIn < 10) {
             standIn = '0' + standIn
             }
           return standIn;
            }
            }
          setInterval(clock, 1000);

           <!--For Alarm-->
           function speech() {
             var txt = document.getElementById('speak-text').value;
             responsiveVoice.speak(txt);
            }


            //var alarmSound = new Audio('one.m4a');

            var alarmTimer;

            function setAlarm(button){
	
	         var ms = document.getElementById('alarmTime').valueAsNumber;
	
	         if(isNaN(ms)){
		
		        alert('Invalid Date');
		        return;
		
	            }
    
   
	
	            var alarm = new Date(ms);
	            var alarmTime = new Date(alarm.getUTCFullYear() , alarm.getUTCMonth() , alarm.getUTCDate() , alarm.getUTCHours() , alarm.getUTCMinutes() , alarm.getUTCSeconds() );
	 
	            var diff = alarmTime.getTime() - (new Date()).getTime();
	
	            if(diff < 0){
		          alert("Specified time is already passed ");
		          return;
		        }
	
	            alarmTimer = setTimeout(initAlarm,diff);
	            button.innerText = 'Cancel Alarm';
	            button.setAttribute('onclick','cancelAlarm(this);');
	          }

            function cancelAlarm(button){
	
	        button.innerText = 'Set Alarm';
	        button.setAttribute('onclick','setAlarm(this);');
	        clearTimeout(alarmTimer);
            }

            function initAlarm(){
	        
			speech();
	        //document.getElementsByClassName("button2 redColor")[0].click();
	        //alarmSound.play();
	        document.getElementById('alarmOptions').style.display = '';
	        }

            function stopAlarm(){
	
	        //alarmSound.pause();
	        //alarmSound.currentTime = 0;
	        document.getElementById('alarmOptions').style.display = 'none';
	        cancelAlarm(document.getElementById('alarmButton'));
            }

            function snooze(){
	        var snz = document.getElementById("snooze").value
	        var s = snz*60000;
	        stopAlarm();
	        setTimeout(initAlarm,s);
}
</script>
		
  <!--Stop Alarm Stop--->
  
</div>



<div id="myNav2" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <div class="overlay-content">
  <div class="container">
   <div id="calendar" style = "font-size: 16px;"></div>
  </div>
  </div>
</div>


<!--Start of Stop Watch-->
<div id="myNav3" class="overlay">
<nav class="controls">
			<button href="#" class="button1" onClick="stopwatch.start();">Start</button>
			<button href="#" class="button1" onClick="stopwatch.lap();">Lap</button>
			<button href="#" class="button1" onClick="stopwatch.stop();">Stop</button>
			<button href="#" class="button1" onClick="stopwatch.restart();">Restart</button>
			<button href="#" class="button1" onClick="stopwatch.clear();">Clear Laps</button>
		</nav>
		<div class="stopwatch"></div>
		<ul class="results"></ul>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav3()">&times;</a>
  
  <script>
  //Timer in machine

class Stopwatch {
    constructor(display, results) {
        this.running = false;
        this.display = display;
        this.results = results;
        this.laps = [];
        this.reset();
        this.print(this.times);
    }
    
    reset() {
        this.times = [ 0, 0, 0 ];
    }
    
    start() {
        if (!this.time) this.time = performance.now();
        if (!this.running) {
            this.running = true;
            requestAnimationFrame(this.step.bind(this));
        }
    }
    
    lap() {
        let times = this.times;
        let li = document.createElement('li');
        li.innerText = this.format(times);
        this.results.appendChild(li);
    }
    
    stop() {
        this.running = false;
        this.time = null;
    }

    restart() {
        if (!this.time) this.time = performance.now();
        if (!this.running) {
            this.running = true;
            requestAnimationFrame(this.step.bind(this));
        }
        this.reset();
    }
    
    clear() {
        clearChildren(this.results);
    }
    
    step(timestamp) {
        if (!this.running) return;
        this.calculate(timestamp);
        this.time = timestamp;
        this.print();
        requestAnimationFrame(this.step.bind(this));
    }
    
    calculate(timestamp) {
        var diff = timestamp - this.time;
        // Hundredths of a second are 100 ms
        this.times[2] += diff / 10;
        // Seconds are 100 hundredths of a second
        if (this.times[2] >= 100) {
            this.times[1] += 1;
            this.times[2] -= 100;
        }
        // Minutes are 60 seconds
        if (this.times[1] >= 60) {
            this.times[0] += 1;
            this.times[1] -= 60;
        }
    }
    
    print() {
        this.display.innerText = this.format(this.times);
    }
    
    format(times) {
        return `\
${pad0(times[0], 2)}:\
${pad0(times[1], 2)}:\
${pad0(Math.floor(times[2]), 2)}`;
    }
}

function pad0(value, count) {
    var result = value.toString();
    for (; result.length < count; --count)
        result = '0' + result;
    return result;
}

function clearChildren(node) {
    while (node.lastChild)
        node.removeChild(node.lastChild);
}

let stopwatch = new Stopwatch(
    document.querySelector('.stopwatch'),
    document.querySelector('.results'));
	
	//Finish Stop Watch
  </script>
  
</div>
<!--Finishing of Stop watch-->

<div id="myNav4" class="overlay">
<h2 class = "glow">Today's Events </h2>
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav4()">&times;</a>
  <div class="overlay-content">
  
  <!--To get the connection's and print the status-->
 <table>
  <tr>
    <th>S.no</th>
    <th>Start date</th>
    <th>End date</th>
    <th>Title</th>
  </tr>
<?php
$hostname = "localhost";
$username = "gayatri";
$password = "";
$database = "test";
$conn = new mysqli($hostname,$username,$password,$database);
if($conn->connect_error)
{
die('Connection Failed'.$conn->connect_error);
}
$user = $_SESSION['id'];
$tdate = date('y-m-d');
$sql = "Select * from events where user_id = '$user' and (DATE(start_event) = '$tdate' or DATE(end_event) = '$tdate')";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
	$i =1;
    while($row = $result->fetch_assoc()) {
		$stDate = $row['start_event'];
		$edDate = $row['end_event'];
		$title = $row['title'];
        echo " <tr>
		      <td>$i</td>
              <td>$stDate</td>
              <td>$edDate</td>
              <td>$title</td>
              </tr>";
			  $i++;
    }
} else {
    echo "<tr style = 'font-size:18px;'>No task for today</tr>";
}
   ?>
 </table>
   <!--Finish-->
  </div>
  
</div>

<!--For a small logo-->
<!--finish-->
<button class="btn info">Time Teller</button>

<!--It's a list-->
<ul>
<li><a class= "active" href="#news"><span style="cursor:pointer">Here</span><br></a></li>
<li><a href="../page1_front.php"><span style="cursor:pointer">Home</span><br></a></li>
<li><a href="#alarm1"><span style="cursor:pointer" onclick="openNav1()">Alarm</span><br></a></li>
<li><a href="#calander"><span style="cursor:pointer" onclick="openNav2()">Calander</span><br></a></li>
<li><a href="#timer"><span style="cursor:pointer" onclick="openNav3()">Stop Watch</span></a></li>
<li><a href="#status"><span style="cursor:pointer" onclick="openNav4()">Today</span></a></li>
</ul>
<!--Finish of whole content-->
</div>
</div>
<script>
function openNav1() {
  $.post('status.php',function(result){
	  if(result == true)
	  {
		document.getElementById("myNav1").style.width = "100%";  
	  }
	  else{
		  alert('You must have to Login first to add events');
	  }
  });
  
}

function closeNav1() {
  document.getElementById("myNav1").style.width = "0%";
}

function openNav2() {
  $.post('status.php',function(result){
	  if(result == true)
	  {
		document.getElementById("myNav2").style.width = "100%";  
	  }
	  else{
		  alert('You must have to Login first to add events');
	  }
  });
  
}

function closeNav2() {
  document.getElementById("myNav2").style.width = "0%";
}


function openNav3() {
  $.post('status.php',function(result){
	  if(result == true)
	  {
		document.getElementById("myNav3").style.width = "100%";  
	  }
	  else{
		  alert('You must have to Login first to add events');
	  }
  });
  
}

function closeNav3() {
  document.getElementById("myNav3").style.width = "0%";
}

function openNav4() {
  $.post('status.php',function(result){
	  if(result == true)
	  {
		document.getElementById("myNav4").style.width = "100%";  
	  }
	  else{
		  alert('You must have to Login first to add events');
	  }
  });
  
}

function closeNav4() {
  document.getElementById("myNav4").style.width = "0%";
}

</script>

</body>
 </html>
<!-- Messages -->
<?php 
	
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
    $message = 'Please login only then can add events ';
    echo "<script type='text/javascript'>alert('$message');</script>";
} 

?>
<!-- IN php-->