<?php if (defined('FOOTER')): ?>
    <div>
        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/js/semantic.min.js"></script>
        <script src="./assets/js/scripter.js"></script>
    </div>
  </body>
</html>
<?php
    else:
        header('location: ../../login.php');
    endif;
?>
