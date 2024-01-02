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

    function addThink(): void
    {
        $temat = isset($_POST['temat']) ? htmlspecialchars($_POST['temat']) : '';
        $tresc = isset($_POST['tresc']) ? htmlspecialchars($_POST['tresc']) : '';
        $id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        $conn = ConnectToDatabase();


        $activationCheckQuery = "SELECT * FROM uzytkownicy WHERE Iduzytkownika=?";
        $activationCheckStmt = $conn->prepare($activationCheckQuery);
        $activationCheckStmt->bind_param("i", $id);
        $activationCheckStmt->execute();
        $activationResult = $activationCheckStmt->get_result();
        $activationCheckStmt->close();

        $row = $activationResult->fetch_assoc();
        if ($row['aktywowany'] == 1) {

            if (strlen($temat) && strlen($tresc)) {
                $addThinkQuery = "INSERT INTO rozkminy (temat, tresc, Iduzytkownika) VALUES (?, ?, ?)";
                $addThinkStmt = $conn->prepare($addThinkQuery);
                $addThinkStmt->bind_param("ssi", $temat, $tresc, $id);
                $addThinkStmt->execute();
                $addThinkStmt->close();

                $_SESSION['Error'] = 'Nowa rozkmina została dodana.';
                header("Location:../rozkminy.php");
            } else {
                $_SESSION['Error'] = 'Nie pozostawiaj pustych pól.';
                $_SESSION['temat'] = $temat;
                $_SESSION['tresc'] = $tresc;
                header("Location:../nowa_rozkmina.php");
            }
        } else {
            $_SESSION['Error'] = 'Aktywuj konto aby dodać rozkminę.';
            header("Location: /nowa_rozkmina.php");
            exit();
        }
    }


    function updateThink(): void
    {
        $tresc = isset($_POST['tresc']) ? htmlspecialchars($_POST['tresc']) : '';
        $temat = isset($_POST['temat']) ? htmlspecialchars($_POST['temat']) : '';
        $id_rozkminy = isset($_POST['entryId']) ? $_POST['entryId'] : '';

        if (isset($tresc, $temat, $id_rozkminy) &&
            strlen($tresc) && strlen($temat) && strlen($id_rozkminy)) {

            $conn = connectToDatabase();

            if (!$conn) {
                echo mysqli_connect_error();
            } else {
                // Corrected SQL syntax and use of bind_param
                $query = "UPDATE rozkminy SET temat=?, tresc=? WHERE idrozkminy=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssi", $temat, $tresc, $id_rozkminy);
                $stmt->execute();
                $stmt->close();

                $_SESSION['Error'] = 'Rozkmina zaktualizowana.';
                header("Location:../tresc_rozkminy.php?Idrozkminy=$id_rozkminy");
            }
        } else {
            $_SESSION['Error'] = 'Nie pozostawiaj pustych pól.';
            $_SESSION['tresc'] = $tresc;
            $_SESSION['temat'] = $temat;
            header("Location:../tresc_rozkminy.php?Idrozkminy=$id_rozkminy");
        }
    }


    function deleteThink(): void
    {
        $idrozkminy = isset($_POST['idrozkminy']) ? htmlspecialchars($_POST['idrozkminy']) : '';

        $conn = connectToDatabase();
        if (!$conn) {
            echo mysqli_connect_error();
        } else {

            $query = "DELETE FROM rozkminy WHERE idrozkminy = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $idrozkminy);
            $stmt->execute();
            $stmt->close();

            $_SESSION['Error'] = 'Rozkmina usunięta.';
            header("Location:../rozkminy.php");
        }
    }

    
    function viewThink(): array
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
    
    function checkOwnerThink( $id_rozkminy ): void
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
    
    function viewThinks(): array
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