const loginBtn = document.getElementById("loginBtn");
const signupBtn = document.getElementById("signupBtn");
const idField = document.getElementById("idField");
const nameField = document.getElementById("nameField");
const phoneField = document.getElementById("phoneField");
const title = document.getElementById("title");

loginBtn.addEventListener("click", function() {
    idField.style.maxHeight = "0";
    nameField.style.maxHeight = "0";
    phoneField.style.maxHeight = "0";
    title.innerHTML = "Log In";
    signupBtn.classList.add("disable");
    loginBtn.classList.remove("disable");
});

signupBtn.addEventListener("click", function() {
    idField.style.maxHeight = "60px";
    nameField.style.maxHeight = "60px";
    phoneField.style.maxHeight = "60px";
    title.innerHTML = "Sign Up";
    signupBtn.classList.remove("disable");
    loginBtn.classList.add("disable");
});
