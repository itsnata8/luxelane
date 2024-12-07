@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible m-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('error') }}
    </div>
@enderror
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible m-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('success') }}
    </div>
@enderror
@if (Session::has('info'))
    <div class="alert alert-danger alert-dismissible m-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('info') }}
    </div>
@enderror
@if (Session::has('warning'))
    <div class="alert alert-danger alert-dismissible m-3">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('warning') }}
    </div>
@enderror
