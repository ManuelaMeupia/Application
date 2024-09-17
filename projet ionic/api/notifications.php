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
    $password_db = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = filter_var($_GET['id'] ?? '', FILTER_SANITIZE_STRING);
        if (empty($id)) {
            echo json_encode(["success" => false, "message" => "ID requis."]);
            exit;
        }

        // Query to count unread notifications
        $sql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = :id AND Statut = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["success" => true, "unread_count" => $result['unread_count']]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erreur de connexion à la base de données : " . $e->getMessage()]);
} finally {
    $conn = null;
}
?>
