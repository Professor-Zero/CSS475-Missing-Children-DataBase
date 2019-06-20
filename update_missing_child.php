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
        $lastName = $_POST['lastName'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];

        if ($firstName === null || $lastName === null || $dateOfBirth === null || $weight === null || $height === null)
            echo "<div><i>Specify a new name</i></div>";
        else if ($firstName === false || $lastName === false || $dateOfBirth === false || $weight === false || $height === false)
            echo "<div><i>Specify a new name</i></div>";
        else if (trim($firstName) === "" || trim($lastName) === "" || $weight < 0 || $height < 0)
            echo "<div><i>Specify a new name</i></div>";
        else {
            /* perform update using safe parameterized sql */
            $sql = "UPDATE MissingChild SET firstName='$firstName', lastName='$lastName', dateOfBirth='$dateOfBirth', height='$height', weight='$weight' WHERE missingChildNo=?";
            $stmt = $conn->stmt_init();
            if (!$stmt->prepare($sql)) {
                echo "failed to prepare";
            } else {
				
				// Bind user input to statement
                $stmt->bind_param('i', $id);
				
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
        . "            WHERE M.missingChildNo=?";
    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        echo "failed to prepare";
    }
    else {
        $stmt->bind_param('i',$id);
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
                    echo "<b class='mc-detail'>Height: </b>". $height . ' ft' . '</br>';
                    echo "<b class='mc-detail'>Weight: </b>". $weight . ' lb'.'</br>';
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

        }
    ?><br><br>
            <div id="mc-form-body" style="text-align:center; background-color:#333; color:white; margin:5;">
                <div id="mc-form-title" style="margin:5; text-decoration: underline;"><b>Missing Child Form </b></div>
                    <div style="margin:5;">
                        <b>First Name:</b> <input type="text" name="firstName" value="<?= $firstName ?>">
                        <b>Last Name:</b> <input type="text" name="lastName" value="<?= $lastName ?>">
                    </div>
                    <br>
                    <div style="margin:5;">
                        <div style="margin:5;">
                            <b>Date of Birth:</b> <input type="date" name="dateOfBirth" value="<?= $dateOfBirth ?>">
                        </div>
                        <br>
                        <div style="margin:5;">
                           <b>height:</b> <input step="any" type="number" name="height"  value="<?= $height ?>">
                        </div>
                        <br>
                        <div style="margin:5;">
                            <b>weight:</b> <input type="number" name="weight" value="<?= $weight ?>">
                        </div>
                        <br>
                    </div>
                <button style="margin:5;" type="submit">Update</button>
                <br>
            <div>
        </form>
    <?php
    }

    $conn->close();

    ?>
</>
</body>
</html>
