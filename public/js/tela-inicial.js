// Atualizar a hora a cada segundo
setInterval(function() {
    var now = new Date();
    var timeString = now.toLocaleTimeString();
    document.getElementById('hora-atual').innerHTML = timeString;
}, 1000);