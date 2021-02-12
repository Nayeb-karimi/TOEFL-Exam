<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
          'first_name'  => $row['first_name'],
          'last_name' => $row['last_name'],
          'active_whatsapp_number' => $row['active_whatsapp_number'],
          'email_address' => $row['email_address'],
        ]);
    }
}
