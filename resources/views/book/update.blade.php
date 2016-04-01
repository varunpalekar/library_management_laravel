@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Book Search</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/book/update') }}">
                            {!! csrf_field() !!}

                            <div class="form-group">
                                <label class="col-md-4 control-label">Book Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ $book->name }}">
                                    <input type="hidden" name="id" value="{{$book->id}}">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Book Publication</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="publication" value="{{ $book->publication }}">

                                    @if ($errors->has('publication'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('publication') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Book Author</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="author" value="{{ $book->author }}">

                                    @if ($errors->has('author'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Update
                                    </button>
                                    <button type="submit" name="action" value="delete" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
