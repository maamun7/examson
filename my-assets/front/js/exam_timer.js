function stopWatch(hour,minute,second)
{
		var hour = hour;
		var minute = minute;
		var second = second;
		
		function runStopwatch() {
		//alert(hour);
	
			second++;

			if(second > 59) {
			  second = 0;
			  minute = minute + 1;
			}

			if(minute > 59) {
			  minute = 0;
			  hour = hour + 1;
			}

			$(".timeHour").html("0".substring(hour >= 10) + hour);
			$(".timeMin").html(":"+ "0".substring(minute >= 10) + minute);
			$(".timeSec").html(":"+ "0".substring(second >= 10) + second);
		}
		setInterval(runStopwatch,1000);
}

function antiClock(hour,minute,second)
{
	var hour = hour;
	var minute = minute;
	var second = second;

	function runAntiClock() {
		second --;

		if(second < 0) {
		  second = 59;
		  minute = minute - 1;
		}

		if(minute < 0) {
			minute = 59;
			if(hour >= 0) {
				hour = 0;
			}else{
				hour = hour-1;
			}
		}

		$(".timeHour").html("0".substring(hour >= 10) + hour);
		$(".timeMin").html(":"+ "0".substring(minute >= 10) + minute);
		$(".timeSec").html(":"+ "0".substring(second >= 10) + second);
		
		
		$("#hour").val("0".substring(hour >= 10) + hour);
		$("#min").val("0".substring(minute >= 10) + minute);
		$("#sec").val("0".substring(second >= 10) + second);
		
		if( second==0 && minute==0 && hour==0 ){
			//Alert popup
			$.prompt("Your time is up", {
				title: "Want to save?",
				buttons: {"Yes,Go ahead..": true, "No, Lets Wait": false },
				submit: function(e,flag,m,f){
					if(flag){
						alert("Mo0000n");
						//If want to save
					}else{		
						//If dont want to save
						false;
					}
				}
			});

			$(".timeHour").hide();
			$(".timeMin").hide();
			$(".timeSec").hide();
		}
	}
	setInterval(runAntiClock,1000);
} 