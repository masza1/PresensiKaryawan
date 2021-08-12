<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Overtime;
use App\Models\Salary;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class SalaryController extends Controller
{

    public function index()
    {
        $attendances = Attendance::select('work_date')->get()->groupBy(function (Attendance $item) {
            return date('Y-m', strtotime($item->work_date));
        });
        $salaries = Salary::orderBy('created_at', 'DESC')->get();
        return view('payroll', [
            'attendances' => $attendances,
            'salaries' => $salaries
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = $request->periode;
        $attendances = Attendance::where('work_date', 'LIKE', $periode . '-%')->get()->groupBy('employee_id');
        foreach ($attendances as $key => $value) {
            $check = Salary::select('employee_id', 'payroll_date')->where('employee_id', '=', $value[$key]->employee_id)->where('payroll_date', '=', $periode)->get();
            if ($check->count() < 1) {
                $upah_lembur_per_jam = $value[$key]->employee->basic_salary / 173;
                $total_tidak_hadir = [];
                $total_overtime = [];
                foreach ($value as $key => $day) {
                    if ($day->description == "Tidak Hadir") {
                        array_push($total_tidak_hadir, 1);
                    }
                }
                $overtimes = Overtime::where('work_date', 'LIKE', $periode . '-%')->get();
                foreach ($overtimes as $key => $overtime) {
                    $total_hours = (strtotime($overtime->time_out) - strtotime($overtime->time_in)) / (60 * 60);
                    if ($total_hours > 4) {
                        $total_hours = $total_hours * 2;
                    }
                    array_push($total_overtime, $total_hours);
                }
                $upah_lembur = $upah_lembur_per_jam * array_sum($total_overtime);
                $nwnp = array_sum($total_tidak_hadir) * $value[$key]->employee->basic_salary / 30;
                $bpjs = ($value[$key]->employee->basic_salary + $value[$key]->employee->allowance) * 3 / 100;
                $total_salaries = $value[$key]->employee->basic_salary + $value[$key]->employee->allowance + $upah_lembur - $nwnp - $bpjs;
                Salary::create([
                    'employee_id' => $value[$key]->employee_id,
                    'payroll_date' => date('Y-m-d', strtotime($periode)),
                    'overtimes' => $upah_lembur,
                    'basic_salary' => $value[$key]->employee->basic_salary,
                    'allowance' => $value[$key]->employee->allowance,
                    'nwnp' => $nwnp,
                    'bpjs' => $bpjs,
                    'total_salaries' => $total_salaries,
                    'approved' => 0,
                ]);
            }
        }
        $salaries = Salary::get();
        return view('layouts.tableBody', [
            'salaries' => $salaries
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print()
    {
        $id = request('id');
        $salary = Salary::find($id);
        $pdf = PDF::loadview('layouts.print', ['salary' => $salary]);
        return $pdf->stream($salary->employee->name.'-'.$salary->payroll_date.'.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $id = $request->id;

        $salary->where('id', '=', $id)->update(['approved' => 1]);
        $salaries = Salary::get();
        return view('layouts.tableBody', [
            'salaries' => $salaries
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
