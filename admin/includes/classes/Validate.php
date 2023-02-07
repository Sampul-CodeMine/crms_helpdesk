<?php

    class Validate {
        
        private $_db = null,
                $_errors = array(),
                $_passed = false;
        
        public function __construct() {
            $this->_db = DB::getInstance();
        }
        
        public function check ( $source, $items = array() ) {
            foreach ( $items as $item =>$rules ) {
                foreach ( $rules as $rule => $rule_value ) {
                    $display = '';
                    $value = trim ( $source[$item] );
                    $item  = escaper ( $item );
                    
                    $field_name = '';
                    switch ( $item ) {
                            
                        case 'reg_full_name':
                        case 'update_name':
                            $field_name = 'Fullname ';
                        break;
                        case 'user_firstname':
                            $field_name = 'Firstname ';
                        break;
                        case 'user_lastname':
                            $field_name = 'Lastname ';
                        break;
                        case 'user_mobile':
                            $field_name = 'Mobile number ';
                        break;   
                        case 'username':
                        case 'user_username':
                        case 'login_username':
                            $field_name = 'Username ';
                        break;
                            
                        case 'reg_password':
                        case 'user_password':
                        case 'login_password':
                            $field_name = 'Password ';
                        break;
                            
                        case 'confirm_password':
                        case 'confirm_reg_password':
                            $field_name = 'Confirm Password ';
                        break;
                            
                        case 'current_password':
                            $field_name = 'Current Password ';
                        break;
                            
                        case 'new_password':
                            $field_name = 'New Password ';
                        break;
                            
                        case 'confirm_new_password':
                            $field_name = 'Confirm New Password ';
                        break;
                        
                        case 'region_name':
                            $field_name = 'Region\'s Name ';
                        break;
                        case 'user_email':
                            $field_name = 'User\'s Email ';
                        break;
                        case 'region_email':
                            $field_name = 'Region\'s Email ';
                        break;
                        case 'region_nation':
                            $field_name = 'Region\'s Country ';
                        break;
                        case 'state_name':
                            $field_name = 'State\'s Name ';
                        break;
                        case 'state_region':
                            $field_name = 'State\'s Region ';
                        break;
                        case 'state_nation':
                            $field_name = 'Region\'s Country ';
                        break;    
                        case 'user_contact_address':
                            $field_name = 'Contact Address ';
                        break;
                        case 'user_region':
                            $field_name = 'Region ';
                        break;
                        case 'vendor_id':
                            $field_name = 'Vendor ID ';
                        break;
                        case 'user_nation':
                            $field_name = 'Country ';
                        break;
                        case 'user_state':
                            $field_name = 'State ';
                        break;
                        case 'location_name':
                            $field_name = 'Location\'s Name ';
                        break;
                        case 'location_email':
                            $field_name = 'Location\'s Email ';
                        break;
                        case 'location_mobile':
                            $field_name = 'Location Mobile ';
                        break;                            
                        case 'location_address':
                            $field_name = 'Location\'s address ';
                        break;
                        case 'inventory_mail':
                            $field_name = 'Inventory Email ';
                        break;
                        case 'location_pincode':
                            $field_name = 'PIN code ';
                        break;
                        case 'location_city':
                            $field_name = 'Location\'s City ';
                        break;                            
                        case 'location_state':
                            $field_name = 'Location\'s State ';
                        break;
                         case 'location_nation':
                            $field_name = 'Location\'s Country ';
                        break;
                        case 'location_region':
                            $field_name = 'Location\'s Region ';
                        break;
						case 'company_name':
                            $field_name = 'Company\'s Name ';
                        break;
						case 'company_email':
                            $field_name = 'Company\'s Email ';
                        break;
						case 'company_mobile':
                            $field_name = 'Company\'s Mobile # ';
                        break;
						case 'company_address':
                            $field_name = 'Company\'s Address ';
                        break;
						case 'company_state':
                            $field_name = 'Company\'s State ';
                        break;
						case 'company_nation':
                            $field_name = 'Company\'s Nation ';
                        break;
						case 'msg_name':
                            $field_name = 'News Flash Title ';
                        break;
						case 'message_desc':
                            $field_name = 'News Flash Description ';
                        break;
                        case 'user_access':
                            $field_name = 'User\'s Access ';
                        break;
                        case 'user_DOB':
                            $field_name = 'Date of Birth ';
                        break;
                        case 'v_t_name':
                            $field_name = 'Vendor Type Name ';
                        break;
                        case 'vendor_type_desc':
                            $field_name = 'Vendor Type Description ';
                        break;
                        case 'vendor_id':
                            $field_name = 'Vendor ID ';
                        break;
                        case 'vendor_name':
                            $field_name = 'Vendor Name ';
                        break;
                        case 'vendor_address':
                            $field_name = 'Vendor Address ';
                        break;
                        case 'vendor_city':
                            $field_name = 'Vendor City ';
                        break;
                        case 'vendor_state':
                            $field_name = 'Vendor State ';
                        break;
                        case 'vendor_nation':
                            $field_name = 'Vendor Country ';
                        break;
                        case 'vendor_region':
                            $field_name = 'Vendor Region ';
                        break;
                        case 'vendor_PIN':
                            $field_name = 'Vendor PIN Code ';
                        break;
                        case 'vendor_email':
                            $field_name = 'Vendor Email ';
                        break;
                        case 'vendor_type':
                            $field_name = 'Vendor Type ';
                        break;
                        case 'vendor_primary_contact_name':
                            $field_name = 'Vendor Primary Contact Name ';
                        break;
                        case 'vendor_primary_contact_mobile':
                            $field_name = 'Vendor Primary Contact Mobile ';
                        break;
                        case 'vendor_primary_contact_email':
                            $field_name = 'Vendor Primary Contact Email ';
                        break;
                        case 'vendor_secondary_contact_name':
                            $field_name = 'Vendor Secondary Contact Name ';
                        break;
                        case 'vendor_secondary_contact_mobile':
                            $field_name = 'Vendor Secondary Contact Mobile ';
                        break;
                        case 'vendor_secondary_contact_email':
                            $field_name = 'Vendor Secondary Contact Email ';
                        break;
                        case 'engr_name':
                            $field_name = 'Engineer\'s Name ';
                        break;
                        case 'engr_email':
                            $field_name = 'Engineer\'s Email ';
                        break;
                        case 'engr_mobile':
                            $field_name = 'Enginerr\'s Mobile ';
                        break;
                        case 'engr_code':
                            $field_name = 'Engineer\'s Code ';
                        break;
                        case 'engr_vendor':
                            $field_name = 'Engineer\'s Vendor ';
                        break;
                        case 'engr_region':
                            $field_name = 'Engineer\'s Region ';
                        break;
                        case 'engr_nation':
                            $field_name = 'Enginerr\'s Country ';
                        break;
                        case 'engr_location':
                            $field_name = 'Engineer\'s Location ';
                        break;
                        case 'service_code_name':
                            $field_name = 'Service\s Name';
                        break;
                        case 'service_code':
                            $field_name ='Service\s Code';
                        break;
                        case 'call_type':
                            $field_name = 'Call Type';
                        break;
                        case 'sub_call_type':
                            $field_name = 'Sub Call Type';
                        break;
                        case 'r_center_name':
                            $field_name = 'Repair Center Name ';
                        break;
                        case 'r_center_region':
                            $field_name = 'Repair Center Region ';
                        break;
                        case 'r_center_nation':
                            $field_name = 'Repair Center Country ';
                        break;
                        case 'bank_name':
                            $field_name = 'Bank Name ';
                        break;
                        case 'bank_shortname':
                            $field_name = 'Bank Shortname ';
                        break;
                        case 'bank_address':
                            $field_name = 'Bank Address ';
                        break;
                        case 'bank_account':
                            $field_name = 'Bank Account ';
                        break;
                        case 'bank_email':
                            $field_name = 'Bank Email ';
                        break;
                        case 'acct_name':
                            $field_name = 'Account Type Name ';
                        break;
					}    
                            
                    if ( $rule === 'required' && empty ( $value ) ) {
                        $this->addError("{$field_name} is required.");
                    } elseif ( !empty ( $value ) ) {
                        
                        switch ( $rule ) {
                                
                            case 'min':
                                if ( strlen ($value) < $rule_value ) {
                                    $this->addError("{$field_name} must not be less than {$rule_value} characters in length.");
                                }
                            break;
                                
                            case 'max':
                                if ( strlen ( $value ) > $rule_value ) {
                                    $this->addError("{$field_name} must not be more than {$rule_value} characters in length.");
                                }
                            break;
                                
                            case 'matches':
                                if ( $value !== $source[$rule_value] ) {
                                    $this->addError("{$field_name} does not match {$pass_field}.");
                                }
                            break;
                                
                            case 'isvalid_V_ID':
                                if ( !preg_match("/^(VEN_)[0-9]{4}$/", $value)) {
                                    $this->addError("Invalid Vendor ID. format: VEN_0000.");
                                }
                            break;
                            
                            case 'isvalid_email':
                                if ( !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                    $this->addError("Please provide a valid email address.");
                                }
                            break;
                                
                            case 'isvalid_mobile':
                                if ( !preg_match("/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/", $value)) {
                                    $this->addError("Invalid mobile number. Format 0801-100-2000");
                                }
                            break;
                                
                            case 'isvalid_PIN':
                                if ( !preg_match("/^[0-9]{4}[-]{1}[0-9]{4}$/", $value)) {
                                    $this->addError("Invalid PIN. Format 0801-2000");
                                }
                            break;
                                
                            case 'match':
                                if ( $value !== $source[$rule_value] ) {
                                    $this->addError("{$field_name} does not match {$new_pass_field}.");
                                }
                            break;
                                
                            case 'unique':
                                $check = $this->_db->get($rule_value, array($item, '=', $value));
                                if ( $check->count() ) {
                                    if ($item === 'username' or $item === 'user_username'){
                                        $display = 'Username';
                                    } elseif ($item === 'region_name') {
                                        $display = 'Region\'s Name';
                                    } elseif ( $item === 'region_email' or $item === 'user_email') {
                                        $display = 'Email';
                                    } elseif ( $item === 'state_name') {
                                        $display = 'State Name';
                                    } elseif ( $item === 'location_name') {
                                        $display = 'Location Name';
                                    } elseif ( $item === 'location_email') {
                                        $display = 'Location Email';
                                    } elseif ( $item === 'inventory_email') {
                                        $display = 'Inventory Email';
                                    } elseif ( $item === 'company_name') {
                                        $display = 'Company Name';
                                    } elseif ( $item === 'company_email') {
                                        $display = 'Company Email';
                                    } elseif ( $item === 'msg_name') {
										$display = 'News Flash with this title';
									} elseif ( $item === 'v_t_name') {
										$display = 'Vendor Type with this name';
									} elseif ( $item === 'vendor_id') {
										$display = 'Vendor ID';
									} elseif ( $item === 'r_center_name') {
										$display = 'Repair Center Name';
									} elseif ( $item === 'bank_name') {
										$display = 'Bank Name';
									} elseif ( $item === 'bank_shortname') {
										$display = 'Bank Shortname';
									} elseif ( $item === 'bank_email') {
										$display = 'Bank Email';
									} elseif ( $item === 'bank_account') {
										$display = 'Bank Account';
									} elseif ( $item === 'acct_name') {
										$display = 'Account Type Name';
									}
                                    $this->addError("{$display} already exists.");
                                }
                            break;
                            case 'value':
                                if ( $value === $rule_value ) {
                                    $this->addError("Please choose from the options.");
                                }
                            break;
                                
                        }
                    }   
                }
            }
            if ( empty ( $this->_errors ) ) {
                $this->_passed = true;
            }
            return $this;
        }
        
        private function addError ( $error ) {
            $this->_errors[] = $error;
        }
        
        public function errors() {
            return $this->_errors;
        }
        
        public function passed() {
            return $this->_passed;
        }
        
    }
    
