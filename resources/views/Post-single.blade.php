@extends('layouts.app')

@section('script')
<script type="text/javascript">
    $(function(){
        $('.btn-delete').click(function(){
            if( confirm('Do you want to delete Post #' + $(this).data('id')) ){
                location.href = 'Post/Delete' + $(this).data('id');
            }
        });
    });
    $(function(){
        var post_id = {{ $id }};
        $.getJSON('/KaoZYC/api/Post/' + post_id, function(data){
            $('#title').html(data.title);
            $('#text').html(data.text);
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" id="title"></div>

                <div class="panel-body" id="text">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
