@extends('layout.pdf.layout_pdf')
@section('title')
    Plan des stands
@endsection
@section('content')

    <style>

        .stand {
            width: 50px; /* Adjust the width to control the number of stands per row */
            max-width: 50px; /* Adjust the width to control the number of stands per row */
            height: 50px;
            border: 1px solid black;
            text-align: center;
            font-size: 12px;
            padding-top: 5px;
            margin: 5px;
            box-sizing: border-box;
        }
    </style>

    <div class="stands-container">
        <table>
            <tr>
                @foreach($aStands as $as)
                    <td class="stand" style="background-color: {{ $as->category->color }};">
                        {{$as->number}} <br>
                        {{$as->booked_for}}
                    </td>
                @endforeach
            </tr>
            <tr>
                <td height="100px"></td>
            </tr>
            <tr>
                @foreach($bStands as $bs)
                    <td class="stand" style="background-color: {{ $bs->category->color }};">
                        {{$bs->number}} <br>
                        {{$bs->booked_for}}
                    </td>
                @endforeach
            </tr>


            <tr>
                @foreach($cStands as $cs)
                    <td class="stand" style="background-color: {{ $cs->category->color }};">
                        {{$cs->number}} <br>
                        {{$cs->booked_for}}
                    </td>
                @endforeach
            </tr>
            <tr>
                <td height="100px"></td>
            </tr>
            <tr>
                @foreach($dStands as $ds)
                    <td class="stand" style="background-color: {{ $ds->category->color }};">
                        {{$ds->number}}<br>
                        {{$ds->booked_for}}
                    </td>
                @endforeach
            </tr>
        </table>

    </div>

@endsection
