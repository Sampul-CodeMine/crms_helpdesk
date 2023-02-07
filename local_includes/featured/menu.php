<?php if(defined('MENU')): ?>
            <!-- Menu to Display on the administrator's page starts here-->
            <div class="ui grid stackable padded">
                <div class="eight wide computer eight wide tablet sixteen wide mobile center aligned column">
                    <div class="row">
                        <table class="ui celled teal table">
                            <thead>
                                <tr>
                                    <th colspan="2">Requests</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="./requests.php">New Request</a></td>
                                    <td>Creating New Request.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="eight wide computer eight wide tablet sixteen wide mobile center aligned column">
                    <div class="row">
                        <table class="ui celled blue table">
                            <thead>
                                <tr>
                                    <th colspan="2">Reports</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="./reports.php">Generate Reports</a></td>
                                    <td>Generate and Analyse reports.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Menu to Display on the administrator's page stops here-->
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
