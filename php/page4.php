<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Vérifier si les champs de recherche sont définis et non vides
        if (!isset($_POST["name"]) || empty($_POST["name"])) {
            header('Location: recherche.php?error=1');
            throw new Exception("Le nom est vide");
        }
        if (!isset($_POST["age"]) || empty($_POST["age"])) {
            header('Location: recherche.php?error=1');
            throw new Exception("L'âge est vide");
        }
        if (!isset($_POST["sexualindentity"]) || empty($_POST["sexualindentity"])) {
            header('Location: recherche.php?error=1');
            throw new Exception("L'identité sexuelle est vide");
        }

        $profiles = file("../donnee/log.txt");


        //Filtrage
        $search_results = [];
        foreach ($profiles as $profile) {
            $profile_data = explode(";", $profile);
           
            if (stripos($profile_data[0], $_POST["name"]) !== false) {
                
                if ((int)$profile_data[2] == (int)$_POST["age"]) {
                    
                    if ($profile_data[3] == $_POST["sexualindentity"]) {
                       
                        $search_results[] = $profile_data;
                    }
                }
            }
        }


        header("Location: ../results_search.php" . urlencode(serialize($search_results)));
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
        exit();
    }
}
?>
