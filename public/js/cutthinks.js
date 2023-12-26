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