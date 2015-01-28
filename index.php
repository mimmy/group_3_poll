<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
    <title>Group 3 - Vote for a Class Representative</title>
</head>
<body>
    <?php
//    echo $_SERVER['REMOTE_ADDR'];

//function getUserIP()
//{
//    $client  = @$_SERVER['HTTP_CLIENT_IP'];
//    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
//    $remote  = $_SERVER['REMOTE_ADDR'];
//
//    if(filter_var($client, FILTER_VALIDATE_IP)){
//        $ip = $client;
//    }
//    elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
//        $ip = $forward;
//    }
//    else {
//        $ip = $remote;
//    }
//    return $ip;
//}
//$user_ip = getUserIP();
//echo $user_ip;

$servername = "localhost";
$username = "root";
$password = "";


try {
    $conn = new PDO("mysql:host=$servername;dbname=vote_class_rep2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    function votes($voter_ip) {
        return "{$voter_ip}";
    }
    $ipcheck = $conn->prepare("SELECT voter_ip FROM votes");
    $ipcheck->execute();

            // set the resulting array to associative
    //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
            $ipresult = $ipcheck->fetchAll(PDO::FETCH_FUNC, 'votes');
    //                                 var_dump($result);
//    echo $_SERVER['REMOTE_ADDR'];
//    $rowsnr = count($ipresult);
//    echo '<br>The number of rows is: ' . $rowsnr. '<br>';
//    echo gettype($ipresult);
//    echo 'type of ip address is ' . gettype($_SERVER['REMOTE_ADDR']);
    $myiprightnow = $_SERVER['REMOTE_ADDR'];
    $inarray = "";
    $rowsnr = count($ipresult);
    if (!in_array($_SERVER['REMOTE_ADDR'], $ipresult) || $rowsnr == 0){
        $inarray = 'success';
        echo '<form action="submit_action.php" method="post">';
                            $stmt = $conn->prepare("SELECT applicant_id, applicant_names FROM applicants");
                            $stmt->execute();

                                // set the resulting array to associative
                                //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
                            $result = $stmt->fetchAll();
                                // var_dump($result);
                            echo "Connected successfully";
                            foreach($result as $key=>$value) {
                                echo '<label><input type="radio" name="vote_choice" value="'.$value['applicant_id'].'"/>' . $value['applicant_names'] . '</label><br>';
                            }
                            echo '<input type="submit" value="Vote"/></form>';

    }
    else {
    echo 'You have voted, dude!';
//    print 'SELECT applicant_names, COUNT( votes.voter_ip )
//           FROM applicants
//           LEFT OUTER JOIN votes ON votes.applicant_id = applicants.applicant_id
//           GROUP BY applicant_names
//           ORDER BY COUNT( votes.voter_ip ) DESC
//           LIMIT 0 , 3;';
//         $votecheck = $conn->prepare("SELECT applicants.applicant_names, votes.applicant_id, applicants.applicant_id FROM votes LEFT JOIN applicants ON applicants.applicant_id=votes.applicant_id");
         $votecheck = $conn->prepare("SELECT applicant_names, COUNT( votes.voter_ip ) FROM applicants LEFT OUTER JOIN votes ON votes.applicant_id = applicants.applicant_id GROUP BY applicant_names ORDER BY COUNT( votes.voter_ip ) DESC LIMIT 0 , 3");
         $votecheck->execute();

                                // set the resulting array to associative
                        //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
         $voteresult = $votecheck->fetchAll();
                        //                                 var_dump($result);
         foreach($voteresult as $key=>$value) {
             echo '<br> Applicant:'.$value['applicant_names'].': '.$value['COUNT( votes.voter_ip )'];
             $totalvotes = count($ipresult);
             $personvotes = $value['COUNT( votes.voter_ip )'];
             $barwidth = '300';
             $barheight = '30';
             $borderradius = '5';
             $percentage = 100/$totalvotes*$personvotes;
             echo '/'.$totalvotes;
             echo '<div style="height: '.$barheight.'px; background-color: #c3c6c6; width: '.$barwidth.'px; border-radius:'.$borderradius.'px; display: block;"><div style="height: '.$barheight.'px; border-bottom-left-radius:'.$borderradius.'px; border-top-left-radius:'.$borderradius.'px; display: block; background-color: #f24538; width: '. $barwidth/$totalvotes*$personvotes.'px; color: white;">'. number_format((float)$percentage, 2, '.', '') . '%</div></div>';
         }
    }
//    foreach($ipresult as $key)
//    {
//        if (in_array($_SERVER['REMOTE_ADDR'], $key)){
//                    $inarray = 'success';
//                    break;
//            }
//            else {
//            $inarray = 'something else, yo! <br>';
//            $inarray += $_SERVER['REMOTE_ADDR'];
//            }
//    }
    echo $inarray;
    print_r($ipresult);

//    echo '<br>The number of rows is: ' . $rowsnr. '<br>';
//if ($rowsnr == 0) {
//                echo '<form action="submit_action.php" method="post">';
//                $stmt = $conn->prepare("SELECT applicant_id, applicant_names FROM applicants");
//                $stmt->execute();
//
//                    // set the resulting array to associative
//                    //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
//                $result = $stmt->fetchAll();
//                    // var_dump($result);
//                echo "Connected successfully";
//                foreach($result as $key=>$value) {
//                    echo '<label><input type="radio" name="vote_choice" value="'.$value['applicant_id'].'"/>' . $value['applicant_names'] . '</label><br>';
//                }
//                echo '<input type="submit" value="Vote"/></form>';
//}
//else {
//$hasVotedBefore = false;
//foreach($ipresult as $key=>$value){
//        echo '<br> The value of voter_ip is ' . $value['voter_ip'];
//        if ($value['voter_ip'] == $_SERVER['REMOTE_ADDR']){
//            echo 'You have already voted' . $value['voter_ip'];
//            echo '<br> the rest of the code';
//            $hasVotedBefore = true;
//        }
//
//}

//if ($hasVotedBefore == false) {
//    echo "hasn't voted before";
//}

//        echo gettype($value['voter_ip']);
        // if ($value['voter_ip'] == $_SERVER['REMOTE_ADDR']) {
//        if (in_array($_SERVER['REMOTE_ADDR'], $ipresult)){
//                echo 'You have already voted';
//                $votecheck = $conn->prepare("SELECT applicants.applicant_names, votes.applicant_id, applicants.applicant_id FROM votes LEFT JOIN applicants ON applicants.applicant_id=votes.applicant_id");
//                        $votecheck->execute();
//
//                        // set the resulting array to associative
//                //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
//                        $voteresult = $votecheck->fetchAll();
//                //                                 var_dump($result);
//                    foreach($voteresult as $key=>$value) {
//                        echo '<br>'.$value['applicant_names'];
//                    }
//        }


}
//    foreach($ipresult as $key=>$value){
//        echo '<br> The value of voter_ip is ' . $value['voter_ip'];
//        if ($value['voter_ip'] == $_SERVER['REMOTE_ADDR']){
//        echo 'this is the ip you are looking for' . $value['voter_ip'];
//        }
//        else {
//        echo 'nopee';
//        }
//        echo gettype($value['voter_ip']);
        // if ($value['voter_ip'] == $_SERVER['REMOTE_ADDR']) {
