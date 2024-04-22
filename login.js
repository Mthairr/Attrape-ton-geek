document.getElementById('LoginForm').addEventListener('submit', function(event){
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    localStorage.setItem('username', username);
    localStorage.setItem('password', password);

    window.location.href = "Profil.html"

});
function index(){
    document.location.href="index.html"
}