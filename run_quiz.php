<?php
    if(!isset($_POST['btn'])){
        header('Location: error.php?e=1'); 
        exit;
        //if no button was clicked then go to error page
    }
    include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<title><?= $sitename; ?></title> 
    <meta name="description" content="<?= $sitedescription; ?>" >
    <meta name="author" content="<?= $author; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat|PT+Serif" rel="stylesheet">
    <link rel="stylesheet" href="style.css" >
</head>
<body>
    <header>
    <h1><?= $sitename; ?></h1>
    </header>
    
    <hr>
    
    <div id="container">
        <p><strong>Note: </strong><?= $note; ?></p>
        <bR><bR>
        <form action="result.php" method="POST">

            <br>
            <div id="name-container">
                <h2 class="namespace" id="givenname" >Name: <? echo $_POST['givenname'] ?></h2>
                <input type='text' name='givenname' value='<? echo $_POST['givenname'] ?>' hidden readonly><br>
            </div>
            
                <ol type="1" >
                    <?php
                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare("SELECT id, answerTxt, answerID FROM qsrc WHERE quiz='" . $quizNumber . "' ORDER BY rand() ");
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                        foreach($stmt->fetchAll() as $k=>$v) {   
                            echo "<BR><div id='question-container'>\n";

                            echo "<li><h2 class='question' id='".$v['id']."' >who own this desktop?</h2></li>\n";
                            
                            echo "<p><img src='./image.php?iCrypt=".$v['id']."' width='700'></p>\n";

                            $stmt2 = $conn->prepare("SELECT id, answerTxt, answerID FROM qsrc WHERE quiz='" . $quizNumber . "'");
                            $stmt2->execute();
                            $result2 = $stmt2->setFetchMode(PDO::FETCH_ASSOC);

                            foreach($stmt2->fetchAll() as $k2=>$v2) {
                                $answer='answer-' .$v['id'];
                                echo "<input type='radio' name='".$answer."' value='".$v2['id']."'>".$v2['answerTxt']."<br>\n";
                            }
                        echo "<BR></div>\n";
                    }
                    
                  echo "</ol>\n";
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>
            <input name="btn" value="Submit" type="submit">
        </form>
    </div>
</body>
</html>