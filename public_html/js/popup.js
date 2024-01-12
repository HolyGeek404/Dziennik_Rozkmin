function displayErrorMessage(message) {
    var errorDiv = $("<div>").attr("id", "error_msg");
    $("body").prepend(errorDiv);

    var span = $("<span>").text(message);
    $(errorDiv).prepend(span);

    setTimeout(function () {
        $(errorDiv).animate({
            right: "0px"
        }, 800);
    }, 800);

    setTimeout(function () {
        $(errorDiv).animate({
            right: "-350px"
        });
    }, 4500);

    setTimeout(function () {
        $(errorDiv).remove();
    }, 5000);
}

document.getElementById('forgotPasswordBtn').addEventListener('click', function () {
    document.getElementById('forgotPasswordPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
});

document.getElementById('closePopupBtn').addEventListener('click', function () {
    document.getElementById('forgotPasswordPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
});

// Dodaj zdarzenie kliknięcia do overlaya
document.getElementById('overlay').addEventListener('click', function () {
    document.getElementById('forgotPasswordPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
});