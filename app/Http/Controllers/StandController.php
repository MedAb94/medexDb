<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stand;
use Illuminate\Http\Request;

class StandController extends Controller
{
    public function index()
    {
        return view('pages.stands.index');
    }


    public function dt()
    {
        $contacts = Stand::query()->latest();
        $category_id = request()->category_id;
        $booking = request()->booking;
        $payment = request()->payment;

        if ($category_id) {
            $contacts->where('category_id', $category_id);
        }
        if (isset($booking) && $booking != 9) {
            $contacts->where('booked', $booking);
        }

        if (isset($payment) && $payment != 9) {
            $contacts->where('paid', $payment);
        }

        return datatables()->of($contacts)

            ->editColumn('category_id', function ($row) {
                return $row->category->name ?? "";
            })

            ->addColumn('actions', function ($instance) {
                return view('pages.stands.actions', compact('instance'));
            })
            ->rawColumns([ 'actions'])
            ->make(true);
    }

    public function plan()
    {
        $aStands = Stand::where('number', 'like', 'A%')->orderBy('number')->get();
        $bStands = Stand::where('number', 'like', 'B%')->orderBy('number')->get();
        $cStands = Stand::where('number', 'like', 'C%')->orderBy('number')->get();
        $dStands = Stand::where('number', 'like', 'D%')->orderBy('number')->get();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->SetAuthor("MyClinic");
        $mpdf->SetTitle('Cloture');
        $mpdf->SetSubject('fiche');
        $mpdf->SetMargins(0, 0, 10, 0);
        $mpdf->SetDisplayMode('fullpage');
        //direction
        $mpdf->SetDirectionality('rtl');
        $mpdf->AddPage('L', 'A4', '', '', '', 10, 10, 10, 10, 0, 0);
        $mpdf->writeHTML(
            view('pages.stands.plan_pdf', [
                'aStands' => $aStands,
                'bStands' => $bStands,
                'cStands' => $cStands,
                'dStands' => $dStands,
            ])->render()
        );

        $mpdf->Output();
    }


}
