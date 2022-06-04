<!-- Slider -->
<div id="home_carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<img src="<?= base_url(); ?>assetss/image_new/homepage1.jpg" alt="image" />
				<div class="carousel-caption">
					<h2>Contact Us</h2>
				    <p>We'd love to hear from you.Whether you have a question,Our team is ready to answer all your questions</p>
				</div>
			</div>
		</div>
</div>
<!-- Slider end -->
<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>Contact us</span></h3>
					<p>Get in touch with us.</p>
				</div>
			</div>
		</div>
		

        

	<div class="container centered bottom_padding">
	<?php if(!empty($this->session->flashdata('msg'))){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
			<div class="row">
				<div class="col-md-9">
				<form action="<?php print site_url();?>about/send" method="POST" class="add-emp" id="contact_form">
					
						<div class="form-group">
							<label for="InputName">Your name</label>
							<?php echo validation_errors(); ?>
							<input type="text" class="form-control" name ="name" id="InputName" placeholder="Your name">
						</div>
						<div class="form-group">
							<label for="InputEmail">Your email</label>
							<input type="email" name ="email" class="form-control" id="InputEmail" placeholder="Your email">
						</div>
						<div class="form-group">
							<label for="InputEmail">Your mobile</label>
							<input type="text" name ="contact_no" class="form-control" id="InputMobile" placeholder="Your contact no">
						</div>
						<div class="form-group">
							<label for="InputMesaagel">Your messsage</label>
							<textarea class="form-control" name ="comment" id="comment" placeholder="Your message" rows="8"></textarea>
						</div>
						<button type="submit" class="btn btn-default btn-green">Send message</button>
					</form>
				</div>
				<div class="col-md-3">
					<ul class="contact-info">
						<li class="telephone">
							1800 102 0379 
						</li>
						
						<li class="mail">
							support@livestoc.com
						</li>
					</ul>
				</div>
			</div>
		</div>
	
		<!-- Content end -->