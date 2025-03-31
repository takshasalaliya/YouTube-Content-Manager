<?php

namespace App\Imports;

use App\Models\Qrdetail;
use App\Mail\Useremail;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Mail;
use CURLFile;


class UserExcel implements ToCollection, ToModel
{
    private $current = 0;

    public function collection(Collection $collection)
    {
        //
    }

        public function model(array $row)
        {
            $this->current++;
        
            if ($this->current > 1) {
                $valid = Qrdetail::where('mobile', $row[1])->first();
                if (empty($valid)) {
                    $data = new Qrdetail();
                    $data->name = $row[0];
                    $data->category = $row[3];
                    $data->email = $row[2];
                    $data->mobile = $row[1];
        
            
                    $message = [
                        'name' => $row[0],
                        'phone' => $row[1],
                        
                    ];
        
                    $subject = "International Conference";
                    $email = $row[2];
                    if ($data->save()) {
                        Mail::to($email)->send(new Useremail($message, $subject));
                    }
                }
            }
        }
}