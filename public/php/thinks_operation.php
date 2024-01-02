<?php
    session_start();
    require_once "connect.php";
    
    
    if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        if ( isset( $_POST[ 'action' ] ) ) {
            $action = $_POST[ 'action' ];
            switch ( $action ) {
                case 'addThink':
                    addThink();
                    break;
                case 'updateThink':
                    updateThink();
                    break;
                case 'deleteThink':
                    deleteThink();
                    break;
            }
        }
    }
    
    function addThink()
    {
        
        $temat = isset( $_POST[ 'temat' ] ) ? htmlspecialchars( $_POST[ 'temat' ] ) : '';
        $tresc = isset( $_POST[ 'tresc' ] ) ? htmlspecialchars( $_POST[ 'tresc' ] ) : '';
        $id = isset( $_SESSION[ 'user_id' ] ) ? $_SESSION[ 'user_id' ] : '';
        $query = "SELECT * FROM uzytkownicy WHERE Iduzytkownika='$id'";
        $QueryResult = executeQuery( connectToDatabase(), $query );
        $row = mysqli_fetch_assoc( $QueryResult );
        if ( $row[ 'aktywowany' ] == 1 ) {
            if ( strlen( $temat ) && strlen( $tresc ) ) {
                
                if ( !connectToDatabase() ) {
                    echo mysqli_connect_error();
                } else {
                    $_SESSION[ 'Error' ] = 'Nowa rozkmina została dodana.';
                    mysqli_query( connectToDatabase(), "INSERT INTO rozkminy (temat, tresc, Iduzytkownika) VALUES ('$temat','$tresc','$id')" );
                    header( "Location:../rozkminy.php" );
                }
            } else {
                $_SESSION[ 'Error' ] = 'Nie pozostawiaj pustych pól.';
                $_SESSION[ 'temat' ] = $temat;
                $_SESSION[ 'tresc' ] = $tresc;
                
                header( "Location:../nowa_rozkmina.php" );
            }
        } else {
            $_SESSION[ 'Error' ] = 'Aktywuj konto aby dodać rozkminę.';
            header( "Location: /nowa_rozkmina.php" );
            exit();
        }
    }
    
    function updateThink()
    {
        $tresc = isset( $_POST[ 'tresc' ] ) ? htmlspecialchars( $_POST[ 'tresc' ] ) : '';
        $temat = isset( $_POST[ 'temat' ] ) ? htmlspecialchars( $_POST[ 'temat' ] ) : '';
        $id_rozkminy = isset( $_POST[ 'entryId' ] ) ? $_POST[ 'entryId' ] : '';
        
        if ( isset( $tresc ) && isset( $temat ) && isset( $id_rozkminy ) &&
            strlen( $tresc ) && strlen( $temat ) && strlen( $id_rozkminy ) ) {
            $conn = connectToDatabase();
            if ( !$conn ) {
                echo mysqli_connect_error();
            } else {
                
                // Corrected SQL syntax
                $query = "UPDATE rozkminy SET temat='$temat', tresc='$tresc' WHERE idrozkminy='$id_rozkminy'";
                
                // Execute the query
                mysqli_query( $conn, $query );
                $_SESSION[ 'Error' ] = 'Rozkmina zaktualizowana.';
                
                header( "Location:../tresc_rozkminy.php?Idrozkminy=$id_rozkminy" );
            }
        } else {
            $_SESSION[ 'Error' ] = 'Nie pozostawiaj pustych pól.';
            
            $_SESSION[ 'tresc' ] = $tresc;
            $_SESSION[ 'temat' ] = $temat;
            header( "Location:../tresc_rozkminy.php?Idrozkminy=$id_rozkminy" );
        }
    }
    
    function deleteThink()
    {
        $idrozkminy = isset( $_POST[ 'idrozkminy' ] ) ? htmlspecialchars( $_POST[ 'idrozkminy' ] ) : '';
        
        $conn = connectToDatabase();
        if ( !$conn ) {
            echo mysqli_connect_error();
        } else {
            mysqli_query( $conn, "DELETE FROM rozkminy WHERE idrozkminy = '$idrozkminy'" );
            $_SESSION[ 'Error' ] = 'Rozkmina usunieta.';
            
            header( "Location:../rozkminy.php" );
        }
    }
    
    function viewThink()
    {
        $result = [ 'temat' => '', 'tresc' => '' ];
        
        if ( connectToDatabase()->connect_errno != 0 ) {
            echo "Coś nie pykło" . connectToDatabase()->connect_errno;
        } else {
            $Idrozkminy = $_GET[ "Idrozkminy" ];
            $query = "SELECT temat, tresc
			FROM rozkminy
			WHERE idrozkminy = '$Idrozkminy'";
            $QueryResult = executeQuery( connectToDatabase(), $query );
            
            if ( $QueryResult->num_rows > 0 ) {
                $wiersze = $QueryResult->fetch_assoc();
                $result[ 'temat' ] = $wiersze[ 'temat' ];
                $result[ 'tresc' ] = $wiersze[ 'tresc' ];
                
                $QueryResult->free_result();
            }
        }
        
        return $result;
    }
    
    function checkOwnerThink( $id_rozkminy )
    {
        if ( isset( $_SESSION[ 'user_id' ] ) ) {
            $query = "SELECT Iduzytkownika FROM rozkminy WHERE idrozkminy = '$id_rozkminy'";
            $result = executeQuery( connectToDatabase(), $query );
            
            if ( $result && $result->num_rows > 0 ) {
                $row = $result->fetch_assoc();
                $ownerId = $row[ 'Iduzytkownika' ];
                
                if ( $_SESSION[ 'user_id' ] == $ownerId ) {
                    echo '<button id="editEntryBtn">Edytuj wpis</button>';
                    echo '<form method="post" action="php/thinks_operation.php">';
                    echo '<input type="hidden" name="idrozkminy" value="' . $_GET[ 'Idrozkminy' ] . '">';
                    echo '<button type="submit" name="action" value="deleteThink" onclick="return confirm(\'Czy na pewno chcesz usunąć ten wpis?\');">Usuń wpis</button>';
                    echo '</form>';
                }
            }
        }
    }
    
    function viewThinks()
    {
        $result = [];
        
        if ( connectToDatabase()->connect_errno != 0 ) {
            echo "Coś nie pykło" . connectToDatabase()->connect_errno;
        } else {
            $query = "SELECT uzytkownicy.Iduzytkownika,
                 uzytkownicy.nick,
                 uzytkownicy.user_img,
                 rozkminy.idrozkminy,
                 rozkminy.temat,
                 rozkminy.tresc
          FROM `rozkminy`
          JOIN uzytkownicy
          ON rozkminy.Iduzytkownika = uzytkownicy.Iduzytkownika
          ORDER BY rozkminy.idrozkminy DESC";
            
            $QueryResult = executeQuery( connectToDatabase(), $query );
            
            while ( $row = $QueryResult->fetch_assoc() ) {
                $result[] = $row;
            }
            
            $QueryResult->free_result();
        }
        
        return $result;
    }