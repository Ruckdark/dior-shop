var $ = document.querySelector.bind(document)
var $$ = document.querySelectorAll.bind(document)

var list = $(".slider .list")
var item = $$(".slider .list .item")
var dots = $$(".slider .dots li")
var prev = $("#prev")
var next = $("#next")

var active = 0
var itemLength = item.length - 1

next.onclick = function() {
    if (active + 1 > itemLength) {
        active = 0
    } else {
        active += 1
    }
    reloadSlider()
}

prev.onclick = function() {
    if (active - 1 < 0) {
        active = itemLength
    } else {
        active -= 1
    }
    reloadSlider()
}

var autoSlide = setInterval(() => {
    next.click()
}, 5000);

function reloadSlider() {
    var checkLeft = item[active].offsetLeft
    list.style.left = -checkLeft + "px"
    
    var lastActiveDots = $(".slider .dots li.active")
    lastActiveDots.classList.remove("active")
    
    var newActiveDots = dots[active]
    newActiveDots.classList.add("active")

    // De reset time khi nguoi dung click chon item bat ky
    clearInterval(autoSlide)
    autoSlide = setInterval(() => {
        next.click()
    }, 5000);
}

dots.forEach(function(li, key) {
    li.addEventListener("click", function() {
        active = key
        reloadSlider()
    })
})