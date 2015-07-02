function GetXmlHttpObject()
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
var status_http_request = false;

function status_makePOSTRequest(url, parameters,divid1) {
	divid=divid1;
  	status_http_request = false;
  	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		status_http_request = new XMLHttpRequest();
	 if (status_http_request.overrideMimeType) {
		// set type accordingly to anticipated content type
		//status_http_request.overrideMimeType('text/xml');
		status_http_request.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		status_http_request = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   status_http_request = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!status_http_request) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
  status_http_request.onreadystatechange = status_alertContents;
  //alert (url + " " +  parameters + " " + divid1);
 // url += "?" + parameters
  
  status_http_request.open('POST', url, true);
  status_http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  status_http_request.setRequestHeader("Content-length", parameters.length);
  status_http_request.setRequestHeader("Connection", "close");
  status_http_request.send(parameters);
}
function status_alertContents() {
	if (status_http_request.readyState == 4) {
		result = status_http_request.responseText;	
		//alert (result);
		$("#" + divid).html(result);	
		$("#" + divid).fadeTo("fast",1);
		//alert (result);
  	}
}

function verify_call_ajax(page,para,divid)
{
	$("#" + divid).fadeTo("slow",0.1,function (){status_makePOSTRequest(page,para,divid);});	
}