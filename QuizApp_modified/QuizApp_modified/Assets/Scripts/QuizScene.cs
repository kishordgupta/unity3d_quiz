using UnityEngine;
using UnityEngine.UI;
using System.Collections;
using System.Collections.Generic;
using System;
using System.Web;
using System.IO;
using System.Net;
using System.Linq;
using System.Text;

public class QuizScene : MonoBehaviour
{

		private int a, playerScore;
		public Button ans1, ans2, ans3, ans4, questionImage, crossButton;
		public Text ques, ans1T, ans2T, ans3T, ans4T, timer, score;
		public Image completePopUp, largeImage, imageShow;
		public Button submit, back;
		public  Dictionary<string,string> ansData = new Dictionary<string,string > ();
		public  Dictionary<int,Dictionary<string,string>> arrayOfAnsData = new Dictionary<int,Dictionary<string,string> > ();
		public Sprite otherSprite, realSprite, backGround, sciBackGround, mathBackGround, eduBackGround, geoBackGround;
		float second = 0.0f;
		public int ansWithinSeconds, numberOfQuestions;
		private bool a1, a2, a3, a4 = false;
		private string[]correctAnswer = new string[4] ;
		private string[]submitAnswer = new string[4];
		public Color greenColor;
		// Use this for initialization
		void Start ()
		{
				a = 0;
				playerScore = 0;
				HidePopUp ();
				string [] arr = new string[2];
				arr [0] = "http://images.earthcam.com/ec_metros/ourcams/fridays.jpg";
				StartCoroutine (ImageShowIfExists (arr));
				QuestionShow (a);
				switch (PlayerPrefs.GetInt ("QuizCat")) {
				case 1:

						GameObject.Find ("Background").GetComponent<SpriteRenderer> ().sprite = mathBackGround;
						break;
				case 2:
						GameObject.Find ("Background").GetComponent<SpriteRenderer> ().sprite = eduBackGround;
						break;
				case 3:
						GameObject.Find ("Background").GetComponent<SpriteRenderer> ().sprite = geoBackGround;
						break;
				case 4:
						GameObject.Find ("Background").GetComponent<SpriteRenderer> ().sprite = sciBackGround;
						break;
				}
				questionImage.onClick.AddListener (() => {
			
						largeImage.GetComponent<CanvasGroup> ().alpha = 1;
						largeImage.GetComponent<CanvasGroup> ().blocksRaycasts = true;
						largeImage.GetComponent<CanvasGroup> ().interactable = true;
			
				});
				crossButton.onClick.AddListener (() => {
						largeImage.GetComponent<CanvasGroup> ().alpha = 0;
						largeImage.GetComponent<CanvasGroup> ().blocksRaycasts = false;
						largeImage.GetComponent<CanvasGroup> ().interactable = false;
				});
				ans1.onClick.AddListener (() => {

						if (!a1) {
								ans1.GetComponent<Image> ().sprite = otherSprite;
		
								submitAnswer [0] = "1";
								a1 = true;
						} else {
								ans1.GetComponent<Image> ().sprite = realSprite;
								a1 = false;
								submitAnswer [0] = "0";
				
				
						}
				});
				ans2.onClick.AddListener (() => {
			
						if (!a2) {
								ans2.GetComponent<Image> ().sprite = otherSprite;
								submitAnswer [1] = "1";
				
								a2 = true;
						} else {
								ans2.GetComponent<Image> ().sprite = realSprite;
								submitAnswer [1] = "0";
				
								a2 = false;
				
						}
				});
				ans3.onClick.AddListener (() => {
			
						if (!a3) {
								ans3.GetComponent<Image> ().sprite = otherSprite;
								submitAnswer [2] = "1";
				
								a3 = true;
						} else {
								ans3.GetComponent<Image> ().sprite = realSprite;
								submitAnswer [2] = "0";
				
								a3 = false;
				
						}
				});
				ans4.onClick.AddListener (() => {
			
						if (!a4) {
								ans4.GetComponent<Image> ().sprite = otherSprite;
								submitAnswer [3] = "1";
				
								a4 = true;
						} else {
								ans4.GetComponent<Image> ().sprite = realSprite;
								submitAnswer [3] = "0";
				
								a4 = false;
				
						}
				});

				back.onClick.AddListener (() => {
						Managers.Instance.SceneChage (2);
						print ("world");
				});
			
		}

		private IEnumerator ImageShowIfExists (string[] arr)
		{
			
//				Managers.Instance.DataContent.RequestAPI (Constant.API_REQUEST_TYPE.IMAGE_URL, arr, CallBackAction);

				WWW www = new WWW (arr [0]);
				yield return www;

				Sprite image = Sprite.Create (www.texture, new Rect (0, 0, www.texture.width, www.texture.height), new Vector2 (0.5f, 0.5f), 100);
				questionImage.GetComponent<Image> ().sprite = image;
				imageShow.GetComponent<Image> ().sprite = image;
		


		}

//		private void CallBackAction (bool res, object obj)
//		{
//				print ("Image came");
////				questionImage.GetComponent<Image> ().sprite = "";
//		}

