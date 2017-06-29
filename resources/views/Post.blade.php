@extends('layouts.app')

@section('script')
<script type="text/javascript">
    $(function(){
        $('.btn-read').click(function(){
            location.href = 'Post/' + $(this).data('id');
        });
    });
    var page = '';
    if ( location.search != undefined) {
        page = location.search;
    }
    $(function(){
        $.getJSON('api/Post' + page, function(resp){
            for( var index in resp.data){
                var obj = resp.data[index];
                $('#tbody').append('<tr><td>' + obj.id + '</td><td>' + obj.author + '</td><td><a href="Post/' + obj.id + '">' + obj.title + '</a></td></tr>');
            }
            if ( resp.next_page_url == null ) {
                $('#btn-next').hide();
            }else if( resp.prev_page_url == null ) {
                $('#btn-prev').hide();
            }
            $('#btn-next').attr('href', resp.next_page_url.replace('api/', ''));
            $('#btn-prev').attr('href', resp.prev_page_url.replace('api/', ''));
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Post Web</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                    <a class="btn btn-primary" id="btn-prev">Previous</a>
                    <a class="btn btn-primary" id="btn-next">Next</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
