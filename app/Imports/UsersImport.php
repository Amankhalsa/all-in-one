<?php

namespace App\Imports;

use App\Models\student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;



class UsersImport implements ToModel  , WithHeadingRow 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
     
     return new student([
                'sname'  => $row['sname'],
                'fname' =>$row['fname'],
                'class' =>$row['class'],
                'roll' =>$row['roll'],
                'dob' =>$row['dob'],
        ]);


         
    }
}



// https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#reading-images-from-a-worksheet


