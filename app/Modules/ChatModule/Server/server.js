var io = require('socket.io')(6003);
console.log('Connected to port 6003');
io.on('error', function (socket) {
    console.log('error')
});
io.on('connection', function (socket) {
    console.log('A connection has just been made: ' + socket.id)
});

var RedisConn = require('ioredis');
var redis = new RedisConn(69);
redis.psubscribe("*", function (error, count) {
    console.log("This is count: "+ count);
});

redis.on('pmessage', function (partner, channel, message) {
    console.log("This is partner: "+ partner);
    console.log('Hi! Im in redis.on');
    message = JSON.parse(message);
    io.emit(channel+ ":"+ message.event, message.data.messages);
    console.log("This is the channel: "+ channel);
    console.log("This is the event: "+ message.event);
    console.log("This is the content: "+ message.data.messages.username);
});
