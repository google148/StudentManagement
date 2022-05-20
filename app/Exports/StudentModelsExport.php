<?php

namespace App\Exports;

use App\Models\studentModel;
use Maatwebsite\Excel\Concerns\FromCollection;




class StudentModelsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return studentModel::all();
    }
}
