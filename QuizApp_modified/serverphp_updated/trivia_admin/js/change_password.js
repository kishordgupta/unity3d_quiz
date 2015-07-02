// JavaScript Document

/*$(document).ready(function(){
		$.doTimeout( 3000, function(){
			$('#fade').fadeOut(1000);
		});
	});
*/	
	
$("#pass_form").submit(function(){
	
	var val="";
	var flag=false;
	if (Trim($("#old_password").val()).length <= 0)
	{
		$("#username").focus();
		val += "<p>Please Enter old password</p>";
		Sexy.error(val);
		return false;
		//
		
	}
	if (Trim($("#password").val()).length <= 0)
	{
		$("#password").focus();
		val += "<p>Please Enter new Password</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	if (Trim($("#re_password").val()).length <= 0)
	{
		$("#re_password").focus();
		val += "<p>Please Enter confirn Password</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	if(Trim($("#re_password").val()) != Trim($("#password").val()))
	{
		$("#re_password").focus();
		val += "<p>Please Enter match Password</p>";
		Sexy.error(val);
		return false;
	}
	return true;
});	


//$("form").submit(function() { alert ("tests"); return false; });
