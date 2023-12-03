var $ = document.querySelector.bind(document)
var $$ = document.querySelectorAll.bind(document)

var login = $("#login")
var register = $("#register")
var registerForm = $("#form-1")
var loginForm = $("#form-2")
var xMrak = $$(".form .xmark")

register.onclick = function() {
    registerForm.style.display = "block"
}

login.onclick = function() {
    loginForm.style.display = "block"
}

xMrak.forEach(function(element) {
    element.onclick = function() {
        registerForm.style.display = "none"
        loginForm.style.display = "none"
    }
})