<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? trim($_GET['country']) : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup === 'cities') {
    if ($country !== '') {
        $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
        $country = "%$country%";
        $stmt->bindParam(':country', $country);
    } else {
        $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code");
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>District</th>";
    echo "<th>Population</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['district'] . "</td>";
        echo "<td>" . $row['population'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    if ($country !== '') {
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $country = "%$country%";
        $stmt->bindParam(':country', $country);
    } else {
        $stmt = $conn->prepare("SELECT * FROM countries");
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Continent</th>";
    echo "<th>Independence Year</th>";
    echo "<th>Head of State</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['continent'] . "</td>";
        echo "<td>" . $row['independence_year'] . "</td>";
        echo "<td>" . $row['head_of_state'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
?>