		private void AnswerSubmited ()
		{
				timer.color = greenColor;
				//initialize array of CorrectAns and SubmitAns
				if (submitAnswer.SequenceEqual (correctAnswer)) {
						print ("correct ans ");
						playerScore++;

				} else {
						print ("Wrong ANswer!");
				}
				for (int k =0; k< 4; k++) {
						submitAnswer [k] = "0";
						correctAnswer [k] = "0";
				}
				second = 0.0f;
				a1 = false;
				ans1.GetComponent<Image> ().sprite = realSprite;
				a2 = false;
				ans2.GetComponent<Image> ().sprite = realSprite;
				a3 = false;
				ans3.GetComponent<Image> ().sprite = realSprite;
				a4 = false;
				ans4.GetComponent<Image> ().sprite = realSprite;
				
		}

		private void QuestionShow (int index)
		{
				Dictionary<string,object> Values;
				if (index < numberOfQuestions) {
						if (DataContentManagement.arrayOfQuesData.TryGetValue (index, out Values)) {		
								foreach (KeyValuePair<string,object> pr in Values as Dictionary<string,object>) {
										if (pr.Key.Equals ("answer")) {
												List<object> obc = pr.Value as List<object>;
												for (int i=0; i< obc.Count; i++) {
			
														foreach (KeyValuePair<string,object> list in obc[i] as Dictionary<string,object>) {

																switch (list.Key) {
																
																case "0":
																		ans1T.text = specialBaal (((list.Value.ToString ())));
																		 
																		break;
																case "1":
									
																		ans2T.text = specialBaal (((list.Value.ToString ())));
																		break;
																case "2":
									
																		ans3T.text = specialBaal (((list.Value.ToString ())));
																		break;
																case "3":
									
																		ans4T.text = specialBaal (((list.Value.ToString ())));
																		break;
																default:
																		correctAnswer [i] = list.Value.ToString ();
																		break;
																}
														}
												}
										}
				
										if (pr.Key.Equals ("question")) {
						
												ques.text = specialBaal ((((pr.Value.ToString ()))));
										}
							
				
								}
							
						}
				
						
				} else {
						ShowPopup ();
				}
		}

		private void ShowPopup ()
		{
				print ("Congrats");
				completePopUp.GetComponent<CanvasGroup> ().alpha = 1.0f;
				completePopUp.GetComponent<CanvasGroup> ().interactable = true;
				completePopUp.GetComponent<CanvasGroup> ().blocksRaycasts = true;
				score.text = playerScore.ToString () + "/" + numberOfQuestions.ToString ();
				UpdateScore ();
		
		}

		private void UpdateScore ()
		{
				string [] arr = new string[3];
				arr [0] = "2";
				arr [1] = PlayerPrefs.GetString (Constant.USER_ID);
				arr [2] = playerScore.ToString ();
				if (PlayerPrefs.GetInt ("LengueScore") < playerScore)
						PlayerPrefs.SetInt ("LengueScore", playerScore);
//				Managers.Instance.DataContent.RequestAPI (Constant.API_REQUEST_TYPE.UPDATE_SCORE, arr, CallBackActionFromServer);
		}

		private void CallBackActionFromServer (bool res, object obj)
		{
				
		}

		private void HidePopUp ()
		{
				completePopUp.GetComponent<CanvasGroup> ().alpha = 0.0f;
				completePopUp.GetComponent<CanvasGroup> ().interactable = false;
				completePopUp.GetComponent<CanvasGroup> ().blocksRaycasts = false;
		}

		public void SubmitButtonFunc ()
		{
				AnswerSubmited ();
				a++;
				QuestionShow (a);
		}

		public void PlayAgain ()
		{
				HidePopUp ();
				a = 0;
				second = 0.0f;
				playerScore = 0;
				QuestionShow (a);
				print ("Play from the start");
		}

		public void ScoreBoard ()
		{
				HidePopUp ();
				print ("ScoreBoard");
				Managers.Instance.SceneChage ((int)Constant.SCENES.SCOREBOARD);
		
		}
		// Update is called once per frame
		void Update ()
		{
				second += Time.deltaTime;
				if (Convert.ToInt32 (Math.Ceiling (second)) == ansWithinSeconds) {
						a++;
						QuestionShow (a);
				} else if (Convert.ToInt32 (Math.Ceiling (second)) >= ansWithinSeconds - 5)
						timer.color = Color.red;
				timer.text = Convert.ToInt32 (Math.Ceiling (second)).ToString () + "/" + ansWithinSeconds.ToString ();
				
		}

		private  string ReencodeText (string text)
		{
				Encoding encoding = Encoding.GetEncoding (1252);
				string text1252 = encoding.GetString (encoding.GetBytes (text));

				return text1252;
//				return text.Equals (text1252, StringComparison.Ordinal) ?
//			text : Convert.ToBase64String (Encoding.UTF8.GetBytes (text));
		}

	#region specialBaal

