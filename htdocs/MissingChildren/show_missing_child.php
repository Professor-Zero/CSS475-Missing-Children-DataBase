<?php
/**
 * Created by PhpStorm.
 * User: moabdi21@uw.edu
 * Date: 6/8/2019
 * Time: 2:30 PM
*/
require_once 'config.inc.php';
// Get Customer Number
$id = $_GET['id'];
if ($id === "") {
    header('location: list_missing_children.php');
    exit();
}
if ($id === false) {
    header('location: list_missing_children.php');
    exit();
}
if ($id === null) {
    header('location: list_missing_children.php');
    exit();
}
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
    <h2 id="show-missing-child">Missing Child</h2>
    <?php

    //echo $id;
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	// Prepare SQL using Parameterized Form (Safe from SQL Injections)
    $sql = "SELECT M.missingChildNo,firstName,lastName,dateOfBirth,ageOfDisappearnce,presentMentalState,height,weight,genderCode,raceCode,eyeColorCode,hairColorCode,M.photoNo,image\n"
        . "            FROM MissingChild M\n"
        . "            INNER JOIN  Photo P ON M.missingChildNo=P.missingChildNo\n"
        . "            WHERE M.missingChildNo=?";
         //"WHERE M.MissingChildNo = ?";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
		
		// Bind Parameters from User Input
        $stmt->bind_param('i',$id);
		
		// Execute the Statement
        $stmt->execute();
		
		// Process Results Using Cursor
        $stmt->bind_result($missingChildNo,$firstName,$lastName,$dateOfBirth,$ageOfDisappearnce,$presentMentalState,$height,$weight,$genderCode,$raceCode,$eyeColorCode,$hairColorCode,$photoNo,$image);
        echo "<div>";
        while ($stmt->fetch()) {
            //identation is extra just easier to read the html.
            echo "<div id=\"current-missing-child-body\">";
                echo "<div id='mc-b1'>";
                    echo '<a href="list_missing_children.php">'.'Back' .'</a><br><br>';
                echo "</div>";
                echo "<div id=mc-b2>";
                //photo
                if($photoNo == NULL) {
                    echo "<p id='no-photo'>"."No Photo"."</p>";
                }else {
                    echo '<img id="photo" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
                }
                echo "</div>";
                echo '<div id="missing-child-details">';
                    echo "<b class='mc-detail'>First Name: </b>". $firstName .'</br>';
                    echo "<b class='mc-detail'>Last Name: </b>". $lastName . '</br>';
                    echo "<b class='mc-detail'>Gender: </b>". $genderCode . '</br>';
                    echo "<b class='mc-detail'>Missing at age: </b>". $ageOfDisappearnce . '</br>';
                    echo "<b class='mc-detail'>Height: </b>". $height . '</br>';
                    echo "<b class='mc-detail'>Weight: </b>". $weight . '</br>';
                    echo "<b class='mc-detail'>Race: </b>". $raceCode . '</br>';
                    echo "<b class='mc-detail'>Eye Color: </b>". $eyeColorCode . '</br>';
                    echo "<b class='mc-detail'>Hair Color: </b>". $hairColorCode . '</br>';
                    if($dateOfBirth == "" || $dateOfBirth == NULL)
                        echo "<b class='mc-detail'>Date of Birth: </b>". 'Unknown'. '</br>';
                    else 
                        echo "<b class='mc-detail'>Date of Birth: </b>". $dateOfBirth . '</br>';
                    if($presentMentalState == "" || $presentMentalState == NULL)
                        echo "<b class='mc-detail'>Present Mental State:</b> " . "Unknown";
                    else 
                        echo "<b class='mc-detail'>Present Mental State:</b> " . $presentMentalState;
                echo '</div>';
            echo "</div>";
        }
        echo "</div>";
    ?>
        <div>
        <br/>
        </div>
        <div>
            <a href="update_missing_child.php?id=<?= $missingChildNo ?>">Update Missing Child</a>
        </div>
    <?php
    }

    $conn->close();

    ?>
</>
</body>
</html>
