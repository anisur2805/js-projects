<<<<<<< HEAD
<?php

$globalErrmsg=false;
$globalErrcls='error';

function validPhone($ph)
{
	$pattern='/^\(\d{3}\)\d{3}-\d{4}$/';
	return preg_match($pattern, str_replace(" ","",$ph));
}


function validIt($val,$key){ 
	$msg=null;
	if($key=='email' && $val==1){ $msg= 'Email is missing';}
	elseif($key=='email' && $val==2){  $msg= 'Invalid Email Address';}
	
	if($key=='phone' && $val==1){ $msg=  'Phone number missing';}
	elseif($key=='phone' && $val==2){ $msg=  'Invalid Phone Number';}

	if($msg==null) $msg='Field is required';
	return sprintf('<span class="error-txt">%s</span>',$msg);
}
$errorList=array_combine(array_keys($_GET),array_map('validIt',$_GET,array_flip($_GET)));
$fname=$email=$phone='';
if(isset($_POST['book_submit']))
{
	$error=false;
	$errorList=array();
	$fname=$_POST['fname'];

	$phone=$_POST['phone'];
	$email=$_POST['email'];

	if($fname==null){$errorList[]='fname=1'; $error=true;}
	if($phone==null){$errorList[]='phone=1'; $error=true;} elseif(!validPhone($phone)){$errorList[]='phone=2'; $error=true;}
	if($email==null){$errorList[]='email=1'; $error=true;}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){$errorList[]='email=2'; $error=true;}
	if($error)
	{
		header('location: ?msgcode=0&'.implode('&',$errorList));
		exit();
	}
	$sitename="Smooth Move Removals";
	$from='no-reply@anisur2805.com';
	$to='anisur2805@gmail.com';
	// $to='zohurul@websbd.com';

	$messages='<html><body>';
	$messages.='<table border="0" cellpadding="4" cellspacing="0" style="border-collapse:collapse; width:100%;"><tr style="border-bottom:1px solid #d6edf7;" valign="top"><td colspan="2"><p style="font-size:15px; font-weight:bold; padding:0px 0px 8px 0px; color:#000; margin:0;">'.$sitename.'</p></td></tr>';
	$messages.='<tr><td colspan="2">&nbsp;</td></tr>';
	$messages.='<tr><td width="35%"><strong>Full Name:</strong></td><td width="65%">'.$fname.'</td></tr>';
	$messages.='<tr><td width="35%"><strong>Phone:</strong></td><td width="65%">'.$phone.'</td></tr>';
	$messages.='<tr><td width="35%"><strong>Email:</strong></td><td width="65%">'.$email.'</td></tr>';
	$messages.='<tr style="border-bottom:1px solid #e2f4fc;"><td colspan="2">&nbsp;</td></tr>';
	$messages.='<tr align="center"><td colspan="2" font-size:12px;">This email has been posted from the Quote form '.$sitename.'.</td></tr></table>';
	$messages.= '</body></html>'; 

	// $sg_email->addTo($emailTo)->addTo($to)->setFrom($from)->setSubject('Quote Request: '.$fname)->setHtml($messages);
	// $mail = $sendgrid->send($sg_email);
	if($mail) {
		header("location: ?msgcode=1");
		exit();
	}
	else
	{
		header("location: ?msgcode=2");
		exit();
	}
}
extract($errorList);