//        if (in_array($_SERVER['REMOTE_ADDR'], $ipresult)){
//                echo 'You have already voted';
//                $votecheck = $conn->prepare("SELECT applicants.applicant_names, votes.applicant_id, applicants.applicant_id FROM votes LEFT JOIN applicants ON applicants.applicant_id=votes.applicant_id");
//                        $votecheck->execute();
//
//                        // set the resulting array to associative
//                //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
//                        $voteresult = $votecheck->fetchAll();
//                //                                 var_dump($result);
//                    foreach($voteresult as $key=>$value) {
//                        echo '<br>'.$value['applicant_names'];
//                    }
//        }
//        else {
//            echo '<form action="submit_action.php" method="post">';
//            $stmt = $conn->prepare("SELECT applicant_id, applicant_names FROM applicants");
//            $stmt->execute();
//
//                // set the resulting array to associative
//                //        $result = $stmt->fetchAll(PDO::FETCH_FUNC, "applicants");
//            $result = $stmt->fetchAll();
//                // var_dump($result);
//            echo "Connected successfully";
//            foreach($result as $key=>$value) {
//                echo '<label><input type="radio" name="vote_choice" value="'.$value['applicant_id'].'"/>' . $value['applicant_names'] . '</label><br>';
//            }
//            echo '<input type="submit" value="Vote"/></form>';
//        }
//    }
//}
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
?>

</body>
</html>