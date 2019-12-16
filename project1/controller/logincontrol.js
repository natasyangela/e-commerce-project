function validateForm()
{
    var username = document.getElementById("ContextPlaceHolder1_Username").value;
    var password = document.getElementById("ContentPlaceHolder1_Password").value;

    if(username == "" && password =="")
    {
        alert("Fill in the blank, Please !!!");
        document.getElementById("ContentPlaceHolder1 _username").focus();
        return false;
    }
    else if(password == "")
    {
        alert("Fill in the blank, Please !!!");
        document.getElementById("ContentPlaceHolder1 _password").focus();
        return false;
    }
    else if (username =="")
    {
        alert("Fill in the blank, Please !!!");
        document.getElementById("ContentPlaceHolder1 _Username").focus();
        return false;
    }
    else if (username.length < 5 || username.length > 20)
    {
        alert("Fill in the blank, Please !!!");
        document.getElementById("ContentPlaceHolder1 _Username").focus();
        return false;
    }
    else if (password.length < 5 || password.length > 20)
    {
        alert("Fill in the blank, Please");
        document.getElementById("ContentPlaceHolder1_password").focus();
        return false;
    }
    else if(username.length == 0)
    {
        alert("Fill in the blank, Please !!");
        document.getElementById("ContentPlaceHolder1_username").focus();
        return false;
    }
    else if(password.length == 0)
    {
        alert("Fill in the blank, Please !!");
        document.getElementById("ContentPlaceHolder1_password").focus();
        return false; 
    }
    return true;
}