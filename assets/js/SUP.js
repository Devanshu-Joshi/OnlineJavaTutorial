function sup(emailText) {
    const modal = document.querySelector("[data-sup]");
    let email = document.getElementById("supContainer__email");
    email.innerHTML = emailText;
    modal.showModal();

    modal.addEventListener("click", e => {
        const dialogDimension = modal.getBoundingClientRect()

        if (
            e.clientX < dialogDimension.left ||
            e.clientX > dialogDimension.right ||
            e.clientY < dialogDimension.top ||
            e.clientY > dialogDimension.bottom
        ) {
            modal.close();
        }
    })
}

function storeData(unm, eid, pwd, num) {
    let txtunm = document.getElementById("txtunm");
    let txteid = document.getElementById("txteid");
    let txtpwd = document.getElementById("txtpwd");
    let txtnum = document.getElementById("txtnum");

    txtunm.value = unm;
    txteid.value = eid;
    txtpwd.value = pwd;
    txtnum.value = num;
}

function firstForm()
{
    let form = document.querySelector(".form");
    form.action = "SignUp.php?resend=true";
    form.submit();
}