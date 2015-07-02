using UnityEngine;
using System.Collections;
using System.Collections.Generic;
using System;

public class APIDataManagement
{
	public LoginEmail loginEmail { get;   private set;}
	public Quiz quiz { get;  set;}
	public Dictionary<int,Quiz> QuizSet;
	public RegisterEmail registerEmail { get; private set;}
	public RegisterOrFB registerOrFB { get; private set ;}
	public TopScorer topScorer { get; private set;}
	public UpdateScore updateScore { get; private set;}
	public UserScore userScore { get; private set;}


	public APIDataManagement()
	{
		loginEmail = new LoginEmail ();
		quiz = new Quiz ();
		QuizSet = new Dictionary<int, Quiz>();
		registerEmail = new RegisterEmail ();
		registerOrFB = new RegisterOrFB ();
		topScorer = new TopScorer ();
		updateScore = new UpdateScore ();
		userScore = new UserScore ();

	}

	~APIDataManagement()
	{
		loginEmail = null;
		quiz = null;
		registerEmail = null;
		registerOrFB = null;
		topScorer = null;
		updateScore = null;
		userScore = null;
	}
}
