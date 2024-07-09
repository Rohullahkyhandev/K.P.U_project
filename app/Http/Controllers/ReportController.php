<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportController extends Controller
{



    public function  TeacherInScholarship(Request $request)
    {

        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $data = Report::

        $report = new Report();
        $report->form_date = $request->from_date;
        $report->form_date = $request->to_date;
        $report->save();

        if ($report) {
            return response([
                'message' => 'the report has been generated successfully',
            ], 200);
        } else {
            return response([
                'error' => 'The report process has been failed, please try again',
            ], 200);
        }
    }
}
