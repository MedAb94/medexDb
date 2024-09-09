<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
</head>

<style>
    h1, h2, h3, h4, h5, h6, p, span {
        /*font-family: gadugi, sans-serif;*/
        font-family: 'Dejavu Sans', serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-title {
        font-size: 25px;
        font-weight: bold;
        /*text-align: center;*/
    }

    th, td {
        line-height: 1.5;
    }
    .uppercase{
        text-transform: uppercase;
    }


</style>
<style>
    .facture-table {
        width: 100%;
        border-collapse: collapse;
    }

    .facture-table th {
        border: 1px solid black;
    }

    .facture-table td {
        border-right: solid 1px #000;
        border-left: solid 1px #000;
    }

    .facture-table th, .facture-table td {
        padding: 0 10px;
        text-transform: uppercase;
        font-size: 14px;
    }

    .facture-table th {
        padding: 5px 0;
    }

    .facture-table .title {
        font-weight: bold;
        text-decoration: underline;
    }

    /*     table facture the child number 1, 2 ,3 text-right*/
    .facture-table tr td:nth-child(2),
    .facture-table tr td:nth-child(3),
    .facture-table tr td:nth-child(4) {
        text-align: right;
    }


    .pdf-table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .pdf-table td,
    .pdf-table th {
        border: 1px solid #ddd;
        padding: 8px 15px;
    }

    /*.pdf-table tr:nth-child(even) {*/
    /*    background-color: #f2f2f2;*/
    /*}*/

    .pdf-table tr:hover {
        background-color: #ddd;
    }

    /*.pdf-table th {*/
    /*    padding-top: 12px;*/
    /*    padding-bottom: 12px;*/
    /*    text-align: left;*/
    /*    background-color: #444;*/
    /*    color: black;*/
    /*}*/
    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .text-uppercase {
        text-transform: uppercase;
    }

    .text-success {
        color: #50cd89;
    }

    .text-danger {
        color: #f1416c;
    }
</style>


<body>
@includeWhen(!isset($hide_header)|| (isset($hide_header) && !$hide_header),'layout.pdf.header')
@yield('content')
</body>
</html>
