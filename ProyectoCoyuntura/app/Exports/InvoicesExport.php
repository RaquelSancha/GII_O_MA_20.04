<?php
namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class InvoicesExport implements FromView, WithStyles
{
    public function __construct($nombreVariable,$years,$ambitos,$supercategorias,$categoria,$values,$idsCategoria)
    {
        $this->years = $years;
        $this->nombreVariable = $nombreVariable;
        $this->ambitos = $ambitos;
        $this->supercategorias = $supercategorias;
        $this->categoria = $categoria;
        $this->values = $values;
        $this->idsCategoria = $idsCategoria;
    }
    public function view(): View
    {
        $years= $this->years;
        $nombreVariable = $this->nombreVariable;
        $ambitos = $this->ambitos;
        $supercategorias = $this->supercategorias;
        $categoria = $this->categoria;
        $values = $this->values;
        $idsCategoria = $this->idsCategoria;
        return view('table.exportarAExcel', compact('categoria','years','values','id','ambitos','nombreVariable','idsCategoria','supercategorias'));
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            2    => ['font' => ['bold' => true]],

        ];
    }
}