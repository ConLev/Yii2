if (!window.WebSocket) {
    alert("Ваш браузер не поддерживает Веб-сокеты");
}

var webSocket = new WebSocket("ws://front.tasks.site:8080");

document.getElementById("chat_form")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        var message ={
            "message": this.message.value,
            "task_id": this.task_id.value,
            "user_id": this.user_id.value
        };

        console.log(message);
        message = JSON.stringify(message);
        console.log(message);
        webSocket.send(message);
        return false;
    });

webSocket.onmessage = function (event) {
    var data = event.data;
    var message = JSON.parse(data);
    console.log(message);
    console.log(message.message);
    var messageContainer = document.createElement('div');
    var textNode = document.createTextNode(message.message);
    messageContainer.appendChild(textNode);
    document.getElementById("chat")
        .appendChild(messageContainer);
};