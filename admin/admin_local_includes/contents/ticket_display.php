<?php if(defined('TICKET_DISPLAY')): ?>
            <!--Ticket Dislay content starts -->
            <div class="ui grid stackable padded">

                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                   <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header teal">
                                    <img src="./uploads/img/all_ticket.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui teal statistic">
                                        <div class="value">3</div>
                                        <div class="label">Previous Tickets</div>
                                    </div>
                                </div>
                                <div class="description">
                                    The total number of tickets that were brought forward from the previous day.
                                </div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui teal button">More Info</div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                   <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header olive">
                                    <img src="./uploads/img/remain.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui olive statistic">
                                        <div class="value">2</div>
                                        <div class="label">Tickets Opened Today</div>
                                    </div>
                                </div>
                                <div class="description">
                                    The total number of tickets that were logged and received from customers today.
                                </div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui olive button">More Info</div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                   <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header brown">
                                    <img src="./uploads/img/images.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui brown statistic">
                                        <div class="value">3</div>
                                        <div class="label">Tickets Closed</div>
                                    </div>
                                </div>
                                <div class="description">
                                    Total number of tickets that were closed today after resolution of faults.
                                </div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui brown button">More Info</div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                   <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header yellow">
                                    <img src="./uploads/img/images.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui yellow statistic">
                                        <div class="value">2</div>
                                        <div class="label">Pending Tickets</div>
                                    </div>
                                </div>
                                <div class="description">
                                    Total number of pending / opened tickets that are yet to be resolved.
                                </div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui yellow button">More Info</div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <!--Ticket Dislay content stops -->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
