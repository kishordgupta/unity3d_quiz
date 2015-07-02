// JavaScript Document

/*$(document).ready(function(){
		$.doTimeout( 3000, function(){
			$('#fade').fadeOut(1000);
		});
	});
*/	
	
$("#role_form").submit(function(){
	
	var val="";
	var flag=false;
	if (Trim($("#name").val()).length <= 0)
	{
		val += "<p>Please Enter Role Name</p>";
		Sexy.error(val);
		return false;
	}
	return true;
});	


//$("form").submit(function() { alert ("tests"); return false; });
