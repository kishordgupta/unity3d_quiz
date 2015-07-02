// JavaScript Document

/*$(document).ready(function(){
		$.doTimeout( 3000, function(){
			$('#fade').fadeOut(1000);
		});
	});
*/	
	
$("#login_form").submit(function(){
	
	var val="";
	var flag=false;
	if (Trim($("#roleid").val()).length <= 0)
	{
		$("#roleid").focus();
		val += "<p>Please Select Usertype</p>";
		Sexy.error(val);
		return false;
		//
		
	}
	if (Trim($("#username").val()).length <= 0)
	{
		$("#username").focus();
		val += "<p>Please Enter Username</p>";
		Sexy.error(val);
		return false;
		//
		
	}
	if (Trim($("#password").val()).length <= 0)
	{
		$("#password").focus();
		val += "<p>Please Enter Password</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	return true;
});	


//$("form").submit(function() { alert ("tests"); return false; });
