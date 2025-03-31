<?php

namespace App\Imports;

use App\Models\Channel;
use App\Mail\Useremail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Carbon; 
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use CURLFile;


class ManuallyUser implements ToCollection, ToModel
{
    private $current = 0;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
    public function model(array $row)
    {
        $this->current++;
    
        if ($this->current > 1) {
          $data=new Channel();
          $dateValue = $row[0];
          if (is_numeric($dateValue)) {
            $dateValue = Date::excelToDateTimeObject($dateValue)->format('Y-m-d');
        }
           $data->date=$dateValue;
           $data->topic=$row[1];
           $data->link=$row[2];
           $data->category=$row[3];
           $data->speaker=$row[4];
           $data->experience_sharing=$row[5];
           $data->prabodh_swami=$row[6];
           $data->save();
        }
    }
}
