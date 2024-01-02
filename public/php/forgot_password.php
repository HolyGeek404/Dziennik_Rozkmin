<?php
    session_start();
    require_once 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

        if ($email) {
            if (emailExistsInDatabase($email)) {
                $newPassword = generateRandomPassword();

                updatePasswordInDatabase($email, $newPassword);

                $subject = "Password Reset";
                $message = "Your new password is: $newPassword";

                $_SESSION['email'] = $email;
                $_SESSION['subject'] = $subject;
                $_SESSION['message'] = $message;
                header("Location: send_mail.php");
                exit();
            } else {
                $_SESSION['Error'] = "Użytkownik o takim emailu nie istnieje.";
                header("Location: /");
                exit();
            }
        }
    }

    function emailExistsInDatabase($email): bool
    {
        $conn = ConnectToDatabase();
        $stmt = $conn->prepare("SELECT * FROM uzytkownicy WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }

    function generateRandomPassword($length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    function updatePasswordInDatabase($email, $password): void
    {
        $conn = ConnectToDatabase();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE uzytkownicy SET haslo = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();
        $stmt->close();
    }
?>
