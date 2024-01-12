<?php
    require_once "./php/connect.php";
    require_once "./php/thinks_operation.php";
    require_once "./php/menu.php";
    $data = viewThink();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rozkmina.pl</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/thinks.css">
    <link rel="stylesheet" type="text/css" href="css/fontello/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <style>
        #topic {
            width: 800px;
            font-size: 24px;
            color: #008aa4;
            font-weight: bold;
            margin: auto;
            padding-top: 15px;
        }

        #content {
            text-align: justify;
            padding: 13px;
            font-size: 18px;
            white-space: pre-wrap;
            font-weight: bold;
            color: #06434f;
            background-color: #4286f4;
            box-shadow: 0px 0px 9px 0px rgba(66, 134, 244, 0.75);
        }
    </style>
</head>
<body>
<div id="container" style="height: auto">
    <div class="menu"><?php echo generateMenu() ?></div>
</div>

</script>
<div id="topic">
    <?php
        echo $data[ 'temat' ];
    ?>
</div>
<div id="content">
    <?php
        echo $data[ 'tresc' ];
        checkOwnerThink( $id_rozkminy = $_GET[ 'Idrozkminy' ] );
    ?>

    <!-- Formularz edycji wpisu -->
    <form id="editEntryForm" method="post" action="php/thinks_operation.php" style="display: none;">
        <textarea id="entryContent" name="temat" rows="1" cols="95"><?php echo $data[ 'temat' ]; ?></textarea>
        <textarea id="entryContent" name="tresc" rows="4" cols="95"><?php echo $data[ 'tresc' ]; ?></textarea>
        <input type="hidden" name="entryId" value="<?php echo $_GET[ "Idrozkminy" ]; ?>">
        <input type="hidden" name="action" value="updateThink">
        <input type="submit" value="Zapisz zmiany">
    </form>
    <script>
        document.getElementById('editEntryBtn').addEventListener('click', function () {
            document.getElementById('editEntryForm').style.display = 'block';
            this.style.display = 'none';
        });
    </script>

    <script src="js/popup.js"></script>
    <?php
        
        if ( isset( $_SESSION[ 'Error' ] ) ) {
            echo "<script>displayErrorMessage('{$_SESSION['Error']}');</script>";
            unset( $_SESSION[ 'Error' ] );
        }
    ?>
</body>
</html>