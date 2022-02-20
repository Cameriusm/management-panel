<!DOCTYPE html>
<html lang="ru">
  <head>
    <style>
        *{ font-family:"DeJaVu Sans Mono",monospace; }
    </style>
    <meta charset="utf-8">
  </head>
  <body>
    <h2 style="text-align:center">Отчёт за {{$reports['date']}}</h2>
    <h3>Не сдали отчёт:</h3>
    @foreach ($reports['unsubmitted'] as $user)
        <p>#
        <span>{{$user['name']}}</span></p>
    @endforeach
    <h3>Сдали отчёт:</h3>
    @foreach ($reports['reports'] as $user)
        <p>#
        <span>{{$user['name']}}</span></p>
        <p>Содержание
        <span>{{$user['desc']}}</span></p>
    @endforeach
  </body>
</html>"