@extends('layouts.base')
@section('content')
@include('layouts.alert')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Ajukan Lembur</h4>
    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createOvertime">Tambah</a>
</div>
<div class="table-responsive mb-4">
    <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($overtimes as $item)
            <tr>
                <td>{{ $item->employee->NIP }}</td>
                <td>{{ $item->employee->name }}</td>
                <td>{{ date('d-m-Y', strtotime($item->work_date)) }}</td>
                <td>{{ date('H:i:s', strtotime($item->time_in)) }}</td>
                <td>{{ date('H:i:s', strtotime($item->time_out)) }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="#" class="btn btn-warning btn-sm" data-id="{{ $item->id }}" data-employee-id="{{ $item->employee_id }}" data-work-date="{{ $item->work_date }}"
                            data-toggle="modal" data-time-in="{{ $item->time_in }}" data-time-out="{{ $item->time_out }}" data-description="{{ $item->description }}"
                            data-target="#editOvertime"><i class="fas fa-pen"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" data-val="{{ $item->id }}" data-toggle="modal"
                            data-target="#deleteOvertime"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>NIP</th>
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
<div class="modal fade" id="deleteOvertime" tabindex="-1" role="dialog" aria-labelledby="deleteOvertime"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Lembur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="overtime/delete" method="POST">
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
<div class="modal fade" id="editOvertime" tabindex="-1" role="dialog" aria-labelledby="editOvertime"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Lembur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="overtime/update" method="POST">
                @csrf
                <input type="hidden" id="del_id" name="del_id" title="deleteKaryawan" readonly>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="work_date">Tanggal</label>
                            <input type="date" name="work_date" id="work_date" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="employee_id" class="form-label">Nama</label>
                            <select class="form-select" id="employee_id" name="employee_id" aria-describedby="positionHelp"
                                class="form-control">
                                @foreach ($employees as $item)
                                <option value="{{ $item->id}}" >{{ $item->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-secondary">Hari Sabtu dan Minggu tidak akan Masuk</span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">Keterangan</label>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time_in">Jam Mulai</label>
                            <input type="time" name="time_in" id="time_in" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time_out">Jam Keluar</label>
                            <input type="time" name="time_out" id="time_out" class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="createOvertime" tabindex="-1" role="dialog" aria-labelledby="createOvertime"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Lembur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="overtime/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="work_date">Tanggal</label>
                            <input type="date" name="work_date" id="work_date" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="employee_id" class="form-label">Nama</label>
                            <select class="form-select" id="employee_id" name="employee_id" aria-describedby="positionHelp"
                                class="form-control">
                                @foreach ($employees as $item)
                                <option value="{{ $item->id}}">{{ $item->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-secondary">Hari Sabtu dan Minggu tidak akan Masuk</span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">Keterangan</label>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time_in">Jam Mulai</label>
                            <input type="time" name="time_in" id="time_in" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="time_out">Jam Keluar</label>
                            <input type="time" name="time_out" id="time_out" class="form-control">
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