<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? trim($_GET['country']) : '';

if ($country !== '') {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $country = "%$country%";
    $stmt->bindParam(':country', $country);
} else {
    $stmt = $conn->prepare("SELECT * FROM countries");
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>";
foreach ($results as $row) {
    echo "<li>" . $row['name'] . ' is ruled by ' . $row['head_of_state'] . "</li>";
}
echo "</ul>";
?>
