@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @foreach($members as $member)
                <div class="panel panel-default">
                    <div class="panel-heading">{{$member['id']}} <br/> <a href="/member/edit/{{$member['id']}}">Edit</a> <br/> <a href="/member/books/{{$member['id']}}">Issue Books</a> </div>
                    <tr>
                    @foreach($member as $key=>$value )
                        @if($key === 'id')
                            <?php continue  ?>
                        @endif
                        <div class="panel-body">
                        <td><b>{{$key}}:</b></td>
                        <td>{{$value}}</td>
                        </div>
                    @endforeach
                    </tr>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
