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
                               <button data-cart="${item.id}" class="btn btn-primary">To Cart</button>
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
});