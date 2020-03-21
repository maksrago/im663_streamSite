function ReloadChat() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("messages_box").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "forms/chatreload.php?id={{ stream_id }}", true);
    xhttp.send();
}