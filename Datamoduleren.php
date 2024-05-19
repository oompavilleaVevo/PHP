<?php
define('DB_SERVER','localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD','');
define('DB_NAME','medewerker2');

//probeert te connecten met sql database
$link = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD,DB_NAME);

//checkt de connectie
if($link === false){
    die("ERROR: Kan niet connecten".mysqli_connect_error());
}

//$query = "SELECT *FROM gebruiker2";
//$result = mysqli_query($link , $query);

$sql = "SELECT gebruiker2, 'username', 'password' *FROM medewerker2 WHERE lastname='Doe'";
$result = mysqli_query($sql, $link);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "voornaam: " . $row["voornaam"]. " - tussenvoegsel " . $row["tussenvoegsel"]. " - achternaam " .$row["achternaam"]. " - salaris" .$row["salaris"]. "<br>";
    }
  } else {
    echo "0 results";
  }
//$name = mysqli_real_escape_string($con, $_POST['name']);

echo "<table>";
$first_row = true;
while($row = mysqli_fetch_assoc($result)){
    if($first_row){
        $first_row = false;
        //before displaying first tow of data
        //display row of headers, from keys
        echo '<tr>';
        foreach($row as $column_name => $value) {
            echo '<th>' . htmlspecialchars($column_name). '</th>';
        }
        echo '</tr>';
    }
    echo '</table>';
    mysqli_close($link);
}
?>
