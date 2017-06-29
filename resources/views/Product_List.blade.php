@extends('layouts.app')

@section('script')
<script type="text/javascript">
    var page = '';
    if ( location.search != undefined) {
        page = location.search;
    }
    $(function(){
        $.getJSON('/KaoZYC/Product/Product_List' + page, function(resp){
            for( var index in resp){
                var obj = resp[index];
                $('#tbody').append('<tr><td>' + obj.id + '</td><td><a href="Product/' + obj.id + '">' + obj.nme + '</a></td><td>' + obj.price + '</td>' +
                                    '<td><button data-id="' + obj.id + '" class="btn btn-sm btn-primary btn-add-cart">刪除</button></td></tr>');
            }
            if ( resp.next_page_url == null ) {
                $('#btn-next').hide();
            }else if( resp.prev_page_url == null ) {
                $('#btn-prev').hide();
            }
            $('#btn-next').attr('href', resp.next_page_url);
            $('#btn-prev').attr('href', resp.prev_page_url);
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cart Web</div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                    <a class="btn btn-primary" id="btn-prev">Previous</a>
                    <a class="btn btn-primary" id="btn-next">Next</a>
                    <a href="{{ url('Product') }}" class="btn btn-danger">繼續購物</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
