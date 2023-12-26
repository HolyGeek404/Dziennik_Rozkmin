<?php
    require_once( './php/session.php' );
    
    error_reporting( 0 );

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/add_think.css">
    <link rel="stylesheet" type="text/css" href="css/thinks.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <title>Rozkmina.pl - tu gdzie tworzy się myśl</title>
</head>
<body>
<a href="/">
    <button>Powrót</button>
</a>
<label>
    <form action="php/thinks_operation.php" method="post">
        <input type="text" name="temat" placeholder="Temat rozkminy" value="<?php echo htmlspecialchars( $temat ); ?>">
        <textarea wrap="easy" name="tresc"
                  placeholder="Napisz, o czym myślisz . . ."><?php echo htmlspecialchars( $tresc ); ?></textarea>
        <input type="hidden" name="action" value="addThink">
        <input type="submit" value="Dodaj rozkminę">
    </form>
</label>
<script src="js/popup.js"></script>
<?php
    
    if ( isset( $_SESSION[ 'Error' ] ) ) {
        echo "<script>displayErrorMessage('{$_SESSION['Error']}');</script>";
        unset( $_SESSION[ 'Error' ] );
    }
?>
</body>
</html>