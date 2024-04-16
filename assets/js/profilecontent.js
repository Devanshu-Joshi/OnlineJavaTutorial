window.onload = function() {
    let imgs = document.querySelectorAll(".img__content");
    imgs.forEach(img => {
        let height = img.offsetHeight;
        if (height > 350) {
            img.style.height = "350px";
            img.style.width = "auto";
        }
    });
}

function profile() {
    window.location.href = "profile.php";
}

function defaultimg() {
    let loginText = document.querySelectorAll(".loginText");
    loginText.forEach(log => {
        log.style.display = "none";
    });
    document.querySelector(".navigation__profile img").style.display = "inline-block";
    document.querySelector('.loginImg').style.display = "inline-block";
    var img = document.getElementById("profile");
    img.src = "../img/Default.png";
}

function customimg(path) {
    let loginText = document.querySelectorAll(".loginText");
    loginText.forEach(log => {
        log.style.display = "none";
    });
    document.querySelector('.navigation__profile img').style.display = "inline-block";
    document.querySelector('.loginImg').style.display = "inline-block";
    var img = document.getElementById("profile");
    img.src = path;
}