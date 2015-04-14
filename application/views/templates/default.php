<!--load the view that contains header common to the home page -->
    <?php echo $this->load->view('templates/common_header_view'); ?>    
    
    <!-- START OF HTML FOR DEMO -->
    <div class="container">
        <?php echo $body; ?>
    </div>
    
    <!--load the view that contains footer common to the home page -->
    <?php echo $this->load->view('templates/common_footer_view'); ?>   