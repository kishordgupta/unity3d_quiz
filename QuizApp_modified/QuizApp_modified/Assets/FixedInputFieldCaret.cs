
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.EventSystems;
using System.Collections;

public class FixedInputFieldCaret : MonoBehaviour, ISelectHandler {
	
	public void OnSelect(BaseEventData eventData) {
		InputField ipFld = gameObject.GetComponent<InputField>();
		if(ipFld != null) {
			RectTransform textTransform = (RectTransform)ipFld.textComponent.transform;
			RectTransform caretTransform = (RectTransform)transform.Find(gameObject.name+" Input Caret");
			if(caretTransform != null && textTransform != null) {
				caretTransform.localPosition = textTransform.localPosition;
			}
		}
	}
}