<?php
    session_start();
    require_once 'connect.php';

    $conn = connectToDatabase();

    $activationCode = isset($_GET['code']) ? $_GET['code'] : '';

    if (empty($activationCode)) {
        $_SESSION['Error'] = "Brak kodu aktywacyjnego.";
        header("Location: /");
        exit();
    }

    $query = "SELECT * FROM uzytkownicy WHERE kod_aktywacyjny = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $activationCode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        $userId = $row['Iduzytkownika'];

        $stmt = $conn->prepare("UPDATE uzytkownicy SET aktywowany = 1 WHERE Iduzytkownika = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();

        $_SESSION['Error'] = "Konto zostało pomyślnie aktywowane. Możesz się teraz zalogować.";
    } else {
        $_SESSION['Error'] = "Błąd aktywacji konta. Nieprawidłowy kod aktywacyjny.";
    }

    header("Location: /");
    exit();
?>
