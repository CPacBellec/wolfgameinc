<?php
    
    namespace wolfpac\Wolfgameinc\Controller;

    use PDO;
    use PDOException;

    class Database{
        protected $table;
        protected $format;
        protected $method;
        protected $lastResult;
        protected $data;
        protected $connexion;
        protected $query;
        
        private $availableKeys =["post","filters"];
        protected $filters;
        protected $post;

        private $host;
        private $username;
        private $password;
        private $port;
        private $db_name;

    
        public function __construct($dbName = null) {
            $this->jsonConnect($dbName);
            $this->connect();
        }
        
        private function connect() : bool {
            try {
                $connexion = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name", $this->username, $this->password);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexion = $connexion;
                return true;
            } catch (PDOException $e) {
                return false;
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        private function jsonConnect($dbName = null){
            $config = file_get_contents('./configs/config.json');
            $config = json_decode($config, true);
            $this->host = $config['host'];
            $this->username = $config['user'];
            $this->password = $config['password'];
            $this->port = $config['port'];
            $this->db_name = $dbName;
        }
        public function table($tablename)
        {
            //Verify if table exist
            $this->table = $tablename;
            return $this;
        }
        public function get($data){
            $this->method = "get";
            $this->makeQuery($data);
            return $this;
        }
        public function post($data){
            $this->method = "post";
            $this->makeQuery($data);
            return $this;
        }
        public function delete($data,$force = false){
            $this->method = "soft-delete";
            if($force){
                $this->method = "delete";
            }
            $this->makeQuery($data);
            return $this;
        }
        public function update($data){
            $this->method = "update";
            $this->makeQuery($data);
            return $this;
        }
        public function getData(){
            return $this->data;
        }
        public function makeQuery($data){
            $this->data = $data;
            $this->setFormat();
            $this->build();
        }
        public function getMethod(){
            return $this->method;
        }
        private function setFormat(){
            $format = "";
            switch ($this->method) {
                case 'post':
                    $format = "INSERT INTO %s %s VALUES %s ;";
                    break;
                case 'soft-delete':
                case 'update':
                    $format = "UPDATE %s SET %s WHERE %s ;";
                    break;
                case 'delete':
                    $format = "DELETE FROM %s WHERE %s ;";
                    break;
                case 'get':
                default:
                    $format = "SELECT %s FROM %s WHERE %s ORDER BY id DESC ;";
                    break;
            }
            $this->format = $format;
        }
        public function getFormat(){
            return $this->format;
        }
        public function getQuery(){
            return $this->query;
        }
        public function getTable(){
            return $this->table;
        }
        public function setColumns(){
    
        }
        public function makeColumnName($raw){
            if(is_string($raw)){
                if($raw == "*"){
                    return $raw;
                }
                else{
                    $raw = '`'.$raw.'`';
                } 
            }
            return $raw;
        }
        //Change Value to SQL Acceptable value
        public function makeSqlValue($raw){
                    if(is_string($raw)){
                        $raw = '"'.$raw.'"';
                    } 
                    if($raw === true){
                        $raw = 'TRUE';
                    }
                    if($raw === false){
                        $raw = 'FALSE';
                    }
                    return $raw;
        }
        //Make listing with separator
        public function makeListing($list =[], $separator = "," ,$prefix ="", $suffix = "", $sqlVal = false,$encapsuler = ""){
            $res = $prefix;
            $index = 0;
            foreach ($list as $value) {
                if($sqlVal){
                    $res .= $this->makeSqlValue($value);
                } else {
                    $res .= $encapsuler . $value . $encapsuler;
                }
                
                if(!(count($list) == ($index + 1 ))){
                    $res .= $separator;
                }
                $index += 1;
            }
            $res .= $suffix;
            return $res;
        }
        public function parseParams($dataKey = 'filters', $separatedBy = " AND "){
            $res = "1";
            if(isset($this->getData()[$dataKey])){
                $res = "";
                $this->setParams($dataKey,$this->getData()[$dataKey])  ;
                $filters = [];
                foreach ($this->getParams($dataKey) as $key => $filter) {
                    $filter  = $this->makeSqlValue($filter);
                    $key = $this->makeColumnName($key);
                    $filters[] = "$key = $filter";
                }
                $res .= $this->makeListing($filters, $separatedBy);
            }
            return $res;  
        }
    
        private function setParams($key,$data){
            if(in_array($key,$this->availableKeys)){
                $this->$key = $data ;
                return $this;
            }
        }
        public function getParams($key){
            if(in_array($key,$this->availableKeys)){
                return $this->$key;
            }
        }
        private function setQuery($query){
            $this->query = $query;
            return $this;
        }
        private function build(){
            switch ($this->getMethod()) {
                case 'post':
                    $query = "";
    
                    if(isset($this->data['post'])){
                        $columns = array_keys($this->data["post"]);
                        foreach($columns as $key => $value){
                            $columns[$key] = $this->makeColumnName($value);
                        }
                        $columns = $this->makeListing($columns, ',', '(',')');
                        $values = $this->makeListing($this->data['post'], ',', '(',')',true);
                        $query = sprintf($this->getFormat(), $this->table, $columns, $values);
                    }
                    break;
                case 'update':
                    // $format = "UPDATE %s SET %s WHERE %s ;";
                    $query = sprintf($this->getFormat(), $this->table, $this->parseParams('post', ' , '), $this->parseParams());
                    break;
                case 'soft-delete':
                    $query = sprintf($this->getFormat(), $this->table, "`online` = false", $this->parseParams());
                    break;
                case 'delete':
                    $query = sprintf($this->getFormat(), $this->table, $this->parseParams());
                    break;
                case 'get':
                    $columns = "*";
                    if(isset($this->data['cols'])){
                        $columns= $this->makeListing($this->data['cols'],',');
                        $columns = explode(",",$columns);
                        foreach($columns as $key => $value){
                            $columns[$key] = $this->makeColumnName($value);
                        }
                        $columns = implode(",",$columns);
                    }
                    
                    $query = sprintf($this->getFormat(),$columns, $this->table, $this->parseParams());
                    break;
                default:
                    // $format = "SELECT %s FROM %s WHERE %s ;"; 
                    $query = sprintf($this->getFormat(),"*", $this->table, $this->parseParams());
                    break;
            }
            $this->query = $query;
        }
        public function do(){
            $this->lastResult = $this->connexion->query($this->getQuery());
            return $this->lastResult;
        }
        //echaper les quote de data (utile pour image)
        public function getEscaping(string $data){
            $escapedString = $this->connexion->quote($data);
            $escapedString = trim($escapedString, "'");
            return $escapedString;
        }

        public function searchFilterOrderby($searchName,$filters = []){
            $prepare = "SELECT * FROM `product` WHERE 1";

            if (isset($filters) && $filters != []) {
                $key = array_keys($filters);
                $prepare .= " AND (".$key[0]." = " . $filters[$key[0]] . ")";
            }
            if ($searchName != '') {
                $prepare .= " AND (name LIKE '%" . $searchName . "%')";
            }
            
            $statement = $this->connexion->prepare($prepare);
            $statement->execute();
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        
    }