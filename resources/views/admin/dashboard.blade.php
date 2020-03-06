@extends('backend.layouts.app')

@section('title', 'Dashboard')

@push('styles')

@endpush


@section('content')

    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL PROPRIETATI</div>
                    <div class="number count-to" data-from="0" data-to="{{ $propertycount }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POSTARI</div>
                    <div class="number count-to" data-from="0" data-to="{{ $postcount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">forum</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL COMENTARII</div>
                    <div class="number count-to" data-from="0" data-to="{{ $commentcount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL UTILIZATORI</div>
                    <div class="number count-to" data-from="0" data-to="{{ $usercount }}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <div class="row clearfix">
        <!-- RECENT PROPERTIES -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>RECENT ADAUGATE</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titlu</th>
                                    <th>Pret</th>
                                    <th>Oras</th>
                                    <th><i class="material-icons small">star</i></th>
                                    <th>Manager</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($properties as $key => $property)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $property->title }}">
                                            {{ str_limit($property->title, 10) }}
                                        </span>
                                    </td>
                                    <td>{{ $property->price }} &euro;</td>
                                    <td>{{ $property->city }}</td>
                                    <td>
                                        @if($property->featured == 1)
                                            <span class="label bg-green">F</span>
                                        @endif
                                    </td>
                                    <td>{{ strtok($property->user->name, " ")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT PROPERTIES -->
        <!-- RECENT POSTS -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>POSTARI RECENTE</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Titlu</th>
                                    <th><i class="material-icons small">comment</i></th>
                                    <th>Autor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $key => $post)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $post->title }}">
                                            {{ str_limit($post->title, 30) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label bg-green">{{ $post->comments_count }}</span>
                                    </td>
                                    <td>{{ strtok($post->user->name, " ")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT POSTS -->

    </div>

    <div class="row clearfix">
        <!-- USER LIST -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>UTILIZATORI</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nume</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Actiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-info btn-sm waves-effect" onclick="makeAgent({{$user->id}})">
                                            <i class="material-icons">compare_arrows</i>
                                        </button>
                                        <form action="{{route('admin.users.make_agent',$user->id)}}" method="POST" id="make-agent-{{$user->id}}" style="display:none;">
                                            @csrf
                                            @method('POST')
                                        </form>

                                        <button type="button" class="btn btn-danger btn-sm waves-effect" onclick="deleteUser({{$user->id}})">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" id="del-user-{{$user->id}}" style="display:none;">
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
        <!-- #END# USER LIST -->

        <!-- RECENT COMMENTS -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header">
                    <h2>COMENTARII RECENTE</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Comentariu</th>
                                    <th><i class="material-icons small">check</i></th>
                                    <th>Autor</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $key => $comment)
                                <tr>
                                    <td>{{ ++$key }}.</td>
                                    <td>
                                        <span title="{{ $comment->body }}">
                                            {{ str_limit($comment->body, 10) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($comment->approved == 1)
                                            <span class="label bg-green">A</span>
                                        @else
                                            <span class="label bg-red">N</span>
                                        @endif
                                    </td>
                                    <td>{{ strtok($comment->users->name, " ")}}</td>
                                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# RECENT COMMENTS -->
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

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('backend/js/pages/index.js') }}"></script>

    <script>
        function deleteUser(id){
            
            swal({
            title: 'Sunteti sigur?',
            text: "Actiune irevesribila!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sterge!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('del-user-'+id).submit();
                    swal(
                    'Sters!',
                    'Utilizator sters!',
                    'success'
                    )
                }
            })
        }
        function makeAgent(id){
            
            swal({
            title: 'Sunteti sigur?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Accepta!'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('make-agent-'+id).submit();
                    swal(
                    'Actualizat!',
                    'Utilizator actualizat!',
                    'success'
                    )
                }
            })
        }
    </script>

@endpush
