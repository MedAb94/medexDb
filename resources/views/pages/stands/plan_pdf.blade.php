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
            font-size: 10px;
            /*padding-top: 5px;*/
            margin: 5px;
            box-sizing: border-box;
        }


    </style>

    <div class="stands-container">
        <div style="margin-bottom: 80px"></div>
        <table width="100%">
            <tr>
                @foreach($aStands as $index => $as)
                    <td class="stand" style="background-color: {{ $as->category->color }};">
                        {{$as->number}} <br>
                        {{$as->booked_for}}
                    </td>

                    @if(($index + 1) % 3 == 0)
                        <td width="5px"></td> <!-- Blank td after every 3 tds -->
                    @endif
                @endforeach
            </tr>

            <!-- Add spacer row to leave space between sections -->
            <tr>
                <td colspan="3" height="100px"></td>
            </tr>

            <!-- Add the 2nd and 3rd rows to the bottom -->
            <tr>
                @foreach($bStands as $index => $bs)
                    <td class="stand" style="background-color: {{ $bs->category->color }};">
                        {{$bs->number}} <br>
                        {{$bs->booked_for}}
                    </td>

                    @if($index == 7 || ($index > 7 && ($index - 7) % 7 == 0))
                        <td></td> <!-- Blank td after the first 7 and then after every 6 -->
                    @endif
                @endforeach
            </tr>

            <tr>
                @foreach($cStands as $index => $cs)
                    <td class="stand" style="background-color: {{ $cs->category->color }};">
                        {{$cs->number}} <br>
                        {{$cs->booked_for}}
                    </td>

                    @if($index == 7 || ($index > 7 && ($index - 7) % 7 == 0))
                        <td></td> <!-- Blank td after the first 7 and then after every 6 -->
                    @endif
                @endforeach
            </tr>

            <!-- Another spacer to separate sections -->
            <tr>
                <td colspan="3" height="100px"></td>
            </tr>

            <!-- Last row -->
            <tr>
                @foreach($dStands as $index => $ds)
                    <td class="stand" style="background-color: {{ $ds->category->color }};">
                        {{$ds->number}}<br>
                        {{$ds->booked_for}}
                    </td>

                    @if(($index + 1) % 3 == 0)
                        <td></td> <!-- Blank td after every 3 tds -->
                    @endif
                @endforeach
            </tr>
        </table>
    </div>

@endsection
