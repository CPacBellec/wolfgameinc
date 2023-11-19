<?php 
    require_once "./src/dbConnect.php";
    class Database {
        private $connection;
        public function __construct($connection) {
            $this->connection = $connection;
        }
        //fonction getall de class
        public function getAllClass(){
            $statement = $this->connection->query("SELECT * FROM `class` WHERE 1");
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data ;
        }
        //fonction getById de class
        public function getByIdClass ($id){
            $statement = $this->connection->prepare("SELECT * FROM `class` WHERE class_id = ?");
            $statement->bindParam(1,$id);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        //fonction de recherche, de tri et de filtre des étudiants
        public function searchFilterSort($filter,$searchName,$sort){
            $prepare = "SELECT * FROM `student` WHERE 1";
            if($filter != ''){
                $prepare .= " AND class_id = ".$filter;
            } 
            if ($searchName != '') {
                $names = explode(' ', $searchName);

                $first_name = isset($names[0]) ? trim($names[0]) : '';
                $last_name = isset($names[1]) ? trim($names[1]) : '';
        
                if ($first_name != '') {
                    $prepare .= " AND (name LIKE '%" . $first_name . "%' OR surname LIKE '%" . $first_name . "%')";
                }
                if ($last_name != '') {
                    $prepare .= " AND (name LIKE '%" . $last_name . "%' OR surname LIKE '%" . $last_name . "%')";
                }
            }
            if($sort != ''){
                if($sort == "asc"){
                    $order = 'ASC';
                }else{
                    $order = 'DESC';
                }
                $prepare .= " ORDER BY name ". $order;
            }
            $statement = $this->connection->prepare($prepare);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        //fonction getById de student
        public function getByID ($id){
            $statement = $this->connection->prepare("SELECT * FROM `student` WHERE id = ?");
            $statement->bindParam(1,$id);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        //function getByName 
        public function getByName ($name,$surname){
            $statement = $this->connection->prepare("SELECT * FROM student WHERE `name` = ? AND `surname` = ?");
            $statement->bindParam(1,$name);
            $statement->bindParam(2,$surname);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        //fonction create
        public function create($payload ){
            $table = '(';
            $first = false;
            foreach($payload as $value){
                if(!$first){
                    $table .= '"'.htmlspecialchars($value).'"';
                    $first = true;
                }else{
                    $table .= ",". '"'.htmlspecialchars($value).'"';
                }
            }
            $table .= ')';
            $statement = $this->connection->prepare("INSERT INTO `student` (`surname`,`name`,`birthday`,`email`,`phone`,`address`,`postalcode`,`city`,`class_id`) 
            VALUES ".$table );
            $statement ->execute();
        }
        //fonction getAll de liste student
        public function getAll(){
            $statement = $this->connection->query("SELECT * FROM student WHERE 1 ORDER BY surname ASC");
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data ;
        }
        // fonction delete 
        public function delete($id){
            $statement = $this->connection->prepare("DELETE FROM `student` WHERE id = ?");
            $statement->bindParam(1,$id);
            $statement ->execute();
        }
        //fonction update
        public function update($id,$payload){
            $first = false;
            $table ='';
            $colmName = ["surname","name","birthday","email","phone","address","postalcode","city","class_id"];
            foreach($payload as $key => $value){
                if(!$first){
                    $table .= '`'.$colmName[$key].'` = "'.htmlspecialchars($value).'"';
                    $first = true;
                }else{
                    $table .= ",".'`'.$colmName[$key].'` = "'.htmlspecialchars($value).'"';
                }
            }
            $statement = $this->connection->prepare("UPDATE `student` SET ".$table." WHERE id = ?");
            $statement->bindParam(1,$id);
            $statement ->execute();
        }
    }