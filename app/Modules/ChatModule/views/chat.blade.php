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
    <center><form method="post">
        @csrf
        <table>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Message: </td>
                <td><textarea rows="10" cols="50" name="content"></textarea></td>
            </tr>
        </table>
        <input type="submit" value="Send">
    </form></center>
</body>
<script type="text/javascript"  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
<script>
    var socket = io('http://localhost:6003')
    socket.on('laravel_database_chat:message', function (data) {
        console.log('A new customer just start a chat')
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