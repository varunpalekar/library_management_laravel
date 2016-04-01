@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Member</div>

                <a href="/member/add">
                    <div class="panel-body">Add Member</div>
                </a>

                <a href="/member/search">
                    <div class="panel-body">Search Member</div>
                </a>

            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Book</div>

                <a href="/book/add">
                    <div class="panel-body">Add Book</div>
                </a>

                <a href="/book/search">
                    <div class="panel-body">Search Book</div>
                </a>

                <a href="/book/issue">
                    <div class="panel-body">Issue/Submit Book</div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
