<?php
    $sitename = 'FbMDevops Desktop Quiz';
    $sitedescription = 'Guees a desktop';
    $author = 'Martin Kraus Larsen';
    $note = 'If you dont click any answer, the corresponding marks for that question will be marked <strong>ZERO</strong> and further changes cannot be undone.';
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
        <form action="run_quiz.php" method="POST">
            <br>
            <div id="name-container">
                <h2 class="namespace" id="givenname" >What is your name?</h2>
                <input type="text" name="givenname" value="..lazy dog"><br>
            </div>

            <ol type="1" >
                <input name="btn" value="Start quiz" type="submit">
            </ol>

        </form>
    </div>
</body>
</html>