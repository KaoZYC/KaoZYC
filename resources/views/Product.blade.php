@extends('layouts.app')

@section('script')
<script type="text/javascript">
    $(document).on('click', '.btn-add-cart', function(){
        var id = $(this).data('id');
        $.get('Product/Add_Cart/' + id, function(resp){
          if( resp.status == true ){
            alert('加入成功');
          }
        })
    });
    var page = '';
    if ( location.search != undefined) {
        page = location.search;
    }
    $(function(){
        $.getJSON('api/Product' + page, function(resp){
            for( var index in resp.data){
                var obj = resp.data[index];
                $('#tbody').append('<tr><td>' + obj.id + '</td><td><a href="Product/' + obj.id + '">' + obj.nme + '</a></td><td>' + obj.price + '</td>' +
                                    '<td><button data-id="' + obj.id + '" class="btn btn-sm btn-primary btn-add-cart">加入購物車</button></td></tr>');
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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Product Web</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>加入</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                    <a class="btn btn-primary" id="btn-prev">Previous</a>
                    <a class="btn btn-primary" id="btn-next">Next</a>
                    <a href="{{ url('Product/Cart') }}" class="btn btn-primary">結帳</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
