<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Message</title>
</head>
<body>
<div id="data">
    @foreach($messages as $mess)
        <p id="{{$mess->id}}"><strong>{{$mess->username}}</strong>: {{$mess->content}}</p>
    @endforeach
</div>
<center><form method="post" action="chat">
        @csrf
        <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Message: </td>
                <td><textarea rows="10" cols="50" name="content"></textarea></td>
                <input name="request" value="0">
                <input name="conversation_id" value="1">
            </tr>
        </table>
        <input type="submit" value="Send">
    </form></center>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
<script>
    var socket = io('http://localhost:6001')
    socket.on('laravel_database_private-customer', function (data) {
        console.log('Id cuar socket nef: ' + socket.id)
        console.log('Hi Im in sendMess.blade')
        console.log(data)
        if ($('#'+ data.id).length == 0) {
            $('#data').append('<p><strong>'+ data.username+ '</strong>: '+ data.content+ '</p>')
        } else console.log("Duplicate message")
    })

    $('form').on('submit', function(e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url:'chat',
            method: 'POST',
            data: $this.serialize(),
        });
    });

</script>
</html>