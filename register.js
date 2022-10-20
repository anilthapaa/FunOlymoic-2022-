var password = document.getElementById("password");
var confirmPassword = document.getElementById("confirm_password");
var passwordHints = document.getElementById("password-hints");
var hr = document.getElementById("hr");
var strengthMessage = document.getElementById("strength_message");
var submitButton = document.getElementById("btn-submit");


var minChar = document.getElementById("min_char");
var alphaNumeric = document.getElementById("alpha_numeric");
var upperLower = document.getElementById("upper_lower");
var specialChar = document.getElementById("special_char");

var upperCaseChars = "(.*[A-Z].*)";
var lowerCaseChars = "(.*[a-z].*)";
var numbers = "(.*[0-9].*)";
var specialChars = "(.*[`,~,!,@,#,$,%,^,&,*,-,_].*$)";

function passwordStrengthCheck() {
  
  if(password.value != ""){
    passwordHints.style.display = "block";
    hr.style.display = "block";
    strengthMessage.style.display="block";
    minCharCheck();
    alphaNumericCheck();
    upperLowerCaseCheck();
    specialCharCheck();
    weakPasswordStrengthMeter();
    moderatePasswordStrengthMeter();
    strongPasswordStrengthMeter();
  }
  else{
    passwordHints.style.display = "none";
    hr.style.display = "none";
    strengthMessage.style.display="none";
  }
}

function minCharCheck(){
  if((password.value).length >= 8){
    minChar.style.color = "green";
    minChar.classList.remove("fa-circle-xmark");
    minChar.classList.add("fa-circle-check");
    return true;
  }
  else{
    minChar.style.color = "red";
    minChar.classList.remove("fa-circle-check");
    minChar.classList.add("fa-circle-xmark");
    return false;
  }
}
function alphaNumericCheck(){
  if(((password.value).match(numbers) && (password.value).match(lowerCaseChars)) || ((password.value).match(numbers) && (password.value).match(upperCaseChars))){
    alphaNumeric.style.color = "green";
    alphaNumeric.classList.remove("fa-circle-xmark");
    alphaNumeric.classList.add("fa-circle-check");
    return true;
  }
  else{
    alphaNumeric.style.color = "red";
    alphaNumeric.classList.remove("fa-circle-check");
    alphaNumeric.classList.add("fa-circle-xmark");
    return false;
  }
}
function upperLowerCaseCheck(){
  if((password.value).match(upperCaseChars) && (password.value).match(lowerCaseChars)){
    upperLower.style.color = "green";
    upperLower.classList.remove("fa-circle-xmark");
    upperLower.classList.add("fa-circle-check");
    return true;
  }
  else{
    upperLower.style.color = "red";
    upperLower.classList.remove("fa-circle-check");
    upperLower.classList.add("fa-circle-xmark");
    return false;
  }
}
function specialCharCheck(){
  if((password.value).match(specialChars)){
    specialChar.style.color = "green";
    specialChar.classList.remove("fa-circle-xmark");
    specialChar.classList.add("fa-circle-check");
    return true;
  }
  else{
    specialChar.style.color = "red";
    specialChar.classList.remove("fa-circle-check");
    specialChar.classList.add("fa-circle-xmark");
    return false;
  }
}
function weakPasswordStrengthMeter(){
  if((alphaNumericCheck() && minCharCheck()) || (upperLowerCaseCheck() && minCharCheck())){
    hr.style.width = "50%";
    hr.style.borderColor = "#ffd43b";
    strengthMessage.innerHTML = "Weak"
    strengthMessage.style.color = "#ffd43b";
  }
  else{
    hr.style.borderColor = "red";
	  hr.style.width = "25%";
    strengthMessage.innerHTML = "Very Weak"
    strengthMessage.style.color = "red";
  }
}
function moderatePasswordStrengthMeter(){
  if((alphaNumericCheck() && minCharCheck() && upperLowerCaseCheck()) || (alphaNumericCheck() && minCharCheck() && specialCharCheck()) || (minCharCheck() && specialCharCheck())){
    hr.style.width = "75%";
    hr.style.borderColor = "orange";
    strengthMessage.innerHTML = "Moderate"
    strengthMessage.style.color = "orange";
  }
}
function strongPasswordStrengthMeter(){
  if((minCharCheck() && alphaNumericCheck() && upperLowerCaseCheck() && specialCharCheck())){
    hr.style.width = "100%";
    hr.style.borderColor = "green";
    strengthMessage.innerHTML = "Strong"
    strengthMessage.style.color = "green";
  }
}


function hidePasswordStrengthCheck(){
  passwordHints.style.display = "none";
}
