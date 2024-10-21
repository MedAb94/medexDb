@php use Carbon\Carbon; @endphp

<table style="border: 0; width:100%;margin-top: 10px;" cellspacing="0">
    <tr class="tR">
        <td>
            <i> CLINIQUE CHIVA</i>
        </td>
        <td>{{Carbon::now()->format('d/m/Y H:i:s')}}</td>
        <td  style="text-align: right;">
            Page {PAGENO}/{nbpg}
        </td>
    </tr>
</table>
