@extends('web.layout')

@section('title')
    Verify Email
@endsection

@section('main')
    <div class="mb-4 alert alert-success">
        A new email verification link has been emailed to you!
    </div>

    <form action="{{url('email/verification-notification')}}" method="post">
    
    @csrf
<button type="submit" >resend email</button>

</form>
@endsection
