var SelectAge = document.getElementById("age");

//Create an age list to choose an age between 18 and 120
for (var i=18; i<=120; i++){
    var option= document.createElement("option");
    option.text = i;
    option.value = i;
    SelectAge.add(option);
}
document.getElementById('SignupForm').addEventListener('submit', function(event){
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirmPassword').value;
    var gender = document.getElementById('gender').value;
    var age = document.getElementById('age').value;
    var remember = document.getElementById('remember').checked;

    if(password !== confirmPassword){
        alert("Les mots de passe ne correspondent pas !");
        return;
    }
    var utilisateur = {
        username: username,
        password: password,
        gender: gender,
        age: age,
        remember: remember,
    };
    var utilisateurJSON = JSON.stringify(utilisateur);

    localStorage.setItem('utilisateur', utilisateurJSON);
    window.location.href="Bienvenue.html";
});
function index(){
    document.location.href="index.html"
}