<?php
header("Access-Control-Allow-Origin: *"); // CORS
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "android";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion: " . $conn->connect_error);
}

// Lire les données POST
$data = json_decode(file_get_contents("php://input"), true);

$nom = filter_var($data['nom'] ?? '', FILTER_SANITIZE_STRING);
$prenom = filter_var($data['prenom'] ?? '', FILTER_SANITIZE_STRING);
$telephone = filter_var($data['telephone'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$email = filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL);
$mot_de_passe = filter_var($data['mot_de_passe'] ?? '', FILTER_SANITIZE_STRING);
$localisation = filter_var($data['localisation'] ?? '', FILTER_SANITIZE_STRING);
$nom_cm = filter_var($data['nom_cm'] ?? '', FILTER_SANITIZE_STRING);
$secteur = filter_var($data['secteur'] ?? '', FILTER_SANITIZE_STRING);
$secteur_v = filter_var($data['secteur_v'] ?? '', FILTER_SANITIZE_STRING);

// Préparer la requête SQL
$sql = "INSERT INTO user (Nom, prenom, telephone, email, pass, localisation, categorie_activite, nom_Cmcial, secteur_act) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Préparer la déclaration
$stmt = $conn->prepare($sql);

// Vérifier la préparation
if ($stmt === false) {
    die("Échec de la préparation de la requête: " . $conn->error);
}

// Lier les paramètres
$stmt->bind_param("sssssssss", $nom, $prenom, $telephone, $email, $mot_de_passe, $localisation, $secteur, $nom_cm, $secteur_v);

// Exécuter la requête
if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement: " . $stmt->error]);
}

// Fermer la déclaration et la connexion
$stmt->close();
$conn->close();
?>
