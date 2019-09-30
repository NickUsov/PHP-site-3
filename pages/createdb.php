<?php
    include_once 'classes.php';
    $pdo = Tools::connect();
    $role = "create table roles(
        id int not null auto_increment primary key,
        role varchar(25) not null unique
    ) default charset ='utf8'";

    $customer = "create table customers(
        id int not null auto_increment primary key,
        login varchar(25) not null unique,
        password varchar(32) not null,
        role_id int not null, foreign key(role_id) references roles(id) on update cascade,
        discount int,
        image_path varchar(255)
    ) default charset ='utf8'";

    $category = "create table categories(
        id int not null auto_increment primary key,
        category varchar(64) not null unique
    ) default charset ='utf8'";

    $item = "create table items(
        id int not null auto_increment primary key,
        item_name varchar(128) not null,
        category_id int not null, foreign key(category_id) references categories(id) on update cascade,
        price_in varchar(12) not null,
        price_sale varchar(12) not null,
        info varchar(255) not null,
        image_path varchar(255) not null

    ) default charset ='utf8'";

    $image = "create table images(
        id int not null auto_increment primary key,
        item_id int not null, foreign key (item_id) references items(id) on update cascade,
        image_path varchar(255) not null
    ) default charset ='utf8'";

    $sale = "create table sales(
        id int not null auto_increment primary key,
        customer_id int  not null, foreign key (customer_id) references customers(id) on update cascade,
        item_id int  not null, foreign key (item_id) references items(id) on update cascade,
        created timestamp,
        quantity int not null
    ) default charset ='utf8'";

    $pdo->exec($role);
    $pdo->exec($customer);
    $pdo->exec($category);
    $pdo->exec($item);
    $pdo->exec($image);
    $pdo->exec($sale);
?>