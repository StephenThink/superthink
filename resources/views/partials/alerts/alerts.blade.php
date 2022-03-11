@if (session()->has('message'))
<div class="alert alert-success ">
    @include('partials.svgs.alerts.tick')
    {{ session('message') }}
</div>
@endif

@if (session()->has('trash'))
<div class="alert alert-success ">
    @include('partials.svgs.alerts.trash')
    {{ session('trash') }}
</div>
@endif

@if (session()->has('redirect'))
<div class="alert alert-redirect ">
    @include('partials.svgs.alerts.exclamation')
    {{ session('redirect') }}
</div>
@endif

