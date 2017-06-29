@extends('layouts.app')

@section('script')
<script type="text/javascript">
    $(function(){
        setInterval(getUpdate, 1000);
        getUpdate();
        $('#chat-form').submit(function(event){
            event.preventDefault(); //阻止Form透過預設方式送出
            let message = $('#message').val();
            $.post('Chat/Create', {
              'message' : message,
              '_token'  : '{{ csrf_token() }}'
            }, function(resp){
              console.log(resp);
            });
            $('#message').val('');
            $('#message').focus();
        });
    });

    function getUpdate(){
        $.get('Chat/all', {}, function(resp){
          let str = '';
            for( let index in resp ){
              let chat = resp[index];
              str += chat.author + ': ' + chat.text + '\n';
            }
            $('#chat-disp').val(str);
        });
    }
</script>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chat Room</div>
                <div class="panel-body">
                    <form id="chat-form" method="post">
                        <div class="form-group">
                            <textarea name="chat-disp" id="chat-disp" class="form-control" rows="10" cols="40" readonly="true"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="message" class="form-control" name="message">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
