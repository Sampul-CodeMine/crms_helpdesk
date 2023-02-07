<?php

    class User {
        
        private $_db,
                $_data,
                $_sessionName,
                $_isLoggedIn;
        
        public function __construct ( $user = null ) {
            
            $this->_db = DB::getInstance();
            $this->_sessionName = Config::get('session/session_name');  
            
            if (!$user) {
                if ( Session::exists($this->_sessionName)){
                    $user = Session::get($this->_sessionName);
                    if($this->find('tab_users', $user)){
                        $this->_isLoggedIn = true;
                    } else {
                        self::logout();
                    }
                }
            } else {
                $this->find('tab_users', $user);
            }
        }
        
        public function create ( $table, $fields = array() ) {
            if ( !$this->_db->insert( $table, $fields) ) {
                throw new Exception('There was a problem with saving your contents.');
            }
        }
        
        public function update ( $table, $id = null, $fields = array () ) {
            
            if ( !$id && $this->isLoggedIn() ) {
                $id = $this->data()->id;
            }
            
            if ( !$this->_db->update( $table, $id, $fields ) ) {
                throw new Exception('There was a problem with updating your contents.');
            }
        }
        
        public function find ( $table, $user = null ) {
            if ( $user ) {
                $field = (is_numeric ($user) ) ? 'u_id' : 'user_username';
                $data = $this->_db->get ( $table, array( $field, '=', $user ) );
                
                if ( $data->count() ) {
                    $this->_data = $data->firstResult();
                    return true;
                }
            }
            return false;
        }
        
        public function login ( $table, $username = null, $password = null ) {            
            $user = $this->find ( $table, $username );
            if ($user) {
                
                if ( $this->data()->plain_password === $password && password_verify($password, $this->data()->password ) ) {
                    Session::put ( $this->_sessionName, $this->data()->u_id );
                    return true;
                } else {
                    Session::put("error", "Login attempt Failed. Invalid Username and/or Password.");
                }               
            } else {
                Session::put("error", "Login attempt Failed. User does not exist.");
            }
            return false;
        }
        
        public function exists() {
            return  ( !empty($this->_data)) ? true : false;
        }
        
        public function data () {
            return $this->_data;
        }
        
        public function isLoggedIn () {
            return $this->_isLoggedIn;
        }
        
        public function logout() {
            Session::delete ( $this->_sessionName );                        
        }
        
        public function hasPermissions ( $key ) {                     
            $group = $this->_db->get('tab_access_permissions', array ( 'p_id', '=', $this->data()->access_level ) );
            if ( $group->count()){
                $permission = $group->firstResult()->p_name;
                if ($permission === $key){
                    return true;
                }
            }
            return false;
        }
        
    }
