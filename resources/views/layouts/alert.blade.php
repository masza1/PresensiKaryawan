@if (session()->has('messages'))
<div class="alert alert-primary" id="primary-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    @if (session('messages'))
    <strong>{{ session('messages') }}</strong> 
    @endif
</div>
@endif