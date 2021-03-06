<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Exports\StudentModelsExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
  
class MyController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new StudentModelsExport, 'students_model.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new StudentModelsExport,request()->file('file'));
           
        return back();
    }
}
