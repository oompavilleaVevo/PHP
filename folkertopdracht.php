<?php

// Verbinding maken met de database
$conn = mysqli_connect("localhost","root", "", "firda");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$imported = false; // Initiëren van de variabele

if(isset($_POST["import"])) {
    $filename = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 0) {
        $file = fopen($filename, 'r');
        // Eerste regel overslaan als het een header bevat
        fgetcsv($file);
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT INTO persoon (voornaam, achternaam) VALUES ('" . $column[0] . "', '" . $column[1] ."')";
            $result = mysqli_query($conn, $sqlInsert);
            if (!empty($result)) {
                $imported = true;
            } else {
                echo "Er is een probleem opgetreden!";
            }
        }
        if($imported){
            echo "CSV is goed geimporteerd!";
        }
    }
}
//copyright oden
        
$conn->close();
?>

<form class="form-horizoontal" action="" method="post" name="uploadCsv" enctype="multipart/form-data">
    <div>
        <label>Kies CSV-bestand</label>
        <input type="file" name="file" accept=".csv">
        <button type="submit" name="import">Importeren</button>
    </div>
</form>
