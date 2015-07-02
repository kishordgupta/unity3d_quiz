function add_event()
{
	var flag=true;
	var val = "";
	if($("#cat_id").val()=='')
	{
		$("#cat_id").focus();
		val += "<p>Please select category.</p>";
		Sexy.error(val);
		return false;
	}
	if($("#title").val()=='')
	{	
		$("#title").focus();
		val += "<p>Please enter title.</p>";
		Sexy.error(val);
		return false;
	}
	if($("#location").val()=='')
	{	
		$("#location").focus();
		val += "<p>Please enter location.</p>";
		Sexy.error(val);
		return false;
	}
}
function add_catagory()
{
	var flag=true;
	var val = "";
	if($("#cat_name").val()=='')
	{	
		$("#cat_name").focus();
		val += "<p>Please enter category name.</p>";
		Sexy.error(val);
		return false;
	}
}

function emailCheck(s)
{
	if(!(s.match(/^[\w]+([_|\.-][\w]{1,})*@[\w]{2,}([_|\.-][\w]{1,})*\.([a-z]{2,4})$/i) ))
    {
     //alert("Please Enter Valid Email Address");
		return false;
	}
	else
	{ 
		return true;
	}	
}


function Trim(str)
{  while(str.charAt(0) == (" "))
  {  str = str.substring(1);
  }
  while(str.charAt(str.length-1) == " " )
  {  str = str.substring(0,str.length-1);
  }
  return str;
}


function temp()
	{
		var browser=navigator.appName;

		if (browser == "Netscape")
		{
			return "table-row";
		}
		else
		{
			return "block";
		}
	}
function emailCheck1(s)
{
	if(!(s.match(/^[\w]+([_|\.-][\w]{1,})*@[\w]{2,}([_|\.-][\w]{1,})*\.([a-z]{2,4})$/i) ))
    {
//		alert("Please Enter Valid Email Address");
		return false;
	}
	else
	{
		return true;
	}	
}


function del_confirm(msg,url)
{
	if (confirm(msg))
	{
		window.location.href=url;
	}
}


//................To select-deselect all check box..............................

function chkall()
{
//	if (parseInt(document.frm.num.value) > 0)
//	{
		len = document.frm.allid.length;
		if(typeof(len)!='number')
		{
			if(document.frm.chk_all.checked == true)
			{
					document.frm.allid.checked = true;
			}		
			else
			{
					document.frm.allid.checked = false;		
			}
		}
		else
		{
			if(document.frm.chk_all.checked == true)
			{
				for(i=0; i<len; i++)
				{
					document.frm.allid[i].checked = true;
				}			
			}
			else
			{
				for(i=0; i<len; i++)
				{
					document.frm.allid[i].checked = false;
				}				
			}
		}	
//	}
}


function isInteger(s)
{   
	var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
//................For Float checking....................
function isFloat(s)
{   var i;
	tmp = 0;
	flag = 0;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
		if (((c >= "0" && c <= "9") || (c == ".")))
		{
			if (c == ".")
			{
				flag++;
			}
			if (flag > 1)
			{
				tmp = 1;
				break;
			}
			//alert (flag);
		}
		else
		{
			tmp = 1; 
			break;
		}		
    }
	if (tmp == 1)
		return false;
	else
    	return true;
}


function delete_item(msg,url)
{
	if (confirm (msg))
		window.location.href=url;
}
function delimage(imgid,t)
{	
		 var ans=confirm("Are you sure to delete this image");
		 if(ans==false)
			{
				 return;
			}

		 var imgid=imgid;
		 var string_ajax="&imgid="+imgid+"&t="+t;

		 $.ajax({
			   type: "GET",
			   url: "del_image_ajax.php",
			   //data: "{st_dt: '"+st_dt+"', end_dt:'"+end_dt+"'}",
			   data: string_ajax,
			   cache: false,
			   success: function(result)
			   			{							
							 $("#"+imgid).html(result);
				   		},
				   error: function(err) {
				   //The ajax call didn't work
				   alert("It didn't work: " + err);
				   }
				 });
}
function check_name(id)
{
	var game_name=$("#game_name").val();
	var string="id="+id+"&game_name="+game_name;
	call_ajax("ajax_gamename.php",string,"gamename_stat");
}
function adduser()
{
	var flag=true;
	var val = "";
	var mode=$("#mode").val();
	if($("#username").val()=='')
	{
		$("#username").focus();
		val += "<p>Please enter first name.</p>";
		Sexy.error(val);
		return false;
	}
	if($("#email").val()=='')
	{	
		$("#email").focus();
		val += "<p>Please enter email.</p>";
		Sexy.error(val);
		return false;
	}
	if($("#password").val()=='' && mode=='add')
	{	
		$("#password").focus();
		val += "<p>Please enter password.</p>";
		Sexy.error(val);
		return false;
	}	
}