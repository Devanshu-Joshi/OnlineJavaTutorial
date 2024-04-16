function validate() {

    // E-Mail Validation
    var x = document.getElementById("txteid").value;
    var atposition = x.indexOf("@");
    var dotposition = x.lastIndexOf(".");
    if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
        alert("Please Enter a Valid E-Mail Address");
        return false;
    }

    // Mobile-Number Validation
    var num = document.getElementById("txtnum").value;
    if (isNaN(num) || num.length < 10 || num.length > 10) {
        alert("Please Enter A Valid Mobile-Number");
        return false;
    }
    else
    {
        return true;    
    }
} 