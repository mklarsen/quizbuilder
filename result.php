<?php
    if(!isset($_POST['btn'])){
        header('Location: error.php?e=1'); 
        exit;
        //if no button was clicked then go to error page
    }

    include("config.php");

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $conn->prepare("SELECT count(id) AS ialt FROM qsrc WHERE quiz='" . $quizNumber . "'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach($stmt->fetchAll() as $k=>$v) {
            $totalQues = $v['ialt']; //Enter total number of questions here
        }
        
        $stmt = $conn->prepare("SELECT id, answerTxt, answerID FROM qsrc WHERE quiz='" . $quizNumber . "'");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach($stmt->fetchAll() as $k=>$v) {   
            if(isset($_POST['answer-'.$v['id']])){
                if ($_POST['answer-'.$v['id']]  == $v['answerID']){
                    $totalMarks++;                    
                }
            }
        }

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    if(isset($_POST['givenname'])){
        $givenname=$_POST['givenname'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quiz Results</title>
        <meta name="author" content="Martin Kraus Larsen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="https://fonts.googleapis.com/css?family=Montserrat|PT+Serif" rel="stylesheet">
        <link rel="stylesheet" href="style.css" >    
    </head>
    
    <body>
        <header><h1>Quiz result for you (<?= $givenname; ?>)</h1></header>
        <hr>
            <div id="result">
                <p>Result posted to tagwall:
                <strong style="font-size:1.5em;" ><?= $totalMarks; ?></strong>/<?= $totalQues; ?></p>
            </div>
        
        <?php
            //echo "<PRE>"; print_r($_REQUEST); echo "</PRE>";

            $upd = $conn->prepare("UPDATE qresults SET latest=0 WHERE person=?");
            $upd->execute(array($givenname));
            
            $resultStr = $totalMarks . "/" .$totalQues;
            $data = array($givenname, $quizNumber , $resultStr); 
            $stmta = $conn->prepare("INSERT INTO qresults (person, quiz, result, latest) VALUES (?, ?, ?, 1)");
            $stmta->execute($data);
        ?>  
        <hr>
        <div id="notecontainer" style="font-size:1.5em; text-align: center;">
            <br><br>
            <P> <a href="tag_wall.php">See quiz tagwall</a></P>
            <br><br>
            <hr>
     
            <p> plz. do not reload the page</p>
        </div>
       
    </body>
</html>