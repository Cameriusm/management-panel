<!DOCTYPE html>
<html lang="ru">
<head>
    <style>
        *{ font-family:"DeJaVu Sans Mono",monospace; }
    </style>
  <meta charset="utf-8">
        </head>
        <body>
        <h2 style="text-align:center">Отчёты</h2>
        <table style="width:100%;" border="1">
            <thead>
                <tr>
                  <th style="text-align:center"><strong>№</strong></th>
                  <th style="text-align:center"><strong>Дата</strong></th>
                  <th style="text-align:center"><strong>Автор</strong></th>
                  <th style="text-align:center"><strong>Название</strong></th>
                  <th style="text-align:center"><strong>Содержание</strong></th>
                </tr>
              </thead>
            <tbody>
              
                @foreach ($reports as  $report)
            <tr class="report-row">
              <th>{{$report['id']}}</th>
              {{-- <th class="report-date">{{$report["created_at"]}}</th> --}}
              <th>{{Carbon\Carbon::parse($report["created_at"])->toDateString()}}</th>
              <th>{{$report["name"]}}</th>
              {{-- <th>{{Auth::user()->where('id', $report->user_id)->value('name')}}</th> --}}
              <th>{{$report['title']}}</th>
              <th>{{$report['desc']}}</th>
              
            </tr>    
            @endforeach


            </tbody>
        </table>
    
        </body>
        </html>"