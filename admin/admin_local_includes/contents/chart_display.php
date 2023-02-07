<?php if(defined('CHART_DISPLAY')): ?>
            <!-- Chart Display starts-->
            <div class="ui grid stackable padded">
                <div class="eight wide computer eight wide tablet sixteen wide mobile center aligned column">
                   <div class="row">
                       <div class="ui fluid card">
                           <div class="content">
                               Chart for ATMS
                           </div>
                       </div>
                   </div>
                </div>

                <div class="eight wide computer eight wide tablet sixteen wide mobile center aligned column">
                   <div class="row">
                       <div class="ui fluid card">
                           <div class="content">
                               Chart for Tickets
                           </div>
                       </div>
                   </div>
                </div>
            </div>
            <!-- Chart Display Ends -->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
