@extends("adminlte::page")

@section("title") Import/Export Produk @endsection

@push('css')
@endpush

@section('content_header')
<div class="row">
    <!-- <div class="col-md-6">
        <h1>Import/Export Produk</h1>
    </div> -->
    <!-- <div class="col-md-6 text-right">
        <a href="{{route('products.create')}}" class="btn btn-primary">Tambah Produk Baru</a>
    </div> -->
</div>
@stop

@section("content")
<div class="row">
    <div class="col-md-12">
        <div class="container mt-5 text-center">
            <h2 class="mb-1">
                Import/Export Produk
            </h2>
            <h6 class="text-danger mb-4"><b>Harap hati-hati dan teliti agar database tidak error!</b></h6>

            <form action="{{ route('product-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="custom-file text-left">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Import data</button>
                <a class="btn btn-success" href="{{ route('product-export') }}">Export data</a>
            </form>
        </div>
    </div>
</div>
<div class="py-3"></div>

@endsection

@push('js')

@endpush