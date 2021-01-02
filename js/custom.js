
function _(id) {
	return document.getElementById(id);
}


function fetchUserInfo() {
	event.preventDefault()
	userInfo = new FormData
	userInfo.append("userid", _("userid").value)
	
	//alert(_("userid").value);
	let ajax = new XMLHttpRequest()
	ajax.open("POST", "modules/fetchuserdata.php")
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			let feedback = ajax.responseText
			let userPayload = JSON.parse(feedback)
			console.log(userPayload)
			_("username").value = userPayload[0].username
			_("fullname").value = userPayload[0].fullname
			_("accountnumber").value = userPayload[0].accountnumber
			_("sortcode").value = userPayload[0].bank

		}
	}

	ajax.send(userInfo);
}


function filterUsersByDate() {
	event.preventDefault();
	dateParams = new FormData()
	dateParams.append("start", _("start").value)
	dateParams.append("end", _("end").value)
	dateParams.append("servicecenter", _("servicecenter").value)
	var ajax = new XMLHttpRequest();
	ajax.open("POST", "modules/filterbydate.php")
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			if (ajax.responseText !== "failed" || ajax.responseText !== "empty") {
				let feedback = ajax.responseText
				//alert(feedback)
				let recipient = JSON.parse(feedback)
				let select = _("recipient")
				//clear dropdown before populating it with new data
				//else, new data from the database will be appended to previously appended data


				let length = select.options.length;
				for (i = length - 1; i >= 0; i--) {
					select.options[i] = null;
				}


				for (var i = 0; i < recipient.length; i++) {
					select.innerHTML = select.innerHTML +
						'<option value="' + recipient[i].ID + '">' + recipient[i].fullname + '</option>'
				}
			}
		}
	}
	ajax.send(dateParams)
}



function addUser() {
	event.preventDefault();
	_("saveuser").disabled = true;
	_("errorinfo").innerHTML = "<p class='text-danger'>Processing customer info . . .</div>";
	var userData = new FormData();
	//alert(_("servicecenter").value)
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
	userData.append("servicecenter", _("servicecenter").value);

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