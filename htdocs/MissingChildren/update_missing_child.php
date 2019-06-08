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
    <h2>Update Missing Child</h2>
    <?php

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	// Check the Request is an Update from User -- Submitted via Form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName = $_POST['firstName'];
        if ($firstName === null)
            echo "<div><i>Specify a new name</i></div>";
        else if ($firstName === false)
            echo "<div><i>Specify a new name</i></div>";
        else if (trim($firstName) === "")
            echo "<div><i>Specify a new name</i></div>";
        else {
            /* perform update using safe parameterized sql */
            $sql = "UPDATE MissingChild SET firstName='$firstName' WHERE missingChildNo=$id";
            $stmt = $conn->stmt_init();
            if (!$stmt->prepare($sql)) {
                echo "failed to prepare";
            } else {
				
				// Bind user input to statement
                //$stmt->bind_param('ss', $firstName,$id);
				
				// Execute statement and commit transaction
                $stmt->execute();
                $conn->commit();
            }
        }
    }

    /* Refresh the Data */
    $sql = "SELECT M.missingChildNo,firstName,lastName,dateOfBirth,ageOfDisappearnce,presentMentalState,height,weight,genderCode,raceCode,eyeColorCode,hairColorCode,M.photoNo,image\n"
        . "            FROM MissingChild M\n"
        . "            INNER JOIN  Photo P ON M.missingChildNo=P.missingChildNo\n"
        . "            WHERE M.missingChildNo=$id";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
        //$stmt->bind_param('s',$id);
        $stmt->execute();
        $stmt->bind_result($missingChildNo,$firstName,$lastName,$dateOfBirth,$ageOfDisappearnce,$presentMentalState,$height,$weight,$genderCode,$raceCode,$eyeColorCode,$hairColorCode,$photoNo,$image);
        ?>
        <form method="post">
            <input type="hidden" name="missingChildNo" value="<?= $id ?>">
        <?php
        while ($stmt->fetch()) {
            //identation is extra just easier to read the html.
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
                        echo "<b class='mc-detail'>Date of Birth: </b>". $dateOfBirth. '</br>';
                    else 
                        echo "<b class='mc-detail'>Date of Birth: </b>". 'Unknown'. '</br>';
                    if($presentMentalState == "" || $presentMentalState == NULL)
                        echo "<b class='mc-detail'>Present Mental State:</b> " . "Unknown";
                    else 
                        echo "<b class='mc-detail'>Present Mental State:</b> " . $presentMentalState;
                echo '</div>';

        }
    ?><br><br>
            New First Name: <input type="text" name="firstName">
            <button type="submit">Update</button>
        </form>
    <?php
    }

    $conn->close();

    ?>
</>
</body>
</html>
