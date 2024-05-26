function index(){
    document.location.href="index.php";
}
function signup(){
    document.location.href="signup.php";
}
function login(){
    document.location.href="Login.php";
}
function updateprofile(){
    document.location.href="updateprofile.php"
}
function results_search(){
    document.location.href="results_search.php"
}
function bienvenue()  {
    document.location.href="Bienvenue.php"
}
function subscription()  {
    document.location.href="subscription.php"
}
function tour_gratuit()  {
    document.location.href="tour_gratuit.php"
}

function rechercher() {
    var termeRecherche = document.getElementById('search').value;
    if (termeRecherche.length > 0) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('resultats').innerHTML = xhr.responseText;
            }
        };
        xhr.send('search=' + encodeURIComponent(termeRecherche));
    } else {
        document.getElementById('resultats').innerHTML = ''; // Efface les résultats si la recherche est vide
    }
}