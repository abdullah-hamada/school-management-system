@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Users_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.Users') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif



<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('Users_trans.add_User') }}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('Users_trans.Name') }}</th>
                            <th>{{ trans('Users_trans.Email') }}</th>
                            <th>{{ trans('Users_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($Users as $User)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $User->name }}</td>
                                <td>{{ $User->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $User->id }}"
                                        title="{{ trans('Users_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $User->id }}"
                                        title="{{ trans('Users_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <!-- edit_modal_User -->
                            <div class="modal fade" id="edit{{ $User->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Users_trans.edit_User') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('Users.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                            class="mr-sm-2">{{ trans('Users_trans.stage_name_ar') }}
                                                            :</label>
                                                        <input id="Name" type="text" name="Name"
                                                            class="form-control"
                                                            value="{{ $User->getTranslation('Name', 'ar') }}"
                                                            required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $User->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                            class="mr-sm-2">{{ trans('Users_trans.stage_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $User->getTranslation('Name', 'en') }}"
                                                            name="Name_en" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('Users_trans.Notes') }}
                                                        :</label>
                                                    <textarea class="form-control" name="Notes"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $User->Email }}</textarea>
                                                </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Users_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('Users_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_User -->
                            <div class="modal fade" id="delete{{ $User->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Users_trans.delete_User') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Users.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Users_trans.Warning_User') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $User->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Users_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('Users_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_User -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Users_trans.add_User') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('Users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('Users_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="Name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('Users_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="Name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('Users_trans.Notes') }}
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Users_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('Users_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
