<?php

    class Hash {
        
        public static function make ( $string ) {
            
            return password_hash( $string, PASSWORD_BCRYPT);
        }
        
        public static function salt ( $length ) {
            return random_bytes( $length );
            // return mcrypt_create_iv($length);
        }
        
        public static function unique () {
            return hash( 'SHA256', uniqid() );
        }
        
    }
