var $ = document.querySelector.bind(document)
var $$ = document.querySelectorAll.bind(document)

var navItems = $$(".nav-item")
var bodyItems = $$(".body-item")

navItems.forEach(function (navItem, index) {
    var bodyItem = bodyItems[index]
    navItem.onclick = function () {
        $(".nav-item.active").classList.remove("active")
        this.classList.add("active")

        $(".body-item.active").classList.remove("active")
        bodyItem.classList.add("active")
    }
})