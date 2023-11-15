<?php
include("config.php");
header('Content-Type: image/jpeg');

if(isset($_REQUEST['iCrypt'])){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT id, img FROM qsrc WHERE id=" . $_REQUEST['iCrypt'] );
        $stmt->execute();
        
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach($stmt->fetchAll() as $k=>$v) {
            $src = "popQuiz/" . $v['img'];
            $data = file_get_contents($src);
            //print_r(  $v['img'] );
            echo $data;
            
        }

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

