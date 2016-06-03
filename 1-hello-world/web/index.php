<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<ul>
  <li style = "float:left"><a class ="active" href="index.php">Mu23 Calculator</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#about">About</a></li>
</ul>

<?php
// define variables and set to empty values
$solute = $base = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $solute = test_input($_POST["solute"]);
   $base = test_input($_POST["base"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Simple mu23 Database</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Solute: <select name="solute", style = "width:120px">
  <option value="(GuH)2SO4">(GuH)2SO4</option>
  <option value="GuHCl">GuHCl</option>
  <option value="GuHSCN" selected="selected">GuHSCN</option>
  <option value="Na2SO4">Na2SO4</option>
  <option value="NaCl">NaCl</option>
  <option value="NaSCN">NaSCN</option>
  </select>

  Base: <select name="base", style = "width:120px">
  <option value="2,6-Diaminopurine">2,6-Diaminopurine</option>
  <option value="5-Aminouracil">5-Aminouracil</option>
  <option value="6-Amino-1,3-dimethyluracil" selected="selected">6-Amino-1,3-dimethyluracil</option>
  <option value="Adenine">Adenine</option>
  <option value="Cytosine">Cytosine</option>
  <option value="Hypoxanthine">Hypoxanthine</option>
  <option value="Naphthalene">Naphthalene</option>
  <option value="Theobromine">Theobromine</option>
  <option value="Theophylline">Theophylline</option>
  <option value="Thymine">Thymine</option>
  <option value="Uracil">Uracil</option>
  </select>

  <input type="submit" value="Submit" />

</form>

<?php
echo "<h2>Your choice: </h2>";
echo "Solute: ";
echo $solute;
echo "<br>";
echo "<br>";
echo "Base: ";
echo $base;
echo "<br>";
echo "<h3>mu23 value is: </h3>";
echo "querying database...<br>";
echo "<br>";

// Using PDO_MySQL (connecting from App Engine)
$db = new pdo(
  'mysql:unix_socket=/cloudsql/mu2333-1331:mu23',
  'root',  // username
  'aoteman'       // password
);
// Using mysqli (connecting from App Engine)
$sql = new mysqli(
  null, // host
  'root', // username
  'aoteman',     // password
  'mu23', // database name
  null,
  '/cloudsql/mu2333-1331:mu23'
  );
// Using MySQL API (connecting from App Engine)
$conn = mysql_connect(':/cloudsql/mu2333-1331:mu23',
  'root', // username
  'aoteman'      // password
  );


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
echo "success";
}

$result = $conn->query("SELECT * FROM salts WHERE Solutes='$solute' AND Model_Compounds='$base';");

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Mu23: " . $row["Experimental"];
        echo "<br>";
        echo "Error: " . $row["Error"];
        echo "<br>";
    }
} else {
    echo "0 results";
    echo "<br>";
}

$conn->close();
?>

<a href = "button.html" style="color:white;" target="_blank">button</a>
<a href = "menu.php" style="color:white;" target="_blank">menu</a>
<a href = "parallax.html" style="color:white;" target="_blank">parallax</a>

</body>
</html>

