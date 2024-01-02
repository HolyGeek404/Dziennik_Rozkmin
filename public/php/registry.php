<?php
    session_start();

    require_once('connect.php');

    $conn = connectToDatabase();

    $_SESSION['gites'] = true;
    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass_rep = filter_var($_POST['pass_rep'], FILTER_SANITIZE_STRING);
    $hash_pass_rep = password_hash($pass_rep, PASSWORD_DEFAULT);
    $activationCode = generateActivationCode();

    if (!$conn) {
        $_SESSION['Error'] = "Błąd połączenia z bazą danych.";
        header("Location: ../registration.php");
        exit();
    } else {
        if (strlen($login) < 3) {
            $_SESSION['Error'] = "Login musi mieć co najmniej 3 znaki";
            header("Location: ../registration.php");
            exit();
        } elseif (!$email) {
            $_SESSION['Error'] = "Nieprawidłowy format adresu email";
            header("Location: ../registration.php");
            exit();
        } elseif (strlen($pass) < 8 || $pass !== $pass_rep) {
            $_SESSION['Error'] = "Hasło musi mieć co najmniej 8 znaków i być zgodne z powtórzeniem";
            header("Location: ../registration.php");
            exit();
        }
    }

    $stmt = $conn->prepare("SELECT nick, email FROM uzytkownicy WHERE nick=? OR email=?");
    $stmt->bind_param("ss", $login, $email);
    $stmt->execute();
    $stmt->store_result();
    $row = $stmt->num_rows;

    if ($row != 0) {
        $_SESSION['Error'] = "Użytkownik o podanym loginie lub emailu już istnieje";
        header("Location: ../registration.php");
        $stmt->close();
        exit();
    } else {

        $stmt = $conn->prepare("INSERT INTO uzytkownicy (nick, haslo, email, kod_aktywacyjny) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $login, $hash_pass_rep, $email, $activationCode);
        $result = $stmt->execute();

        if (!$result) {
            $_SESSION['Error'] = "Błąd podczas dodawania użytkownika do bazy danych";
        } else {
            $subject = "Aktywacja konta";
            $message = "Witaj $login,<br><br>Kliknij poniższy link, aby aktywować swoje konto:<br>http://localhost/php/activation_account.php?code=$activationCode";

            $_SESSION['email'] = $email;
            $_SESSION['subject'] = $subject;
            $_SESSION['message'] = $message;
            header("Location: send_mail.php");
            $stmt->close();
            exit();
        }

        header("Location: ../index.php");
        $stmt->close();
        exit();
    }

    function generateActivationCode(): string
    {
        return bin2hex(random_bytes(16));
    }
?>
