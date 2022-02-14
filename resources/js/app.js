require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**
 * Initilize Clients
 */
function clientSocket(config = {}) {
    let route = config.route || "127.0.0.1";
    let port = config.port || "3280";
    window.Websocket = window.WebSocket || window.MozWebSocket;
    return new WebSocket("ws://" + route + ":" + port);
}

// Instantiate a connection
var connection = clientSocket();


/**
 * When the connection is open
 */
connection.onopen = function() {
    console.log("Connection is open!");
}

connection.onclose = function () {
    console.log("Connection was closed!");
    console.log("Reconnecting after 10 seconds...");
    setTimeout(() => {
        window.location.reload();
    }, 10000);
}

/**
 * Will receive the messages from the websocket server
 * @param {*} message
 */
connection.onmessage = function (message) {
    var result = JSON.parse(message.data);
    var notificationMessage = `
        <h3>${result.eventName}</h3>
        <p>${result.eventMessage}</p>
    `;

    // Begin animation - Display Message
    $(".event-notification-box").html(notificationMessage);
    $(".event-notification-box").removeClass("opacity-0");
    $(".event-notification-box").addClass("opacity-100");

    // Hide the message
    setTimeout(() => {
        $(".event-notification-box").addClass("opacity-0");
        $(".event-notification-box").removeClass("opacity-100");
    }, 3000);
}

/**
 * The event listener that will be dispatched to the websocket
 */
window.addEventListener('event-notification', event => {
    connection.send(JSON.stringify({
        eventName: event.detail.eventName,
        eventMessage: event.detail.eventMessage
    }));
})
