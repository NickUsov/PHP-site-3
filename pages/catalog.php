
<?php
    $pdo = Tools::connect();
    $ps = $pdo->prepare('select * from items');
    $ps->execute();
    $rows = ceil($ps->rowCount() / 4);
    $pr = $pdo->prepare('select * from categories');
    $pr->execute();
?>
<div class="row">
<div class="col-md-6"><h2>Catalog</h2>
</div>
    
    <div class="col-md-6 clerfix form-inline">
    <select name="category_id" class="pull-right clearfix form-control" id="sel_category">
        <?while($row = $pr->fetch()):?>
            <option value="<?=$row['id']?>"><?=$row['category']?></option>
        <? endwhile;?>
    </select>
</div>
</div>

<div class="catalog">
    <? for($i = 0; $i < $rows; $i ++):?>
        <div class="row">
            <? for($j = 0; $j < 4; $j ++):?>
                <? if($row = $ps->fetch()):?>
                    <div class="col-md-3">
                        <div class="panel panel-success">
                            <div class="panel-heading"><?=$row['item_name']?></div>
                            <div class="panel-body" style="height:200px">
                                <img src="<?=$row['image_path']?>" alt="picture" class="" style="max-width:100%;max-height:100%">
                            </div>
                            <div class="panel-footer clearfix">
                                <div class="pull-left"><?=$row['price_sale']?></div>
                                <div class="pull-right">
                                    <button data-cart="<?="cart_".$row['id']?>" class="btn btn-primary">To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endif;?>
            <?endfor;?>
        </div>
    <?endfor;?>
</div>
