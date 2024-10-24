@extends('layout.pdf.layout_pdf')
@section('title')
    Plan des stands
@endsection
@section('content')

    <style>
        .stand {
            width: 50px; /* Adjust the width to control the number of stands per row */
            max-width: 50px;
            height: 50px;
            text-align: center;
            font-size: 10px;
            margin: 5px;
            box-sizing: border-box;
        }
    </style>

    <div class="stands-container">
        <div style="margin-bottom: 80px"></div>
        <table width="100%">
            <tr>
                @foreach($aStands as $index => $as)
                    <td class="stand" style="background-color: {{ $as->category->color }};
                        border: 1px solid {{ $as->booked_for && !$as->is_paid ? 'red' : 'black' }};">
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
                    <td class="stand" style="background-color: {{ $bs->category->color }};
                        border: 1px solid {{ $bs->booked_for && !$bs->is_paid ? 'red' : 'black' }};">
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
                    <td class="stand" style="background-color: {{ $cs->category->color }};
                        border: 1px solid {{ $cs->booked_for && !$cs->is_paid ? 'red' : 'black' }};">
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
                    <td class="stand" style="background-color: {{ $ds->category->color }};
                        border: 1px solid {{ $ds->booked_for && !$ds->is_paid ? 'red' : 'black' }};">
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
