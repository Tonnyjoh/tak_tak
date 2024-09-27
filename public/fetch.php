<?php
// fetch.php

header('Content-Type: application/json');

// Database connection settings
$host = 'localhost';
$dbname = 'takalo_takalo';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get input data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if query parameter is present
    if (isset($data['query'])) {
        $searchQuery = $data['query'];

        try {
            // Database connection
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Fetch user details
            $stmt = $pdo->prepare("
                SELECT U.id, U.username, U.email, U.role, U.registration_date 
                FROM users AS U 
                WHERE U.username LIKE :search
            ");
            $stmt->execute(['search' => '%' . $searchQuery . '%']);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                // No user found
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Utilisateur non trouvé.'
                ]);
                exit;
            }

            // Fetch item count for user
            $stmt = $pdo->prepare("SELECT COUNT(*) AS item_count FROM items WHERE user_id = :user_id");
            $stmt->execute(['user_id' => $user['id']]);
            $itemCount = $stmt->fetch(PDO::FETCH_ASSOC)['item_count'];

            // Fetch exchange statistics for user
            $stmt = $pdo->prepare("
                SELECT 
                    (SELECT COUNT(*) FROM exchanges WHERE offered_item_id IN (SELECT id FROM items WHERE user_id = :user_id)) AS exchanges_offered,
                    (SELECT COUNT(*) FROM exchanges WHERE requested_item_id IN (SELECT id FROM items WHERE user_id = :user_id)) AS exchanges_received
            ");
            $stmt->execute(['user_id' => $user['id']]);
            $exchangeStats = $stmt->fetch(PDO::FETCH_ASSOC);

            // Construct response
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                    'item_count' => $itemCount,
                    'exchanges_offered' => $exchangeStats['exchanges_offered'],
                    'exchanges_received' => $exchangeStats['exchanges_received']
                ]
            ]);

        } catch (PDOException $e) {
            // Handle database error
            echo json_encode([
                'status' => 'error',
                'message' => 'Erreur de base de données: ' . $e->getMessage()
            ]);
        }
    } else {
        // Missing query parameter
        echo json_encode([
            'status' => 'error',
            'message' => 'Paramètre "query" manquant.'
        ]);
    }
} else {
    // Invalid request method
    echo json_encode([
        'status' => 'error',
        'message' => 'Méthode non autorisée.'
    ]);
}
