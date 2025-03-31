<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Channel;


class ExportUser implements FromCollection,WithMapping,WithHeadings
{
    private $num=0;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Channel::all();
    }
   public function map($user):array{
            $this->num++;
        return[
            $this->num,
            $user->date?$user->date:'-',
            $user->topic?$user->topic:'-',
            $user->link?$user->link:'-',
            $user->category?$user->category:'-',
            $user->speaker?$user->speaker:'-',
            $user->experience_sharing?$user->experience_sharing:'-',
            $user->prabodh_swami?$user->prabodh_swami:'-',
            
        ];
    
           
      }
    public function headings():array{
        return[
            'Sr.No.',
            'Date',
            'Topic',
            'Link',
            'Category',
            'Speaker',
            'Experience Sharing Person',
            'Prabodh Swami',
        ];
    }
}
