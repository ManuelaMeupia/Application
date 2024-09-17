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
    } else {
        echo json_encode(["success" => false, "message" => "Invalid request method."]);
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

    $sql = "SELECT contact_name, contact_number FROM notifications WHERE user_id = :id_user";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "data" => $contacts]);
}
?>
