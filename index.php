<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>Group 3 - Vote for a Class Representative</title>
</head>
<body>
<h1>Who do you want to be your class WU 15-V representative?</h1>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";


        try {
            $conn = new PDO("mysql:host=$servername;dbname=vote_class_rep2", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            function votes($voter_ip) {
                return "{$voter_ip}";
            }
            $ipcheck = $conn->prepare("SELECT voter_ip FROM votes");
            $ipcheck->execute();
            $ipresult = $ipcheck->fetchAll(PDO::FETCH_FUNC, 'votes');
            $myiprightnow = $_SERVER['REMOTE_ADDR'];
            $inarray = "";
            $rowsnr = count($ipresult);
            if (!in_array($_SERVER['REMOTE_ADDR'], $ipresult) || $rowsnr == 0){
                $inarray = 'success';
                echo '<form action="submit_action.php" method="post">';
                $stmt = $conn->prepare("SELECT applicant_id, applicant_names FROM applicants");
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach($result as $key=>$value) {
                    echo '<label><input type="radio" name="vote_choice" value="'.$value['applicant_id'].'"/>' . $value['applicant_names'] . '</label>';
                }
                echo '<br><input type="submit" value="VOTE"/></form>';
            }
            else {
            echo '<div class="results">';
                echo '<h2>You have already voted</h2>';
                $votecheck = $conn->prepare("SELECT applicant_names, COUNT( votes.voter_ip ) FROM applicants LEFT OUTER JOIN votes ON votes.applicant_id = applicants.applicant_id GROUP BY applicant_names ORDER BY COUNT( votes.voter_ip ) DESC LIMIT 0 , 3");
                $votecheck->execute();
                $voteresult = $votecheck->fetchAll();
                foreach($voteresult as $key=>$value) {
                     echo '<br> Applicant:'.$value['applicant_names'].': '.$value['COUNT( votes.voter_ip )'];
                     $totalvotes = count($ipresult);
                     $personvotes = $value['COUNT( votes.voter_ip )'];
                     $barwidth = '300';
                     $barheight = '30';
                     $borderradius = '5';
                     $percentage = 100/$totalvotes*$personvotes;
                     echo '/'.$totalvotes;
                     echo '<div style="height: '.$barheight.'px; background-color: #c3c6c6; width: '.$barwidth.'px; border-radius:'.$borderradius.'px; display: block;"><div style="height: '.$barheight.'px; padding-top: 5px; padding-left: 5px; border-bottom-left-radius:'.$borderradius.'px; border-top-left-radius:'.$borderradius.'px; display: block; background-color: #f24538; width: '. $barwidth/$totalvotes*$personvotes.'px; color: white;">'. number_format((float)$percentage, 2, '.', '') . '%</div></div>';
                echo '</div>';
                }
            }
//            echo $inarray;
//            print_r($ipresult);
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    ?>
</body>
</html>