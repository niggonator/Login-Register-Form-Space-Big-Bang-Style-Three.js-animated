// Send Login
function login(event) {
event.preventDefault();

var email = document.getElementById('email').value;
var password = document.getElementById('password').value;

var xhr = new XMLHttpRequest();
xhr.open('POST', 'loginscript.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
xhr.onreadystatechange = function() {
if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    window.location.href = "#"; // Redirected Page
} else if (this.readyState === XMLHttpRequest.DONE) {
    alert("Login failed: " + this.responseText);
}
};
xhr.send('email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
}