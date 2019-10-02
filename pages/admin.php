<h2>Admin</h2>
<?php 
    // Add items
    if(isset($_POST['add_btn'])){
        if(is_uploaded_file($_FILES['image_path']['tmp_name'])){
            $path = 'images/'.$_FILES['image_path']['name'];
            move_uploaded_file($_FILES['image_path']['tmp_name'], $path);
        }
        $category_id = $_POST['category_id'];
        $price_in = $_POST['price_in'];
        $price_sale = $_POST['price_sale'];
        $item_name = $_POST['item_name'];
        $info = trim(htmlspecialchars($_POST['info']));
        $item = new Item($item_name, $category_id, $price_in, $price_sale, $info, $path);
        $err = $item->intoDb();
        if($err){
            echo  "<script>alert($err)</script>";
        }
    }

    // Add categories
    if(isset($_POST['add_category'])){
        $category = $_POST['categories'];
        $pdo = Tools::connect();
        $ps = $pdo->prepare("insert into categories(category) values(?)");
        $ps->execute([$category]);
        echo "<script>alert('New category was adding')</script>";
    }

    //Add pictures
    if(isset($_POST['add_picture'])){
        if(is_uploaded_file($_FILES['picture_path']['tmp_name'])){
            $_path = 'images/'.$_FILES['picture_path']['name'];
            move_uploaded_file($_FILES['picture_path']['tmp_name'], $_path);
        }
        $item_id = $_POST['item_id'];
        $pdo = Tools::connect();
        $ps = $pdo->prepare("insert into images(item_id, image_path) values(:item_id, :image_path)");
        $ps->execute(['item_id'=>$item_id, 'image_path'=>$_path]);
        echo "<script>alert('New image was adding')</script>";
    }
?>
<div class="col-md-4">
    <div class="panel panel-success">
        <div class="panel-heading">Items</div>
        <div class="panel-body">
            <form action="index.php?page=4" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Select Category:</label>
                <select name="category_id">
                    <?php
                        $pdo = Tools::connect();
                        $list = $pdo->query('select * from categories');
                    ?>
                    <? while($row=$list->fetch()):?>
                        <option value="<?=$row['id']?>"><?= $row['category']?></option>
                    <? endwhile;?>
                </select>
            </div>
            <div class="form-group">
                <label for="item_name">Name:</label>
                <input type="text" name="item_name" class="form-control">
            </div>
            <div class="form-group">
                <label>Price In & Pice Sale
                    <input type="number" name="price_in" class="form-control">
                    <input type="number" name="price_sale" class="form-control">
                </label>
            </div>
            <div class="form-group">
                <label for="info">Description:
                    <textarea name="info" cols="40" rows="5" class="form-control"></textarea>
                </label>
            </div>
            <div class="form-group">
                <label for="image_path">Select Image:</label>
                <input type="file" name="image_path" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning" name="add_btn">Add</button>
        </form>
        </div>
    </div>
 </div>
 <div class="col-md-4">
    <div class="panel panel-danger">
        <div class="panel-heading">Categories</div>
        <div class="panel-body">
            <form action="index.php?page=4" method="post">
                <div class="form-group">
                    <label for="categories">Categories</label>
                    <input type="text" name="categories" class="form-group">
                </div>
                <button type="submit" class="btn btn-warning" name="add_category">Add</button>
            </form>
        </div>
    </div>
 </div>
 <div class="col-md-4">
    <div class="panel panel-warning">
        <div class="panel-heading">Pictures</div>
        <div class="panel-body">
            <form action="index.php?page=4" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="item_id">Select Item:</label>
                <select name="item_id">
                    <?php
                        $pdo = Tools::connect();
                        $list = $pdo->query('select * from items');
                    ?>
                    <? while($row_=$list->fetch()):?>
                        <option value="<?=$row_['id']?>"><?= $row_['item_name']?></option>
                    <? endwhile;?>
                </select>
            </div>
                <div class="form-group">
                    <label for="pictures">Pictures</label>
                    <input type="file" name="picture_path" class="form-group">
                </div>
                <button type="submit" class="btn btn-warning" name="add_picture">Add</button>
            </form>
        </div>
    </div>
 </div>   
