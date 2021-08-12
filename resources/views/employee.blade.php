@extends('layouts.base')
@section('content')
@include('layouts.alert')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Data Karyawan</h4>
  <a href="/employee/create" class="btn btn-success">Tambah</a>
</div>
<div class="table-responsive mb-4">
  <table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th>NIP</th>
        <th>Nama</th>
        <th>TTL</th>
        <th>Jabatan</th>
        <th>Gaji Tetap</th>
        <th>Tunjangan Tetap</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($employees as $item)
      <tr>
        <td>{{ $item->NIP }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->place_of_birth .', '. date('d-m-Y', strtotime($item->birthdate)) }}</td>
        <td>{{ $item->position_name }}</td>
        <td>Rp. {{ number_format($item->basic_salary,0,',','.')}}</td>
        <td>Rp. {{ number_format($item->allowance,0,',','.')}}</td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a type="button" href="/employee/{{ $item->id }}" class="btn btn-warning btn-sm"><i
                class="fas fa-pen"></i></a>
            <a href="#" class="btn btn-danger btn-sm" data-val="{{ $item->id }}" data-toggle="modal"
              data-target="#my-modal"><i class="fas fa-trash"></i></a>
            {{-- <a type="button" href="/payroll" title="Hitung Gaji" class="btn btn-info btn-sm"><i class="fas fa-calculator"></i></a> --}}
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>NIP</th>
        <th>Nama</th>
        <th>TTL</th>
        <th>Jabatan</th>
        <th>Gaji Tetap</th>
        <th>Tunjangan Tetap</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</div>
@endsection
@section('footer')
<div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="my-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="employee/delete" method="POST">
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
@endsection