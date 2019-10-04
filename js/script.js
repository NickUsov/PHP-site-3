$('document').ready(function(){
    $('#sel_category').on('change',function(){
        let category_id = $(event.target).val();
        $.ajax({
            type:'POST',
            url: 'pages/list_ajax.php',
            data: {'category_id':category_id},
            success: function(data){
                let categories = JSON.parse(data);
                let html = '';
                categories.forEach(function(item){
                   html += `<div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading"><span style="cursor:pointer" class="item_head">${item.item_name}</span></div>
                        <div class="panel-body" style="height:200px">
                            <img src="${item.image_path}" alt="picture" style="max-width:100%;max-height:100%">
                        </div>
                        <div class="panel-footer clearfix">
                            <div class="pull-left">${item.price_sale}</div>
                            <div class="pull-right">
                                <button data-cart="${item.id}" class="btn btn-primary btn_to_cart">To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>`;
                });
                $('.catalog').html(html);
            },
            error: function(data) {
                alert('Something wrong' + data.statusText);
            }
        })
    });

    $(document).on('click', '.btn_to_cart', ()=>{
        event.preventDefault();
        let date = new Date((new Date().getTime()+60*1000*30));
        document.cookie = $(event.target).data('cart') + '=ok; path=/;expires=' + date.toUTCString();
    });

    function removeCookie(name) {
        let date = new Date(new Date().getTime() - 60000);
        document.cookie = name + '=ok; path=/;expires=' + date.toUTCString();
        document.location.reload();
    };

    function removeCookies() {
      let cookies_array = document.cookie.split(';');
        cookies_array.forEach((cookies_item)=>{
            if(cookies_item.indexOf('cart') === 1){
                let cook = cookies_item.split('=');
                let date = new Date(new Date().getTime() - 60000);
                document.cookie = cook[0] + '=ok; path=/;expires=' + date.toUTCString();
                console.log(cookies_item);
                document.location.reload();
            }
        });  
    };

    $('.btn_remove').on('click', ()=>{
        removeCookie($(event.target).data('target'));
        
    });

    $('#btn_buy').on('click', ()=>{
        let id = $(event.target).data('user_id');
        let cookies_array = document.cookie.split(';');
        let data_array = [];
        cookies_array.forEach((cookies_item)=>{
            if(cookies_item.indexOf('cart') === 1){
                let cook = cookies_item.split('=');
                let id = cook[0].split('_');
                data_array.push(id[1]);
               
            };
        });
        $.ajax({
                    type:'POST',
                    url: 'pages/buy_ajax.php',
                    data: {'jsonData': JSON.stringify (data_array), 'user_id':id },
                    success: function(data){
                        console.log(data);
                        if(data){
                            removeCookies();
                        }
                    }
                });
    });

    $(document).on('click', '.item_head', ()=>{
        let item_id = $(event.target).data('item_id');
        $('.modal').removeClass('hide');
        $('.modal').addClass('show');
        //$('.modal').text('item_id ' + item_id);
        $.ajax({
            type:'POST',
            url: 'pages/modal_ajax.php',
            data: {'item_id': item_id },
            success: function(data){
                console.log(data);
                if(data){
                    $('.item_info').html(data);
                }
            } 
        });   
    });

    $(document).on('click', '#btn_close', (event)=>{
        event.preventDefault();
        $('.modal').removeClass('show');
        $('.modal').addClass('hide');
    });

});