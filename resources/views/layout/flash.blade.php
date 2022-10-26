@if (session()->has('message'))
    <div class="alert alert-{{ session('message_type') }} my-3">
        {{ session('message') }}
    </div>
@endif
