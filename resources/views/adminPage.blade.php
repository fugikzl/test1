<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>админ</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>
<body style="padding: 20px 20px">
    <form method="POST" action="{{route("exit")}}">
        @csrf
        <input type="submit" value="Выйти">
    </form>

    <table style="max-width:100%"class="table">
        <tbody>
            <tr>
                <th scope="col">phone</th>
                <th scope="col">username</th>
                <th scope="col">link</th>
                <th scope="col">дата создания</th>
                <th scope="col">дата исхода</th>

                <th scope="col">Редактировать</th>
                <th scope="col">Удалить</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <form method="POST" action={{route("redact")}}>
                    @csrf
                    <td><input value="{{$user->phone}}" name="newphone" required size='12'></td>
                    <td><input value="{{$user->username}}" name="username" required ></td>
                    <td>{{$user->unique_link}}</td>
                    <td>{{$user->link_created_at}}</td>
                    <td>{{$user->link_will_end_at}}</td>
                    <input type="hidden" value="{{$user->phone}}" name="phone">
                    <td><input type="submit" value="Редактировать" class="btn btn-primary"></td>
                </form>
               <td>
                   <form method="POST" action={{route("delete")}}>
                       @csrf
                       <input type="hidden" name="phone" value="{{$user->phone}}">
                       <input type="submit" value="удалить" class="btn btn-danger">
                   </form>
                </td>

            </tr>
            @endforeach
            

        </tbody>
    </table>  
    <div>
        <label>Создать нового пользователя</label>
        <form method="POST" action={{route("newUser")}}>
            @csrf
        <input name="username" required class="form-control" placeholder="username">
        <br>
        <input class="form-control" name="phone" zize="12" required placeholder="385aabbbcccc">
        <br>
        <input type="submit" value="Создать нового пользователя" class="btn btn-success">
        </form>
    </div>
    
</body>
</html>