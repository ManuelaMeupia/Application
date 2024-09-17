<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handlePostRequest($conn);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database connection error: " . $e->getMessage()]);
} finally {
    $conn = null;
}

function handlePostRequest($conn) {
    $input = json_decode(file_get_contents('php://input'), true);
    $notificationId = $input['id'] ?? '';

    if (empty($notificationId)) {
        echo json_encode(["success" => false, "message" => "Notification ID required."]);
        return;
    }

    try {
        $sql = "UPDATE notifications SET status = 1 WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $notificationId);
        $stmt->execute();

        echo json_encode(["success" => true, "message" => "Notification status updated."]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error updating notification status: " . $e->getMessage()]);
    }
}
?>
