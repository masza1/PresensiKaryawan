@extends('layouts.base', ['title' => 'Edit'])
@section('content')
@include('layouts.alert')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Buat data Karyawan</h4>
</div>

<div class="mb-4">
    <form action="/employee/store" method="POST">
        @csrf
        @include('layouts.formKaryawan', ['submit' => 'Simpan', 'employee' => new App\Models\Employee()])
    </form>
</div>
@endsection