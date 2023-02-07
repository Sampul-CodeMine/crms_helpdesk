<?php 
    include_once './includes/core/init.php'; 

    #this is to get the regions from chosen nations in the add region form
    if ( isset($_POST['countryId']) && !empty($_POST['countryId'])) {
        $id = (int)$_POST['countryId'];
        
        $regionQuery = DB::getInstance()->free_run("SELECT * FROM `tab_regions` WHERE `region_nation_id` = $id ORDER BY `region_name` ASC;");
        $regions = '<option value="">-- Select --</option>';
        if ( $regionQuery->count() ) {
            foreach ( $regionQuery->results() as $region){
                $regions .= '<option value="' . $region->r_id . '">'. $region->region_name .'</option>';
            }
        } 
        echo $regions;
    }

    #this is to get the states from chosen regions in the add location form
    if ( isset($_POST['regionId']) && !empty($_POST['regionId']) ) {
        $id = (int)$_POST['regionId'];
        $statesQuery = DB::getInstance()->free_run("SELECT * FROM `tab_states` WHERE `region_id` = $id ORDER BY `state_name` ASC;");
        $states = '<option value="">-- Select --</option>';
        if ( $statesQuery->count() ) {
            foreach ( $statesQuery->results() as $state){
                $states .= '<option value="' . $state->s_id . '">'. $state->state_name .'</option>';
            }
        }  
        echo $states;
    }

    #this is to get the nation from chosen company in the add company form
    if ( isset($_POST['companyId']) && !empty($_POST['companyId']) ) {
        $id = (int)$_POST['companyId'];
        $nations = '<option value="">-- Select --</option>';
        $comp = DB::getInstance()->free_run("SELECT `c_country_id` FROM `tab_companies` WHERE `c_id` = $id;");
        if ( $comp->count() ) {
            $result = $comp->firstResult();
            $natID = (int)$result->c_country_id;
            
            $nationQuery = DB::getInstance()->free_run("SELECT * FROM `tab_nations` WHERE `n_id` = $natID;");
            if ( $nationQuery->count() ) {
                foreach ( $nationQuery->results() as $nation){
                    $nations .= '<option value="' . $nation->n_id . '">'. $nation->n_name .'</option>';
                }
            } 
            echo $nations;
        }      
    }


?>