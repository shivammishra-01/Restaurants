//navbar
let nav = document.querySelector(".navigation-wrap");
window.onscroll = function () {
    if (document.documentElement.scrollTop > 20) {
        nav.classList.add("scroll-on");
    } else {
        nav.classList.remove("scroll-on");
    }
}
let navBar = document.querySelectorAll('.nav-link');
let navCollapse = document.querySelector('.navbar-collapse.collapse');
console.log(navBar.length);
navBar.forEach(function (a) {
    a.addEventListener("click", function () {
        let pp = (a.id === "navbarDropdownMenuLink");
        if (!pp) {
            navCollapse.classList.remove("show");
        }
    })
});

//counter design
document.addEventListener("DOMContentLoaded", () => {
    function counter(id, start, end, duration) {
        let obj = document.getElementById(id),
            current = start,
            range = end - start,
            increament = end > start ? 1 : -1,
            step = Math.abs(Math.floor(duration / range)),
            timer = setInterval(() => {
                current += increament;
                obj.textContent = current;
                if (current == end) {
                    clearInterval(timer);
                }

            }, step)
    }
    let vv1 = document.getElementById("order").value;
    let vv2 = document.getElementById("user").value;
    let vv3 = document.getElementById("item").value;
    counter("count1", 0, vv1, 3000);
    counter("count2", 0, 100, 3000);
    counter("count3", 0, vv3, 3000);
    counter("count4", 0, vv2, 3000);
});
