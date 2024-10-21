<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;




class EtatExcelExport implements FromView,ShouldAutoSize
{

    private  $article_depot;
    private $is_excel;
    private $depot=null;


    public function __construct( $article_depot,$is_excel,$depot=null)
    {
        $this->article_depot = $article_depot;
        $this->is_excel = $is_excel;
        $this->depot = $depot;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('pages.stocks.etat_export', [
            'article_depot' => $this->article_depot,
            'is_excel' => $this->is_excel,
            'depot' => $this->depot
        ]);
    }
}
