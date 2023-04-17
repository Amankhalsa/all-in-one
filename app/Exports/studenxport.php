<?php

namespace App\Exports;

use App\Models\student;
use Maatwebsite\Excel\Concerns\FromCollection;

class studenxport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return student::select(['class','roll','sname','fname'])->get();
        
    }
}
