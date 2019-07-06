if (!window.WebSocket) {
    alert("Ваш браузер не поддерживает Веб-сокеты");
}

var webSocket = new WebSocket("ws://front.tasks.site:8080?channel=" + channel);

document.getElementById("chat_form")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        var data = {
            message: this.message.value,
            user_id: this.user_id.value,
            channel: this.channel.value
        };

        webSocket.send(JSON.stringify(data));
        return false;
    });

webSocket.onmessage = function (event) {
    var data = JSON.parse(event.data);
    var messageContainer = document.createElement('div');
    var username = document.createElement('span');
    username.innerHTML = data.username;
    messageContainer.appendChild(username);
    var message = document.createElement('span');
    message.innerHTML = data.message;
    messageContainer.appendChild(message);
    document.getElementById("ws_chat")
        .appendChild(messageContainer);
};