<?php
//print_r( $_REQUEST );
//print_r( $_GET );

$word = $_GET['word'];
$bruker = $_GET['rater'];
$rating = (int) $_GET['rating'];


// Create connection
include 'settings.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
} else { 
	// printf("Current character set: %s\n <br/>", $conn->character_set_name()); 
}
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$word = $conn->real_escape_string($word);
$bruker = $conn->real_escape_string($bruker);
$rating = $conn->real_escape_string($rating);


//$result = $conn->query($sql);

// has this coder given a value before?
$sql1 = "SELECT * FROM sentiment_words WHERE name = '".$word."' AND coder ='".$bruker."'"; 

$result = $conn->query($sql1);
if ($conn->affected_rows > 0) {
	$row_exists = true;
} else {
	$row_exists = false;
}

// insert or update
if ($row_exists) {
	// update
	$sql = "UPDATE sentiment_words SET value='".$rating."' WHERE name='".$word."' AND coder='".$bruker."'";
	if ($conn->query($sql) === TRUE) {
	    echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $conn->error;
	}
} else {
	// insert
	$sql = "INSERT INTO sentiment_words (name, value, coder) values ('".$word."', '".$rating."', '".$bruker."')";
	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Something vent wrong..";
	}

}

$conn->close();

?>