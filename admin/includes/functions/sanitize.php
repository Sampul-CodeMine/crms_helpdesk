<?php
    function escaper ( $string ){
        return trim ( htmlentities ( $string, ENT_QUOTES, 'UTF-8' ) );
    }

?>