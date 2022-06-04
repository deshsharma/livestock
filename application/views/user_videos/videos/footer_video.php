
    <!-- jquery
    ============================================ -->
    <script src="<?= base_url() ?>assets/allvideos/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
    ============================================ -->
    <script src="<?= base_url() ?>assets/allvideos/js/bootstrap.min.js"></script>
    <!-- meanmenu JS
    ============================================ -->
    <script src="<?= base_url() ?>assets/allvideos/js/jquery.meanmenu.js"></script>
    <!-- sticky JS
    ============================================ -->
    <script src="<?= base_url() ?>assets/allvideos/js/jquery.sticky.js"></script>
    <!-- main JS
    ============================================ -->
    <script src="<?= base_url() ?>assets/allvideos/js/main.js"></script>



    <!--add vide in card --->
    <script src="<?= base_url() ?>assets/allvideos/js/videos_cart.js"></script>


</body>

</html>

<script type="text/javascript">
function cart(video_id, price, users_id, title){
    app_url = "<?= base_url('/all_videos'); ?>";
    video_cart_add(video_id, price, users_id, title, '1');
 }
  function intrested_to_buy(id){
    var user_id = "<?= $this->session->userdata("users_id") ?>";
    var type = "<?php echo $this->session->userdata("user_type"); ?>"
    $.ajax({
            type: "POST",
            url: "<?= base_url('all_videos/') ?>"+"add_interested",
            data: { video_id: id, user_id: user_id, type: type},
            dataType: "json",
            cache : false,
            success: function(data){
                alert(data.msg);
                location.reload();
            } 
        });
    }
</script>