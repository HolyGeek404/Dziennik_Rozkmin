<?php
    session_start();
    require_once "connect.php";

    $conn = connectToDatabase();

    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);


    $query = "SELECT * FROM uzytkownicy WHERE nick=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row != NULL) {
        $user_pass = $row['haslo'];

        // Używanie funkcji password_verify do porównywania hasła
        if (password_verify($pass, $user_pass)) {
            $_SESSION['user_id'] = $row['Iduzytkownika'];
            $_SESSION['user_img'] = $row['user_img'];
            $_SESSION['user_login'] = $row['nick'];

            if ($row['aktywowany'] == 1) {
                header("Location: ../index.php");
                exit();
            } else {
                $_SESSION['Error'] = "Twoje konto nie jest jeszcze aktywowane. Sprawdź skrzynkę e-mail.";
                header("Location: ../index.php");
                exit();
            }
        } else {
            $_SESSION['Error'] = "Nieprawidłowe hasło.";
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['Error'] = "Użytkownik o podanym loginie nie istnieje.";
        header("Location: ../index.php");
        exit();
    }
?>