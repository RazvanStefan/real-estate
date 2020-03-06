@extends('backend.layouts.app')

@section('title', 'Testimonials')

@push('styles')

    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}">

@endpush

@section('content')

    <div class="block-header">
        <a href="{{route('admin.testimonials.create')}}" class="waves-effect waves-light btn right m-b-15 addbtn">
            <i class="material-icons left">add</i>
            <span>CREAZA </span>
        </a>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-indigo">
                    <h2>LISTA</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imagine</th>
                                    <th>Nume</th>
                                    <th>Testimonial</th>
                                    <th width="100px">Actiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @if(Storage::disk('public')->exists('testimonial/'.$testimonial->image))
                                            <img src="{{Storage::url('testimonial/'.$testimonial->image)}}" alt="{{$testimonial->name}}" width="160" class="img-responsive img-rounded">
                                        @endif
                                    </td>
                                    <td>{{$testimonial->name}}</td>
                                    <td>{{$testimonial->testimonial}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.testimonials.edit',$testimonial->id)}}" class="btn btn-info btn-sm waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteTestimonial({{$testimonial->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form action="{{route('admin.testimonials.destroy',$testimonial->id)}}" method="POST" id="del-testimonial-{{$testimonial->id}}" style="display:none;">
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
        function deleteTestimonial(id){
            
            swal({
            title: 'Sunteti sigur?',
            text: "Aceasta actiune este ireversibila!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sterge!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-testimonial-'+id).submit();
                    swal(
                    'Sters!',
                    'Testimonial sters!',
                    'success'
                    )
                }
            })
        }
    </script>


@endpush
