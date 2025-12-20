{{-- @if (session('success'))
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
@endif --}}


@if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
        <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span class="font-bold">Please fix the following errors:</span>
        </div>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div id="successAlert"
        class="mb-6 flex items-center p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm transition-all duration-500">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-green-500 text-xl"></i>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-bold uppercase tracking-wide">Success</p>
            <p class="text-sm opacity-90">{{ session('success') }}</p>
        </div>
        <button onclick="document.getElementById('successAlert').style.display='none'"
            class="text-green-700 hover:text-green-900">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif


{{-- <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
    <div class="flex items-center mb-2">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <span class="font-bold">Please fix the following errors:</span>
    </div>
    <ul class="list-disc list-inside text-sm">
        <li>The full name field is required.</li>
        <li>The mobile number must be at least 10 digits.</li>
        <li>The email address format is invalid.</li>
    </ul>
</div>

<div id="testSuccessAlert"
    class="mb-6 flex items-center p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
    <div class="flex-shrink-0">
        <i class="fas fa-check-circle text-green-500 text-xl"></i>
    </div>
    <div class="ml-3 flex-1">
        <p class="text-sm font-bold uppercase tracking-wide">Success</p>
        <p class="text-sm opacity-90">Customer details have been updated successfully!</p>
    </div>
    <button onclick="this.parentElement.style.display='none'" class="text-green-700 hover:text-green-900">
        <i class="fas fa-times"></i>
    </button>
</div> --}}
