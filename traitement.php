<?php

$serveur = "localhost"; 
$utilisateur = "root"; 
$motdepasse = ""; 
$base_de_donnees = "USERS";

$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

// Vérification si le formulaire a été soumis
if (isset($_POST["join"])) {
    // Vérification des champs
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validation des données (vous pouvez ajouter plus de validation si nécessaire)
    if (!empty($username) && !empty($password) && !empty($email)) {
        // Préparation de la requête d'insertion
        $insertion = $connexion->prepare("INSERT INTO utilisateur VALUES (?, ?, ?)");

        // Liaison des valeurs et exécution de la requête
        $insertion->bind_param("sss", $username, $password, $email); // "sss" indique que les trois paramètres sont des chaînes de caractères
        if ($insertion->execute()) {
            echo "Formulaire soumis avec succès !";
        } else {
            echo "Une erreur s'est produite lors de l'insertion des données.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

$connexion->close();
?>
