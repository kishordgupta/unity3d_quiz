using UnityEngine;
using UnityEngine.UI;
using System.Collections;

public class ScoreBoardScene : MonoBehaviour
{

		// Use this for initialization
		public Text MatheScore, LengeScore, SocialScore, CienciasScore, top1, top2, top3, top4;

		void Start ()
		{
				LengeScore.text = PlayerPrefs.GetInt ("LengueScore").ToString ();
		}

		public void BackToWheel ()
		{
				Managers.Instance.SceneChage ((int)Constant.SCENES.MAINSCENE);
		}
		// Update is called once per frame
		void Update ()
		{
	
		}
}
