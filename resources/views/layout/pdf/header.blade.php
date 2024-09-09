<style>
    .table-header {
        width: 100%;
        border-collapse: collapse;
    }

    .clinic-name {
        font-size: 15px;
        font-weight: bold;
        text-align: center;
    }

    .title {
        font-size: 15px;
        font-weight: bold;
    }

    .table-header th, .table-header td {
        /*line-height: 1.5;*/
        text-align: center;
    }

    .table-header {
        font-size: 12px !important;
    }

    .text-green {
        color: #0a8d5b;
    }

    .text-red {
        color: #780606;
    }
</style>

{{--<table>--}}
{{--    <tr>--}}
{{--        <td style="font-weight: bolder;font-size: 20px;color: red;">--}}
{{--            <span style="border: 1px solid red;"> Payed </span>--}}
{{--        </td>--}}
{{--    </tr>--}}
{{--</table>--}}

<table class="table-header">
    <tr>
        <td style="width: 40%">
            <span class="clinic-name text-red">CLINIQUE CHIVA</span><br>
            <span style="font-weight: bold">Ilot A, N°: 54 BP 803 TVZ</span> <br>
            <span>NOUAKCHOTT MAURITANIE</span> <br>
            <span style="font-weight: bold">Tél: (222) 45 25 80 80 / 22 34 24 29</span> <br>
            <span>Fax: 00 222 45 25 34 35</span> <br>
            <span>E-mail: cliniquechiva@chiva.com</span>
        </td>
        <th style="width: 20%">
            <img src="{{ public_path(config('setup.logo_main')) }}" alt="" style="width: 80px">
        </th>
        <td style="width: 40%;" dir="rtl">
            <span class="clinic-name text-green">مصحة الشفاء</span><br>
            <span style="font-weight: bold">حي (أ) رقم 54 ص ب 803 تفرغ زينه</span><br>
            <span>نواكشوط موريتانيا</span><br>
            <span style="font-weight: bold">هاتف: 80 80 25 45 222+</span><br>
            <span>فاكس: 35 34 25 45 222+</span><br>
            <span>بريد الإلكتروني: cliniquechiva@chiva.com</span>
        </td>
    </tr>
</table>
<hr style="border-width: 2px">
