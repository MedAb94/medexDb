@php
    $model = $export->model;
    $title = $export->title;
    $query = $export->query;
    $data_values = $model::getExcelData();
    $headers = $model::getExcelHeaders();
    $data = $model::all();
@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$export->title}}</title>
</head>
<body>
{{--@include('layout.pdf.header')--}}
<table>
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th style="font-weight: bolder;padding: 10px">
            <h3>
                {{$title}}
            </h3>
        </th>
    </tr>
    </thead>
</table>

<table>
    <thead>
    <tr>
        @foreach($headers as $header)
            <th>{{$header}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            @foreach($data_values as $data_value)
                <td>{{$item->$data_value}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
