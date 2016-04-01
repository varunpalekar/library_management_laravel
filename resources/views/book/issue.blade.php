@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Issue Book</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/book/issue') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Book ID</label>

                                <div class="col-md-6">
                                    @if(!empty($bookID))
                                        <input type="text" class="form-control" name="bookID" value="{{$bookID}}">
                                    @else
                                        <input type="text" class="form-control" name="bookID" >
                                    @endif

                                    @if(!empty($status))
                                         <input type="text" class="form-control" name="status" value="{{$status}}">
                                    @endif

                                    @if ($errors->has('bookID'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('bookID') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Member ID</label>

                                <div class="col-md-6">
                                    @if(!empty($memberID))
                                        <input type="text" class="form-control" name="memberID" value="{{$memberID}}">
                                    @else
                                        <input type="text" class="form-control" name="memberID" >
                                    @endif

                                    @if ($errors->has('memberID'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('memberID') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Status</label>

                                <div class="col-md-6">
                                    <select name="status">
                                        <option value="issue">Issue</option>
                                        <option value="return">Return</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Issue
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
