///////////////////////////////////////////////////////////////////////////////////////// general ajx function			
var http_request_news = false;
var divid;
function JmakePOSTRequest_news(url, parameters) {
  http_request_news = false;
//  divid=divid1;
  if (window.XMLHttpRequest) { // Mozilla, Safari,...
	 http_request_news = new XMLHttpRequest();
	 if (http_request_news.overrideMimeType) {
		// set type accordingly to anticipated content type
		//http_request_news.overrideMimeType('text/xml');
		http_request_news.overrideMimeType('text/html');
	 }
  } else if (window.ActiveXObject) { // IE
	 try {
		http_request_news = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
		try {
		   http_request_news = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {}
	 }
  }
  if (!http_request_news) {
	 alert('Cannot create XMLHTTP instance');
	 return false;
  }
//  alert (parameters);
  http_request_news.onreadystatechange = JalertContents_news;
  http_request_news.open('POST', url, true);
  http_request_news.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http_request_news.setRequestHeader("Content-length", parameters.length);
  http_request_news.setRequestHeader("Connection", "close");
  http_request_news.send(parameters);
}
function JalertContents_news() 
{
  if (http_request_news.readyState == 1 || http_request_news.readyState == 2 || http_request_news.readyState == 3 ) 
  {
  	$("#sending_mail").fadeIn();
  	$("#mail_send").hide();
	$("#mail_err").hide();
  }
  if (http_request_news.readyState == 4) 
  {
	 //alert(http_request_news.status);
	 if (http_request_news.status == 200) 
	 {
		$("#sending_mail").hide();
		result = http_request_news.responseText;
		//alert(result);
		if (result == "1")
		{
			$("#mail_send").fadeIn();
			$("#mail_err").fadeOut();	
		}
		else
		{
			$("#mail_err").fadeIn();
			$("#mail_send").fadeOut();
		}
	 }
	 else 
	 {
		//alert('There was a problem with the request.');
	 }
  }
}

function call_ajax_news(url,para)
{  
	//alert(url + "," + para);
	//$('#loadingdiv').show();
	//document.getElementById(divid1).innerHTML = '<img src="images/ajax-loader.gif" />';
	JmakePOSTRequest_news(url,para);
}