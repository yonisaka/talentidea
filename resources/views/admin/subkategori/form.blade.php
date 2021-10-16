@extends('admin.layouts.main')

@section('body')
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6"><h4 class="mt-0 header-title my-auto">{{ $title }}</h4></div>
                    <div class="col-md-6 text-right"><a href="{{url('admin/subkategori')}}" class="btn btn-secondary text-right px-5"><i class="fa fa-angle-left"></i> Kembali </a></div>
                </div>
                <hr>
                <form action="{{url('admin/subkategori/form_subkategori_store')}}" method="post">
                @csrf
                <div class="progress m-b-30">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- <input type="hidden" name="subkategori_id" value="{{$subkategori->id ?? ''}}"> -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama SubKategori</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nama" value="{{$subkategori->nama ?? ''}}" placeholder="Nama Subkategori">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-5">
                            <select name="kategori_id" class="custom-select">
                                <option>Pilih Kategori</option>
                                @foreach ($kategori as $data)
                                <option value="{{$data->id}}" @if (($subkategori->kategori_id ?? '') == $data->id) selected @endif>{{$data->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary px-3"> Simpan <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin_template/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_template/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.js')}} "></script>
<script src="{{ asset('user_template/assets/pages/sweet-alert.init.js')}} "></script>
<script>
    $(document).ready(function(){
        if ($('[name="kategori_id"]').val() != ''){
            $('[name="subkategori_id"]').attr('disabled', false);
            var kategori_id = $('[name="kategori_id"]').val();
            var subkategori_id = $('[name="subkategori_id"]').val();
            $.ajax({
                type: 'GET',
                url: '{{ url("helper/get_subkategori")}}' + '/' + kategori_id + '/' + subkategori_id,
                success: function (data) {
                    if (data){
                        $('[name="subkategori_id"]').find("option").remove().end();
                        $('[name="subkategori_id"]').append(data);
                    }
                },
                error: function(e) {
                    console.log(e);
                    $('[name="subkategori_id"]').find("option").remove().end();
                    $('[name="subkategori_id"]').attr('disabled', true);
                }
            });
        } else {
            $('[name="subkategori_id"]').attr('disabled', true);
        }

        $('[name="kategori_id"]').change(function () {
            $('[name="subkategori_id"]').attr('disabled', false);
            var kategori_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ url("helper/get_subkategori")}}' + '/' + kategori_id,
                success: function (data) {
                    if (data){
                        $('[name="subkategori_id"]').find("option").remove().end();
                        $('[name="subkategori_id"]').append(data);
                    }
                },
                error: function(e) {
                    console.log(e);
                    $('[name="subkategori_id"]').find("option").remove().end();
                    $('[name="subkategori_id"]').attr('disabled', true);
                }
            });
        });

        $('#summernote').summernote({
            height: 300,  
            minHeight: 300,   
            maxHeight: null,
            toolbar: [
                [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            ]
        });
    });
</script>
@endsection