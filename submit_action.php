<?php
//    function applicants($applicant_id, $applicant_names) {
//        return "{$applicant_id}: {$applicant_names}";
//    }
//echo $_POST['vote_choice'];
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=vote_class_rep2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO votes (applicant_id, voter_ip) VALUES (:vote_choice, :remote_address)");
    $stmt->bindParam(':vote_choice', $_POST['vote_choice']);
	$stmt->bindParam(':remote_address', $_SERVER['REMOTE_ADDR']);

        $stmt->execute();

        // set the resulting array to associative
//        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");

    echo "Connected successfully";
    }
    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    ?>