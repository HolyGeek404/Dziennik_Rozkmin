<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/fontello/fontello.css">
    <link rel="shortcut icon" type="image/png" href="./img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Dodaj inne elementy head, takie jak linki do stylów CSS, skrypty JS itp. -->

    <title>Document</title>
    <script>
        function CutThinkContent() {
            var ThinkContentClassArrary = document.getElementsByClassName("think_content");

            for (let i = 1; i <= ThinkContentClassArrary.length; i++) {

                var ContentOfThinkContentClass = ThinkContentClassArrary[i - 1].textContent;
                if (ContentOfThinkContentClass.length > 416) {

                    ThinkContentClassArrary[i - 1].innerHTML = "";

                    var CorrectContentSizeOfThinkContentClass = ContentOfThinkContentClass.substring(0, 416);
                    CorrectContentSizeOfThinkContentClass += "...";

                    var x = document.createElement('div');
                    var TextNode = document.createTextNode(CorrectContentSizeOfThinkContentClass);

                    x.id = "test";
                    x.appendChild(TextNode);

                    ThinkContentClassArrary[i - 1].appendChild(x);
                }
            }
        }

        function error_msg() {
            var error_div = document.createElement('div');
            $(error_div).attr('id', 'error_msg');
            $('body').prepend(error_div);
            $(error_div).prepend('<span>Wypełnij prawidłowo formularz</span>');

            setTimeout(function () {
                $(error_div).animate({
                    right: "0px"
                }, 800);
            }, 800);
            setTimeout(function () {
                $(error_div).animate({
                    right: "-350px"
                });
            }, 4500);
            setTimeout(function () {
                $(error_div).remove();
            }, 5000);
            // FUNKCJA KTÓRA TWORZY DIVA Z WIADOMOŚCIĄ O BŁĘDNYM
            // ZALOGOWANIU / REJESTRACJI
        }
    </script>
    <style>
        #test {
            display: flex;
            align-items: center;
            padding: 10px;
        }
    </style>
</head>
<body>
