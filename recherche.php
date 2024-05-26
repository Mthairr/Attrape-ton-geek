<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    // Récupérer le terme de recherche
    $termeRecherche = $_POST['search'];

    // Chemin vers le dossier des images
    $dossierImages = 'img/';

    // Chemin vers le fichier texte
    $fichier = 'donnee/log.txt';

    // Vérifier si le fichier existe et si le terme de recherche n'est pas vide
    if (file_exists($fichier) && !empty($termeRecherche)) {
        // Lire le fichier ligne par ligne
        $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Initialiser un booléen pour vérifier si au moins un résultat a été trouvé
        $resultatTrouve = false;

        // Parcourir chaque ligne
        foreach ($lignes as $ligne) {
            // Ignorer l'en-tête (première ligne)
            if (strpos($ligne, 'pseudo|id|email') === false) {
                // Séparer les champs par le délimiteur ';'
                $champs = explode(';', $ligne);

                // Récupérer le pseudo (premier champ)
                $pseudo = $champs[0];

                // Vérifier si une image correspondante existe
                $cheminImage = $dossierImages . $pseudo . '.png';
                if (!file_exists($cheminImage)) {
                    $cheminImage = $dossierImages . $pseudo . '.jpg';
                }
                if (!file_exists($cheminImage)) {
                    $cheminImage = $dossierImages . $pseudo . '.jpeg';
                }

                // Afficher l'image de profil et le pseudo s'ils correspondent au terme de recherche
                if (stripos($pseudo, $termeRecherche) === 0 && file_exists($cheminImage) && $pseudo!=$_SESSION['username']) {
                    echo '<div style="display:flex; align-items:center;">';
                    echo '<img src="' . htmlspecialchars($cheminImage) . '" style="max-width: 50px; max-height: 50px; margin-right: 10px;">';
                    echo '<a href="profil.php?username=' . urlencode($pseudo) . '">' . htmlspecialchars($pseudo) . '</a><br>';
                    echo '</div>';
                    $resultatTrouve = true;
                }
            }
        }

        // Si aucun résultat n'a été trouvé, afficher "Aucun résultat trouvé"
        if (!$resultatTrouve) {
            echo "Aucun résultat trouvé.";
        }
    } else {
        echo "Aucun résultat trouvé.";
    }
}

