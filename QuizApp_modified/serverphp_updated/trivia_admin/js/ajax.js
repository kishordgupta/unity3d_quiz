// JavaScript Document
function GetXmlHttpObject1()
{
	var xmlHttp=null;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

///////////////////////////////////////////////////////////////////////////////////////// general ajx function			
var http_request = false;
var divid;
function JmakePOSTRequest(url, parameters,divid1) {
  http_request = false;
  divid=divid1;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_request = new XMLHttpRequest();
	 if (http_request.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_request.overrideMimeType('text/xml');
		http_request.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_request = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_request) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
//  alert (parameters);
  http_request.onreadystatechange = JalertContents;
  http_request.open('POST', url, true);
  http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request.setRequestHeader("Content-length", parameters.length);
  http_request.setRequestHeader("Connection", "close");
  http_request.send(parameters);
}
function JalertContents() {
  if (http_request.readyState == 4) {
	 if (http_request.status == 200) 
	 {
		//alert(http_request.responseText);
		result = http_request.responseText;		
		document.getElementById(divid).innerHTML = result;
		$('#' + divid).fadeTo("slow",1);
	 } else {
		alert('There was a problem with the request.');
	 }
	 //$('#loadingdiv').hide();
  }
}

function call_ajax(url,para,divid1)
{
	$('#' + divid1).fadeTo("slow",0.1);
	JmakePOSTRequest(url,para,divid1);
}
$(document).ready(function(){
	$(function() {
		$("#cat_order").sortable({ opacity: 0.6, cursor: 'move', update: function() 
		{
			$("#success").html('');
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("update_cat_order.php", order, function(theResponse){				
				$("#success").fadeIn(500);
				$("#success").html(theResponse);
			}); 															 
		}								  
		});
	});
});