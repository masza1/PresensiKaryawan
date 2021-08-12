@extends('layouts.base')
@section('content')
@include('layouts.alert')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Absensi Karyawan</h4>
    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createAttendances">Tambah</a>
</div>
<div class="table-responsive mb-4">
    <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $item)
            <tr>
                <td>{{ $item->employee->name }}</td>
                <td>{{ date('d-m-Y', strtotime($item->work_date)) }}</td>
                <td>{{ date('H:i:s', strtotime($item->time_in)) }}</td>
                <td>{{ date('H:i:s', strtotime($item->time_out)) }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="#" class="btn btn-danger btn-sm" data-val="{{ $item->id }}" data-toggle="modal"
                            data-target="#deleteAttendance"><i class="fas fa-trash"></i></a>
                        {{-- <a type="button" href="/payroll" title="Hitung Gaji" class="btn btn-info btn-sm"><i class="fas fa-calculator"></i></a> --}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
@section('footer')
<div class="modal fade" id="deleteAttendance" tabindex="-1" role="dialog" aria-labelledby="deleteAttendance"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="attendances/delete" method="POST">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="del_id" name="del_id" title="deleteKaryawan" readonly>
                    <div id="modalDelete">Anda yakin ingin menghapus ?</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="createAttendances" tabindex="-1" role="dialog" aria-labelledby="createAttendances"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="attendances/store" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fromDate">From</label>
                            <input type="date" name="fromDate" id="fromDate" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="toDate">To</label>
                            <input type="date" name="toDate" id="toDate" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <select class="form-select" id="name" name="name" aria-describedby="positionHelp"
                                class="form-control">
                                @foreach ($employees as $item)
                                <option value="{{ $item->id}}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-secondary">Hari Sabtu dan Minggu tidak akan terhitung</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection