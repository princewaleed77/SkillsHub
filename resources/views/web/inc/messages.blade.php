
{{-- success alert --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Errors alert --}}
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif


{{-- Email verification alert --}}
@if (session('status') == 'verification-link-sent')
    <div class="mb-4 alert alert-success">
        A new email verification link has been emailed to you!
    </div>
@endif

@if (session('status'))
    <div class="mb-4 alert alert-success">
        {{ session('status') }}
    </div>
@endif