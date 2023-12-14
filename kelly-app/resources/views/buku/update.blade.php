@extends('template/master')
@section('content')
    <br>
    <div class="col">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Buku</h3>
            </div>
            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-12 form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $buku->nama }}" placeholder="Masukkan Nama BUku">

                        </div>
                    </div>
                    <div class="row">
                        <div class="co col-md-12 form-group">
                            <label for="exampleInputFile">Foto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-12 form-group">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit"
                                placeholder="Masukkan Penerbit" value="{{ $buku->penerbit }}">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col col-md-12 form-group">
                            <label>Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang"
                                placeholder="Masukkan Pengarang" value="{{ $buku->pengarang }}">

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('js')
    <script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            $('#deskripsi_form').summernote()
        })
    </script>
@endsection