?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book </title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="jquery.mask.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style type="text/css">
		/*#step-1, #step-2, #step-3{display: none;}*/

		#contactInfo h1, #contactInfo h2, #contactInfo h3, #contactInfo h4, #contactInfo h5, #contactInfo h6 {margin: 15px 0 15px;} 
		[data-toggle="modal"]{border-bottom: 2px dotted #000;display: inline-block;}
		
		#pickup, #dropoff, #additional {margin-bottom: 30px;}

		form .item {margin: 8px 0;position: relative;}
		form .item input[type="text"], form .item input[type="email"], form .item input[type="phone"]{padding: 6px 10px;color: #000;width: 100%;}
		::placeholder{color: #000;}
		form .item select {width: 100%;padding: 6px 10px;}

		#progressBar_area {padding-top: 75px;}
		#progressBar_area h3{background-color: #f48f94;color: #fff;font-size: 20px;margin: 0;padding: 10px 10px;}

		.js-progressBar-steps {background: #f5f5f5;padding: 10px;list-style-type: none;}
		.js-progressBar-steps li{position: relative;}
		.js-progressBar-steps li:not(:first-child):after {content: "\2713";position: absolute;top: 6px;right: 0;width: 16px;height: 30px;}
	.js-progressBar-steps li.active:after {content: "";border: 4px solid red;width: 3px;height: 3px;position: absolute;right: 6px;box-shadow: inset 0 0 3px #f00;border-radius: 100%;top: 14px;/*transition: all .4s;*/}
	.js-progressBar-steps li a, .noaction{color: #9b9696;display: block;padding: 6px;text-decoration: none;}
	.js-progressBar-steps li.active a{color: #ed1c24;}

	.tatitem{display: block;width: 100%;height: 90px;padding: 6px 10px;margin-bottom: 10px;}

	div#formorning, div#foran {display: inline-block;width: 150px;vertical-align: middle;background: #f00;color: #fff;text-align: center;}
	div#formorning label, div#foran label {margin: 0;padding: 6px 10px;display: block;font-size: 16px;}
	div#formorning input[type="radio"], div#foran input[type="radio"]{visibility: hidden;}

	#contactInfo .modal {background: rgba(55,47,45,.6);}
	.bookbtn.bookingForm__submit {width: 100%;}
	.bookbtn {background: #372f2d;border: 0;color: #fff;transition: all .4s;height: 90px;width: 250px;font-size: 30px;}
	.bookbtn:hover {background-color: #ac2426;color: #fff;}

	.tbl thead {background: #fff;color: #372f2d;font-size: 14px;}
	.tbl tbody {background: #372f2d;font-size: 13px;line-height: 18px;color: #fff;}
	.tbl th, .tbl td{border: 1px solid #372f2d;border-collapse: collapse;padding: 6px 10px;text-align: center;}
	.tbl td{border: 1px solid #fff;}

	span.error-txt {position: absolute;right: 20px;top: 8px;}

</style>

<script type="text/javascript">
	jQuery(function($) {
		$("#step-2, #step-3, #step-4").hide();

		$(".js-progressBar-steps li a").on("click", function(){
				//alert($(this).attr("href"));
				var id = $(this).attr("href");
				$(id).show();
				$(id).siblings().hide();
				$(this).parent().addClass("active");
				$(this).parent().siblings().removeClass("active");

				return false;


				// $(".js-progressBar-steps li a").parent().siblings().removeClass("active");

				// if($(".js-progressBar-steps li").hasClass("active")){
				// 	$("#progressBar_area h3").addClass("pc");
				// }
			});

		$( "#datepicker" ).datepicker();
	});
</script>
</head>

<body>

	<div id="contactInfo">
		<div class="container">
			<form class="bookingForm" id="bookingForm" method="post" action="">
				<div class="row">

					<div class="col-md-8">


						<!-- Step One -->
						<div class="bookingForm__step js-booking-step" id="step-1">
							<div class="step__contact" data-step="contact">
								<h2>Contact Information</h2>

								<div class="row">
									<div class="col-md-12 item">
										<?php echo $fname; ?>
										<input type="text" class="cms required" name="fname" placeholder="Full Name"/>
										<span class="tip"></span>
									</div>

									<div class="col-md-12 item">
										<?php echo $phone; ?>
										<input type="phone" class="cms phone required" name="phone" placeholder="Phone number"/>
										<span class="tip"></span>
									</div>

									<div class="col-md-12 item">
										<?php echo $email; ?>
										<input type="email" class="cms email required" name="email" placeholder="Email"/>
										<span class="tip"></span>
									</div>
								</div>

							</div>
						</div>

						<!-- Step Two -->
						<div class="bookingForm__step js-booking-step" id="step-2">
							<div class="step__contact" data-step="address">
								<div id="pickup" class="pickup">
									<h2>Pick-up</h2>
									<div class="row">
										<div class="col-md-12 item">
											<?php echo $pu_street_addr; ?>
											<input type="text" class="cms" name="pu_street_addr" placeholder="Pick-up street address"/>
											<span class="tip"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 item">
											<input type="text" class="cms" name="pu_sailors_gully" placeholder="Sailors Gully"/>
											<span class="tip"></span>
										</div>
										<div class="col-md-6 item">
											<select name="pu_data_type" class="select js-dropdown-select">
												<option value="">Type of property</option>
												<option value="" disabled="disabled">-----------------------</option>
												<option value="Apartment">Apartment</option>
												<option value="Unit">Unit</option>
												<option value="House">House</option>
												<option value="Office">Office</option>
												<option value="Warehouse">Warehouse</option>
											</select>
										</div>
									</div>

									<div class="access_block">
										<div class="access">
											<h5 data-toggle="modal" data-target="#myModal2">Access</h5>
											<!-- The Modal -->
											<div class="modal fade" id="myModal2">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">

														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Access</h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>

														<!-- Modal body -->
														<div class="modal-body">
															<p>The distance between the truck and your things will have a real impact on the time taken for your move. Give us your best guess here to make sure your estimate is accurate.</p>
														</div>

													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 item">
												<select name="pu_start_address_parking_distance" class="select js-dropdown-select js-ga_form_access">
													<option value="">How close can we park?</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="null">Don't know</option>
													<option value="0">Less than 10 metres to the front door</option>
													<option value="35">25-50m to the front door</option>
													<option value="75">50-100m to the front door</option>
													<option value="100">100m or more to the front door</option>  
												</select>
											</div>
											<div class="col-md-6 item">
												<select name="pu_start_address_stairs_lift" class="select js-dropdown-select js-ga_form_access">
													<option value="">Flight of stairs / Lift</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="No stairs">No stairs</option>
													<option value="Lift available">Yes, there’s a lift we can use</option>
													<option value="1">No lift, 1 flight of stairs</option>
													<option value="2">No lift, 2 flights of stairs</option>
													<option value="3">No lift, 3 flights of stairs</option>
													<option value="4">No lift, 4 flights of stairs</option>
													<option value="5">No lift, 5 flights of stairs</option>
													<option value="6">No lift, 6 flights of stairs</option>
													<option value="7">No lift, 7 flights of stairs</option>
													<option value="8">No lift, 8 flights of stairs</option>
													<option value="9">No lift, 9 flights of stairs</option>
													<option value="10">No lift, 10 flights of stairs</option>
													<option value="11">No lift, more than 10 flights of stairs</option>
												</select>
											</div>
										</div>
									</div> <!-- !Access Block -->
								</div>

								<div id="dropoff" class="dropoff">
									<h2>Drop-off</h2>
									<div class="row">
										<div class="col-md-12 item">
											<input name="do_street_addr" type="text" class="cms" placeholder="Drop-off street address"/>
											<span class="tip"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 item">
											<input type="text" name="do_sailors_gully" class="cms" placeholder="Sailors Gully"/>
											<span class="tip"></span>
										</div>
										<div class="col-md-6 item">
											<select name="do_start_address_property_type" class="select js-dropdown-select ">
												<option value="">Type of property</option>
												<option value="" disabled="disabled">-----------------------</option>
												<option value="Apartment">Apartment</option>
												<option value="Unit">Unit</option>
												<option value="House">House</option>
												<option value="Office">Office</option>
												<option value="Warehouse">Warehouse</option>
											</select>
										</div>
									</div>
									<div class="access_block">

										<div class="access">
											<h5 data-toggle="modal" data-target="#myModal">Access</h5>

											<!-- The Modal -->
											<div class="modal fade" id="myModal">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">

														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Access</h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>

														<!-- Modal body -->
														<div class="modal-body">
															<p>The distance between the truck and your things will have a real impact on the time taken for your move. Give us your best guess here to make sure your estimate is accurate.</p>
														</div>

													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6 item">
												<select name="do_start_address_parking_distance" class="select js-dropdown-select js-ga_form_access">
													<option value="">How close can we park?</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="null">Don't know</option>
													<option value="0">Less than 10 metres to the front door</option>
													<option value="35">25-50m to the front door</option>
													<option value="75">50-100m to the front door</option>
													<option value="100">100m or more to the front door</option>
												</select>
											</div>
											<div class="col-md-6 item">
												<select data-var="do_start_address_stairs_lift" class="select js-dropdown-select js-ga_form_access">
													<option value="">Flight of stairs / Lift</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="No stairs">No stairs</option>
													<option value="Lift available">Yes, there’s a lift we can use</option>
													<option value="1">No lift, 1 flight of stairs</option>
													<option value="2">No lift, 2 flights of stairs</option>
													<option value="3">No lift, 3 flights of stairs</option>
													<option value="4">No lift, 4 flights of stairs</option>
													<option value="5">No lift, 5 flights of stairs</option>
													<option value="6">No lift, 6 flights of stairs</option>
													<option value="7">No lift, 7 flights of stairs</option>
													<option value="8">No lift, 8 flights of stairs</option>
													<option value="9">No lift, 9 flights of stairs</option>
													<option value="10">No lift, 10 flights of stairs</option>
													<option value="11">No lift, more than 10 flights of stairs</option>
												</select>
											</div>
										</div>
									</div>
								</div> <!-- !Drop Off -->

								<div id="additional">
									<h6><a href="" class="yes conditional"><span class="fa fa-check"></span></a> <a href="" class="no conditional"><span class="fa fa-cross"></span></a>Do you have <a data-toggle="modal" data-target="#modal3">additional pick-up or drop-off locations?</a></h6>
									<!-- The Modal -->
									<div class="modal fade" id="modal3">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Additional Locations</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<!-- Modal body -->
												<div class="modal-body">
													<p>The Man is happy to make extra stops along the way. Just let us know, so we can make sure we allow enough time.</p>
												</div>
											</div>
										</div>
									</div>

									<textarea name="full_address_req" placeholder="Please enter the full address of your additional pick-up/drop-off location(s)" class="conditional-yes tatitem"></textarea>
									<textarea name="full_address" placeholder="Any additional details about the properties?" class="tatitem default"></textarea>
								</div> <!-- !Additional -->

							</div>
						</div> <!-- Close Step Two -->

						<!-- Step Three -->
						<div class="bookingForm__step js-booking-step" id="step-3">
							<div class="step__contact" data-step="address">

								<div id="pickup" class="pickup">
									<h2>Pick a <span data-toggle="modal" data-target="#myModal4">date</span></h2>
									<!-- The Modal -->
									<div class="modal fade" id="myModal4">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Pick A Date</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<!-- Modal body -->
												<div class="modal-body">
													<p>Let us know what works for you. Our men are available 7 days a week, from 8am-5pm. Weekdays are the best value, followed by Saturdays, then Sundays and public holidays. Your preferred date should be available, but we'll confirm later.</p>
												</div>

											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 item">

											<p><input name="datepick" placeholder="MM/DD/YY" type="text" id="datepicker"></p>

											<div class="movetime mtone">
												<h3>Move time</h3>
												<p>Let us know what time of day you would prefer.</p>
												<div id="formorning">
													<label for="morning"><input type="radio" id="morning" name="movetime" value="morning">Morning</label>
												</div>
												<div id="foran">
													<label for="afternoon"><input type="radio" id="afternoon" name="movetime" value="afternoon">Afternoon</label>
													<!-- <input type="radio" name="movetime" value="afternoon"> -->
												</div>
											</div>

											<div class="movetime mttwo">
												<p><strong>Request a specific time</strong></p>
												<p>If your requested time is not available, we'll suggest some alternatives when we contact you to confirm.</p>

												<select name="selectMoveTime">
													<option value="">None</option>
													<option value="8:00am">8:00am</option>
													<option value="9:00am">9:00am</option>
													<option value="9:30am">9:30am</option>
													<option value="10:00am">10:00am</option>
													<option value="10:30am">10:30am</option>
													<option value="11:00am">11:00am</option>
													<option value="11:30am">11:30am</option>
													<option value="12:00pm">12:00pm</option>
													<option value="12:30pm">12:30pm</option>
													<option value="1:00pm">1:00pm</option>
													<option value="1:30pm">1:30pm</option>
													<option value="2:00pm">2:00pm</option>
													<option value="3:00pm">3:00pm</option>
													<option value="4:00pm">4:00pm</option>  
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- Close Step Three -->

					</div> <!-- Close Col MD 8 -->

					<div class="col-md-4">
						<div id="progressBar_area">
							<h3>Book a move</h3>
							<ul class="js-progressBar-steps">
								<li class="noaction">Move Type</li>
								<li class="active"><a href="#step-1" data-step="1">Contact Details</a></li>
								<li><a href="#step-2" data-step="2">Address Details</a></li>
								<li><a href="#step-3" data-step="3">Move Date & Time</a></li>
								<li><a href="#step-4" data-step="4">Confirmation</a></li>
							</ul>
						</div>

						<div id="submitbtnarea">
							<input type="submit" value="Continue" class="bookbtn bookingForm__submit" name="book_submit">
							<!-- <i class="icon-arrow-down"></i>  -->
							<!-- <input type="submit" class="bookbtn" value="Send" name="submit"> -->
						</div>
					</div> <!-- Close Col MD 4 -->

					<!-- Step Four -->
					<div class="col-md-12" id="step-4">
						<div class="bookingForm__step js-booking-step">
							<div class="step__contact" data-step="movedatetime">
								<div id="pickup" class="pickup">
									<h2>Ready to send your booking enquiry to The Man?</h2>
									<div class="row">
										<div class="col-md-12 item">
											<table class="tbl">
												<thead>
													<tr>
														<th>Job Type</th>
														<th>Vehicle + Movers</th>
														<th>Date + Time</th>
														<th>$ Hourly Rate</th>
														<th>Job Time</th>
														<th>Travel Time</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1 - 2 bed home Lots of stuff!</td>
														<td>You'll probably need a Large Truck + 2 Movers</td>
														<td>Wed 3 Apr 2019 Afternoon</td>
														<td>$158 per hour</td>
														<td>This job often takes 2 to 4 hours</td>
														<td>3 hrs 12 mins Travel Time</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<h6>Pick-up</h6>
											<p>test, Sailors Falls</p>
										</div>
										<div class="col-md-6">
											<h6>Drop-off</h6>
											<p>d, Dales Creek</p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<p class="tooltip"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Best trained movers in the biz</p>
											<p class="tooltip"><i class="fa fa-umbrella" aria-hidden="true"></i> Fully insured, at no extra cost</p>
											<br>
											<div id="finaldetails">
												<p><input type="checkbox" name="final"> Any final details about your move?</p>
												<textarea class="tatitem" name="fdta" placeholder="Any other info you want us to know?"></textarea>
											</div>

											<p><input type="checkbox" name="agree"> I agree to the Terms & Conditions of this booking enquiry. *</p>
											<h5>Please note</h5>
											<p>Your move is not considered fully booked in until we've discussed it with you. Once you send, we'll call to confirm within one working day.</p>

											<input type="submit" class="bookbtn" value="Send" name="book_submit">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>


	<script type="text/javascript">

		jQuery(".bookbtn").on("click", function(){
			alert("hey");
		});


		jQuery(document).ready(function($){
			$('.cms.phone').mask('(000) 000-0000');
			//var abc = $("")
			$("#bookingForm").submit(function(e){
				var error=false;
				$(".required").each(function(){
					var value=$(this).val(),elm=$(this);
					if(value==null || value==' ' || value=='')
					{
						error=true;
						elm.prev('.error-txt').remove();
						elm.before('<span class="error-txt">Filed is required!</span>');

					}
					else if($(this).hasClass('email') && !validateEmail(value))
					{
						error=true;
						elm.prev('.error-txt').remove();
						elm.before('<span class="error-txt">Invalid Email Address!</span>');
					}
					else if($(this).hasClass('phone') && !validatePhone(value))
					{
						error=true;
						elm.prev('.error-txt').remove();
						elm.before('<span class="error-txt">Invalid Phone Number!</span>');
					}
				});
				if(error) return false;
				return true;
			});
			$(".required").focus(function(){
				$(this).prev('.error-txt').remove();
			});
		});
		function validateEmail(em) {
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(em);
		}
		function validatePhone(ph) {
			var re = /^\(\d{3}\)\d{3}-\d{4}$/;
			return re.test(ph.replace(" ",""));
		}
	</script>

</body>
=======
<?php

$globalErrmsg=false;
$globalErrcls='error';

function validPhone($ph)
{
	$pattern='/^\(\d{3}\)\d{3}-\d{4}$/';
	return preg_match($pattern, str_replace(" ","",$ph));
}


function validIt($val,$key){ 
	$msg=null;
	if($key=='email' && $val==1){ $msg= 'Email is missing';}
	elseif($key=='email' && $val==2){  $msg= 'Invalid Email Address';}
	
	if($key=='phone' && $val==1){ $msg=  'Phone number missing';}
	elseif($key=='phone' && $val==2){ $msg=  'Invalid Phone Number';}

	if($msg==null) $msg='Field is required';
	return sprintf('<span class="error-txt">%s</span>',$msg);
}
$errorList=array_combine(array_keys($_GET),array_map('validIt',$_GET,array_flip($_GET)));
$fname=$email=$phone='';
if(isset($_POST['book_submit']))
{
	$error=false;
	$errorList=array();
	$fname=$_POST['fname'];

	$phone=$_POST['phone'];
	$email=$_POST['email'];

	if($fname==null){$errorList[]='fname=1'; $error=true;}
	if($phone==null){$errorList[]='phone=1'; $error=true;} elseif(!validPhone($phone)){$errorList[]='phone=2'; $error=true;}
	if($email==null){$errorList[]='email=1'; $error=true;}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){$errorList[]='email=2'; $error=true;}
	if($error)
	{
		header('location: ?msgcode=0&'.implode('&',$errorList));
		exit();
	}
	$sitename="Smooth Move Removals";
	$from='no-reply@anisur2805.com';
	$to='anisur2805@gmail.com';
	// $to='zohurul@websbd.com';

	$messages='<html><body>';
	$messages.='<table border="0" cellpadding="4" cellspacing="0" style="border-collapse:collapse; width:100%;"><tr style="border-bottom:1px solid #d6edf7;" valign="top"><td colspan="2"><p style="font-size:15px; font-weight:bold; padding:0px 0px 8px 0px; color:#000; margin:0;">'.$sitename.'</p></td></tr>';
	$messages.='<tr><td colspan="2">&nbsp;</td></tr>';
	$messages.='<tr><td width="35%"><strong>Full Name:</strong></td><td width="65%">'.$fname.'</td></tr>';
	$messages.='<tr><td width="35%"><strong>Phone:</strong></td><td width="65%">'.$phone.'</td></tr>';
	$messages.='<tr><td width="35%"><strong>Email:</strong></td><td width="65%">'.$email.'</td></tr>';
	$messages.='<tr style="border-bottom:1px solid #e2f4fc;"><td colspan="2">&nbsp;</td></tr>';
	$messages.='<tr align="center"><td colspan="2" font-size:12px;">This email has been posted from the Quote form '.$sitename.'.</td></tr></table>';
	$messages.= '</body></html>'; 

	// $sg_email->addTo($emailTo)->addTo($to)->setFrom($from)->setSubject('Quote Request: '.$fname)->setHtml($messages);
	// $mail = $sendgrid->send($sg_email);
	if($mail) {
		header("location: ?msgcode=1");
		exit();
	}
	else
	{
		header("location: ?msgcode=2");
		exit();
	}
}
extract($errorList);

?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book </title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="jquery.mask.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style type="text/css">
		/*#step-1, #step-2, #step-3{display: none;}*/

		#contactInfo h1, #contactInfo h2, #contactInfo h3, #contactInfo h4, #contactInfo h5, #contactInfo h6 {margin: 15px 0 15px;} 
		[data-toggle="modal"]{border-bottom: 2px dotted #000;display: inline-block;}
		
		#pickup, #dropoff, #additional {margin-bottom: 30px;}

		form .item {margin: 8px 0;position: relative;}
		form .item input[type="text"], form .item input[type="email"], form .item input[type="phone"]{padding: 6px 10px;color: #000;width: 100%;}
		::placeholder{color: #000;}
		form .item select {width: 100%;padding: 6px 10px;}

		#progressBar_area {padding-top: 75px;}
		#progressBar_area h3{background-color: #f48f94;color: #fff;font-size: 20px;margin: 0;padding: 10px 10px;}

		.js-progressBar-steps {background: #f5f5f5;padding: 10px;list-style-type: none;}
		.js-progressBar-steps li{position: relative;}
		.js-progressBar-steps li:not(:first-child):after {content: "\2713";position: absolute;top: 6px;right: 0;width: 16px;height: 30px;}
	.js-progressBar-steps li.active:after {content: "";border: 4px solid red;width: 3px;height: 3px;position: absolute;right: 6px;box-shadow: inset 0 0 3px #f00;border-radius: 100%;top: 14px;/*transition: all .4s;*/}
	.js-progressBar-steps li a, .noaction{color: #9b9696;display: block;padding: 6px;text-decoration: none;}
	.js-progressBar-steps li.active a{color: #ed1c24;}

	.tatitem{display: block;width: 100%;height: 90px;padding: 6px 10px;margin-bottom: 10px;}

	div#formorning, div#foran {display: inline-block;width: 150px;vertical-align: middle;background: #f00;color: #fff;text-align: center;}
	div#formorning label, div#foran label {margin: 0;padding: 6px 10px;display: block;font-size: 16px;}
	div#formorning input[type="radio"], div#foran input[type="radio"]{visibility: hidden;}

	#contactInfo .modal {background: rgba(55,47,45,.6);}
	.bookbtn.bookingForm__submit {width: 100%;}
	.bookbtn {background: #372f2d;border: 0;color: #fff;transition: all .4s;height: 90px;width: 250px;font-size: 30px;}
	.bookbtn:hover {background-color: #ac2426;color: #fff;}

	.tbl thead {background: #fff;color: #372f2d;font-size: 14px;}
	.tbl tbody {background: #372f2d;font-size: 13px;line-height: 18px;color: #fff;}
	.tbl th, .tbl td{border: 1px solid #372f2d;border-collapse: collapse;padding: 6px 10px;text-align: center;}
	.tbl td{border: 1px solid #fff;}

	span.error-txt {position: absolute;right: 20px;top: 8px;}

</style>

<script type="text/javascript">
	jQuery(function($) {
		$("#step-2, #step-3, #step-4").hide();

		$(".js-progressBar-steps li a").on("click", function(){
				//alert($(this).attr("href"));
				var id = $(this).attr("href");
				$(id).show();
				$(id).siblings().hide();
				$(this).parent().addClass("active");
				$(this).parent().siblings().removeClass("active");

				return false;


				// $(".js-progressBar-steps li a").parent().siblings().removeClass("active");

				// if($(".js-progressBar-steps li").hasClass("active")){
				// 	$("#progressBar_area h3").addClass("pc");
				// }
			});

		$( "#datepicker" ).datepicker();
	});
</script>
</head>

<body>

	<div id="contactInfo">
		<div class="container">
			<form class="bookingForm" id="bookingForm" method="post" action="">
				<div class="row">

					<div class="col-md-8">


						<!-- Step One -->
						<div class="bookingForm__step js-booking-step" id="step-1">
							<div class="step__contact" data-step="contact">
								<h2>Contact Information</h2>

								<div class="row">
									<div class="col-md-12 item">
										<?php echo $fname; ?>
										<input type="text" class="cms required" name="fname" placeholder="Full Name"/>
										<span class="tip"></span>
									</div>

									<div class="col-md-12 item">
										<?php echo $phone; ?>
										<input type="phone" class="cms phone required" name="phone" placeholder="Phone number"/>
										<span class="tip"></span>
									</div>

									<div class="col-md-12 item">
										<?php echo $email; ?>
										<input type="email" class="cms email required" name="email" placeholder="Email"/>
										<span class="tip"></span>
									</div>
								</div>

							</div>
						</div>

						<!-- Step Two -->
						<div class="bookingForm__step js-booking-step" id="step-2">
							<div class="step__contact" data-step="address">
								<div id="pickup" class="pickup">
									<h2>Pick-up</h2>
									<div class="row">
										<div class="col-md-12 item">
											<?php echo $pu_street_addr; ?>
											<input type="text" class="cms" name="pu_street_addr" placeholder="Pick-up street address"/>
											<span class="tip"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 item">
											<input type="text" class="cms" name="pu_sailors_gully" placeholder="Sailors Gully"/>
											<span class="tip"></span>
										</div>
										<div class="col-md-6 item">
											<select name="pu_data_type" class="select js-dropdown-select">
												<option value="">Type of property</option>
												<option value="" disabled="disabled">-----------------------</option>
												<option value="Apartment">Apartment</option>
												<option value="Unit">Unit</option>
												<option value="House">House</option>
												<option value="Office">Office</option>
												<option value="Warehouse">Warehouse</option>
											</select>
										</div>
									</div>

									<div class="access_block">
										<div class="access">
											<h5 data-toggle="modal" data-target="#myModal2">Access</h5>
											<!-- The Modal -->
											<div class="modal fade" id="myModal2">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">

														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Access</h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>

														<!-- Modal body -->
														<div class="modal-body">
															<p>The distance between the truck and your things will have a real impact on the time taken for your move. Give us your best guess here to make sure your estimate is accurate.</p>
														</div>

													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 item">
												<select name="pu_start_address_parking_distance" class="select js-dropdown-select js-ga_form_access">
													<option value="">How close can we park?</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="null">Don't know</option>
													<option value="0">Less than 10 metres to the front door</option>
													<option value="35">25-50m to the front door</option>
													<option value="75">50-100m to the front door</option>
													<option value="100">100m or more to the front door</option>  
												</select>
											</div>
											<div class="col-md-6 item">
												<select name="pu_start_address_stairs_lift" class="select js-dropdown-select js-ga_form_access">
													<option value="">Flight of stairs / Lift</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="No stairs">No stairs</option>
													<option value="Lift available">Yes, there’s a lift we can use</option>
													<option value="1">No lift, 1 flight of stairs</option>
													<option value="2">No lift, 2 flights of stairs</option>
													<option value="3">No lift, 3 flights of stairs</option>
													<option value="4">No lift, 4 flights of stairs</option>
													<option value="5">No lift, 5 flights of stairs</option>
													<option value="6">No lift, 6 flights of stairs</option>
													<option value="7">No lift, 7 flights of stairs</option>
													<option value="8">No lift, 8 flights of stairs</option>
													<option value="9">No lift, 9 flights of stairs</option>
													<option value="10">No lift, 10 flights of stairs</option>
													<option value="11">No lift, more than 10 flights of stairs</option>
												</select>
											</div>
										</div>
									</div> <!-- !Access Block -->
								</div>

								<div id="dropoff" class="dropoff">
									<h2>Drop-off</h2>
									<div class="row">
										<div class="col-md-12 item">
											<input name="do_street_addr" type="text" class="cms" placeholder="Drop-off street address"/>
											<span class="tip"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 item">
											<input type="text" name="do_sailors_gully" class="cms" placeholder="Sailors Gully"/>
											<span class="tip"></span>
										</div>
										<div class="col-md-6 item">
											<select name="do_start_address_property_type" class="select js-dropdown-select ">
												<option value="">Type of property</option>
												<option value="" disabled="disabled">-----------------------</option>
												<option value="Apartment">Apartment</option>
												<option value="Unit">Unit</option>
												<option value="House">House</option>
												<option value="Office">Office</option>
												<option value="Warehouse">Warehouse</option>
											</select>
										</div>
									</div>
									<div class="access_block">

										<div class="access">
											<h5 data-toggle="modal" data-target="#myModal">Access</h5>

											<!-- The Modal -->
											<div class="modal fade" id="myModal">
												<div class="modal-dialog modal-lg">
													<div class="modal-content">

														<!-- Modal Header -->
														<div class="modal-header">
															<h4 class="modal-title">Access</h4>
															<button type="button" class="close" data-dismiss="modal">&times;</button>
														</div>

														<!-- Modal body -->
														<div class="modal-body">
															<p>The distance between the truck and your things will have a real impact on the time taken for your move. Give us your best guess here to make sure your estimate is accurate.</p>
														</div>

													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6 item">
												<select name="do_start_address_parking_distance" class="select js-dropdown-select js-ga_form_access">
													<option value="">How close can we park?</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="null">Don't know</option>
													<option value="0">Less than 10 metres to the front door</option>
													<option value="35">25-50m to the front door</option>
													<option value="75">50-100m to the front door</option>
													<option value="100">100m or more to the front door</option>
												</select>
											</div>
											<div class="col-md-6 item">
												<select data-var="do_start_address_stairs_lift" class="select js-dropdown-select js-ga_form_access">
													<option value="">Flight of stairs / Lift</option>
													<option value="" disabled="disabled">-----------------------</option>
													<option value="No stairs">No stairs</option>
													<option value="Lift available">Yes, there’s a lift we can use</option>
													<option value="1">No lift, 1 flight of stairs</option>
													<option value="2">No lift, 2 flights of stairs</option>
													<option value="3">No lift, 3 flights of stairs</option>
													<option value="4">No lift, 4 flights of stairs</option>
													<option value="5">No lift, 5 flights of stairs</option>
													<option value="6">No lift, 6 flights of stairs</option>
													<option value="7">No lift, 7 flights of stairs</option>
													<option value="8">No lift, 8 flights of stairs</option>
													<option value="9">No lift, 9 flights of stairs</option>
													<option value="10">No lift, 10 flights of stairs</option>
													<option value="11">No lift, more than 10 flights of stairs</option>
												</select>
											</div>
										</div>
									</div>
								</div> <!-- !Drop Off -->

								<div id="additional">
									<h6><a href="" class="yes conditional"><span class="fa fa-check"></span></a> <a href="" class="no conditional"><span class="fa fa-cross"></span></a>Do you have <a data-toggle="modal" data-target="#modal3">additional pick-up or drop-off locations?</a></h6>
									<!-- The Modal -->
									<div class="modal fade" id="modal3">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Additional Locations</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<!-- Modal body -->
												<div class="modal-body">
													<p>The Man is happy to make extra stops along the way. Just let us know, so we can make sure we allow enough time.</p>
												</div>
											</div>
										</div>
									</div>

									<textarea name="full_address_req" placeholder="Please enter the full address of your additional pick-up/drop-off location(s)" class="conditional-yes tatitem"></textarea>
									<textarea name="full_address" placeholder="Any additional details about the properties?" class="tatitem default"></textarea>
								</div> <!-- !Additional -->

							</div>
						</div> <!-- Close Step Two -->

						<!-- Step Three -->
						<div class="bookingForm__step js-booking-step" id="step-3">
							<div class="step__contact" data-step="address">

								<div id="pickup" class="pickup">
									<h2>Pick a <span data-toggle="modal" data-target="#myModal4">date</span></h2>
									<!-- The Modal -->
									<div class="modal fade" id="myModal4">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
													<h4 class="modal-title">Pick A Date</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<!-- Modal body -->
												<div class="modal-body">
													<p>Let us know what works for you. Our men are available 7 days a week, from 8am-5pm. Weekdays are the best value, followed by Saturdays, then Sundays and public holidays. Your preferred date should be available, but we'll confirm later.</p>
												</div>

											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 item">

											<p><input name="datepick" placeholder="MM/DD/YY" type="text" id="datepicker"></p>

											<div class="movetime mtone">
												<h3>Move time</h3>
												<p>Let us know what time of day you would prefer.</p>
												<div id="formorning">
													<label for="morning"><input type="radio" id="morning" name="movetime" value="morning">Morning</label>
												</div>
												<div id="foran">
													<label for="afternoon"><input type="radio" id="afternoon" name="movetime" value="afternoon">Afternoon</label>
													<!-- <input type="radio" name="movetime" value="afternoon"> -->
												</div>
											</div>

											<div class="movetime mttwo">
												<p><strong>Request a specific time</strong></p>
												<p>If your requested time is not available, we'll suggest some alternatives when we contact you to confirm.</p>

												<select name="selectMoveTime">
													<option value="">None</option>
													<option value="8:00am">8:00am</option>
													<option value="9:00am">9:00am</option>
													<option value="9:30am">9:30am</option>
													<option value="10:00am">10:00am</option>
													<option value="10:30am">10:30am</option>
													<option value="11:00am">11:00am</option>
													<option value="11:30am">11:30am</option>
													<option value="12:00pm">12:00pm</option>
													<option value="12:30pm">12:30pm</option>
													<option value="1:00pm">1:00pm</option>
													<option value="1:30pm">1:30pm</option>
													<option value="2:00pm">2:00pm</option>
													<option value="3:00pm">3:00pm</option>
													<option value="4:00pm">4:00pm</option>  
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> <!-- Close Step Three -->

					</div> <!-- Close Col MD 8 -->

					<div class="col-md-4">
						<div id="progressBar_area">
							<h3>Book a move</h3>
							<ul class="js-progressBar-steps">
								<li class="noaction">Move Type</li>
								<li class="active"><a href="#step-1" data-step="1">Contact Details</a></li>
								<li><a href="#step-2" data-step="2">Address Details</a></li>
								<li><a href="#step-3" data-step="3">Move Date & Time</a></li>
								<li><a href="#step-4" data-step="4">Confirmation</a></li>
							</ul>
						</div>

						<div id="submitbtnarea">
							<input type="submit" value="Continue" class="bookbtn bookingForm__submit" name="book_submit">
							<!-- <i class="icon-arrow-down"></i>  -->
							<!-- <input type="submit" class="bookbtn" value="Send" name="submit"> -->
						</div>
					</div> <!-- Close Col MD 4 -->

					<!-- Step Four -->
					<div class="col-md-12" id="step-4">
						<div class="bookingForm__step js-booking-step">
							<div class="step__contact" data-step="movedatetime">
								<div id="pickup" class="pickup">
									<h2>Ready to send your booking enquiry to The Man?</h2>
									<div class="row">
										<div class="col-md-12 item">
											<table class="tbl">
												<thead>
													<tr>
														<th>Job Type</th>
														<th>Vehicle + Movers</th>
														<th>Date + Time</th>
														<th>$ Hourly Rate</th>
														<th>Job Time</th>
														<th>Travel Time</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1 - 2 bed home Lots of stuff!</td>
														<td>You'll probably need a Large Truck + 2 Movers</td>
														<td>Wed 3 Apr 2019 Afternoon</td>
														<td>$158 per hour</td>
														<td>This job often takes 2 to 4 hours</td>
														<td>3 hrs 12 mins Travel Time</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<h6>Pick-up</h6>
											<p>test, Sailors Falls</p>
										</div>
										<div class="col-md-6">
											<h6>Drop-off</h6>
											<p>d, Dales Creek</p>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<p class="tooltip"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Best trained movers in the biz</p>
											<p class="tooltip"><i class="fa fa-umbrella" aria-hidden="true"></i> Fully insured, at no extra cost</p>
											<br>
											<div id="finaldetails">
												<p><input type="checkbox" name="final"> Any final details about your move?</p>
												<textarea class="tatitem" name="fdta" placeholder="Any other info you want us to know?"></textarea>
											</div>

											<p><input type="checkbox" name="agree"> I agree to the Terms & Conditions of this booking enquiry. *</p>
											<h5>Please note</h5>
											<p>Your move is not considered fully booked in until we've discussed it with you. Once you send, we'll call to confirm within one working day.</p>

											<input type="submit" class="bookbtn" value="Send" name="book_submit">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>


	<script type="text/javascript">

		jQuery(".bookbtn").on("click", function(){
			alert("hey");
		});


		jQuery(document).ready(function($){
			$('.cms.phone').mask('(000) 000-0000');
			$("#bookingForm").submit(function(e){
				var error=false;
				$(".required").each(function(){
					var value=$(this).val(),elm=$(this);
					if(value==null || value==' ' || value=='')
					{
						error=true;
						elm.prev('.error-txt').remove();
						elm.before('<span class="error-txt">Filed is required!</span>');

					}
					else if($(this).hasClass('email') && !validateEmail(value))
					{
						error=true;
						elm.prev('.error-txt').remove();
						elm.before('<span class="error-txt">Invalid Email Address!</span>');
					}
					else if($(this).hasClass('phone') && !validatePhone(value))
					{
						error=true;
						elm.prev('.error-txt').remove();
						elm.before('<span class="error-txt">Invalid Phone Number!</span>');
					}
				});
				if(error) return false;
				return true;
			});
			$(".required").focus(function(){
				$(this).prev('.error-txt').remove();
			});
		});
		function validateEmail(em) {
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(em);
		}
		function validatePhone(ph) {
			var re = /^\(\d{3}\)\d{3}-\d{4}$/;
			return re.test(ph.replace(" ",""));
		}
	</script>

</body>
>>>>>>> 6962a59c0c584e8e8c58cf9503246558c9884825
</html>