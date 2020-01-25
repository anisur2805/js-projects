<<<<<<< HEAD
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery UI Slider - Slider bound to select</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style type="text/css" media="screen">

	/* 11.03.2019 */
	#slideheader h3 {margin: 30px 0;text-align: center;}
	#slideheader h3 span:hover,#slidecon li:hover,#slidecon2 li:hover {cursor: pointer;}
#slider.ui-slider-horizontal:hover,span.ui-state-default:hover {/*cursor: e-resize;*/}
#slideheader #home,#slideheader #business {color: #c3c1c0}
#slideheader #home.colored,#slideheader #business.colored {color: #ed1c25;position: relative;padding-right: 30px;/*transition: all .4s;*/}
#slideheader #business.colored::after,#slideheader #home.colored::after {content: '\f00c';font-family: 'fontAwesome';right: 0;position: absolute;top: 4px;display: block;}
#slidecon,#slidecon2 {text-align: center;margin: 20px 0 !important;display: table;}
#slidecon li,#slidecon2 li {display: table-cell;/*max-width: 12%;width: 100%;*/padding: 0px 6px;box-sizing: border-box;font-weight: 700;font-size: 12px;margin: 0;}
li.colored {color: #ed1c25;}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {border: 1px solid #b61c26 !important;background: #b61c26 !important;font-weight: normal;color: #b61c26 !important;}
.slider_btns {margin: 30px 0 15px;display: block;text-align: center;width: 100%;}
.slider_btns .slider_btn {color: #fff;background: #000 url(img/button-medium.png) top left no-repeat;background-size: 100% 100%;width: 197px;height: 50px;transition: all .2s;color: #fff;font-size: 17px;line-height: 20px;position: relative;padding: 15px;margin: 0 5px;display: inline-block;}
#firstone {background: #f5f5f5;width: 100%;display: table;}
#firstone li {margin: 0;vertical-align: middle;text-align: center;font-size: 14px;display: table-cell;padding: 10px 4px;font-weight: 700;}
#firstone li+ li {border-left: 1px solid #000;}
span#progress {background: #f00;height: 11px;}
.ui-slider .ui-slider-handle{transition: left .3s;}

</style>
<script>


	jQuery(function($) {
		
		
		


		$("#slidecon li:first-child, #slidecon2 li:first-child").addClass("colored");

		sliderClick("1");
		var xx=0;

		sliderfunction(0);

		function sliderfunction(steps) {
			xx = steps;
			$("#slider").slider({
				value: steps,
				animate: "slow"
			});

		}

		$("#slidecon li, #slidecon2 li").on("click", function() {

			$(this).addClass("colored").siblings("li").removeClass("colored");

			sliderClick($(this).attr('id'));

			/*get button left value and set backgroung color*/
			$("#progress").css({
				"width": xx+"%", 
				"display": "block", 
				"transition": "width .3s"
			});

		});

		function showContent(counter){

			$showcontent = $(counter).html();
			$("#dynamicData").html($showcontent).show();
		}

		function sliderClick(selectData) {

			var i,addition = 14.29;
			for ( i = 1; i <= 8; i++) {
				var widthLength=0;
				if ('sc_'+i == selectData) {
					if(i!=1){
						addition = addition * (i-1);
						widthLength += addition;
					}
					sliderfunction(widthLength);
					showContent("#dd_"+i);
					break;
				}

			}

			
		}



		$("#slidecon li, #slidecon2 li, #firstone li").addClass("list-inline-item");
		$("#home").toggleClass("colored");

		$("#home").on('click', function() {
			$("#business").removeClass("colored");
			$("#home").addClass("colored");

			$("#slidecon2").hide();
			$("#slidecon").show();
		});

		$("#business").on('click', function() {
			$("#home").removeClass("colored");
			$("#business").addClass("colored");

			$("#slidecon").hide();
			$("#slidecon2").show();
		});

		$("span.ui-slider-handle").before('<span id="progress"></span>');


	});
</script>
</head>

<body>
	<div class="container">
		<div id="dd_1" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>A few large items or a large appliance</li>
				<li>You'll probably need a medium truck + 2 movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_2" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>1 bed home Avarage</li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_3" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Small storage unit, up to 10m<sup>3</sup></li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_4" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>2 bed home Average</li>
				<li>You'll probably need a Large truck + 2 movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_5" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>1 - 2 bed home Lots of Stuff!</li>
				<li>You'll probably need a Large truck +2 moves</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_6" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Large storage unit, up to 20m<sup>3</sup></li>
				<li>You'll probably need a Large truck +2 moves</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_7" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>3 - 4 bed home Average</li>
				<li>You'll probably need a XL truck +2 movers</li>
				<li>Date + Time</li>
				<li>From $177 per hour</li>
				<li>This job often takes 3 to 5 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_8" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Bed home Lots of Stuff!</li>
				<li>You'll probably need a XL truck + 3 movers</li>
				<li>Date + Time</li>
				<li>From $216 per hour</li>
				<li>This job often takes 5 to 7 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_9" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Just archive boxes, up to 170</li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_10" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Furnished office 2 people</li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_11" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Heaps of archive boxes, up to 250</li>
				<li>You'll probably need a Large Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_12" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Small office Up to 5 people</li>
				<li>You'll probably need a Large Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>	
		<div id="dd_13" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Big or tall furniture or shop fittings</li>
				<li>You'll probably need a Large Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_14" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Medium office Up to 10 people</li>
				<li>You'll probably need an XL Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $177 per hour</li>
				<li>This job often takes 3 to 5 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_15" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Large office Up to 20 people</li>
				<li>You'll probably need an XL Truck + 3 Movers</li>
				<li>Date + Time</li>
				<li>From $216 per hour</li>
				<li>This job often takes 5 to 7 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_16" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Lots and lots of big stuff! </li>
				<li>You'll probably need an XL Truck + 3 Movers</li>
				<li>Date + Time</li>
				<li>From $216 per hour</li>
				<li>This job often takes 5 to 7 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>


		<span id="dynamicData"></span>
		<div id="slideheader">
			<h3>Choose your <span id="home">Home</span> or <span id="business">business</span> move size: </h3>
		</div>
		<!-- <p class="sliderval">&nbsp;</p> -->
		<div id="slider"></div>
		<ul id="slidecon" class="list-inline">
			<li id="sc_1">A few large items or a large appliance</li>
			<li id="sc_2">1 bed home Average</li>
			<li id="sc_3">Small storage unit, up to 10m<sup>3</sup></li>
			<li id="sc_4">2 bed home Average</li>
			<li id="sc_5">1 - 2 bed home Lots of stuff!</li>
			<li id="sc_6">Large storage unit, up to 20m<sup>3</sup></li>
			<li id="sc_7">3 - 4 bed home Average</li>
			<li id="sc_8">Big home Lots of stuff!</li>
		</ul>
		<ul id="slidecon2" class="list-inline" style="display: none;">
			<li id="sc_1">Just archive boxes, up to 170</li>
			<li id="sc_2">Furnished office 2 people</li>
			<li id="sc_3">Heaps of archive boxes, up to 250</li>
			<li id="sc_4">Small office Up to 5 people</li>
			<li id="sc_5">Big or tall furniture or shop fittings</li>
			<li id="sc_6">Medium office Up to 10 people</li>
			<li id="sc_7">Large office Up to 20 people</li>
			<li id="sc_8">Lots and lots of big stuff!</li>
		</ul>
		<div class="slider_btns">
			<a class="slider_btn" href="book.php"> Book this move </a>
			<a class="slider_btn" href="#"> Quick Estimate </a>
		</div>
	</div>

</body>

=======
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery UI Slider - Slider bound to select</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style type="text/css" media="screen">

	/* 11.03.2019 */
	#slideheader h3 {margin: 30px 0;text-align: center;}
	#slideheader h3 span:hover,#slidecon li:hover,#slidecon2 li:hover {cursor: pointer;}
#slider.ui-slider-horizontal:hover,span.ui-state-default:hover {/*cursor: e-resize;*/}
#slideheader #home,#slideheader #business {color: #c3c1c0}
#slideheader #home.colored,#slideheader #business.colored {color: #ed1c25;position: relative;padding-right: 30px;/*transition: all .4s;*/}
#slideheader #business.colored::after,#slideheader #home.colored::after {content: '\f00c';font-family: 'fontAwesome';right: 0;position: absolute;top: 4px;display: block;}
#slidecon,#slidecon2 {text-align: center;margin: 20px 0 !important;display: table;}
#slidecon li,#slidecon2 li {display: table-cell;/*max-width: 12%;width: 100%;*/padding: 0px 6px;box-sizing: border-box;font-weight: 700;font-size: 12px;margin: 0;}
li.colored {color: #ed1c25;}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {border: 1px solid #b61c26 !important;background: #b61c26 !important;font-weight: normal;color: #b61c26 !important;}
.slider_btns {margin: 30px 0 15px;display: block;text-align: center;width: 100%;}
.slider_btns .slider_btn {color: #fff;background: #000 url(img/button-medium.png) top left no-repeat;background-size: 100% 100%;width: 197px;height: 50px;transition: all .2s;color: #fff;font-size: 17px;line-height: 20px;position: relative;padding: 15px;margin: 0 5px;display: inline-block;}
#firstone {background: #f5f5f5;width: 100%;display: table;}
#firstone li {margin: 0;vertical-align: middle;text-align: center;font-size: 14px;display: table-cell;padding: 10px 4px;font-weight: 700;}
#firstone li+ li {border-left: 1px solid #000;}
span#progress {background: #f00;height: 11px;}
.ui-slider .ui-slider-handle{transition: left .3s;}

</style>
<script>


	jQuery(function($) {
		
		
		


		$("#slidecon li:first-child, #slidecon2 li:first-child").addClass("colored");

		sliderClick("1");
		var xx=0;

		sliderfunction(0);

		function sliderfunction(steps) {
			xx = steps;
			$("#slider").slider({
				value: steps,
				animate: "slow"
			});

		}

		$("#slidecon li, #slidecon2 li").on("click", function() {

			$(this).addClass("colored").siblings("li").removeClass("colored");

			sliderClick($(this).attr('id'));

			/*get button left value and set backgroung color*/
			$("#progress").css({
				"width": xx+"%", 
				"display": "block", 
				"transition": "width .3s"
			});

		});

		function showContent(counter){

			$showcontent = $(counter).html();
			$("#dynamicData").html($showcontent).show();
		}

		function sliderClick(selectData) {

			var i,addition = 14.29;
			for ( i = 1; i <= 8; i++) {
				var widthLength=0;
				if ('sc_'+i == selectData) {
					if(i!=1){
						addition = addition * (i-1);
						widthLength += addition;
					}
					sliderfunction(widthLength);
					showContent("#dd_"+i);
					break;
				}

			}

			
		}



		$("#slidecon li, #slidecon2 li, #firstone li").addClass("list-inline-item");
		$("#home").toggleClass("colored");

		$("#home").on('click', function() {
			$("#business").removeClass("colored");
			$("#home").addClass("colored");

			$("#slidecon2").hide();
			$("#slidecon").show();
		});

		$("#business").on('click', function() {
			$("#home").removeClass("colored");
			$("#business").addClass("colored");

			$("#slidecon").hide();
			$("#slidecon2").show();
		});

		$("span.ui-slider-handle").before('<span id="progress"></span>');


	});
</script>
</head>

<body>
	<div class="container">
		<div id="dd_1" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>A few large items or a large appliance</li>
				<li>You'll probably need a medium truck + 2 movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_2" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>1 bed home Avarage</li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_3" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Small storage unit, up to 10m<sup>3</sup></li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_4" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>2 bed home Average</li>
				<li>You'll probably need a Large truck + 2 movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_5" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>1 - 2 bed home Lots of Stuff!</li>
				<li>You'll probably need a Large truck +2 moves</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_6" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Large storage unit, up to 20m<sup>3</sup></li>
				<li>You'll probably need a Large truck +2 moves</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_7" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>3 - 4 bed home Average</li>
				<li>You'll probably need a XL truck +2 movers</li>
				<li>Date + Time</li>
				<li>From $177 per hour</li>
				<li>This job often takes 3 to 5 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_8" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Bed home Lots of Stuff!</li>
				<li>You'll probably need a XL truck + 3 movers</li>
				<li>Date + Time</li>
				<li>From $216 per hour</li>
				<li>This job often takes 5 to 7 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_9" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Just archive boxes, up to 170</li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_10" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Furnished office 2 people</li>
				<li>You'll probably need a Medium Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $137 per hour</li>
				<li>This job often takes 1 to 2 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_11" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Heaps of archive boxes, up to 250</li>
				<li>You'll probably need a Large Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_12" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Small office Up to 5 people</li>
				<li>You'll probably need a Large Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>	
		<div id="dd_13" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Big or tall furniture or shop fittings</li>
				<li>You'll probably need a Large Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $158 per hour</li>
				<li>This job often takes 2 to 4 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_14" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Medium office Up to 10 people</li>
				<li>You'll probably need an XL Truck + 2 Movers</li>
				<li>Date + Time</li>
				<li>From $177 per hour</li>
				<li>This job often takes 3 to 5 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_15" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Large office Up to 20 people</li>
				<li>You'll probably need an XL Truck + 3 Movers</li>
				<li>Date + Time</li>
				<li>From $216 per hour</li>
				<li>This job often takes 5 to 7 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>
		<div id="dd_16" style="display: none;">
			<ul id="firstone" class="list-inline">
				<li>Your Move</li>
				<li>Lots and lots of big stuff! </li>
				<li>You'll probably need an XL Truck + 3 Movers</li>
				<li>Date + Time</li>
				<li>From $216 per hour</li>
				<li>This job often takes 5 to 7 hours</li>
				<li>Travel Time</li>
				<li>New Move</li>
			</ul>
		</div>


		<span id="dynamicData"></span>
		<div id="slideheader">
			<h3>Choose your <span id="home">Home</span> or <span id="business">business</span> move size: </h3>
		</div>
		<!-- <p class="sliderval">&nbsp;</p> -->
		<div id="slider"></div>
		<ul id="slidecon" class="list-inline">
			<li id="sc_1">A few large items or a large appliance</li>
			<li id="sc_2">1 bed home Average</li>
			<li id="sc_3">Small storage unit, up to 10m<sup>3</sup></li>
			<li id="sc_4">2 bed home Average</li>
			<li id="sc_5">1 - 2 bed home Lots of stuff!</li>
			<li id="sc_6">Large storage unit, up to 20m<sup>3</sup></li>
			<li id="sc_7">3 - 4 bed home Average</li>
			<li id="sc_8">Big home Lots of stuff!</li>
		</ul>
		<ul id="slidecon2" class="list-inline" style="display: none;">
			<li id="sc_1">Just archive boxes, up to 170</li>
			<li id="sc_2">Furnished office 2 people</li>
			<li id="sc_3">Heaps of archive boxes, up to 250</li>
			<li id="sc_4">Small office Up to 5 people</li>
			<li id="sc_5">Big or tall furniture or shop fittings</li>
			<li id="sc_6">Medium office Up to 10 people</li>
			<li id="sc_7">Large office Up to 20 people</li>
			<li id="sc_8">Lots and lots of big stuff!</li>
		</ul>
		<div class="slider_btns">
			<a class="slider_btn" href="book.php"> Book this move </a>
			<a class="slider_btn" href="#"> Quick Estimate </a>
		</div>
	</div>

</body>

>>>>>>> 6962a59c0c584e8e8c58cf9503246558c9884825
</html>