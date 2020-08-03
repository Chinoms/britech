
function _(id) {
	return document.getElementById(id);
}



function addUser() {
	event.preventDefault();
	_("saveuser").disabled = true;
	_("errorinfo").innerHTML = "<p class='text-danger'>Processing customer info . . .</div>";
	var userData = new FormData();
	userData.append("fullname", _("fullname").value);
	userData.append("username", _("username").value);
	userData.append("password", _("password").value);
	userData.append("gender", _("gender").value);
	userData.append("phone", _("phone").value);
	userData.append("accountnumber", _("accountnumber").value);
	userData.append("bank", _("bank").value);
	userData.append("dateregistered", _("dateregistered").value);
	userData.append("viplevel", _("viplevel").value);
	userData.append("referrer", _("referrer").value);
	userData.append("daysleft", _("daysleft").value);

	var ajax = new XMLHttpRequest();
	ajax.open("POST", "modules/adduser.php");
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			if (ajax.responseText == "useradded") {
				var ajaxFeedback = ajax.responseText;
				alert("User added succesfully.")
				window.location.assign("index.php");
				//_("errorinfo").innerHTML = ajaxFeedback;
				//window.location.assign("index.php");
				//setTimeout(redirectUser, 2000)

			} else if (ajax.responseText == "choosebank") {
				//alert("You must choose a bank.")
				_("errorinfo").innerHTML = "<p class='text-danger'>You must choose a bank</div>"
				_("saveuser").disabled = false;

			} else if (ajax.responseText == "choosereferrer") {
				_("errorinfo").innerHTML = "<p class='text-danger'>You must choose a referrer</div>"
				_("saveuser").disabled = false;

			} else if (ajax.responseText == "choosegender") {
				_("errorinfo").innerHTML = "<p class='text-danger'>You must choose a gender</div>"
				_("saveuser").disabled = false;

			} else if (ajax.responseText == "chooseviplevel") {
				_("errorinfo").innerHTML = "<p class='text-danger'>You must choose a gender</div>"
				_("saveuser").disabled = false;

			} else {
				var ajaxFeedback = ajax.responseText;
				if (ajaxFeedback == "usernameexists") {
					alert("There's an error somewhere. Check top of page for error");
					_("errorinfo").innerHTML = "<p class='text-danger'>Username already exists. Check user details.</div>"
					_("saveuser").disabled = false;
				}

			}
		}
	}
	ajax.send(userData);
}