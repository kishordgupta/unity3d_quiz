using UnityEngine;
using System.Collections;

public class UpdateScore {

	private string _catId;
	private string _userId;
	private string _score;
	
	
	
	public string catId
	{
		get {return _catId;}
		set {_catId = value;}
	}
	
	public string userId
	{
		get {return _userId;}
		set {_userId = value;}
	}
	public string score
	{
		get {return _score;}
		set {_score = value;}
	}
}
