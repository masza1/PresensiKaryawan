@if (!empty($salaries))
@foreach ($salaries as $item)
<tr>
    <td>{{ $item->employee->NIP }}</td>
    <td>{{ $item->employee->name }}</td>
    <td>{{ $item->employee->position_name }}</td>
    <td>Rp. {{ number_format($item->basic_salary,0,',','.')}}</td>
    <td>Rp. {{ number_format($item->allowance,0,',','.')}}</td>
    <td>Rp. {{ number_format($item->total_salaries,0,',','.')}}</td>
    <td>
        @if ($item->approved == 0)
        <span class="">Belum disetujui</span>
        @else
        <span class="">disetujui</span>
        @endif</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic example">
            @role('Supervisor')
            @if ($item->approved ==0)
            <button id="approved" class="btn btn-primary btn-sm" title="Setujui" data-payrollId="{{ $item->id }}"><i
                    class="fa fa-check"></i></button>
            @endif
            @else
            @if ($item->approved !=0)
            <a href="/payroll/print-pdf/{{ $item->id }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
            @endif
            @endrole
        </div>
    </td>
</tr>
@endforeach
@endif