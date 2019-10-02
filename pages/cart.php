<h2>Cart</h2>
<?php
    $total = 0;
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Price</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach ($_COOKIE as $key => $value) :?>
            <?$pos = strpos($key,'_');?>
            <?php if(substr($key, 0, $pos) == 'cart'):?>
            
            <?    
                $item_id = substr($key, $pos + 1);
                $item = Item::fromDb($item_id);
                $total += $item->Price;
            ?>
            <tr>
                <td><img src="<?=$item->Image?>" alt=""></td>
                <td><?=$item->Name?></td>
                <td><?=$item->Price?></td>
                <td><span data-target="<?='cart_'.$item->Id?>" style="color:red; cursor:pointer" class="glyphicon glyphicon-remove-sign btn_remove"></span></td>
            </tr>
            <?endif?>
        <?endforeach;?>
    </tbody>
    <tfoot class="bg-info">
        <tr>
            <td colspan="3">Total</td>
            <td><?=$total?></td>
        </tr>
    </tfoot>
</table>
<button class="btn btn-success" id="btn_buy">Buy</button>
  