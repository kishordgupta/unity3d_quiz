using UnityEngine.UI;
using UnityEngine;
using System.Collections;
using System;

//using Mono.Data.SqliteClient;
//using System.Data;
using System.Collections.Generic;
public class MainScene : MonoBehaviour
{

		public Button spinner, playAgain, accept, user, yes, no;
		public Image popUp, popUpLogOut, eduImage, mathImage, sciImage, geoImage;
		public Text loading, category, userName;
		public static string salt, sign;
		private static bool pressSpinner = false;
		GameObject sphere;

		void WheelCreation ()
		{
				sphere = GameObject.Find ("Sphere");
				sphere.renderer.material.color = Color.red;
				Mesh mesh = sphere.GetComponent<MeshFilter> ().mesh;
				Vector3[] basev = mesh.vertices;
				Vector2[] baseh = mesh.uv;
				bool[] side = new bool[basev.Length];
				print ("vertices " + basev.Length + " uv " + baseh.Length + " triangeles " + mesh.triangles.Length);
		}

		void Start ()
		{
//				WheelCreation ();
//		print (Convert.ToChar ("%C1").ToString () + "  baal hoice ");
				userName.text = PlayerPrefs.GetString (Constant.USER_NAME);
				playAgain.onClick.AddListener (() => {
			
						print ("hide popup");
						hidePopup ();
				});
				user.onClick.AddListener (() => {
						showPopUpLogout ();
					
				});
				yes.onClick.AddListener (() => {
						hidePopUpLogOut ();
						Managers.Instance.LoggedOut ();
						Managers.Instance.SceneChage ((int)Constant.SCENES.LOGINSCENE);
				});
				no.onClick.AddListener (() => {
						hidePopUpLogOut ();
				});
				accept.onClick.AddListener (() => {

						loading.text = "Loading..";
						string [] arr = new string[2];
						arr [0] = PlayerPrefs.GetInt ("QuizCat").ToString ();
						Managers.Instance.DataContent.RequestAPI (Constant.API_REQUEST_TYPE.GET_QUIZ, arr, CallBackAction);
					
				});
				spinner.onClick.AddListener (() => {
						if (!pressSpinner) {
								pressSpinner = true;
								float timer = UnityEngine.Random.Range (2.5f, 4f);
								print (timer + "timer with float");
								iTween.RotateBy (GameObject.Find ("Wheel"), new Vector3 (0, 0, UnityEngine.Random.Range (-220, -360)), timer);
								Invoke ("CategorySelectShow", timer += 0.15f);
						}
				});
		}

		public void GoToScoreBoardScene ()
		{
				
				Managers.Instance.SceneChage ((int)Constant.SCENES.SCOREBOARD);
		}

		void CategorySelectShow ()
		{

				pressSpinner = false;
				RaycastHit2D hit = Physics2D.Raycast (Vector2.up, spinner.transform.position);
				if (hit.collider != null) {
						//			print ("wokring");
						if (hit.collider.tag == "Math") {
								category.text = "D Gray Man";
								PlayerPrefs.SetInt ("QuizCat", 1);
								print ("Math");
						}
						if (hit.collider.tag == "Education") {
								category.text = "Attack On Titan";
								PlayerPrefs.SetInt ("QuizCat", 2);
								print ("Education");
						}
					
						if (hit.collider.tag == "Geography") {
								category.text = "Fairy Tail";
								PlayerPrefs.SetInt ("QuizCat", 3);
								print ("Geography");
						}
						if (hit.collider.tag == "Science") {
								category.text = "One Piece";
								PlayerPrefs.SetInt ("QuizCat", 4);
								print ("Science");
						}
						showPopUp ();
			
						print (PlayerPrefs.GetInt ("QuizCat"));

						switch (PlayerPrefs.GetInt ("QuizCat")) {
						
						case 1:
								mathImage.GetComponent<Image> ().enabled = true;
								break;
						case 2:
								eduImage.GetComponent<Image> ().enabled = true;
								break;
						case 3:
								geoImage.GetComponent<Image> ().enabled = true;
								break;
						case 4:
								sciImage.GetComponent<Image> ().enabled = true;
								break;
						}
				}

		}

		void CallBackAction (bool res, object obj)
		{
				print ("Call back from action in wheel Scene");
				Managers.Instance.SceneChage ((int)Constant.SCENES.QUIZSCENE);


		}

		void showPopUpLogout ()
		{
				
		
				popUpLogOut.GetComponent<CanvasGroup> ().alpha = 1;
				popUpLogOut.GetComponent<CanvasGroup> ().interactable = true;
				popUpLogOut.GetComponent<CanvasGroup> ().blocksRaycasts = true;
		
		}

		void hidePopUpLogOut ()
		{
				popUpLogOut.GetComponent<CanvasGroup> ().alpha = 0;
				popUpLogOut.GetComponent<CanvasGroup> ().interactable = false;
				popUpLogOut.GetComponent<CanvasGroup> ().blocksRaycasts = false;
		}

		void showPopUp ()
		{
				print ("popup show");
		
				popUp.GetComponent<CanvasGroup> ().alpha = 1;
				popUp.GetComponent<CanvasGroup> ().interactable = true;
				popUp.GetComponent<CanvasGroup> ().blocksRaycasts = true;

		}

		void hidePopup ()
		{
				pressSpinner = false;
				popUp.GetComponent<CanvasGroup> ().alpha = 0;
				popUp.GetComponent<CanvasGroup> ().interactable = false;
				popUp.GetComponent<CanvasGroup> ().blocksRaycasts = false;

				sciImage.GetComponent<Image> ().enabled = false;
				eduImage.GetComponent<Image> ().enabled = false;

				geoImage.GetComponent<Image> ().enabled = false;
				mathImage.GetComponent<Image> ().enabled = false;
		
		

		}
		// Update is called once per frame
		void Update ()
		{
//			if()
		}
}
