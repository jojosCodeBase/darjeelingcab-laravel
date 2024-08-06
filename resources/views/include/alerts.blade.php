@if (session('success'))
    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="btn-close " data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
