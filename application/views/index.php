		<!-- Services -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>Our Services</span></h3>
				</div>
				<div class="col-md-4 col3">
					<a href="<?= base_url() ?>treatment" title="Animal Treatment" class="roundal" id="advice" style="background-color: #f5886C !important"></a>
					<a href="<?= base_url() ?>treatment"><h3>Animal Treatment</h3></a>
					<p><?php $text = "Through our online treatment module, the livestock owner can protect his animals from quacks by having access to a qualified veterinarian and a skilled VT through the app. Livestoc enables the dairy farmer to get in direct contact with Veterinarians and Paravets for both consultation & professional treatment of his animal."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					<form method="post" action="<?= base_url() ?>treatment">
						<button type="submit" class="btn btn-default btn-green" style="color: #f5886c; border: 2px solid #f5886c;">Learn more</button>
					</form>
				</div>
				<div class="col-md-4 col3">
					<a href="<?= base_url() ?>insemination" title="Artifical Insemination" class="roundal" id="grooming" style="background-color: #ffCC29 !important"></a>
					<a href="<?= base_url() ?>insemination"><h3>Artifical Insemination</h3></a>
					<p><?php $text = "The livestock owner can now order for Artificial Insemination online. This service allows the user to not only choose the desired bull/sire/semen straw from listings of high quality semen available through the app but also the best skilled AI worker. Breed improvement and pedigree determination lead to higher valuation for livestock."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					<form method="post" action="<?= base_url() ?>insemination">
						<button type="submit" class="btn btn-default btn-green" style="color: #ffcc29; border: 2px solid #ffcc29;">Learn more</button>
					</form>
				</div>
				<div class="col-md-4 col3">
					<a href="<?= base_url() ?>semen" title="Best Quality Semen" class="roundal" id="kennel" style="background-color: #F6AFCE !important"></a>
					<a href="<?= base_url() ?>semen"><h3>Best Quality Semen</h3></a>
					<p><?php $text = "After understanding the requirement of quality semen at grass root level for breed improvement and better yield, Livestoc has shortlisted best performing bulls in each breed category and also sourced the best quality semen from multiple institutions. We want to make it available in the market for the farmers and are appointing area wise distributers to take our initiative forward."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					<form method="post" action="<?= base_url() ?>semen">
						<button type="submit" class="btn btn-default btn-green" style="color: #f6afce; border: 2px solid #f6afce;">Learn more</button>
					</form>
				</div>
				<div class="col-md-4 col3">
					<a href="https://www.livestoc.com/app/buy-animal.php" title="Buy & Sell Livestoc" class="roundal" id="walking" style="background-color: #F06277 !important"></a>
					<a href="https://www.livestoc.com/app/buy-animal.php"><h3>Buy & Sell Livestock</h3></a>
					<p><?php $text = "Buyers can browse through our extensive listing of animals and select the breed of their choice. Pet sellers can be assured of a wide audience and premium prices for their animals. Livestoc ensures transparency and convenience while buying or selling pets across the country through its animal profiling feature."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					<form method="post" action="https://www.livestoc.com/app/buy-animal.php">
						<button type="submit" class="btn btn-default btn-green" style="color: #f06277; border: 2px solid #f06277;">Learn more</button>
					</form>
				</div>
				<div class="col-md-4 col3">
					<a href="<?= base_url() ?>nutrition_consultancy" title="Animal Nutrition Consultancy" class="roundal" id="play"></a>
					<a href="<?= base_url() ?>nutrition_consultancy"><h3>Animal Nutrition Consultancy</h3></a>
					<p><?php $text = "Meeting livestock nutritional requirements is extremely important in maintaining acceptable performance of neonatal, growing, finishing and breeding animals. Farmers can now avail feed and nutrition consultancy from Animal Nutrition Experts at Livestoc just by clicking a button on the Livestoc Mobile Application."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					<form method="post" action="<?= base_url() ?>nutrition_consultancy">
						<button type="submit" class="btn btn-default btn-green">Learn more</button>
					</form>
				</div>
				<div class="col-md-4 col3">
					<a href="<?= base_url(); ?>farm_management" title="Farm Management" class="roundal" id="adoption" style="background-color: #A8CF45 !important"></a>
					<a href="<?= base_url(); ?>farm_management"><h3>Farm Automation&nbsp;/&nbsp;New Farm Set Up</h3></a>
					<p><?php $text = "The livestock segment urgently needs to evolve and strengthen itself per optimal international parameters in order to face the growing volatilities of the marketplace. Livestoc provides expert consultation by LPM professionals on various aspects of an integrated farming system, feed & nutrition, latest methodologies and economic feasibility of your farm."; $str = str_split($text, 200); echo $str[0].'..............'; ?> </p>
					<form method="post" action="<?= base_url(); ?>farm_management">
						<button type="submit" class="btn btn-default btn-green" style="color: #a8cf45; border: 2px solid #a8cf45;">Learn more</button>
					</form>
				</div>
			</div>
		</div>
		
		<!-- Adoption -->
		<div class="container">
		<div class="row">
				<div class="col-md-12 centered">
					<h3><span>Featured Semen</span></h3>
				</div>
			</div>
			<div class="row adoption">
				<div class="col-md-4">
					<a href="<?= base_url() ?>semen" title="Murrah"><img src="<?= base_url(); ?>assetss/images/dog-4.jpg" alt="Murrah" style="height:250px;" /></a>
					<div class="title">
						<h5>
							<span data-hover="Murrah">Murrah</span>
						</h5>
					</div>
				</div>
				<div class="col-md-4">
					<a href="<?= base_url() ?>semen" title="HF(Holstein Friesian)"><img src="<?= base_url(); ?>assetss/images/dog-5.jpg" style="height:250px;" alt="HF(Holstein Friesian)" /></a>
					<div class="title">
						<h5>
							<span data-hover="HF(Holstein Friesian)">HF(Holstein Friesian)</span>
						</h5>
					</div>
				</div>
				<div class="col-md-4">
					<a href="<?= base_url() ?>semen" title="Sahiwal"><img src="<?= base_url(); ?>assetss/images/Sahiwal.jpg" alt="Sahiwal" style="height:250px;" /></a>
					<div class="title">
						<h5>
							<span data-hover="Sahiwal">Sahiwal</span>
						</h5>
					</div>
				</div>
			</div>
					<div class="row">
						<div class="col-md-12 centered">
							<h3><span>Featured Products</span></h3>
						</div>
					</div>
					<div class="row adoption">
								<div class="col-md-4">
									<a href="#" title="Digital Mastitis Detector"><img src="<?= base_url(); ?>assetss/image_new/1.jpg" alt="Digital Mastitis Detector" style="height:250px;" /></a>
									<div class="title">
										<h5>
											<span data-hover="Digital Mastitis Detector">Digital Mastitis Detector</span>
										</h5>
									</div>
								</div>
								<div class="col-md-4">
									<a href="https://www.livestoc.com/ecommerce/index.php?route=product/product&product_id=138" title="Rapid Pregnancy Kit(After 18 Days)"><img src="<?= base_url(); ?>assetss/image_new/2.jpg" style="height:250px;" alt="Rapid Pregnancy Kit(After 18 Days)" /></a>
									<div class="title">
										<h5>
											<span data-hover="Rapid Pregnancy Kit">Rapid Pregnancy Kit</span>
										</h5>
										
									</div>
								</div>
								<div class="col-md-4">
									<a href="https://www.livestoc.com/ecommerce/index.php?route=product/product&path=57&product_id=130" title="Cow Dung Machine"><img src="<?= base_url(); ?>assetss/image_new/3.jpg" alt="Cow Dung Machine" style="height:250px;" /></a>
									<div class="title">
										<h5>
											<span data-hover="Cow Dung Machine">Cow Dung Machine</span>
										</h5>
									</div>
								</div>
								<div class="col-md-4">
									<a href="https://www.livestoc.com/ecommerce/index.php?route=product/product&product_id=137" title="Brucella Rapid Test Kit"><img src="<?= base_url(); ?>assetss/image_new/4.jpg" alt="Brucella Rapid Test Kit" style="height:250px;" /></a>
									<div class="title">
										<h5>
											<span data-hover="Brucella Rapid Test Kit">Brucella Rapid Test Kit</span>
										</h5>
									</div>
								</div>
								<div class="col-md-4">
									<a href="#" title="Milk Checker"><img src="<?= base_url(); ?>assetss/image_new/5.jpg" style="height:250px;" alt="Milk Checker" /></a>
									<div class="title">
										<h5>
											<span data-hover="Milk Checker">Milk Checker</span>
										</h5>
									</div>
								</div>
								<div class="col-md-4">
									<a href="#" title="Rapid Milk Testing Kit"><img src="<?= base_url(); ?>assetss/image_new/6.jpg" style="height:250px;" alt="Rapid Milk Testing Kit" /></a>
									<div class="title">
										<h5>
											<span data-hover="Rapid Milk Testing Kit">Rapid Milk Testing Kit</span>
										</h5>
									</div>
								</div>
					</div>
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>Buy & Sell Livestock</span></h3>
				</div>
			</div>
			<div class="row adoption">
				<div class="col-md-4">
					<a href="https://www.livestoc.com/app/animals/46/3/pitbull-dog-for-sale" title="Pitbull"><img src="<?= base_url(); ?>assetss/images/Pit_Bull_Dog.jpg" alt="Pitbull" style="height:250px;" /></a>
					<div class="title">
						<h5>
							<span data-hover="Pitbull for Sale">Pitbull for Sale</span>
						</h5>
					</div>
				</div>
				<div class="col-md-4">
					<a href="https://www.livestoc.com/app/animals/88/1/jersey-cow-for-sale" title="Jersey"><img src="<?= base_url(); ?>assetss/images/jercy.jpg" style="height:250px;" alt="Jersey" /></a>
					<div class="title">
						<h5>
							<span data-hover="Jersey for Sale">Jersey for Sale</span>
						</h5>
					</div>
				</div>
				<div class="col-md-4">
					<a href="https://www.livestoc.com/app/animals/38/2/marwari-horse-for-sale" title="Marwari for Sale"><img src="<?= base_url(); ?>assetss/images/dog-6.jpg" alt="Marwari for Sale" style="height:250px;" /></a>
					<div class="title">
						<h5>
							<span data-hover="Marwari for Sale">Marwari for Sale</span>
						</h5>
					</div>
				</div>
			</div>
			<?php require('blog.php');?>
		<div >
			<div class="container">
				<div class="row">
					&nbsp;
				</div>
			</div>
		</div>
		<!-- Adoption end -->
		
		