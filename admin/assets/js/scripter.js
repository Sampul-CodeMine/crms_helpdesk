$(document).ready(function() {
    $('.ui.dropdown').dropdown();
    $('.sidebar-menu-toggler').on('click', function() {
        var target = $(this).data('target');
        $(target).sidebar({
            dinPage: true,
            transition: 'overlay',
            mobileTransition: 'overlay'
        }).sidebar('toggle');
    });
    
    //Validates the login form
    $('.ui.form.login').form({
       fields: {
           name: {
               identifier: 'login_username',
               rules:[{
                   type: 'empty',
                   prompt: 'Provide your username.'
               }, {
                   type: 'minLength[5]',
                   prompt: 'Username must be at least {ruleValue} characters.'
               }, {
                   type: 'maxLength[20]',
                   prompt: 'Username must not exceed {ruleValue} characters.'
               }]
           },
           password: {
               identifier: 'login_password',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide your password.'
               }, {
                   type: 'minLength[6]',
                   prompt: 'Password must be at least {ruleValue} characters.'
               }, {
                   type: 'maxLength[32]',
                   prompt: 'Password must not exceed {ruleValue} characters.'
               }]
           }
       } 
    });
    
    //Validate the add regions form
    $('.ui.form.segment.region').form({
        fields: {
            region_name:{
               identifier: 'region_name',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a region name.'
               },{
                   type: 'minLength[3]',
                   prompt: 'Region name must be at least {ruleValue} characters.'
               }]
            },
            region_email: {
               identifier: 'region_email',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a region email.'
               }]
            }, 
            region_nation: {
                identifier: 'region_nation',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Nation for the region.'
                }]
            }
        }
    });
    
    //Validate the add states form
    $('.ui.form.segment.state').form({
        fields: {
            state_name:{
               identifier: 'state_name',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a state name.'
               },{
                   type: 'minLength[3]',
                   prompt: 'State name must be at least {ruleValue} characters.'
               }]
            },
            state_region: {
               identifier: 'state_region',
               rules: [{
                   type: 'empty',
                   prompt: 'Choose a Region for the State.'
               }]
            },
            state_nation: {
               identifier: 'state_nation',
               rules: [{
                   type: 'empty',
                   prompt: 'Choose a Nation for the State.'
               }]
            }
        }
    });
    
    //Validate the add users form
    $('.ui.form.segment.user').form({
        fields: {
            user_firstname:{
               identifier: 'user_firstname',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a Firstname.'
               },{
                   type: 'minLength[2]',
                   prompt: 'Firstname must be at least {ruleValue} characters.'
               }]
            },
            user_lastname:{
               identifier: 'user_lastname',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a Lastname.'
               },{
                   type: 'minLength[2]',
                   prompt: 'Lastname must be at least {ruleValue} characters.'
               }]
            },
            user_email:{
               identifier: 'user_email',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide an Email address.'
               }]
            },
            user_mobile:{
                identifier: 'user_mobile',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a mobile number.'
                },{
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid Mobile number: format 0801-100-2000'
                }]
            },
            user_contact_address:{
                identifier: 'user_contact_address',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Contact/Residential address.'
                }]
            },
            user_city:{
                identifier: 'user_city',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a City'
                }]
            },
            user_username: {
               identifier: 'user_username',
               rules:[{
                   type: 'empty',
                   prompt: 'Provide a username.'
               }, {
                   type: 'minLength[5]',
                   prompt: 'Username must be at least {ruleValue} characters.'
               }, {
                   type: 'maxLength[20]',
                   prompt: 'Username must not exceed {ruleValue} characters.'
               }]
           },
           user_password: {
               identifier: 'user_password',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a password.'
               }, {
                   type: 'minLength[6]',
                   prompt: 'Password must be at least {ruleValue} characters.'
               }, {
                   type: 'maxLength[32]',
                   prompt: 'Password must not exceed {ruleValue} characters.'
               }]
           }, 
           confirm_password: {
               identifier: 'confirm_password',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a Password confirmation.'
               }, {
                   type: 'match[user_password]',
                   prompt: 'Both Passwords dont match.'
               }]
           },
           user_DOB: {
               identifier: 'user_DOB',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a Date of Birth.'
               }]
           },
           user_access: {
               identifier: 'user_access',
               rules: [{
                   type: 'empty',
                   prompt: 'Choose permission for the user.'
               }]
           },
           user_nation: {
               identifier: 'user_nation',
               rules: [{
                   type: 'empty',
                   prompt: 'Choose a Country for the user.'
               }]
           },
           user_state: {
               identifier: 'user_state',
               rules: [{
                   type: 'empty',
                   prompt: 'Choose a State for the user.'
               }]
           },
           user_region: {
               identifier: 'user_region',
               rules: [{
                   type: 'empty',
                   prompt: 'Choose a Region for the user.'
               }]
           }
        }
    });
    
    //Validate the add locations form
    $('.ui.form.segment.loca').form({
        fields: {
            location_name:{
               identifier: 'location_name',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a Name for the location.'
               },{
                   type: 'minLength[3]',
                   prompt: 'Location Name must be at least {ruleValue} characters.'
               },{
                   type: 'maxLength[255]',
                   prompt: 'Location Name must not exceed {ruleValue} characters.'
               }]
            },
            location_email:{
               identifier: 'location_email',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide an email for the location.'
               }]
            },
            location_address:{
                identifier: 'location_address',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Location address.'
                }]
            },
            location_mobile:{
                identifier: 'location_mobile',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a mobile number'
                },{
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid Mobile number: format 0801-100-2000'
                }]
            },
            inventory_email:{
               identifier: 'inventory_email',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide an Email address for inventory purposes.'
               }]
            },
            location_city:{
                identifier: 'location_city',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a City for the Location.'
                },{
                   type: 'minLength[2]',
                   prompt: 'Location City must be at least {ruleValue} characters.'
               }]
            },
            location_region: {
                identifier: 'location_region',
                rules: [{
                    type: "empty",
                    prompt: 'Choose a Region.'
                }]
            },
            location_nation: {
                identifier: 'location_nation',
                rules: [{
                    type: "empty",
                    prompt: 'Choose a Nation.'
                }]
            },
            location_state: {
                identifier: 'location_state',
                rules: [{
                    type: "empty",
                    prompt: 'Choose a State for the Location.'
                }]
            },
            location_pincode: {
                identifier: 'location_pincode',
                rules: [{
                    type: "empty",
                    prompt: 'Provide Company\'s PIN-code.'
                }, {
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid PIN format. 0801-2000.'
                }]
            },
            company: {
                identifier: 'company',
                rules: [{
                    type: "empty",
                    prompt: 'Choose a Region for the Company.'
                }]
            },
            repair_center: {
                identifier: 'repair_center',
                rules: [{
                    type: 'empty',
                    prompt:'Choose a Repair Center.'
                }]
            }
        }
    });
    
    //Validate the add Company form
    $('.ui.form.segment.company').form({
        fields: {
            company_name:{
               identifier: 'company_name',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide a Name for the Company.'
               },{
                   type: 'minLength[5]',
                   prompt: 'Company Name must be at least {ruleValue} characters.'
               },{
                   type: 'maxLength[255]',
                   prompt: 'Company Name must not exceed {ruleValue} characters.'
               }]
            },
            company_email:{
               identifier: 'company_email',
               rules: [{
                   type: 'empty',
                   prompt: 'Provide an email for the Company.'
               }]
            },
            company_address:{
                identifier: 'company_address',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Company address.'
                }]
            },
            company_mobile:{
                identifier: 'company_mobile',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a mobile number.'
                },{
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid Mobile number: format 0801-100-2000'
                }]
            },
            company_region:{
                identifier: 'company_region',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Region for the Company.'
                }]
            },
            company_state:{
                identifier: 'company_state',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a State for the Company.'
                }]
            },
            company_nation:{
                identifier: 'company_nation',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Nation for the Company.'
                }]
            }
        }
    });
      
    //Validate the add Vendor form
    $('.ui.form.segment.vendor').form({
        fields: {
            vendor_id: {
                identifier: 'vendor_id',
                rules: [{
                    type: 'empty',
                    prompt: 'Refresh page to get Vendor ID.'
                }, {
                    type: 'minLength[8]',
                    prompt: 'Vendor ID must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[8]',
                    prompt: 'Vendor ID must not exceed {ruleValue} characters.'
                },{
                    type: "regExp[/^(VEN_)[0-9]{4}$/]",
                    prompt: 'Invalid Vendor ID. format: VEN_0000.'
                }]
            },
            vendor_name:{
                identifier: 'vendor_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Vendor Name.'
                }, {
                    type: 'minLength[5]',
                    prompt: 'Vendor Name must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[255]',
                    prompt: 'Vendor Name must not exceed {ruleValue} characters.'
                }]
            },
            vendor_address:{
                identifier: 'vendor_address',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Vendor Address.'
                }]
            },
            vendor_city: {
                identifier: 'vendor_city',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Vendor City'
                }]
            },
            vendor_state:{
                identifier: 'vendor_state',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a State for the Vendor.'
                }]
            },
            vendor_nation:{
                identifier: 'vendor_nation',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Nation for the Vendor.'
                }]
            },
            vendor_region:{
                identifier: 'vendor_region',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Region for the Vendor.'
                }]
            },
            vendor_PIN: {
                identifier: 'vendor_PIN',
                rules: [{
                    type: "empty",
                    prompt: 'Provide Vendor\'s PIN-code.'
                }, {
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid PIN format. 0801-2000.'
                }]
            },
            vendor_email:{
                identifier: 'vendor_email',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide an email for the Vendor.'
                }]
            },
            vendor_type:{
                identifier: 'vendor_type',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Vendor Type for the Vendor.'
                }]
            },
            vendor_primary_contact_name:{
                identifier: 'vendor_primary_contact_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Primary Contact Name.'
                }, {
                    type: 'minLength[2]',
                    prompt: 'Primary Contact Name must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[255]',
                    prompt: 'Primary Contact Name must not exceed {ruleValue} characters.'
                }]
            },
            vendor_primary_contact_mobile:{
                identifier: 'vendor_primary_contact_mobile',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a mobile number.'
                },{
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid Mobile number: format 0801-100-2000'
                }]
            },
            vendor_primary_contact_email:{
                identifier: 'vendor_primary_contact_email',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide an email for the Primary Contact.'
                }]
            },
            vendor_secondary_contact_name:{
                identifier: 'vendor_secondary_contact_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Secondary Contact Name.'
                }, {
                    type: 'minLength[2]',
                    prompt: 'Secondary Contact Name must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[255]',
                    prompt: 'Secondary Contact Name must not exceed {ruleValue} characters.'
                }]
            },
            vendor_secondary_contact_mobile:{
                identifier: 'vendor_secondary_contact_mobile',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a mobile number.'
                },{
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid Mobile number: format 0801-100-2000'
                }]
            },
            vendor_secondary_contact_email:{
                identifier: 'vendor_secondary_contact_email',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide an email for the Secondary Contact.'
                }]
            }
        }
    });

     //Validate the add Vendor form
     $('.ui.form.segment.engr').form({
        fields: {
            engr_code: {
                identifier: 'engr_code',
                rules: [{
                    type: 'empty',
                    prompt: 'Refresh page to get Engineer Code.'
                }, {
                    type: 'minLength[9]',
                    prompt: 'Engineer\'s Code must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[9]',
                    prompt: 'Engineer\'s Code must not exceed {ruleValue} characters.'
                },{
                    type: "regExp[/^(ENGR_)[0-9]{4}$/]",
                    prompt: 'Invalid Engineer Code. format: ENGR_0000.'
                }]
            },
            engr_name:{
                identifier: 'engr_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide an Engineer\'s Name.'
                }, {
                    type: 'minLength[5]',
                    prompt: 'Engineer\'s Name must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[50]',
                    prompt: 'Engineer\'s Name must not exceed {ruleValue} characters.'
                }]
            },
            engr_vendor:{
                identifier: 'engr_vendor',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Vendor Type for the Engineer.'
                }]
            },
            engr_location: {
                identifier: 'engr_location',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Location for the Engineer'
                }]
            },
            engr_region:{
                identifier: 'engr_region',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a State for the Engineer.'
                }]
            },
            engr_nation:{
                identifier: 'engr_nation',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Nation for the Engineer.'
                }]
            },
            engr_mobile:{
                identifier: 'engr_mobile',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a mobile number.'
                },{
                    type: "regExp[/^[0-9]{4}[-]{1}[0-9]{3}[-]{1}[0-9]{4}$/]",
                    prompt: 'Invalid Mobile number: format 0801-100-2000'
                }]
            },
            engr_email:{
                identifier: 'engr_email',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide an email for the Engineer.'
                }]
            }
        }
    });

    //Validate the add Repair Center form
    $('.ui.form.segment.repair_center').form({
        fields: {
            r_c_name:{
                identifier: 'r_c_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a Repair Center Name.'
                }, {
                    type: 'minLength[5]',
                    prompt: 'Repair Center Name must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[50]',
                    prompt: 'Repair Center Name must not exceed {ruleValue} characters.'
                }]
            },
            r_center_region:{
                identifier: 'r_center_region',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a State for the Repair Center.'
                }]
            },
            r_center_nation:{
                identifier: 'r_center_nation',
                rules: [{
                    type: 'empty',
                    prompt: 'Choose a Nation for the Repair Center.'
                }]
            }
        }
    });

    //Validate the add Company form
    $('.ui.form.segment.flash').form({
        fields: {
            msg_name:{
                identifier: 'msg_name',
                rules: [{
                    type: 'empty',
                    prompt: 'Provide a News Flash Title.'
                },{
                    type: 'minLength[5]',
                    prompt: 'News Flash Title must be at least {ruleValue} characters.'
                },{
                    type: 'maxLength[100]',
                    prompt: 'News Flash Title must not exceed {ruleValue} characters.'
                }]
            },
            message_desc:{
                identifier: 'message_desc',
                rules: [{
                    type: 'empty',
                    prompt: 'Message Description is required.'
                }]
            }
        }
    });
    
    //Validate the add Vendor Type form
    $('.ui.form.segment.vendorType').form({
            fields: {
                v_t_name:{
                   identifier: 'v_t_name',
                   rules: [{
                       type: 'empty',
                       prompt: 'Provide a Name for the Vendor Type.'
                   },{
                       type: 'minLength[5]',
                       prompt: 'Vendor Type Name must be at least {ruleValue} characters.'
                   },{
                       type: 'maxLength[100]',
                       prompt: 'Vendor Type Name must not exceed {ruleValue} characters.'
                   }]
                },
                vendor_type_desc:{
                   identifier: 'vendor_type_desc',
                   rules: [{
                       type: 'empty',
                       prompt: 'Vendor Type Description is required.'
                   }]
                }
            }
        });
        
    //Validate the add Bank form
    $('.ui.form.segment.bank').form({
            fields: {
                bank_name:{
                   identifier: 'bank_name',
                   rules: [{
                       type: 'empty',
                       prompt: 'Provide a Bank Name.'
                   },{
                       type: 'minLength[5]',
                       prompt: 'Bank Name must be at least {ruleValue} characters.'
                   },{
                       type: 'maxLength[50]',
                       prompt: 'Bank Name must not exceed {ruleValue} characters.'
                   }]
                },
                bank_email:{
                    identifier: 'bank_email',
                    rules: [{
                        type: 'empty',
                        prompt: 'Provide an email for the Bank.'
                    }]
                },
                bank_address:{
                    identifier: 'bank_address',
                    rules: [{
                        type: 'empty',
                        prompt: 'Provide a Bank Address.'
                    }]
                },
                bank_shortname:{
                    identifier: 'bank_shortname',
                    rules: [{
                        type: 'empty',
                        prompt: 'Provide a Bank Shortname.'
                    },{
                       type: 'minLength[3]',
                       prompt: 'Bank shortname must be at least {ruleValue} characters.'
                    },{
                       type: 'maxLength[3]',
                       prompt: 'Bank shortname must not exceed {ruleValue} characters.'
                    }]
                },
                bank_account:{
                    identifier: 'bank_account',
                    rules: [{
                        type: 'empty',
                        prompt: 'Provide a Bank Account Number.'
                    }, {
                        type: 'minLength[10]',
                       prompt: 'Bank account must be at least {ruleValue} characters.'
                    },{
                       type: 'maxLength[10]',
                       prompt: 'Bank account must not exceed {ruleValue} characters.'
                    }]
                }
            }
        });
    
     //Validate the add Account Type form
    $('.ui.form.segment.acct_type').form({
            fields: {
                acct_name:{
                   identifier: 'acct_name',
                   rules: [{
                       type: 'empty',
                       prompt: 'Provide an Account Type Name.'
                   },{
                       type: 'minLength[3]',
                       prompt: 'Type Name must be at least {ruleValue} characters.'
                   },{
                       type: 'maxLength[50]',
                       prompt: 'Type Name must not exceed {ruleValue} characters.'
                   }]
                }
            }
        });
      
    
    
    
    
    //Generate random code for the Vendors
    $('#vendor_id').val(generateRandomVendorCode());

    //Generate random code for the Engineers
    $('#engr_code').val(generateRandomEngrCode());
    
    // populate the regions from the chosen country //add_state form
    $('#state_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#state_region');
    });
    
    // populate the regions from the chosen country //repair center form
    $('#r_center_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#r_center_region');
    });
    
    // populate the regions from the chosen country //add Location form
    $('#location_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#location_region');
    });
    
    // populate the states from the chosen region //add Location form
    $('#location_region').on('change', function(){
        getStateContents(this, 'extractors.php', '#location_state');
    });
   
    //populate the nation if the company name changes //add Location form
    $('#company').change(function(){
        if ( $(this).val() != '' ) {
            var company_id = $(this).val();
            $.ajax({
                url: 'extractors.php',
                method: 'post',
                data: {
                    companyId: company_id
                },
                dataType: 'text',
                success: function(data){
                    $('#location_nation').html(data);
                }
            });
        }
    });
    
    //populate the region if the nation changes //add Engineer form
    $('#engr_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#engr_region');
    });
    
    //Populates the vendor region if the nation is changed // add vendor form
    $('#vendor_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#vendor_region');
    });
    
    // populates the states if the region is chosen //add vendor form
    $('#vendor_region').on('change', function(){
        getStateContents(this, 'extractors.php', '#vendor_state');
    });
    
    //Populates the company region if the nation is changed // add company form
    $('#company_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#company_region');
    });
    
    // populates the states if the region is chosen //add company form
     $('#company_region').on('change', function(){
        getStateContents(this, 'extractors.php', '#company_state');
    });

    //Populates the company region if the nation is changed // add user form
    $('#user_nation').on('change', function(){
        getRegionContents(this, 'extractors.php', '#user_region');
    });
    
    // populates the states if the region is chosen //add user form
    $('#user_region').on('change', function(){
        getStateContents(this, 'extractors.php', '#user_state');
    });

    
    
    
    
    
    
    
    
    
    
    
    
});

