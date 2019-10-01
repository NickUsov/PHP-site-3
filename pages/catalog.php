<h2>Catalog</h2>
<?php
    $pdo = Tools::connect();
    $ps = $pdo->prepare('select * from items');
    $ps->execute();
    $rows = ceil($ps->rowCount() / 4);
?>
<? for($i = 0; $i < $rows; $i ++):?>
    <div class="row">
        <? for($j = 0; $j < 4; $j ++):?>
            <? if($row = $ps->fetch()):?>
                <div class="col-md-3">
                    <div class="pane panel-succes">
                        <div class="panel-heading"><?=$row['item_name']?></div>
                        <div class="panel-body">
                            <img src="<?=$row['image_path']?>" alt="picture" class="" style="max-width:100%;max-height:100%">
                        </div>
                        <div class="panel-footer clearfix">
                            <div class="pull-left"><?=$row['price_sale']?></div>
                            <div class="pull-right">
                                <button class="btn btn-primary">Buy</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?endif;?>
        <?endfor;?>
    </div>
<?endfor;?>
