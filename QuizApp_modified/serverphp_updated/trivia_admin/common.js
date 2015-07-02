function show_msg()
{
	$("#msg_disp").slideDown(1000);
}

function image_fileInput() 
{	   
 	var d = document.createElement("div");
 	var file = document.createElement("input");
 	file.setAttribute("type", "text");
	file.setAttribute("style", "padding-top:2px");
	file.setAttribute("placeholder", "Enter Link");
	file.setAttribute("class","register_namefield_tax_fieldarea");
	file.setAttribute("name", "links[]");
	file.setAttribute("id", "links[]");
 	d.appendChild(file);
		
		
	var d1 = document.createElement("div");
 	var file1 = document.createElement("input");
 	file1.setAttribute("type", "text");
	file1.setAttribute("style", "padding-top:2px");
	file1.setAttribute("placeholder", "Enter Link Text");
	file1.setAttribute("class","register_namefield_tax_fieldarea");
	file1.setAttribute("name", "text_links[]");
	file1.setAttribute("id", "text_links[]");
 	d1.appendChild(file1);	
		
 	document.getElementById("more_imageupload").appendChild(d);
	document.getElementById("more_imageupload").appendChild(d1);
 	upload_number++;	
	
	document.postcar.no_of_attch.value=upload_number;	
}

function del_confirm(title,page)
{	
        Sexy.confirm('<p>Are you sure to delete this ' + title + '?</p>', {onComplete: 
          function(returnvalue) { 
            if(returnvalue)
            {
            	window.location.href=page;	
            }
            else
            {
            	return false;
            }
          }
        });
      
}

function del_confirm1()
{	
	Sexy.confirm('<p>Are you sure to delete this records?</p>', {onComplete: 
	  function(returnvalue) { 
		if(returnvalue)
		{
			//alert ("ters");
			return true;	
		}
		else
		{
			return false;
		}
	  }
	});     
}


$("#submit_action").click(function(){
	var val="";
	var len = document.data_list.ids.length;
	var flag12 = true;
	if(typeof(len)!='number')
	{
		if(document.data_list.ids.checked==false)
		{
			val += "<p>Please select atleast one element.</p>";
			Sexy.error(val);
			return false;
		}
	}
	else
	{
		for(i=0; i<len; i++)
		{
			if (document.data_list.ids[i].checked == true)
			{
				flag12=false;
				break;
			}
		}	
		if (flag12==true)
		{
			val += "<p>Please select atleast one element.</p>";
			Sexy.error(val);
			return false;
		}
		else
		{
			var action_all = $("#list_action").val();
			var news_all = $("#newsletter").val();							
			if(action_all == "delete")
			{ 
				Sexy.confirm('<p>Are you sure to delete this records?</p>', {onComplete: 
				function(returnvalue) { 
					if(returnvalue)
					{
						
						$("#data_list").submit();
					}
					else
					{
						return false;
					}
				}
			
			});
			}
			if(action_all=='news_letter' && news_all > 0)
			{ 
				$("#data_list").submit();			
			}
			else if(action_all=='news_letter' && news_all <= 0)
			{
				val += "<p>Please select at least one newsletter to send.</p>";
				Sexy.error(val);
				return false;
			}
			if(action_all == 'active' || action_all == 'inactive' )
			{	 
				$("#data_list").submit();
			}
			if(action_all == '')
			{	 
				val += "<p>Please select any action.</p>";
				Sexy.error(val);
				return false;
			}
		    /*else
			{
				$("#data_list").submit();
			}*/
		}
	return true;
	}
});	
function check_news()
{
	var action_sel = $("#list_action").val();
	if(action_sel == "news_letter")
	{ 
		$("#news_dis").fadeIn();
		$("#submit_action").val("Send Newsletter");
	}
	else
	{
		$("#news_dis").fadeOut();
		$("#submit_action").val("Apply to selected");
	}
}

function checkUncheckAll(theElement) 
{
     var theForm = theElement.form, z = 0;
	 for(z=0; z<theForm.length;z++)
	 {
		  if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall')
		  {
			theForm[z].checked = theElement.checked;
		  }
     }
}
var upload_number = 1;
function addFileInput() 
{	   
 	var d=document.createElement("div");
 	var file=document.createElement("input");
 	file.setAttribute("type", "file");
	file.setAttribute("class","text-input medium-input datepicker");
	file.setAttribute("name","image[]");
	file.setAttribute("id","image[]");
	file.setAttribute("style","margin-top:6px");
 	d.appendChild(file);
		
 	document.getElementById("moreUploads").appendChild(d);
 	upload_number++;	
	document.postcar.no_of_attch.value=upload_number;	
}

function hb_addFileInput() 
{	   
 	var d = document.createElement("div");
 	var file = document.createElement("input");
 	file.setAttribute("type", "text");
	file.setAttribute("size", "40");
 	//file.setAttribute("name", "image_url"+upload_number);
	//file.setAttribute("id", "image_url"+upload_number);
	file.setAttribute("name", "hb_image_url[]");
	file.setAttribute("id", "hb_image_url[]");
 	d.appendChild(file);
		
 	document.getElementById("hb_moreUploads").appendChild(d);
 	upload_number++;	
	document.postcar.no_of_attch.value=upload_number;	
}
function copyfor_hewbrew(control,src,dest)
{		
	var chkbox=$('#'+control).attr('checked'); 
	if(chkbox==true)
	{  $("#"+dest).val($("#"+src).val());  }
	else
	{  $("#"+dest).val('');  }
}