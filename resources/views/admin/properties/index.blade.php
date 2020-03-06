@extends('backend.layouts.app')

@section('title', 'Properties')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
        <a href="{{route('admin.properties.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>ADAUGA </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>ANUNTURI</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imagine</th>
                                    <th>Titlu</th>
                                    <th>Author</th>
                                    <th>Tip</th>
                                    <th>Vanzare/Inchiriere</th>
                                    <th>Paturi</th>
                                    <th>Bai</th>
                                    <!--<th><i class="material-icons small">comment</i></th>-->
                                    <th>Contact</th>
                                    <th><i class="material-icons small">stars</i></th>
                                    <th width="150">Actiuni</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $properties as $key => $property )
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{Storage::url('property/'.$property->image)}}" alt="{{$property->title}}" width="60" class="img-responsive img-rounded">
                                    </td>
                                    <td>
                                        <span title="{{$property->title}}">
                                            {{ str_limit($property->title,10) }}
                                        </span>
                                    </td>
                                    <td>{{$property->user->name}}</td>
                                    <td>{{$property->type}}</td>
                                    <td>{{$property->purpose}}</td>
                                    <td>{{$property->bedroom}}</td>
                                    <td>{{$property->bathroom}}</td>
                                    <td>{{$property->contact_person}} </br> <b>Telefon:</b> {{$property->contact_phone}}</td>
<!--
                                    <td>
                                        <span class="badge bg-indigo">{{ $property->comments_count }}</span>
                                    </td>
-->
                                    <td>
                                        @if($property->featured == true)
                                            <span class="badge bg-indigo"><i class="material-icons small">star</i></span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{route('admin.properties.show',$property->slug)}}" class="btn btn-success btn-sm waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.properties.edit',$property->slug)}}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deletePost({{$property->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form action="{{route('admin.properties.destroy',$property->slug)}}" method="POST" id="del-post-{{$property->id}}" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script>
        function deletePost(id){
            
            swal({
            title: 'Sunteti sigur?',
            text: "Aceasta actiune este ireversibila!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sterge'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-post-'+id).submit();
                    swal(
                    'Sters!',
                    'Postare stearsa',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush
