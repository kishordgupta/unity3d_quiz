
using UnityEngine;
using System.Collections;
using System;

//using Mono.Data.SqliteClient;
//using System.Data;
using System.Collections.Generic;
using MiniJSON;

public class DataContentManagement : SingletonSystem<DataContentManagement>
{
		public APIDataManagement API { get; set; }

		static int counter = 0;
		private Action<bool, object> APIResult;
		private bool AccessTrue;
		private bool m_AccessWait;
		private float m_Time;
		private float m_AllDeltaTime;
		public string m_ServerConnectResult;
		public float TryConnectTime = 0f;
		public const float NetWorkTimeOut = 5.0f;
		public Dictionary<string,object> quesData;
		public static Dictionary<int,Dictionary<string,object>> arrayOfQuesData = new Dictionary<int,Dictionary<string,object> > ();

		void Start ()
		{
//		string constr="URI=file:NPCMaster.db";
//		IDbConnection dbCon;
//
//		dbCon = (IDbConnection) new SqliteConnection(constr);
//		dbCon.Open();
		}

		void Awake ()
		{
				if (this != Instance) {
						Destroy (this);
						return;
				}
				DontDestroyOnLoad (this.gameObject);
				API = new APIDataManagement ();
		}

		public void RequestAPI (Constant.API_REQUEST_TYPE _request =Constant.API_REQUEST_TYPE.NONE, string[] array =null, Action<bool, object> _result = null)
		{
				if (_request == Constant.API_REQUEST_TYPE.NONE)
						return;
		
				if (_result != null)
						APIResult = _result;
		
				AccessTrue = false;
		
				TryConnectTime = 0f;
		
				switch (_request) {
				case Constant.API_REQUEST_TYPE.LOGIN_EMAIL:
						StartCoroutine (LoginEmailWWW (array));
						break;
				case Constant.API_REQUEST_TYPE.REGISTER_EMAIL:
						StartCoroutine (RegisterWWW (array));
						break;
				case Constant.API_REQUEST_TYPE.GET_QUIZ:
						StartCoroutine (GetQuizWWW(array));
						break;
				case Constant.API_REQUEST_TYPE.GRAPH_FACEBOOK:
						StartCoroutine (GraphFacebookWWW (array));
						break;
				case Constant.API_REQUEST_TYPE.REGISTER_FB_USER:
						StartCoroutine (RegisterFBUser (array));
						break;
				case Constant.API_REQUEST_TYPE.UPDATE_SCORE:
						StartCoroutine (UpdateScore (array));
						break;
				case Constant.API_REQUEST_TYPE.IMAGE_URL:
						StartCoroutine (ImageGrab (array));
						break;
				}
		}
	#region ImageGrab
		private IEnumerator ImageGrab (string[] arr)
		{
				WWW www = new WWW (arr [0]);
				yield return www;

				print (" image texture" + www.texture);
				if (APIResult != null)
						APIResult (true, www);
//				if (TryConnectTime > NetWorkTimeOut) {
//						TryConnectTime = 0f;
//			
//						Debug.Log (TryConnectTime);
//			
//						//TODO: NetWorkTimeOutError
//						if (APIResult != null)
//								APIResult (false, null);
//			
//						yield break;
//				}
//		
//				TryConnectTime += 0.2f;
//		
//				yield return new WaitForSeconds (0.2f);
//				try {
//						if (!CheckError (www))
//								yield break;
//			
//						if (getJSON ["success"].Equals ("1")) {
//								if (APIResult != null)
//										APIResult (true, www);
//								yield break;
//						} else {
//								APIResult (false, null);
//								//TODO: APIResultError
//								yield break;
//						}
//				} catch {
//			
//						if (APIResult != null)
//								APIResult (false, null);
//				}
		}
	#endregion
	#region UpdateScore
		private IEnumerator UpdateScore (string[] arr)
		{
				Dictionary<string, object> getJSON = new Dictionary<string, object> ();      
				object getObject = new object ();
				string salt = MD5Generator.Salt ();
		
				while (getJSON.Count == 0) {
						WWWForm wwwform = new WWWForm ();
						wwwform.AddField ("api", Constant.UpdateScore);
						wwwform.AddField ("sign", MD5Generator.Sign (salt));
						wwwform.AddField ("salt", salt);
						wwwform.AddField ("cat_id", arr [0]);
						wwwform.AddField ("user_id", arr [1]);
						wwwform.AddField ("score", arr [2]);
			
			
						WWW www = new WWW (Constant.API_URL, wwwform);
			
						yield return www;
			
			
						try {
								getJSON = MiniJSON.Json.Deserialize (www.text) as Dictionary<string, object>;
								getObject = getJSON ["data"];
				
						} catch {
								if (getObject == null)
										getJSON.Clear ();
						}
			
						if (TryConnectTime > NetWorkTimeOut) {
								TryConnectTime = 0f;
				
								Debug.Log (TryConnectTime);
				
								//TODO: NetWorkTimeOutError
								if (APIResult != null)
										APIResult (false, null);
				
								yield break;
						}
			
						TryConnectTime += 0.2f;
			
						yield return new WaitForSeconds (0.2f);
				}
				try {
						if (!CheckError (getObject))
								yield break;
			
						if (getJSON ["success"].Equals ("1")) {
								if (APIResult != null)
										APIResult (true, getObject);
								yield break;
						} else {
								APIResult (false, null);
								//TODO: APIResultError
								yield break;
						}
				} catch {
			
						if (APIResult != null)
								APIResult (false, null);
				}
		}
	#endregion



	#region RegisterFBUser
		private IEnumerator RegisterFBUser (string[] arr)
		{
				Dictionary<string, object> getJSON = new Dictionary<string, object> ();      
				object getObject = new object ();
				string salt = MD5Generator.Salt ();
		
				while (getJSON.Count == 0) {
						WWWForm wwwform = new WWWForm ();
						wwwform.AddField ("api", Constant.RegisterOrLoginFB);
						wwwform.AddField ("sign", MD5Generator.Sign (salt));
						wwwform.AddField ("salt", salt);
						wwwform.AddField ("email", arr [1]);
						wwwform.AddField ("username", arr [2]);
						wwwform.AddField ("facebook_id", arr [0]);
			
			
						WWW www = new WWW (Constant.API_URL, wwwform);
			
						yield return www;
			
			
						try {
								getJSON = MiniJSON.Json.Deserialize (www.text) as Dictionary<string, object>;
								getObject = getJSON ["data"];
				
						} catch {
								if (getObject == null)
										getJSON.Clear ();
						}
			
						if (TryConnectTime > NetWorkTimeOut) {
								TryConnectTime = 0f;
				
								Debug.Log (TryConnectTime);
				
								//TODO: NetWorkTimeOutError
								if (APIResult != null)
										APIResult (false, null);
				
								yield break;
						}
			
						TryConnectTime += 0.2f;
			
						yield return new WaitForSeconds (0.2f);
				}
				try {
						if (!CheckError (getObject))
								yield break;
						print (getJSON ["success"]);
			
						if (getJSON ["success"].Equals ("OK")) {
								print ("success");
								if (APIResult != null)
										APIResult (true, getObject);
								yield break;
						} else {
								APIResult (false, null);
								//TODO: APIResultError
								yield break;
						}
				} catch {
			
						if (APIResult != null)
								APIResult (false, null);
				}
		}
	#endregion
	#region graphfacebook
		private IEnumerator GraphFacebookWWW (string[] accessToken)
		{
				Dictionary<string, object> getJSON = new Dictionary<string, object> ();      
				object getObject = new object ();
				string salt = MD5Generator.Salt ();
		
				while (getJSON.Count == 0) {
			
			
						WWW www = new WWW (Constant.GRAPH_FACEBOOK_URL + accessToken [0]);
			
						yield return www;
			
			
						try {
								getJSON = MiniJSON.Json.Deserialize (www.text) as Dictionary<string, object>;
				
						} catch {
								if (getObject == null)
										getJSON.Clear ();
						}
			
						if (TryConnectTime > NetWorkTimeOut) {
								TryConnectTime = 0f;
				
								Debug.Log (TryConnectTime);
				
								//TODO: NetWorkTimeOutError
								if (APIResult != null)
										APIResult (false, null);
				
								yield break;
						}
			
						TryConnectTime += 0.2f;
			
						yield return new WaitForSeconds (0.2f);
				}
				try {
						if (!CheckError (getObject))
								yield break;
						if (APIResult != null)
								APIResult (true, getJSON);
						
				} catch {
			
						if (APIResult != null)
								APIResult (false, null);
				}

		}
	#endregion
	#region LoginWWW
		private IEnumerator LoginEmailWWW (string[] arr)
		{
				Dictionary<string, object> getJSON = new Dictionary<string, object> ();      
				object getObject = new object ();
				string salt = MD5Generator.Salt ();

				while (getJSON.Count == 0) {
						WWWForm wwwform = new WWWForm ();
						wwwform.AddField ("api", Constant.LoginEmail);
						wwwform.AddField ("sign", MD5Generator.Sign (salt));
						wwwform.AddField ("salt", salt);
						wwwform.AddField ("email", arr [0]);
						wwwform.AddField ("password", arr [1]);
				

						WWW www = new WWW (Constant.API_URL, wwwform);
			
						yield return www;
			
		
						try {
								getJSON = MiniJSON.Json.Deserialize (www.text) as Dictionary<string, object>;
								getObject = getJSON ["data"];
								print ("data from login " + getObject);
								
						} catch {
								if (getObject == null)
										getJSON.Clear ();
						}
			
						if (TryConnectTime > NetWorkTimeOut) {
								TryConnectTime = 0f;
				
								Debug.Log (TryConnectTime);
				
								//TODO: NetWorkTimeOutError
								if (APIResult != null)
										APIResult (false, null);
				
								yield break;
						}
			
						TryConnectTime += 0.2f;
			
						yield return new WaitForSeconds (0.2f);
				}
				try {
						if (!CheckError (getObject))
								yield break;
						print (getJSON ["success"]);

						if (getJSON ["success"].Equals ("OK")) {
								print ("success");
								if (APIResult != null)
										APIResult (true, getObject);
								yield break;
						} else {
								APIResult (false, null);
								print ("success with invalid ");
								//TODO: APIResultError
								yield break;
						}
				} catch {
					
						if (APIResult != null)
								APIResult (false, null);
				}
		}
	#endregion
	#region GetQuiz
	private IEnumerator GetQuizWWW (string[] arr)
		{
				Dictionary<string, object> getJSON = new Dictionary<string, object> ();    
				Dictionary <string,string> gJsonData = new Dictionary<string, string> ();    
				object getObject = new object ();
				string salt = MD5Generator.Salt ();
				while (getJSON.Count == 0) {
						WWWForm wwwform = new WWWForm ();
						wwwform.AddField ("api", Constant.GetQuiz);
						wwwform.AddField ("sign", MD5Generator.Sign (salt));
						wwwform.AddField ("salt", salt);
						wwwform.AddField ("cat_id", arr[0]);
			
						WWW www = new WWW (Constant.API_URL, wwwform);
			
						yield return www;

						try {
								//01847123583
								getJSON = MiniJSON.Json.Deserialize (www.text) as Dictionary<string, object>;

								List<object> ob = getJSON ["data"] as List<object>;
								arrayOfQuesData.Clear ();
								for (int i=0; i< ob.Count; i++) {
										quesData = new Dictionary<string,object > ();
										foreach (KeyValuePair<string, object> en in ob[i] as Dictionary<string,object>) {

												if (en.Key.ToString ().Equals ("answer")) {
														quesData.Add (en.Key.ToString (), en.Value as List<object>);
														
												} else
														quesData.Add (en.Key.ToString (), en.Value as String);
						
										}
										arrayOfQuesData.Add (i, quesData);
								}

							

						} catch {
								if (getObject == null)
										getJSON.Clear ();
						}
			
						if (TryConnectTime > NetWorkTimeOut) {
								TryConnectTime = 0f;
				
								Debug.Log (TryConnectTime);
				
								//TODO: NetWorkTimeOutError
								if (APIResult != null) {
										print ("Network Error");
										APIResult (false, null);
								}
								yield break;
						}
			
						TryConnectTime += 0.2f;
			
						yield return new WaitForSeconds (0.2f);
				}
				try {
						if (!CheckError (getObject))
								yield break;

						var resData = MiniJSON.Json.Deserialize (MiniJSON.Json.Serialize (getObject)) as Dictionary<string,  object>;

						if (getJSON ["success"].Equals ("1")) {
								if (APIResult != null)
										APIResult (true, null);
								yield break;
						} else {
								APIResult (false, null);
								//TODO: APIResultError
								yield break;
						}
				} catch {
						
						if (APIResult != null)
								APIResult (false, null);
				}
		}
	#endregion endGetQuiz



	#region Registration
		private IEnumerator RegisterWWW (string[] arr)
		{
				Dictionary<string, object> getJSON = new Dictionary<string, object> ();      
				object getObject = new object ();
				string salt = MD5Generator.Salt ();
		
				while (getJSON.Count == 0) {
						WWWForm wwwform = new WWWForm ();
						wwwform.AddField ("api", Constant.RegisterEmail);
						wwwform.AddField ("sign", MD5Generator.Sign (salt));
						wwwform.AddField ("salt", salt);
						wwwform.AddField ("username", arr [0]);
			
						wwwform.AddField ("email", arr [1]);
						wwwform.AddField ("password", arr [2]);
			
			
						WWW www = new WWW (Constant.API_URL, wwwform);
			
						yield return www;
			
			
						try {
								getJSON = MiniJSON.Json.Deserialize (www.text) as Dictionary<string, object>;
								print (www.text);
								getObject = getJSON ["error_code"];
						} catch {
								if (getObject == null)
										getJSON.Clear ();
						}
			
						if (TryConnectTime > NetWorkTimeOut) {
								TryConnectTime = 0f;
				
								Debug.Log (TryConnectTime);
				
								//TODO: NetWorkTimeOutError
								if (APIResult != null)
										APIResult (false, null);
				
								yield break;
						}
			
						TryConnectTime += 0.2f;
			
						yield return new WaitForSeconds (0.2f);
				}
				try {
						if (!CheckError (getObject))
								yield break;
						print (getJSON ["success"]);
			
						if (getJSON ["success"].Equals ("OK")) {
								print ("success");
								if (APIResult != null)
										APIResult (true, null);
								yield break;
						} else {
								print ("success with invalid ");
								//TODO: APIResultError
								yield break;
						}
				} catch {
						//AppError
						//			Managers.Instance.SystemContent.OpenPopup(MessagePopupTarget.Message, 0);
			
						if (APIResult != null)
								APIResult (false, null);
				}
				print (APIResult);
		}
	#endregion Register
		public bool CheckError (object errorObject)
		{
				var errorList = MiniJSON.Json.Deserialize (errorObject.ToString ()) as List<object>;
		
				if (errorList == null)
						return true;
		
				if (errorList.Count > 0) {
						foreach (var code in errorList) {
								Debug.Log (code.ToString ());
				
								int codeId = int.Parse (code.ToString ());

								if (APIResult != null)
										APIResult (false, null);
						}
			
						return false;
				}
		
				return true;
		}
}