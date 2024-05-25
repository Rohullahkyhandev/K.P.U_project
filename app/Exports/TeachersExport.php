<?php

namespace App\Exports;

use App\Models\Teacher;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class TeachersExport implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // /**
    //  * @return \Illuminate\Support\Collection
    //  */
    // public function array(): array
    // {
    //     return $this->data->toArray();
    // }

    // /**
    //  * @return Builder|EloquentBuilder|Relation|ScoutBuilder
    //  */

    public function view(): View
    {
        return view('reports.teacherReport', ['data' => $this->data]);
    }
}
