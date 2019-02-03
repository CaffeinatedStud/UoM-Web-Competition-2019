function redborder(id){
	id.style.borderColor="red";
}

function greenborder(id){
	id.style.borderColor="green";
}

function blurFunction(id){
	var obj = document.getElementById(id);
	if (!checkTextBlankById(id)){
		redborder(obj);
	}
	else{
		if (!checkEmailFormat()){
			redborder(obj);
		}
		else{
			greenborder(obj);
		}
	}
}

function checkTextBlankById(obj_id ,msg){
	var obj = document.getElementById(obj_id);
	if(obj.value.length ==0){
		redborder(obj);
		return false;
	}
	greenborder(obj);
	return true;
}

function checkPasswordEqual(){
	var strpass1=document.getElementById('password').value;
	var strpass2=document.getElementById('cpassword').value;
	var obj=document.getElementById('cpassword');
	if (strpass1 == strpass2){
		redborder(obj);
		return true;
	}
	greenborder(obj);
	return false;
}

function checkEmailFormat(){
	var obj = document.getElementById('email');
	var str = obj.value;
	var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	if (!pattern.test(str)){
		redborder(obj);
		return false;
	}
	greenborder(obj);
	return true;
}

function validateRegister(){
	var emailblank, usernameblank, passwordblank, cpasswordblank;
	emailblank=checkTextBlankById('email');
	usernameblank=checkTextBlankById('username');
	passwordblank=checkTextBlankById('password');
	cpasswordblank=checkTextBlankById('cpassword');
	if (emailblank==false){
		document.getElementById('email').placeholder="Email cannot be blank.";
	}
	if (usernameblank==false){
		document.getElementById('username').placeholder="Username cannot be blank.";
	}
	if (passwordblank==false){
		document.getElementById('password').placeholder="Password cannot be blank.";
	}
	else{
		if (cpasswordblank==false){
			document.getElementById('cpassword').placeholder="Please confirm password.";
		}
	}
	if (!checkPasswordEqual()){
		document.getElementById('cpassword').placeholder="Passwords do not match. Try again.";
	}
	if (!checkEmailFormat){
		document.getElementById('email').value="";
		document.getElementById('email').placeholder="Invalid email format.";
	}
	if (emailblank==true && usernameblank==true && passwordblank==true && cpasswordblank==true && checkPasswordEqual() && checkEmailFormat()){
		return true;
	}
	return false;
}

function validateLogin(){
	var usernameblank,passwordblank;
	usernameblank=checkTextBlankById('username');
	passwordblank=checkTextBlankById('password');
	if (usernameblank==false){
		document.getElementById('username').placeholder="Please enter username.";
	}
	if (passwordblank==false){
		document.getElementById('password').placeholder="Please enter password.";
	}
	if (usernameblank==true && passwordblank==true){
		return true;
	}
	return false;
}

function incorrectUsername(){
	var obj=document.getElementById('username');
	redborder(obj);
	obj.value='';
	obj.placeholder="Incorrect username"
}