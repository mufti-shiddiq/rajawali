@extends("adminlte::page")

@section("title") Pengguna @endsection

@section('content_header')
<div class="row">
    <div class="col-md-6">
        <h1>Pengguna</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('users.create')}}" class="btn btn-primary">Buat User Baru</a>
    </div>
</div>
@stop

@section("content")
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<table class="table table-bordered bg-light">
    <thead>
        <tr>
            <th><b>Nama</b></th>
            <th style="width: 300px"><b>Username</b></th>
            <th style="width: 100px"><b>Status</b></th>
            <!-- <th>Role</th> -->
            <th style="width: 200px"><b></b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>

            <td>{{$user->name}}</td>

            <td>{{$user->username}}</td>

            <td>
                @if($user->status == "AKTIF")
                <span class="badge badge-success">
                    {{$user->status}}
                </span>
                @else
                <span class="badge badge-danger">
                    {{$user->status}}
                </span>
                @endif
            </td>

            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Edit</a>

                <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>

                <form onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="d-inline" action="{{route('users.destroy', [$user->id])}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{$users->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
@endsection