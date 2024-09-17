<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$conn = null;
try {
    $host = "localhost";
    $dbname = "android";
    $username = "root";
    $password = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        handleGetRequest($conn);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handlePostRequest($conn);
    }
} catch(PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur de connexion : " . $e->getMessage()]);
} finally {
    $conn = null;
}

function handleGetRequest($conn) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        echo json_encode(["success" => false, "message" => "ID non fourni"]);
        return;
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE Id_user = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(["success" => true, "data" => $user]);
    } else {
        echo json_encode(["success" => false, "message" => "Utilisateur non trouvé"]);
    }
}

function handlePostRequest($conn) {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'] ?? null;

    if (!$id) {
        echo json_encode(["success" => false, "message" => "ID non fourni"]);
        return;
    }

    $sql = "UPDATE user SET 
            Nom = :nom,
            Prenom = :prenom,
            Telephone = :telephone,
            Email = :email,
            Localisation = :localisation,
            Nom_cm = :nom_cm,
            Secteur_act = :secteur,
            secteur_act_v = :secteur_v
            WHERE Id_user = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nom', $data['nom']);
    $stmt->bindParam(':prenom', $data['prenom']);
    $stmt->bindParam(':telephone', $data['telephone']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':localisation', $data['localisation']);
    $stmt->bindParam(':nom_cm', $data['nom_cm']);
    $stmt->bindParam(':secteur', $data['secteur']);
    $stmt->bindParam(':secteur_v', $data['secteur_v']);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Profil mis à jour avec succès"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour du profil"]);
    }
}
?>