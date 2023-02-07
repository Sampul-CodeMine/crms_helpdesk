<?php
    
    class DB {
        
        #Declaration of private properties for the class
        private static $_instance = null;
        private $_pdo,
                $query,
                $_error = false,
                $_results,
                $_count = 0;
        
        #Constructor for the DB class
        public function __construct () {
            try {
                $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/dbname') , Config::get('mysql/username'), Config::get('mysql/password'));
            } catch (PDOException $err ) {
                die ( $err->getMessage() );
            }
        }
        
        #Function to get an instance of the DB class
        public static function getInstance () {
            if ( !isset ( self::$_instance ) ) {
                self::$_instance = new DB();
            } 
            return self::$_instance;
        }
        
        #Function to execute a query
        public function query ( $sql, $params = array() ) {
            
            $this->_error = false;
            if ( $this->_query = $this->_pdo->prepare( $sql ) ) {
                $x = 1;
                if ( count ( $params ) ) {
                    foreach ( $params as $param ) {
                        $this->_query->bindValue ( $x, $param );
                        $x++;
                    }
                }
                if ( $this->_query->execute() ) {
                    $this->_results     = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count       = $this->_query->rowCount();
                } else {
                    $this->_error       = true;
                }
            }
            return $this;
        }
        
        #Function to perform specific database actions
        public function action ( $action, $table, $where = array() ) {
            if ( count ( $where ) === 3 ) {
                $operators  = array ( '=', '>', '<', '>=', '<=' );
                
                $field      = $where[0];            
                $operator   = $where[1];
                $value      = $where[2];
                
                if ( in_array($operator, $operators) ) {
                    $sql = "{$action} FROM `{$table}` WHERE {$field} {$operator} ?;";
                    if ( !$this->query ( $sql, array($value) )->error() ) {
                        return $this;
                    }
                }
            }
            return false;
        }
        
        #Function to perform specific database actions
        public function all_actions ( $action, $table ) {         
            $sql = "{$action} FROM `{$table}`;";
            if ( !$this->query ( $sql, array() )->error() ) {
                return $this;
            }
            return false;
        }
        
        #function to run free hardwired queries
        public function free_run( $query) {
            if (!$this->query($query)->error()) {
                return $this;
            }
            return false;
        }
        
        #Funtion to get all data from the database
        public function get_all($table) {
            return $this->all_actions('SELECT * ', $table);
        }
        
        #Function to get data/record from the database
        public function get ( $table, $where = array() ) {
            return $this->action('SELECT * ', $table, $where);
        }
        
        #Function to delete a record/data from the database.
        public function delete ( $table, $where = array() ) {
            return $this->action('DELETE ', $table, $where);
        }
        
        #Function to insert data into the database.
        public function insert ( $table, $fields = array() ) {
            if ( count ( $fields ) ) {
                $keys   = array_keys( $fields );
                $values = '';
                $x      = 1;
                
                foreach ( $fields as $field ) {
                    $values .= '?';
                    if ( $x < count( $fields ) ) {
                        $values .= ', ';
                    }
                    $x++;
                }
                
                $sql    = "INSERT INTO `{$table}` (`" . implode('`, `', $keys) . "`) VALUES ({$values});";
                
                if ( !$this->query( $sql, $fields )->error() ) {
                    return true;
                }
                
            }
            return false;
        }
        
        #Function to updadte data into the database.
        public function update ( $table, $id, $fields = array() ) {
            $set    = '';
            $x      = 1;
            
            foreach ( $fields as $name => $value ) {
                $set .= "`{$name}` = ?";
                if ( $x < count($fields )) {
                    $set .= ', ';
                }
                $x++;
            }
            
            $sql    = "UPDATE `{$table}` SET {$set} WHERE `id` = {$id};";
            
            if ( !$this->query( $sql, $fields )->error() ) {
                return true;
            }
            return false;
        }
        
        #Function to return the results fetched from the database.
        public function results() {
            return $this->_results;
        }
        
        #Function to return the first result fetched from the database.
        public function firstResult() {
            return $this->results()[0];    
        }        
        
        #Function to return all the errors generated
        public function error () {
            return $this->_error;    
        }
        
        #Function to count the records retrieved from the database
        public function count() {
            return $this->_count;
        }
        
        #Function to implement filter region
        public function region_filter($region){
            $region = $this->_pdo->prepare("SELECT region_name, region_email, region_nation_id FROM `tab_regions` WHERE `region_name` LIKE '$region%'");
            $region->execute();   

            while ($row = $region->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr>";
                    echo "<td>" . $row['region_name'] . "</td>";
                    echo "<td>" . $row['region_email'] . "</td>";
                    echo "<td>";
                        $nation = DB::getInstance()->get('tab_nations', array('n_id', '=', $row['region_nation_id']) );
                        if ( $nation->count()) {
                            $db_result = $nation->firstResult()->n_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";
                    echo"<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui orange pencil icon'>";
                            echo "</i>";
                        echo "</a>";
                    echo"</td>";
                    echo "<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui red trash icon'>";
                            echo "</i>";
                        echo "</a>";
                    echo "</td>";
                echo "</tr>";
            }
            return $region->fetchAll();
        }

        #Function to implement filter state
        public function state_filter($state){
            $state = $this->_pdo->prepare("SELECT region_id, country_id, state_name FROM `tab_states` WHERE `state_name` LIKE '$state%'");
            $state->execute();

            while ($row = $state->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr>";
                    echo "<td>";
                        $state_region = DB::getInstance()->get('tab_regions', array('r_id', '=', $row['region_id'] ));
                        if ($state_region->count())
                        {
                            $db_result = $state_region->firstResult()->region_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";
  
                    echo "<td>";
                        $nation = DB::getInstance()->get('tab_nations', array('n_id', '=', $row['country_id'] ));
                        if($nation->count())
                            {
                                $db_result = $nation->firstResult()->n_name;
                                echo ucfirst($db_result);
                            }
                    echo "</td>";
                    
                    echo "<td>" . $row['state_name'] . "</td>";

                    echo"<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui orange pencil icon'>";
                            echo "</i>";
                        echo "</a>";
                    echo"</td>";

                    echo "<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui red trash icon'>";
                            echo "</i>";
                        echo "</a>";
                    echo "</td>";
                echo "</tr>";
            }
            return $state->fetchAll();
        }

        #function to implement location filter
        public function location_filter($location){
            $location = $this->_pdo->prepare("SELECT location_name, location_email, address, state_id, phone_number, repair_center_id FROM `tab_locations` WHERE `location_name` LIKE '$location%'");
            $location->execute();

            while ($row=$location->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr>";
                    echo "<td>" . $row['location_name'] . "</td>";
                    echo "<td>" . $row['location_email'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>";
                        $location_state = DB::getInstance()->get('tab_states', array('s_id', '=', $row['state_id'] ));
                        if($location_state->count())
                        {
                            $db_result=$location_state->firstResult()->state_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>";
                        $location_repair_center = DB::getInstance()->get('tab_repair_center', array('r_id', '=', $row['repair_center_id']));
                        if($location_repair_center->count())
                        {
                            $db_result = $location_repair_center->firstResult()->r_center_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";  
                    echo "<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui orange pencil icon'>";
                            echo "</i>";
                        echo "</a>";
                    echo "</td>";
                    echo "<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui red trash icon'>";
                            echo "</i>";
                        echo "</a>";
                    echo "</td>";                    
                echo "</tr>";
            }
            return $location->fetchAll();
        }

        #Funtion to implement Engineer filter
        public function engineer_filter($engineer){
            $engineer = $this->_pdo->prepare("SELECT engr_name, engr_code, engr_mobile, engr_email, engr_location_id, engr_vendor_id, engr_nation_id FROM `tab_engineer` WHERE `engr_name` LIKE '$engineer%'");
            $engineer->execute();

            while ($row=$engineer->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr>";
                    echo "<td>" . $row['engr_name'] . "</td>";
                    echo "<td>" . $row['engr_code'] . "</td>";
                    echo "<td>" . $row['engr_mobile'] . "</td>";
                    echo "<td>" . $row['engr_email'] . "</td>";
                    echo "<td>";
                        $engineer_location = DB::getInstance()->get('tab_locations', array('l_id', '=', $row['engr_location_id']));
                        if($engineer_location->count())
                        {
                            $db_result=$engineer_location->firstResult()->location_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";
                    echo "<td>";
                        $engineer_vendor = DB::getInstance()->get('tab_regions', array('r_id', '=', $row['engr_vendor_id']));
                        if($engineer_vendor->count())
                        {
                            $db_result = $engineer_vendor->firstResult()->region_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";
                    echo "<td>";
                        $engineer_nation = DB::getInstance()->get('tab_nations', array('n_id', '=', $row['engr_nation_id']));
                        if($engineer_nation->count())
                        {
                            $db_result = $engineer_nation->firstResult()->n_name;
                            echo ucfirst($db_result);
                        }
                    echo "</td>";
                    echo "<td>";
                        echo "<a name='btnEdit' id='btnEdit' class='ui small orange' href=''>";
                            echo "<i class='ui orange pencil icon'></i>";
                        echo "</a>";
                    echo "</td>";
                    echo "<td>";
                        echo "<a name='btnDelete' id='btnDelete' class='ui small orange' href=''>";
                            echo "<i class='ui red trash icon'></i>";
                        echo "</a>";
                    echo "</td>";
                echo "</tr>";
            }
            return $engineer->fetchAll();
        }
    }