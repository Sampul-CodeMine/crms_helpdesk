<?php if(defined('ATM_DISPLAY')): ?>
       <!--ATM Dislay content starts -->
            <div class="ui grid stackable padded">
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                    <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header blue">
                                    <img src="./uploads/img/total.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui blue statistic">
                                        <div class="value">130</div>
                                        <div class="label">Total ATMS</div>
                                    </div>
                                </div>
                                <div class="description justified container">Total number of ATMs that have been acquired by the organization.</div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui blue button">More Info</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                    <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header green">
                                    <img src="./uploads/img/active.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui green statistic">
                                        <div class="value">110</div>
                                        <div class="label">Live ATMS</div>
                                    </div>
                                </div>
                                <div class="description justified container">Total number of ATMs that are presently online and live.</div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui green button">More Info</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                    <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header orange">
                                    <img src="./uploads/img/live.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui orange statistic">
                                        <div class="value">11</div>
                                        <div class="label">Faulty Online ATMS</div>
                                    </div>
                                </div>
                                <div class="description justified container">Total number of ATMs that are online but with faults.</div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui orange button">More Info</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile center aligned column">
                    <div class="row">
                        <div class="ui fluid card">
                            <div class="content">
                                <div class="ui right floated header red">
                                    <img src="./uploads/img/down.png" alt="" class="ui avatar image" />
                                </div>
                                <div class="meta">
                                    <div class="ui red statistic">
                                        <div class="value">9</div>
                                        <div class="label">Total Offline ATMS</div>
                                    </div>
                                </div>
                                <div class="description justified container">Total number of ATMs that are faulty and offline.</div>
                            </div>
                            <div class="extra content">
                                <div class="ui two buttons">
                                    <div class="ui red button">More Info</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--ATM Dislay content stops -->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
