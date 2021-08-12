<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::get();
        return view('employee',[
            'employees' => $employees
        ]);
    }

    public function create(Request $request)
    {
        $employee = $request->validate([
            'NIP' => 'required|numeric|min:3',
            'name' => 'required|string|min:3',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'birthdate' => 'required',
            'position_name' => 'required',
            'basic_salary' => 'required|numeric',
            'allowance' => 'required|numeric'
        ]);

        auth()->user()->employees()->create($employee);
        session()->flash('createKaryawan', 'Success');
        return redirect('/');
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('editkaryawan', compact('employee'));
    }

    public function updates(Request $request)
    {
        $employee = $request->validate([
            'NIP' => 'required|numeric|min:3',
            'name' => 'required|string|min:3',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'birthdate' => 'required',
            'position_name' => 'required',
            'basic_salary' => 'required|numeric',
            'allowance' => 'required|numeric'
        ]);

        try {
            auth()->user()->employees()->where('id', '=', request('id'))->update($employee);
            return redirect('/')->with('messages', 'Success Merubah data');
        } catch (\Throwable $th) {
            return redirect('/')->with('messages', 'Gagal Merubah data' .$th);
        }
        
    }
    
    public function delete(Employee $employee)
    {
        try {
            auth()->user()->employees()->where('id', '=', request('del_id'))->delete();
            return redirect('/')->with('messages', 'Success menghapus data');
        } catch (\Throwable $th) {
            return redirect('/')->with('messages', 'Gagal menghapus data' .$th);
        }
    }
}
