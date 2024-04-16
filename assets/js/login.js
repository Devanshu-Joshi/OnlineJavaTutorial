function validate()
{
    if(document.myform.txtunm.value == "" && document.myform.txtpwd.value == "")
    {
        alert("Please Enter Username and Password First");
        return false;
    }
}