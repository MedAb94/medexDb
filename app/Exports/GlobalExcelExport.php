<?php

namespace App\Exports;
use App\Models\ExcelExport;
use App\Models\hr\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;



class GlobalExcelExport implements FromView,ShouldAutoSize
{
    public ExcelExport $excelExport;


    public function __construct($excelExport)
    {
        $this->excelExport = $excelExport;
    }
    public function styles(Worksheet $sheet)
    {
        // Styling for the header
        $sheet->mergeCells('A1:C1');
        $sheet->getStyle('A1:C1')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(15)->setColor(new Color('FF0000'));
        $sheet->getRowDimension('7')->setRowHeight(50); // Adding bottom space to the header
        $sheet->setCellValue('A1', 'CLINIQUE CHIVA');

        $sheet->setCellValue('A2', 'Ilot A, N°: 54 BP 803 TVZ');
        $sheet->setCellValue('A3', 'NOUAKCHOTT MAURITANIE');
        $sheet->setCellValue('A4', 'Tél: (222) 45 25 80 80 / 22 34 24 29');
        $sheet->setCellValue('A5', 'Fax: 00 222 45 25 34 35');
        $sheet->setCellValue('A6', 'E-mail: cliniquechiva@chiva.com');

        $sheet->getStyle('A2:A6')->getFont()->setBold(true);

        $sheet->mergeCells('D1:F1');
        $sheet->getStyle('D1:F1')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('D1')->getFont()->setBold(true)->setSize(15)->setColor(new Color('008000'));
        $sheet->setCellValue('D1', 'مصحة الشفاء');

        // Additional styling if needed

        // Return the styles
        return [
            1 => ['font' => ['bold' => true]],
            // Additional styling if needed
        ];
    }



    public function view(): \Illuminate\Contracts\View\View
    {
        return view('pages.excel_exports.index', [
            'export' => $this->excelExport,
        ]);
    }
}
