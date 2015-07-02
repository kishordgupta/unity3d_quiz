using UnityEngine;
using UnityEngine.UI;
using System.Collections;
using System;
using System.Collections.Generic;

public class LoginScene : MonoBehaviour
{

		public Button loginFacebookButton, loginEmailButton, registrationButton, backButton, submitButton ;
		public InputField userName, passWord;
		public Image popUp;
		public Text msg, fbMsg;
		private string lastResponse;
		private  string strMsg;
		// Use this for initialization
		void Start ()
		{
				if (Managers.Instance.IsLoggedIn ())
						LogInToMainScene ();
				else {
						FB.Init (SetInit, OnHideUnity);
						msg.text = "";
						registrationButton.onClick.AddListener (() => {
								Managers.Instance.SceneChage ((int)Constant.SCENES.REGISTRATIONSCENE);
						});

						loginEmailButton.onClick.AddListener (() => {

								popUp.GetComponent<CanvasGroup> ().alpha = 1;
								popUp.GetComponent<CanvasGroup> ().blocksRaycasts = true;
								popUp.GetComponent<CanvasGroup> ().interactable = true;

						});

						loginFacebookButton.onClick.AddListener (() => {
								CallFBLogin ();
						
						});
						backButton.onClick.AddListener (() => {
								popUp.GetComponent<CanvasGroup> ().alpha = 0;
								popUp.GetComponent<CanvasGroup> ().blocksRaycasts = false;
								popUp.GetComponent<CanvasGroup> ().interactable = false;
						});
			
						submitButton.onClick.AddListener (() => {
								msg.text = "Loading..";
								if (string.IsNullOrEmpty (userName.text) || string.IsNullOrEmpty (passWord.text)) {
										msg.text = "Email Or Password Is empty";
										print ("empty");
								} else {
										print (passWord.text + " pass and user " + userName.text);
							
										string [] arr = new string[2];
										arr [0] = userName.text;
										arr [1] = passWord.text;
										Managers.Instance.DataContent.RequestAPI (Constant.API_REQUEST_TYPE.LOGIN_EMAIL, arr, CallBackAction);
								}
						});
				}
		}

		private void CallFBLogin ()
		{
				FB.Login ("email,publish_actions", FBLoginCallback);
		}
	
		void FBLoginCallback (FBResult result)
		{
				if (result.Error != null) {
						fbMsg.text = "INVALID LOGIN CREDENTIALS from facebook";
						lastResponse = "Error Response:\n" + result.Error;
				} else if (!FB.IsLoggedIn) {
						fbMsg.text = "Not VALID LOGIN CREDENTIALS facebook";
						lastResponse = "Login cancelled by Player";
				} else {
						print ("Result " + result.Text);
						lastResponse = "Login was successful!";
						fbMsg.text = "Loading..";
//						fbMsg.text = result.Text;
						Dictionary<string, object> getJSON = new Dictionary<string, object> ();      
						getJSON = MiniJSON.Json.Deserialize (result.Text) as Dictionary<string, object>;
						foreach (KeyValuePair<string,object> value in getJSON as Dictionary<string,object>) {
								if (value.Key.Equals ("access_token")) {
										string [] arr = new string[1];
										arr [0] = value.Value.ToString ();
										Managers.Instance.DataContent.RequestAPI (Constant.API_REQUEST_TYPE.GRAPH_FACEBOOK, arr, CallBackFromFacebook);
								}
						}
			
				}
		}

		private void CallBackFromFacebook (bool res, object obj)
		{
				fbMsg.text = "Loading..";
				string [] arr = new string[3];
				foreach (KeyValuePair<string,object> value in obj as Dictionary<string,object>) {
						if (value.Key == "id") {
								arr [0] = value.Value.ToString ();
						} else if (value.Key == "email") 
								arr [1] = value.Value.ToString ();
						else  if (value.Key == "first_name") {
								if (String.IsNullOrEmpty (value.Value.ToString ()))
										arr [2] = "Welcome";
								else
										arr [2] = value.Value.ToString ();
						}
					
						
				}
				System.Text.StringBuilder sb = new System.Text.StringBuilder ();
				for (int i = 0; i < 3; i++) {
						sb.AppendLine (arr [i]);
				}
				Managers.Instance.DataContent.RequestAPI (Constant.API_REQUEST_TYPE.REGISTER_FB_USER, arr, CallBackFromRegisteringFBUser);
		}

		private void CallBackFromRegisteringFBUser (bool res, object obj)
		{
				fbMsg.text = "Loading from facebook..";
				if (!res) {
						fbMsg.text = "INVALID FB ID";
						return;
				} else {
			
						fbMsg.text = "Loading from facebook successfully..";
						foreach (KeyValuePair<string,object > values in obj as Dictionary<string,object>) {
								print ("data from login " + values.Key + "  value  " + values.Value);
								if (values.Key.Equals ("uid"))
										PlayerPrefs.SetString (Constant.USER_ID, values.Value.ToString ());
								if (values.Key.Equals ("username"))
										PlayerPrefs.SetString (Constant.USER_NAME, values.Value.ToString ());
						}
						Managers.Instance.LoggedIn ();
						LogInToMainScene ();
					
				}
			
		}

		private void LogInToMainScene ()
		{
				Managers.Instance.SceneChage ((int)Constant.SCENES.MAINSCENE);
		}

		private void SetInit ()
		{
				enabled = true; 
				// "enabled" is a magic global; this lets us wait for FB before we start rendering
		}
	
		private void OnHideUnity (bool isGameShown)
		{
				if (!isGameShown) {
						// pause the game - we will need to hide
						Time.timeScale = 0;
				} else {
						// start the game back up - we're getting focus again
						Time.timeScale = 1;
				}
		}

		private void CallBackAction (bool res, object obj)
		{
				if (!res) {
						msg.text = "INVALID LOGIN CREDENTIALS";
						print ("result didnt came back from server");
						return;
				} else {

						msg.text = "Loading";
						foreach (KeyValuePair<string,object > values in obj as Dictionary<string,object>) {
								print ("data from login " + values.Key + "  value  " + values.Value);
								if (values.Key.Equals ("user_id"))
										PlayerPrefs.SetString (Constant.USER_ID, values.Value.ToString ());
								if (values.Key.Equals ("username"))
										PlayerPrefs.SetString (Constant.USER_NAME, values.Value.ToString ());
						}
						Managers.Instance.LoggedIn ();
						LogInToMainScene ();
				}

		}

		public void GuestLoginAction ()
		{
				msg.text = "Loading";
	
				PlayerPrefs.SetString (Constant.USER_ID, "51");
	
				PlayerPrefs.SetString (Constant.USER_NAME, "Guest");
	
				Managers.Instance.LoggedIn ();
				LogInToMainScene ();
		}
		// Update is called once per frame
		void Update ()
		{
	
		}
}
