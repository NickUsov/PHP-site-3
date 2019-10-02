$('document').ready(function(){
    $('#sel_category').on('change',function(){
        let category_id = $(this).val();
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
                        <div class="panel-heading">${item.item_name}</div>
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

    $('.btn_to_cart').on('click', ()=>{
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
        let cookies_array = document.cookie.split(';');
        //console.log(cookies_array);
        data_array = [];
        cookies_array.forEach((cookies_item)=>{
            if(cookies_item.indexOf('cart') === 1){
                let cook = cookies_item.split('=');
                let item = cook[0].split('_');
                
               console.log(item[1]);
            }
        });
    });
});