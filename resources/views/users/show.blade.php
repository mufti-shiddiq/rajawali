@extends("adminlte::page")

@section("title") Detail User @endsection

@section('content_header')
<h1>Detail User</h1>
@stop

@section("content")
<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <b>Name:</b> <br />
            {{$user->name}}
            <br><br>
            <b>Username:</b><br>
            {{$user->username}}
            <br>
            <br>

            <b class="text-danger">TODO: Info Role dan Status user belum bisa muncul</b>

            {{--<b>Role:</b> <br>
            @foreach (json_decode($user->role) as $roleku)
            &middot; {{$roleku}} <br>
            @endforeach --}}
        </div>
    </div>
</div>
@endsection