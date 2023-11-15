<?php
    include("config.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quiz tagwall</title>
        <meta name="author" content="Martin Kraus Larsen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="https://fonts.googleapis.com/css?family=Montserrat|PT+Serif" rel="stylesheet">
        <link rel="stylesheet" href="style.css" >    
    </head>
    
    <body>
        <header><h1>Quiz tagwall</h1></header>
        <hr>
        <ol type="1" >
        <?php
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT quiz, person, result FROM qresults WHERE latest=1 AND quiz='" . $quizNumber . "'");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach($stmt->fetchAll() as $k=>$v) {
                    echo "<div id='question-container'>\n";
                    echo "<li><h2 class='question' id='".$v['id']."' >".$v['person']."</h2></li>\n";
                    echo "<p>". $v['result'] . "</p>\n";
                    echo "</div>\n";
                }
                echo "</ol>\n";               
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>
      
    </body>
</html>