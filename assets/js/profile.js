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