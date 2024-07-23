@if (session()->has('dont-access'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {{ session()->get('dont-access') }} .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="ti-check"></i></strong>{{ session()->get('success') }} .

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="ti-check"></i></strong>{{ session()->get('warning') }} .

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('Delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><i class="ti-close"></i></strong>{{ session()->get('Delete') }} .

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
