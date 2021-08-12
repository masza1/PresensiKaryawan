<?php

namespace App\Http\Controllers;

use App\Http\Resources\AttendanceCollection;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    
    public function index()
    {
        $attendances = Attendance::orderBy('work_date', 'DESC')->get();
        $employees = Employee::select('id','name')->orderBy('name', 'ASC')->get();
        return view('attendances', [
            'attendances' => $attendances,
            'employees' => $employees
        ]);
    }

    
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'fromDate' => 'required|date',
            'toDate' => 'required|date|after_or_equal:fromDate',
            'name' => 'required'
        ]);
        $month_from= date('m', strtotime($request->fromDate));
        $month_to= date('m', strtotime($request->toDate));
        $attendances = Attendance::select('work_date')->where('work_date', '<=', $request->toDate)
                                ->where('work_date', '>=', $request->fromDate)
                                ->get();
        if ($validate->fails()) {
            return redirect('/attendances')->with('messages', 'Validator : '.$validate->errors()->first());
        }else if($month_from != $month_to) {
            return redirect('/attendances')->with('messages', 'Validator : Bulan harus sama');
        }else if($attendances->count() > 0) {
            return back()->with('messages', 'Anda sudah absen di tanggal tersebut');
        }else{
            $year = date('Y', strtotime($request->fromDate));
            $month = date('m', strtotime($request->fromDate));
            $day_from = date('d', strtotime($request->fromDate));
            $day_to = date('d', strtotime($request->toDate));
            $totalDays = cal_days_in_month(CAL_GREGORIAN,$month, $year);

            for ($i=1; $i<=$totalDays ; $i++) {     
                $weekend = date('l', strtotime($year.'-'.$month.'-'.$i));            
                if($weekend == "Sunday" || $weekend == 'Saturday'){
                    Attendance::create([
                            'employee_id' => request('name'),
                            'work_date' => $year.'-'.$month.'-'.$i,
                            'time_in' => date('H:i:s', strtotime('00:00:00')),
                            'time_out' => date('H:i:s', strtotime('00:00:00')),
                            'description' => "Libur"
                    ]);
                }else if ($i > $day_to || $i < $day_from) {
                    Attendance::create([
                        'employee_id' => request('name'),
                        'work_date' => $year.'-'.$month.'-'.$i,
                        'time_in' => date('H:i:s', strtotime('00:00:00')),
                        'time_out' => date('H:i:s', strtotime('00:00:00')),
                        'description' => "Tidak Hadir"
                    ]);
                }else {
                    Attendance::create([
                        'employee_id' => request('name'),
                        'work_date' => $year.'-'.$month.'-'.$i,
                        'time_in' => date('H:i:s', strtotime('08:00:00')),
                        'time_out' => date('H:i:s', strtotime('16:00:00')),
                        'description' => "Hadir"
                    ]);
                }
            }
            return redirect('/attendances')->with('messages', 'Berhasil Menambah absen');
        }

    }

    public function delete()
    {
        try {
            Attendance::where('id', '=', request('del_id'))->delete();
            return redirect('/attendances')->with('messages', 'Success menghapus data');
        } catch (\Throwable $th) {
            return redirect('/attendances')->with('messages', 'Gagal menghapus data' .$th);
        }
    }
}
