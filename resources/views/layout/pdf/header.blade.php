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
        color: blue;
    }

    .text-red {
        color: blue;
    }
</style>


<table class="table-header">
    <tr>
        <td style="width: 40%">
            <span class="clinic-name text-red">Medex Mauritanie</span><br>
            <span>NOUAKCHOTT MAURITANIE</span> <br>
            <span style="font-weight: bold">Tél: (+222) 36293639 / 26212622</span> <br>
            <span>E-mail: contact@medex.mr</span>
        </td>
        <th style="width: 20%">
            <img src="{{ public_path(config('setup.logo_main')) }}" alt="" style="width: 80px">
        </th>
        <td style="width: 40%;" dir="rtl">
            <span class="clinic-name text-green">مدكس موريتانيا</span><br>
            <span>نواكشوط موريتانيا</span><br>
            <span style="font-weight: bold">هاتف: (+222) 36293639 / 26212622</span><br>
            <span>بريد الإلكتروني: contact@medex.mr</span>
        </td>
    </tr>
</table>
<hr style="border-width: 2px">
