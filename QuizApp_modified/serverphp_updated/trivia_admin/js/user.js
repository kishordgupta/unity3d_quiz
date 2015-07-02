$("#adminuser").submit(function(){
	var val="";
	var flag=false;
	if (Trim($("#roleid").val()).length <= 0)
	{
		$("#roleid").focus();
		val += "<p>Please Select usertype</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	if (Trim($("#username").val()).length <= 0)
	{
		$("#username").focus();
		val += "<p>Please Enter username</p>";
		Sexy.error(val);
		return false;
		//
		
	}
	if (Trim($("#password").val()).length <= 0 && Trim($("#mode").val())=="add" )
	{
		$("#password").focus();
		val += "<p>Please Enter Password</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
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
	else if(!emailCheck(Trim($("#email").val())))
	{  
		$("#email").focus();
		val += "<p>Please Enter Valid Email</p>";
		Sexy.error(val);
		return false;
		//Sexy.error('<p>Please Enter Password</p>');return false;
	}
	
	return true;
});	

