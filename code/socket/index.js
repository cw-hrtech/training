let app = require('express')();
let http = require('http').createServer(app);
let io = require('socket.io')(http);
let lodash = require('lodash');

app.get('/', function (req, res) {
    // res.send('<h1>Hello world</h1>');
    res.sendFile(`${__dirname}/chat.html`);
});

http.listen(3000, function () {
    console.log('listening on *:3000');
});


let clients = []

function showClient() {
    console.log('clients', clients)
}

function removeClient(socketId) {
    // let item = clients.fill(item => item.socket_id == socketId);
    lodash.remove(clients, (item) => {
        return item['socket_id'] == socketId
    });
    console.log('removeClient', socketId)
    showClient();
}

function getSocketIdByClientId(clientId) {
    return lodash.filter(clients, (obj) => {
        return obj.client_id == clientId
    })
}

io.on('connection', (socket) => {
    console.log('a user connected', socket.id);

    io.to(socket.id).emit('socket_id', socket.id);

    socket.on('disconnect', () => {
        console.log('a user disconnect', socket.id);
        removeClient(socket.id);
    })

    socket.on('send_message', (obj) => {
        console.log('message: ', obj);

        if (obj.hasOwnProperty('client_id') && obj['client_id'].length > 0) {
            // io.to(obj['client_id']).emit('send_message', {message: obj.message});

            let ids = getSocketIdByClientId(obj['my_id']);
            if (ids.length > 0) {
                lodash.forEach(ids, (item) => {
                    io.to(item.socket_id).emit('send_message', {message: obj.message});
                })
            }


            ids = getSocketIdByClientId(obj['client_id']);
            if (ids.length > 0) {
                lodash.forEach(ids, (item) => {
                    io.to(item.socket_id).emit('send_message', {message: obj.message});
                })
            }

        } else {
            io.emit('send_message', {message: obj.message});
        }
    })


    socket.on('save_client_id', (obj) => {
        clients.push(obj);
        showClient();
    })
});