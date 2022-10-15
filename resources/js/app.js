require('./bootstrap');

document.addEventListener('DOMContentLoaded', function() {
    let btn = document.getElementById("nav-open-button");
    btn.addEventListener("click", openNav);

    let closebtn = document.getElementById("button-close");
    closebtn.addEventListener("click", openNav);

    function openNav() {
        let x = document.getElementById("nav-menu");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            if (window.innerWidth < 1024){
                openNav();
            }
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
