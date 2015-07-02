using UnityEngine;
using System.Collections;


public class Managers : SingletonSystem<Managers> 
{
    private DataContentManagement _dataContent;
//    public DataContentManagement 
    public DataContentManagement DataContent { get { return _dataContent; } }


    public void Awake()
    {
        if (this != Instance)
        {
            Destroy (this);
            return;
        }
        DontDestroyOnLoad (this.gameObject);
        
        _dataContent   = this.transform.FindChild("DataManagement").GetComponent<DataContentManagement>();
    }


    ~Managers()
    {
        _dataContent = null;
    }
        
	public void SceneChage(int sceneNumber)
	{
		switch(sceneNumber)
		{
		case 0:
			Application.LoadLevel(Constant.LOGIN_SCENE);
			break;
		case 1:
			Application.LoadLevel(Constant.REGISTRATION_SCENE);
			break;
		case 2:
			Application.LoadLevel(Constant.MAIN_SCENE);
			break;
		case 3:
			Application.LoadLevel(Constant.QUIZ_SCENE);
			break;
		case 4:
			Application.LoadLevel(Constant.SCORE_SCENE);
			break;
		}

	}
	
	public void LoggedIn ()
	{
		PlayerPrefs.SetInt ("LoggedIn", 1);
	}
	
	public  void LoggedOut ()
	{
		PlayerPrefs.SetInt ("LoggedIn", 0);
	}
	
	public bool IsLoggedIn ()
	{
		if (PlayerPrefs.GetInt ("LoggedIn") == 1)
			return true;
		else
			return false;
	}
	public void ExitOnBackButton()
	{
		if (Input.GetKeyDown(KeyCode.Escape)) { 
			
		
			Application.Quit(); 
		}
	}
	void Update()
	{
		ExitOnBackButton();
	}
}
