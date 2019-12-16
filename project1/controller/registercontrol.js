var error = document.getElementById("lblError");

function validate()
{
    var username = document.getElementById('txtUsername').value;
    var email = document.getElementById('txtEmail').value;
    var password = document.getElementById('txtPassword').value;
    var confirm_password = document.getElementById('txtConfirmPass').value;

    if(username == "")
    {
        error.innerHTML = "Fill in the blank, please.";
    }
    else if(username.length < 3)
    {
        error.innerHTML = "Too Short";
    }
    else if(username.length > 20)
    {
        error.innerHTML = "Too long";
    }
}

// var username = document.forms['vform']['username'];
// var email = document.forms['vforms']['email'];
// var password = document.forms['vforms']['password'];
// var confirm_password = document.forms['vforms']['confirm_password'];

// var username_error = document.getElementById('username_error');
// var email_error = document.getElementById('email_error');
// var password_error = document.getElementById('password_error');

// username.addEventListener('blur',usernameVerify,true);
// password.addEventListener('blur',passwordVerify,true);
// email.addEventListener('blur',emailVerify,true);

// function validate()
// {
//     if(username.value=="")
//     {
//         username.style.border="1px solid red";
//         document.getElementById(username_div).style.color ="red";
//         name_error.textContent = "Fill in the blank, please";
//         username.focus();
//         return false;
//     }else if (username.value.length <5 || username.value.length >20){
//         username.style.border = "1px solid red";
//         document.getElementById(username_div).style.color ="red";
//         name.error.textContent = "Please Try Again";
//         username.focus();
//         return false;
//     }

//     if(email.value == "")
//     {
//         email.style.border = "1px solid red";
//         document.getElementById('email_div').style.color = "red";
//         email_error.textContent = "Fill in the blank, please";
//         email.focus();
//         return false;
//     }

//     if(password.value == "")
//     {
//         password.style.border = "1px solid red";
//         document.getElementById('password_div').style.color = "red";
//         password_confirm.style.border = "1px solid red";
//         password_error.textContent = "Fill in the blank, please";
//         password.focus();
//         return false;
//     }
//     if(password.value != confirm_password.value)
//     {
//         password.style.border = "1px solid red";
//         document.getElementById("confirm_password_div").style.color = "red";
//         password_confirm.style.border = "1px solid red";
//         password_error.innerHTML = "Something is not match";
//         return false;
//     }
// }

// function nameVerify(){
//     if (username.value != ""){
//         username.style.border = "1px solid #FFFF00";
//         document.getElementById('username_div').style.color = "#FFFF00";
//         name_error.innerHTML = "";
//         return true;
//     }
// }

// function emailVerify(){
//     if(email.value != ""){
//         email.style.border = "1px solid #FFFF00";
//         document.getElementById('email_div').style.color = "#FFFF00";
//         email_error.innerHTML = "";
//         return true;
//     }
// }

// function passwordVerify(){
//     if(password.value != ""){
//         password.style.border = "1px solid #FFFF00";
//         document.getElementById('confirm_password_div').style.color = "#FFFF00";
//         document.getElementById('password_div').style.color = "#FFFF00";
//         password_error.innerHTMl = "";
//         return true;
//     }if(password.value === confirm_password.value){
//         password.style.border = "1px solid #FFFF00";
//         document.getElementById('confirm_password_div').style.color = "#FFFF00";
//         password_error.innerHTML = "";
//         return true;
//     }
// }