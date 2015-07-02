using UnityEngine;
using UnityEngine.UI;
using System.Collections;

public class RegistrationScene : MonoBehaviour {
	public Button submitButton, backToLoginSceneButton;
	public InputField nameInputField, emailInsputField, passwordInputField, confirmPwInputField;
	public Text msg;

	void Awake()
	{

	}
	// Use this for initialization
	void Start () {


		emailInsputField.keyboardType = TouchScreenKeyboardType.EmailAddress;
		backToLoginSceneButton.onClick.AddListener(()=>{

			//back to login Scene
			Managers.Instance.SceneChage((int)Constant.SCENES.LOGINSCENE);
		});
		submitButton.onClick.AddListener(()=>{

			msg.text = "Loading..";

			if( !string.IsNullOrEmpty(nameInputField.text) && !string.IsNullOrEmpty(emailInsputField.text)
			   && !string.IsNullOrEmpty(passwordInputField.text) && !string.IsNullOrEmpty(confirmPwInputField.text))
			{
				if(passwordInputField.text.Equals(confirmPwInputField.text))
				{
					string [] arr = new string[3];
					arr[0] = nameInputField.text;
					arr[1] = emailInsputField.text;
					arr[2] = passwordInputField.text;

					Managers.Instance.DataContent.RequestAPI(Constant.API_REQUEST_TYPE.REGISTER_EMAIL,arr,CallBackAction);
					print ("working");
				}
				else{
					msg.text = "Password and Confirm password are not same";
					print ("Password and Confirm password are not same!!");
				}
			}
			else
			{
				msg.text = "Please Fill Up all the Informations";
				print ("Please Fill Up all the Informations!!");
			}
		});

	}
	private void CallBackAction(bool res, object obj)
	{
		if(!res){
			msg.text = "Duplicate Credentials, please fillup again";
			print("result didnt came back from server");
			return;
		}
		else{
			msg.text = "Successfully Created!";
		}
		
	}
	// Update is called once per frame
	void Update () {
	
	}
}
