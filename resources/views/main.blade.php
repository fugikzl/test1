<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>регистрация</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
    <div class="containter">
        <div class="card-body d-flex flex-column justify-content-center" style="align-items: center;">
            <h3 class="card-title">Регистрация</h3> 
            <form method="POST" action={{route('registration')}}>
            <div class="form-group d-flex flex-column" style="">
              @csrf
              <label for="exampleFormControlInput1">Введите имя пользователя</label>
              <input type="login" name="username" class="form-control form-control" required id="exampleFormControlInput1" placeholder="username">
              <label for="exampleFormControlInput1">Введите телефонный номер</label>
              <input  name ="phone" class="form-control form-control" required id="exampleFormControlInput1" placeholder="385bbcccdddd ">
              <br>
              <input type="submit" class="btn btn-primary" value="регистрация">
            </div>
            </form>
            @guest
            <a href="{{route("adminLogin")}}">Вход в админ</a>
            @endguest
            @auth
            <a href="{{route("adminPage")}}">Админ панель</a>

            @endauth
          </div>
    </div>
</body>
</html>