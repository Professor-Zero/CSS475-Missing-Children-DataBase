<?php
/**
 * Created by PhpStorm.
 * User: moabdi21@uw.edu
 * Date: 6/8/2019
 * Time: 2:30 PM
*/
require_once 'config.inc.php';

?>
<html>
<head>
    <link rel="stylesheet" href="base.css">
</head>
<body>
<?php
require_once 'header.inc.php';
?>
<div>
    <h2>Missing Children List</h2>
    <?php
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT missingChildNo, firstName, lastName, eyeColorCode FROM MissingChild ORDER BY firstName";

    // Check the Request is an Update from User -- Submitted via Form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $eyeColorCode = $_POST['eyeColorCode'];

        if ($eyeColorCode === null)
            echo "<div><i>Select eye color</i></div>";
        else if ($eyeColorCode === false )
            echo "<div><i>Select eye color</i></div>";
        else if (trim($eyeColorCode) === "" )
            echo "<div><i>Select eye color</i></div>";
        else {
            $sql = "SELECT missingChildNo, firstName, lastName, eyeColorCode FROM MissingChild WHERE eyeColorCode='$eyeColorCode' ORDER BY firstName";
        }
    }

    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
		
		// Execute the Statement
        $stmt->execute();
		
		// Loop Through Result
        $stmt->bind_result($missingChildNo,$firstName,$lastName, $eyeColorCode);

        echo '<form method="post">';
            echo '<div style="margin:5;">
                Eye color
                <select name="eyeColorCode">
                    <option value=""></option>
                    <option value="Black">Black</option>
                    <option value="Blue">Blue</option>
                    <option value="Brown">Brown</option>
                    <option value="Gray">Gray</option>
                    <option value="Green">Green</option>
                    <option value="Hazel">Hazel</option>
                    <option value="Maroon">Maroon</option>
                    <option value="Multi-Color">Multi-Color</option>
                    <option value="Pink">Pink</option>
                    <option value="Unkown">Unknown</option>
                </select>
            </div>';
            echo '<button style="margin:5;" type="submit">Filter</button>';
        echo '</form>';
        echo "<div id='list'>";
            echo "<ul id='main-list-mc'>";
                while ($stmt->fetch()) {
                    echo '<li id="list-mc"><a href="show_missing_child.php?id='  . $missingChildNo . '">' . $firstName . " ". $lastName . '</a></li>';
                }
            echo "</ul>";
        echo "</div>";
    }
    
	// Close Connection
    $conn->close();
    
    ?>
</div>
</body>
</html>
