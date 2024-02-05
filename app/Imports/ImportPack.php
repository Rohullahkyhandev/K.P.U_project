<?php

namespace App\Imports;

use App\Models\Pack;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ImportPack implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        return new Pack([
            'Person ID' => $row['Person ID'],
            'Name' => $row['Name'],
            'Department' => $row['Department'],
            'Position' => $row['Position'],
            'Gender' => $row['Gender'],
            'Date' => $row['Date'],
            'Week' => $row['Week'],
            'Timetable' => $row['Timetable'],
            'Check-in' => $row['Check-in'],
            'Check-out' => $row['Check-out'],
            'Work' => $row['Work'],
            'OT' => $row['OT'],
            'Attended' => $row['Attended'],
            'Late' => $row['Late'],
            'Early' => $row['Early'],
            'Absent' => $row['Absent'],
            'Leave' => $row['Leave'],
            'Status' => $row['Status'],
            'Records' => $row['Records'],
        ]);
    }
    public function headingRow(): int
    {
        return 19;
    }
}
