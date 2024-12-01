<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
?>

<?php
$temp=False;
if (isset($_GET['query'])&&isset($_GET['lookup'])) {
  $country = trim($_GET['query']);
  $city = $_GET['lookup'];
  $temp=True;
  $bool=True;
}
else if (isset($_GET['query'])) {
  $country = $_GET['query'];
  $bool=True;
} else {
  $bool=False;
}
?>

<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if($temp==True){
  $stmt = $conn->prepare("SELECT cities.*
    FROM cities
    JOIN countries ON cities.country_code = countries.code
    WHERE countries.name = :country");

$stmt->bindParam(':country', $country, PDO::PARAM_STR);


$stmt->execute();

$results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

 
}
else if($bool==True){
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else{
  $stmt = $conn->query("SELECT * FROM countries");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<?php if ($temp): ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results2 as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($bool): ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Continent</th>
            <th>Independence</th>
            <th>Head of State</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['continent']; ?></td>
                <td><?= $row['independence_year']; ?></td>
                <td><?= $row['head_of_state']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>