		string specialBaal (string _enter)
		{
				string _exit = _enter;
				string[] baalArray = new string[] {" ",
						"!",
						"\"",
						"#",
						"$",
						"%",
						"&",
						"'",
						"(",
						")",
						"*",
						"+",
						",",
						"-",
						".",
						"/",
						":",
						";",
						"<",
						"=",
						">",
						"?",
						"@",
						"[",
						"\\",
						"]",
						"^",
						"_",
						"`",
						"{",
						"|",
						"}",
						"~",
						"`",
						"‚",
						"ƒ",
						"„",
						"…",
						"†",
						"‡",
						"ˆ",
						"‰",
						"Š",
						"‹",
						"Œ",
						"Ž",
						"‘",
						"’",
						"“",
						"”",
						"•",
						"–",
						"—",
						"˜",
						"™",
						"š",
						"›",
						"œ",
						"ž",
						"Ÿ",
						"¡",
						"¢",
						"£",
						"¤",
						"¥",
						"¦",
						"§",
						"¨",
						"©",
						"ª",
						"«",
						"¬",
						"",
						"®",
						"¯",
						"°",
						"±",
						"²",
						"³",
						"´",
						"µ",
						"¶",
						"·",
						"¸",
						"¹",
						"º",
						"»",
						"¼",
						"½",
						"¾",
						"¿",
						"À",
						"Á",
						"Â",
						"Ã",
						"Ä",
						"Å",
						"Æ",
						"Ç",
						"È",
						"É",
						"Ê",
						"Ë",
						"Ì",
						"Í",
						"Î",
						"Ï",
						"Ð",
						"Ñ",
						"Ò",
						"Ó",
						"Ô",
						"Õ",
						"Ö",
						"×",
						"Ø",
						"Ù",
						"Ú",
						"Û",
						"Ü",
						"Ý",
						"Þ",
						"ß",
						"à",
						"á",
						"â",
						"ã",
						"ä",
						"å",
						"æ",
						"ç",
						"è",
						"é",
						"ê",
						"ë",
						"ì",
						"í",
						"î",
						"ï",
						"ð",
						"ñ",
						"ò",
						"ó",
						"ô",
						"õ",
						"ö",
						"÷",
						"ø",
						"ù",
						"ú",
						"û",
						"ü",
						"ý",
						"þ",
						"ÿ"," "," "," "
				};			
				string[] baalCopyArray = new string[] {"+",
						"%21",
						"%22",
						"%23",
						"%24",
						"%25",
						"%26",
						"%27",
						"%28",
						"%29",
						"%2A",
						"%2B",
						"%2C",
						"%2D",
						"%2E",
						"%2F",
						"%3A",
						"%3B",
						"%3C",
						"%3D",
						"%3E",
						"%3F",
						"%40",
						"%5B",
						"%5C",
						"%5D",
						"%5E",
						"%5F",
						"%60",
						"%7B",
						"%7C",
						"%7D",
						"%7E",
						"%81",
						"%82",
						"%83",
						"%84",
						"%85",
						"%86",
						"%87",
						"%88",
						"%89",
						"%8A",
						"%8B",
						"%8C",
						"%8E",
						"%91",
						"%92",
						"%93",
						"%94",
						"%95",
						"%96",
						"%97",
						"%98",
						"%99",
						"%9A",
						"%9B",
						"%9C",
						"%9E",
						"%9F",
						"%A1",
						"%A2",
						"%A3",
						"%A4",
						"%A5",
						"%A6",
						"%A7",
						"%A8",
						"%A9",
						"%AA",
						"%AB",
						"%AC",
						"%AD",
						"%AE",
						"%AF",
						"%B0",
						"%B1",
						"%B2",
						"%B3",
						"%B4",
						"%B5",
						"%B6",
						"%B7",
						"%B8",
						"%B9",
						"%BA",
						"%BB",
						"%BC",
						"%BD",
						"%BE",
						"%BF",
						"%C0",
						"%C1",
						"%C2",
						"%C3",
						"%C4",
						"%C5",
						"%C6",
						"%C7",
						"%C8",
						"%C9",
						"%CA",
						"%CB",
						"%CC",
						"%CD",
						"%CE",
						"%CF",
						"%D0",
						"%D1",
						"%D2",
						"%D3",
						"%D4",
						"%D5",
						"%D6",
						"%D7",
						"%D8",
						"%D9",
						"%DA",
						"%DB",
						"%DC",
						"%DD",
						"%DE",
						"%DF",
						"%E0",
						"%E1",
						"%E2",
						"%E3",
						"%E4",
						"%E5",
						"%E6",
						"%E7",
						"%E8",
						"%E9",
						"%EA",
						"%EB",
						"%EC",
						"%ED",
						"%EE",
						"%EF",
						"%F0",
						"%F1",
						"%F2",
						"%F3",
						"%F4",
						"%F5",
						"%F6",
						"%F7",
						"%F8",
						"%F9",
						"%FA",
						"%FB",
						"%FC",
						"%FD",
						"%FE",
						"%FF","%09","%0A","%0D"
				};
				for (var i = 0; i < baalArray.Length; i++) {
						_exit = _exit.Replace (baalCopyArray [i], baalArray [i]);
				}
		
				return _exit;
		}
		#endregion

}
