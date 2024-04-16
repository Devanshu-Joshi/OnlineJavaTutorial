function adjustSize() {
    const textBox = document.querySelectorAll(".textLabel");
    textBox.forEach(text => {
        textLength = text.value.length;
        text.setAttribute("size", textLength + 1);
    })
}

function validate() {

    // E-Mail Validation
    var x = document.getElementById("eid").value;
    var atposition = x.indexOf("@");
    var dotposition = x.lastIndexOf(".");
    if (atposition < 1 || dotposition < atposition + 2 || dotposition + 2 >= x.length) {
        alert("Please Enter a Valid E-Mail Address");
        return false;
    }

    // Mobile-Number Validation
    var num = document.getElementById("num").value;
    if (isNaN(num) || num.length < 10 || num.length > 10) {
        alert("Please Enter A Valid Mobile-Number");
        return false;
    }
    else
    {
        return true;    
    }
}

let isEditing = false;
let oldEvent = null;
let oldText = null;

let textBoxes = document.querySelectorAll(".content__edit");
textBoxes.forEach(label => {
    label.addEventListener("click", (e) => {
        const textID = e.target.getAttribute('data-id');
        const textBox = document.getElementById(textID);

        if (e.target.innerHTML == "Edit") {
            if(isEditing)
            {
                oldEvent.target.innerHTML = "Edit";
                const oldTextID = oldEvent.target.getAttribute('data-id');
                const oldTextBox = document.getElementById(oldTextID);
                oldTextBox.setAttribute("readonly", true);
                oldTextBox.style.border = "none";
                oldTextBox.value = oldText;
            }
            e.target.innerHTML = "Submit";
            textBox.style.border = "2px solid black";
            textBox.removeAttribute("readonly");
            textBox.focus();
            textBox.select();
            oldEvent = e;
            isEditing = true;
            oldText = textBox.value;
        }
        else if (e.target.innerHTML == "Submit") {
            if(!textBox.value.length < 1)
            {
                if(validate())
                {
                    e.target.innerHTML = "Edit";
                    textBox.setAttribute("readonly", true);
                    textBox.style.border = "none";
                    isEditing = false;
                    let content = textBox.value;
                    window.location.href = "../php/changes.php?changes="+content+"&id="+textID;
                }
            }
            else
            {
                alert("Please, Fill-Up The Field , Blank Field is Not Allowed");
            }
        }
    })
})