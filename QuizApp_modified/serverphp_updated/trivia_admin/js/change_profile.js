// JavaScript Document

/*$(document).ready(function(){
		$.doTimeout( 3000, function(){
			$('#fade').fadeOut(1000);
		});
	});
*/	
	
function profile_frm(th){
	
	var val="";
	var flag=false;
	if (Trim($("#fname").val()).length <= 0)
	{
		$("#fname").focus();
		val += "<p>Please Enter First Name</p>";
		Sexy.error(val);
		return false;
		//
		
	}
	if (Trim($("#lname").val()).length <= 0)
	{
		$("#lname").focus();
		val += "<p>Please Enter Last Name</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	if (Trim($("#email").val()).length <= 0)
	{
		$("#email").focus();
		val += "<p>Please Enter Email</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	 if (Trim($("#phoneno").val()).length <= 0)
	 {
		$("#phoneno").focus();
		val += "<p>Please Enter Phone</p>";
		Sexy.error(val);
		return false;
	 }
	if (Trim($("#paypal_email").val()).length <= 0)
	{
		$("#paypal_email").focus();
		val += "<p>Please Enter paypal email</p>";
		Sexy.error(val);
		return false;
	}
	if (!emailCheck(th.email.value))
	{
		$("#email").focus();
		val += "<p>Please Enter Valid Email</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	if (!emailCheck(th.paypal_email.value))
	{
		$("#paypal_email").focus();
		val += "<p>Please Enter Valid paypal email</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	return true;
}	


//$("form").submit(function() { alert ("tests"); return false; });
