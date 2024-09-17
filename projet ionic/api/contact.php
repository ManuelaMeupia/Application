<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$conn = null;
try {
    $host = "localhost";
    $dbname = "android";
    $username = "root";
    $password_db = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        handleGetRequest($conn);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handlePostRequest($conn);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database connection error: " . $e->getMessage()]);
} finally {
    $conn = null;
}

function handleGetRequest($conn) {
    $id = filter_var($_GET['id'] ?? '', FILTER_SANITIZE_STRING);
    if (empty($id)) {
        echo json_encode(["success" => false, "message" => "ID required."]);
        return;
    }

    $sql = "SELECT Id_user, Nom, Telephone FROM user WHERE Id_user != :id AND categorie_activite LIKE secteur_act";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "data" => $contacts]);
}

function handlePostRequest($conn) {
    $input = json_decode(file_get_contents('php://input'), true);
    $contactIds = $input['ids'] ?? [];
    $authorName = filter_var($input['author_name'] ?? '', FILTER_SANITIZE_STRING);
    $authorPhone = filter_var($input['author_phone'] ?? '', FILTER_SANITIZE_STRING);
    
    if (empty($contactIds)) {
        echo json_encode(["success" => false, "message" => "IDs de contact requis."]);
        return;
    }

    try {
        // Insertion des notifications pour chaque ID de contact
        $sql = "INSERT INTO notifications (user_id, contact_name, contact_number) VALUES (:user_id, :contact_name, :contact_number)";
        $stmt = $conn->prepare($sql);

        foreach ($contactIds as $contactId) {
            $stmt->execute([
                ':user_id' => $contactId,
                ':contact_name' => $authorName,
                ':contact_number' => $authorPhone
            ]);
        }

        echo json_encode(["success" => true, "message" => "Notifications ajoutées avec succès."]);

    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'insertion : " . $e->getMessage()]);
    }
}
?>
