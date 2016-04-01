@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @foreach($books as $book)
                <div class="panel panel-default">
                    <div class="panel-heading">{{$book['id']}}
                    @if($book['status'] == 'issue')
                            <br> <a href="/book/issue?bookID={{$book['id']}}&memberID={{$member}}">Return</a>
                    @endif
                    </div>
                    <tr>
                    @foreach($book as $key=>$value )
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
