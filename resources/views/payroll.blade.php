@extends('layouts.base')
@section('content')
@include('layouts.alert')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h4 class="h4">Gaji Karyawan</h4>
    </div>
    @role('Staff')
    <div class="col-sm-3">
        <div class="d-flex justify-content-between align-items-center">
            <select class="example-select-periode form-select" style="width: 65%" id="setPeriode" name="setPeriode"
                aria-describedby="positionHelp">
                <option value="" selected>Select Periode</option>
                @foreach ($attendances as $item)
                <option value="{{ date('Y-m', strtotime($item[0]->work_date)) }}">
                    {{ date('Y-m', strtotime($item[0]->work_date)) }}</option>
                @endforeach
            </select>
            <button id="getPayroll" class="btn btn-success btn-sm" title="Tarik Data">Tarik
                Data</i></button>
        </div>
    </div>
    @endrole
</div>
<div class="table-responsive mb-4">
    <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Gaji Tetap</th>
                <th>Tunjangan</th>
                <th>Total Gaji</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @include('layouts.tableBody')
        </tbody>
        <tfoot>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Gaji Tetap</th>
                <th>Tunjangan</th>
                <th>Total Gaji</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection