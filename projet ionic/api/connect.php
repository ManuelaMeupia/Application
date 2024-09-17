<?php
header("Access-Control-Allow-Origin: *"); // CORS
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Lire les données POST
$input = json_decode(file_get_contents('php://input'), true);

// Vérifier si les données sont présentes
$email = filter_var($input['email'] ?? '', FILTER_SANITIZE_EMAIL);
$mot_de_passe = filter_var($input['password'] ?? '', FILTER_SANITIZE_STRING); // Correction ici

if (empty($email) || empty($mot_de_passe)) {
    echo json_encode(["success" => false, "message" => "Email et mot de passe requis."]);
    exit;
}

// Connexion à la base de données
$host = "localhost";
$dbname = "android";
$username = "root";
$password_db = "";  // Renommé pour éviter le conflit avec le mot de passe utilisateur

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification de l'utilisateur
    $sql = "SELECT Id_user, Nom,telephone, pass FROM user WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if (password_verify($mot_de_passe, $user['pass'])) {
            // Réponse avec les détails de l'utilisateur
            echo json_encode([
                "success" => true,
                "message" => "Authentification réussie.",
                "data" => [
                    "id" => $user['Id_user'],
                    "name" => $user['Nom'],
                    "telephone"=>$user['telephone']
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Mot de passe incorrect."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email incorrect."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
}

// Fermer la connexion
$conn = null;
?>
