<?php
    require_once "connect.php";

    function QueryUserProfile($id, $conn)
    {
        $query = "SELECT Iduzytkownika, nick, user_img, email, Data_dolaczenia, Omnie
                      FROM uzytkownicy
                      WHERE Iduzytkownika = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }

    function User_object($object, $id, $conn)
    {
        $resultArray = mysqli_fetch_assoc(QueryUserProfile($id, $conn));
        return $resultArray[$object];
    }

    function UserThink($id, $conn)
    {
        $query = "SELECT temat, idrozkminy
                      FROM rozkminy
                      WHERE Iduzytkownika = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result;
    }
?>
