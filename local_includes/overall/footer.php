<?php if (defined('FOOTER')): ?>
   <!--    Include the javascript files for this project-->
    <div>
        <script src="./admin/assets/js/jquery.min.js"></script>
        <script src="./admin/assets/js/semantic.min.js"></script>
        <script src="./admin/assets/js/scripter.js"></script>
    </div>
<!--    End of including Javascript for this project-->
</body>
</html>
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
