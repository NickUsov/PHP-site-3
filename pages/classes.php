<?php
    class Tools
    {
        public static function connect($host='localhost:3306',$user='root', $password='', $dbname='shop_db')
        {
            $cs = "mysql:host=$host;dbname=$dbname;charset=utf8";
            $options = [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
            ];
            try
            {
                $pdo= new PDO($cs, $user, $password, $options);
                return $pdo;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
                return false;
            }
        }

        public static function register($login, $password, $image_path)
        {
            $login = trim(htmlspecialchars($login));
            $password = trim(htmlspecialchars($password));
            $image_path = trim(htmlspecialchars($image_path));
            if($login == '' || $password == '' || $image_path == ''){
                echo  "<script>alert('Fill All Required Fields')</script>";
                return false;
            }
            Tools::connect();
            $customer = new Customer($login, $password, $image_path);
            $err = $customer->intoDb();
            if($err){
                if($err == 1062){
                    echo  "<script>alert('This login is Already Token')</script>";
                }
                else {
                    echo  "<script>alert($err)</script>";
                }
                return false;
            }
            return true;
        }
    }

    class Customer
    {
        protected $id;
        protected $login;
        protected $password;
        protected $role_id;
        protected $discount;  //null
        protected $image_path; //null
        public function __construct($login, $password, $image_path, $id = 0)
        {
            $this->login = $login;
            $this->password = $password;
            $this->image_path = $image_path;
            $this->id = 0;
            $this->role_id = $role_id;
        }
        public function intoDb()
        {
            try {
                $pdo = Tools::connect();
                $ps = $pdo->prepare('insert into customers(login, password, role_id, discount, image_path) values(:login, :password, :role_id, :discount, :image_path)');
                $array =  ['login'=>$this->login, 'password'=>$this->password, 'role_id'=>$this->role_id, 'discount'=>$this->discount, 'image_path'=> $this->image_path];
                
                $ps->execute($array);
            } catch (PDOException $ex) {
                $err = $ex->getMessage();
                if(substr($err ,0 ,strpos($err, ':')) =='SQLSTATE[23000]:Integrity constraint violation'){
                    return 1062;
                }
                else{
                    return $ex->getMessage();
                }
            }
        }
        public static function fromDb($id)
        {
            try {
                $pdo = Tools::connect();
                $ps = $pdo->prepare("select * from customers where id=?");            
                $ps->execute([$id]);
                $row = $ps->fetch();
                $customer = new Customer($row['login'], $row['password'], $row['rimage_path'], $row['id']);
                return $customer;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                return false;
            }
        }
    }
?>