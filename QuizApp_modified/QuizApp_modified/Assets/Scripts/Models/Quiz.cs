using UnityEngine;
using System.Collections;

public class Quiz {

	public string _catId,_quiz_id,_flag,_image,_question,_total_answer,_video_url;
	private Answer [] ansArray = new Answer[4];
//	private string [][] _answer = new string[4][2]; 
	
	public string catId
	{
		get {return _catId;}
		set {_catId = value;}
	}
	public string quizId
	{
		get {return _quiz_id;}
		set {_quiz_id = value;}
	}
	public string flag
	{
		get {return flag;}
		set {flag = value;}
	}
	public string image
	{
		get {return image;}
		set {image = value;}
	}
	public string question
	{
		get {return _question;}
		set {_question = value;}
	}
	public string totalAnswer
	{
		get {return _total_answer;}
		set {_total_answer = value;}
	}
	public string videoUrl
	{
		get {return _video_url;}
		set {_video_url = value;}
	}
}
public class Answer
{
	private string _ans,_correct_ans;
	public string ans
	{
		get {return _ans;}
		set {_ans = value;}
	}
	public string correctAns
	{
		get {return _correct_ans;}
		set {_correct_ans = value;}
	}
}