// Function to generate random vendor code
function generateRandomVendorCode(){
    let num = Math.round(Math.random()*10000);
    let str_num = String(num);
    let str_len = str_num.length;
    
    if (str_len === 1) {
        output_build = `000${str_num}`;
    } else if (str_len === 2) {
        output_build = `00${str_num}`;
    } else if (str_len === 3) {
        output_build = `0${str_num}`;
    } else if (str_len === 4){
        output_build = str_num;
    }
    return `VEN_${output_build}`;
}

// Function to generate random engineer code
function generateRandomEngrCode(){
    let num = Math.round(Math.random()*10000);
    let str_num = String(num);
    let str_len = str_num.length;
    
    if (str_len === 1) {
        output_build = `000${str_num}`;
    } else if (str_len === 2) {
        output_build = `00${str_num}`;
    } else if (str_len === 3) {
        output_build = `0${str_num}`;
    } else if (str_len === 4){
        output_build = str_num;
    }
    return `ENGR_${output_build}`;
}

//Function to get regions from selected nations dropdown 
function getRegionContents(nations, links, regions){
    if( $(nations).val() != ''){
        let id = parseInt($(nations).val());
        $.ajax({
            url: links,
            method: 'post',
            data: {
                countryId: id
            },
            dataType: 'text',
            success: function(data){
                $(regions).html(data);
            }
        });
    }
}

//Function to get states from selected regions dropdown 
function getStateContents(regions, links, states){
    if( $(regions).val() != ''){
        let id = parseInt($(regions).val());
        $.ajax({
            url: links,
            method: 'post',
            data: {
                regionId: id
            },
            dataType: 'text',
            success: function(data){
                $(states).html(data);
            }
        });
    }
}