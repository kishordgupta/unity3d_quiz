using UnityEngine;
using System.Collections;

public class RegisterOrFB  {

	private string _userName;
	
	private string _email;
	private string _fbId;
	public string fbId
	{
		get { return _fbId; }
		set { _fbId = value; }
	}
	public string userName
	{
		get { return _userName; }
		set { _userName = value; }
	}
	
	public string email
	{
		get {return _email;}
		set {email = value;}
	}
	

}
