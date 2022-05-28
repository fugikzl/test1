<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>linkpage</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>
<body style="padding: 10px 10px;">
    <label id="link" link="{{route("link",["unique_link"=>$user[0]->unique_link])}}">Ваша уникальная ссылка {{$user[0]->unique_link}}</label>    <button onclick="copy()">копировать</button>

    <br>
    <label>Срок истечения {{$user[0]->link_will_end_at}}</label>
    <form method="POST" action={{route("linkRefresh")}}>
        @csrf
        <input type="hidden" name='link' value="{{$user[0]->unique_link}}">
        <input type="submit" value="обновить ссылку">
    </form>
    <form method="POST" action={{route("userDelete")}}>
        @csrf
        <input type="hidden" name='link' value="{{$user[0]->unique_link}}">
        <input type="submit" value="деактивировать ссылку и удалить пользователя">
    </form>
    <br>
    <br>
    <form action={{route("play")}} method="POST">
        @csrf
        <input type="hidden" name='phone' value="{{$user[0]->phone}}">
        <input type="submit"  value="I'm feeling lucky" class="btn btn-primary">
    </form>
    <br>
    @foreach ($plays as $play )
        <br>
        <label>Число:{{$play->num}} Выигрыш: {{$play->summ}}</label>
    @endforeach
</body>

<script>
function copy() {

  var copyText = document.getElementById("link");

  navigator.clipboard.writeText(copyText.getAttribute("link"));

  alert("Ссылка скопирована");

}
</script>
</html>