using UnityEngine;
using System.Collections;

public class RegisterEmail{

	private string _userName;
	private string _email;
	private string _passWord;
	private string _confirmPassword;
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

	public string passWord
	{
		get {return _passWord;}
		set {_passWord = value;}
	}
}
