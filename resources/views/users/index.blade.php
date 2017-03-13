@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulaire d'ajout d'un nouvel user :</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body row">
                    <div class="col-md-10">
                        <!-- form start -->
                        <form role="form"
                              class="form-horizontal"
                              method="post"
                              action="{{route('users_add')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nom" class="col-sm-4 control-label">Nom</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control"
                                           id="nom" placeholder="Nom et prénom"
                                           name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-4 control-label">Email</label>

                                <div class="col-sm-8">
                                    <input type="email" class="form-control"
                                           id="email" placeholder="Email (unique)"
                                           name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-4 control-label">Mot de passe</label>

                                <div class="col-sm-8">
                                    <input type="password" class="form-control"
                                           id="password" placeholder="Mot de passe"
                                           name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-4 control-label">Confirmation du mot de
                                    passe</label>

                                <div class="col-sm-8">
                                    <input type="password" class="form-control"
                                           id="password_confirmation" placeholder="re-saisir le mot de passe"
                                           name="password_confirmation">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="box-footer" style="text-align: center;">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">List des utilsiateurs <span
                                style="font-style: italic; font-size: 0.9em;">({{ $users->total() }} users)</span> :
                    </h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Créé le</th>
                            <th>Modifié le</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if(!$user->canDeleteUser())
                                        <i class="fa fa-unlock-alt" title="This user can't be deleted"></i>
                                    @endif
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ show_date_time($user->created_at) }}</td>
                                <td>{{ show_date_time($user->updated_at) }}</td>
                                <td>
                                    <a href="{{ route('users_edit', ['id'=>$user->id]) }}"
                                       title="Editer cet utilisateur">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @if($user->canDeleteUser())
                                        &nbsp;
                                        <a href="#" style="color: #FF0000"
                                           data-action="{{ route('users_delete', ['id'=>$user->id]) }}"
                                           onclick="process_delete_btn_click(this)"
                                           title="Supprimer cet user">
                                            <i class="fa fa-remove"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer" style="text-align: center;">
                    {{ $users->render() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form role="form" style="display: none;"
                  method="post" id="delete-user-form">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <!-- /.box-body -->
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function process_delete_btn_click(btn) {
            var frm = document.getElementById('delete-user-form');
            if (confirm('Voulez-vous supprimer cet utilisateur ?')) {
                frm.setAttribute('action', btn.dataset.action);
                var frmBtn = frm.getElementsByTagName('button').item(0);
                frmBtn.click();
            }
        }
    </script>
@endsection