@extends('exports.layout_pdf')
@section('content')
    <style>
        .table-total {
            width: 100%;
            border-collapse: collapse;
        }

        .table-total th, .table-total td {
            border: 1px solid black;
        }

        table td {
            padding: 0 10px;
            font-size: 12px;
        }

        table td p {
            font-size: 10px !important;
        }
    </style>
    <style>
        .sous-total td:nth-child(3) {
            border-top: solid 1px #000;
            border-bottom: solid 1px #000;
            border-right: 0;
            border-left: 0;
        }

        .sous-total td:nth-child(4) {
            border-top: solid 1px #000;
            border-bottom: solid 1px #000;
        }

        .sous-total td:nth-child(1) {
            border-top: solid 1px #000;
            border-bottom: solid 1px #000;
            border-right: 0;
            text-align: center;
        }

        .sous-total td:nth-child(2) {
            border-top: solid 1px #000;
            border-bottom: solid 1px #000;
            border-right: 0;
            border-left: 0;
        }

    </style>
    @include('layout.pdf.header')

    <table>
        <tr>
            <td style="width: 33.33%" class="barcode">
                <img height="20" src="{{ asset('img/bar-code.png') }}">
            </td>
            <th style="width: 33.33%" class="text-center">
                <h3>FACTURE</h3>
            </th>
            <th style="width: 33.33%" class="qr-code">
                <h4 class="text-green">DIPLICATAT</h4>
            </th>
        </tr>
    </table>

    <table>
        <tr>
            <td width="50%">
                <h3 style="font-weight: normal">MED ABDALLAHI OULD AHMED</h3>
            </td>
            <td></td>
            <td style="text-align: right">FACTURE N°: FMG20216/49497</td>
        </tr>
    </table>

    <table>
        <tr>
            <td width="33.33%"></td>
            <td></td>
            <td width="33.33%" style="text-align: right; font-size: 14px">Date de facture: 2021-09-16</td>
        </tr>
        <tr>
            <td>N°: 118 632 Tél: 36351982</td>
            <td width="50%">Matricule: 4527130</td>
            <td style="text-align: right">Établie par: Yeslem</td>
        </tr>
    </table>

    <table>
        <tr>
            <td width="100%">PC: PR:MSH INTERNATIONAL (PR MSH INTERNATIONAL)</td>
        </tr>
    </table>

    <br>

    <table class="facture-table">
        <tr>
            <th width="60%">ACTE</th>
            <th>Nombre</th>
            <th>Mt N-UM</th>
            <th>Mt A-UM</th>
        </tr>
        <tr>
            <td class="title">FRAIS DE SAIJOURS</td>
            <td></td>
            <td class="title">200</td>
            <td class="title">2000</td>
        </tr>
        <tr>
            <td>chambre 201</td>
            <td>1</td>
            <td>200</td>
            <td>2000</td>
        </tr>
        <tr>
            <td class="title">MEDICAMENTS & CONSOMMABLLES</td>
            <td></td>
            <td class="title">200</td>
            <td class="title">2000</td>
        </tr>
        <tr>
            <td>DEXAMETHASONE 4mg/ml</td>
            <td>4</td>
            <td>416</td>
            <td>4 160</td>
        </tr>
        <tr>
            <td>DUOCLAV 1.2G</td>
            <td>3</td>
            <td>975</td>
            <td>9 750</td>
        </tr>
        <tr>
            <td>INTRANULE 18</td>
            <td>1</td>
            <td>78</td>
            <td>780</td>
        </tr>
        <tr>
            <td>INTRANULE 22</td>
            <td>2</td>
            <td>156</td>
            <td>1 560</td>
        </tr>
        <tr>
            <td>KIT INJECTION</td>
            <td>3</td>
            <td>117</td>
            <td>1 170</td>
        </tr>
        <tr>
            <td>LOVENOX 04</td>
            <td>1</td>
            <td>468</td>
            <td>4 680</td>
        </tr>
        <tr>
            <td>PERFUSEURS</td>
            <td>2</td>
            <td>130</td>
            <td>1 300</td>
        </tr>
        <tr>
            <td>SS 9%</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>ANALYSES MEDICALES</td>
            <td></td>
            <td>3120</td>
            <td>31 200</td>
        </tr>
        <tr>
            <td>CREATINEMIE</td>
            <td>1</td>
            <td>195</td>
            <td>1 950</td>
        </tr>
        <tr>
            <td>CRP</td>
            <td>1</td>
            <td>390</td>
            <td>3 900</td>
        </tr>
        <tr>
            <td>D - DIMER</td>
            <td>1</td>
            <td>1 300</td>
            <td>13 000</td>
        </tr>
        <tr>
            <td>KIT PRELEVEMENT</td>
            <td>3</td>
            <td>195</td>
            <td>1 950</td>
        </tr>
        <tr>
            <td>NFS</td>
            <td>1</td>
            <td>325</td>
            <td>3 250</td>
        </tr>
        <tr>
            <td>TRANSAMINASES</td>
            <td>1</td>
            <td>520</td>
            <td>5 200</td>
        </tr>
        <tr>
            <td>UREE</td>
            <td>1</td>
            <td>195</td>
            <td>1 950</td>
        </tr>
        <tr class="sous-total">
            <td style="">Sous-total</td>
            <td style=""></td>
            <td style="">9 230</td>
            <td style="">92 300</td>
        </tr>

        <tr>
            <td class="title">IMAGERIE</td>
            <td></td>
            <td class="title">11 960</td>
            <td class="title">119 600</td>
        </tr>
        <tr>
            <td>TDM ABDOMINAL DR AHMEDOU SEYID</td>
            <td>1</td>
            <td>6 110</td>
            <td>61 100</td>
        </tr>
        <tr>
            <td>TDM THORAX SANS INJECTION DR AHMEDOU SEYID</td>
            <td>1</td>
            <td>5 850</td>
            <td>58 500</td>
        </tr>
        <tr>
            <td>HONORAIRES MEDECINS</td>
            <td></td>
            <td>1 690</td>
            <td>16 900</td>
        </tr>
        <tr>
            <td>DR DELLAHI</td>
            <td>1</td>
            <td>520</td>
            <td>5 200</td>
        </tr>
        <tr>
            <td>DR ZAWI O CHEYBANI</td>
            <td>1</td>
            <td>520</td>
            <td>5 200</td>
        </tr>
        <tr>
            <td>MEDECIN RESIDENT</td>
            <td>1</td>
            <td>650</td>
            <td>6 500</td>
        </tr>
        <tr class="sous-total">
            <td>Sous-total</td>
            <td></td>
            <td>11 960</td>
            <td>119 600</td>
        </tr>
        <tr class="sous-total">
            <td>Total facture</td>
            <td></td>
            <td>21 190</td>
            <td>211 900</td>
        </tr>

    </table>
    <br>
    <table>
        <tr>
            <td width="40%"></td>
            <td width="60%">
                <table class="table-total">
                    <tr>
                        <th style="border-right: 0;"></th>
                        <th style="border-left: 0;">N-UM</th>
                        <th>A-UM</th>
                    </tr>
                    <tr>
                        <td style="border-right: 0;">
                            <p style="font-weight: bold">Total facture</p>
                            <p>Remise</p>
                            <p>Frais PCBI</p>
                        </td>
                        <td style="border-right: 0; border-left: 0;text-align: right">
                            <p>22 880,0</p>
                            <p>0</p>
                            <p>0</p>
                        </td>
                        <td style="text-align: right">
                            <p>228 800,0</p>
                            <p>0</p>
                            <p>0</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right: 0;">
                            <p style="font-weight: bold">Net à payer</p>
                            <p>Avance</p>
                        </td>
                        <td style="border-right: 0; border-left: 0;text-align: right">
                            <p>22 880,0</p>
                            <p>0</p>
                        </td>
                        <td style="text-align: right">
                            <p>228 800,0</p>
                            <p>0</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; font-weight: bold">Reste à payer</td>
                        <td style="border-right: 0; border-left: 0;text-align: right">0,0</td>
                        <td style="text-align: right">0</td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    <br>

    <style>
        .table-reglement {
            width: 100%;
            border-collapse: collapse;
        }

        .table-reglement tr {
            border: 1px solid black;
        }

        table td {
            padding: 0 10px;
            font-size: 12px;
        }

        table td p {
            font-size: 10px !important;
        }
    </style>

    <table class="table-reglement">
        <tr>
            <th style="text-align: left">Reglement</th>
            <th>Justif</th>
            <th>Date</th>
            <th>N-UM</th>
            <th>A-UM</th>
        </tr>
        <tr>
            <td>
                <p>PC PR:MSH INTERNATIONAL</p>
                <p>CASH</p>
            </td>
            <td></td>
            <td>
                <p>29/06/2021</p>
                <p>29/06/2021</p>
            </td>
            <td style="text-align: right">
                <p>22 880,0</p>
                <p>0,0</p>
            </td>
            <td style="text-align: right">
                <p>228 800,0</p>
                <p>0,0</p>
            </td>
        </tr>
        <tr>
            <th style="text-align: left">Total reglement</th>
            <th></th>
            <th></th>
            <th style="text-align: right">22 880,00</th>
            <th style="text-align: right">228800,00</th>
        </tr>
        <tr>
            <td colspan="5" style="padding: 5px">
                <b style="text-decoration: underline; font-size: 15px">Pour la caisse :</b>
                <span>HAMAD</span>
            </td>
        </tr>
    </table>

@endsection
