
<!-- Slider -->
<div id="home_carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#home_carousel" data-slide-to="0" class="active"></li>
				<li data-target="#home_carousel" data-slide-to="1"></li>
				<li data-target="#home_carousel" data-slide-to="2"></li>
				<li data-target="#home_carousel" data-slide-to="3"></li>
				<li data-target="#home_carousel" data-slide-to="4"></li>
				<li data-target="#home_carousel" data-slide-to="5"></li>
				<li data-target="#home_carousel" data-slide-to="6"></li>
			</ol>
			
			<!-- Wrapper for slides -->
			<div class="carousel-inner" style="text-shadow: 118px 100px 120px black;">
				<div class="item active">
					<img src="<?= base_url(); ?>assetss/image_new/homepage1.jpg" alt="Animal Treatment" />
					<div class="carousel-caption">
						<h2>Animal Treatment</h2>
					    <p><?php $text = "Through our online treatment module, the livestock owner can protect his animals from quacks by having access to a qualified veterinarian and a skilled VT through the app. Livestoc enables the dairy farmer to get in direct contact with Veterinarians and Paravets for both consultation & professional treatment of his animal."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="<?= base_url() ?>treatment">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    	</form>
					</div>
				</div>
				<div class="item">
					<img src="<?= base_url(); ?>assetss/image_new/homepage3.jpg" alt="Artifical Insemination" />
					<div class="carousel-caption">
						<h2>Artifical Insemination</h2>
					    <p><?php $text = "The livestock owner can now order for Artificial Insemination online. This service allows the user to not only choose the desired bull/sire/semen straw from listings of high quality semen available through the app but also the best skilled AI worker. Breed improvement and pedigree determination lead to higher valuation for livestock."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="<?= base_url() ?>insemination">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    </form>
					</div>
				</div>
				<div class="item">
					<img src="<?= base_url(); ?>assetss/image_new/homepage_insemination.jpg" alt="Best Quality Semen" />
					<div class="carousel-caption">
						<h2>Best Quality Semen</h2>
					    <p><?php $text = "After understanding the requirement of quality semen at grass root level for breed improvement and better yield, Livestoc has shortlisted best performing bulls in each breed category and also sourced the best quality semen from multiple institutions. We want to make it available in the market for the farmers and are appointing area wise distributers to take our initiative forward."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="<?= base_url() ?>semen">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    </form>
					</div>
				</div>
				<div class="item">
					<img src="<?= base_url(); ?>assetss/image_new/buy_and_sell_livestoc.jpg" alt="Buy & Sell Livestock" />
					<div class="carousel-caption">
						<h2>Buy & Sell Livestock</h2>
					    <p><?php $text = "Buyers can browse through our extensive listing of animals and select the breed of their choice. Pet sellers can be assured of a wide audience and premium prices for their animals. Livestoc ensures transparency and convenience while buying or selling pets across the country through its animal profiling feature."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="https://www.livestoc.com/app/buy-animal.php">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    </form>
					</div>
				</div>
				<div class="item">
					<img src="<?= base_url(); ?>assetss/image_new/Dairy_farm_equipment.jpg" alt="Farm Products&nbsp;/&nbsp;Equipment Shopping" />
					<div class="carousel-caption">
						<h2>Farm Products&nbsp;/&nbsp;Equipment Shopping</h2>
					    <p><?php $text = "The livestock segment urgently needs to evolve and strengthen itself per optimal international parameters in order to face the growing volatilities of the marketplace. Livestoc provides expert consultation by LPM professionals on various aspects of an integrated farming system, feed & nutrition, latest methodologies and economic feasibility of your farm."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="https://www.livestoc.com/ecommerce/">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    </form>
					</div>
				</div>
				<div class="item">
					<img src="<?= base_url(); ?>assetss/image_new/animal_nutrition.jpg" alt="Animal Nutrition Consultancy" />
					<div class="carousel-caption">
						<h2>Animal Nutrition Consultancy</h2>
					    <p><?php $text = "Meeting livestock nutritional requirements is extremely important in maintaining acceptable performance of neonatal, growing, finishing and breeding animals. "; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="<?= base_url() ?>nutrition_consultancy">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    </form>
					</div>
				</div>
				<div class="item">
					<img src="<?= base_url(); ?>assetss/image_new/automoted_farm.jpg" alt="Farm Automation&nbsp;/&nbsp;New Farm Set Up" />
					<div class="carousel-caption">
						<h2>Farm Automation&nbsp;/&nbsp;New Farm Set Up</h2>
					    <p><?php $text = "The livestock segment urgently needs to evolve and strengthen itself per optimal international parameters in order to face the growing volatilities of the marketplace. Livestoc provides expert consultation by LPM professionals on various aspects of an integrated farming system, feed & nutrition, latest methodologies and economic feasibility of your farm."; $str = str_split($text, 200); echo $str[0].'..............'; ?></p>
					    <form method="post" action="<?= base_url(); ?>farm_management">
					    	<button type="submit" class="btn btn-lg btn-default">Learn more</button>
					    </form>
					</div>
				</div>
			</div>
			
			<!-- Controls -->
			<a class="left carousel-control" href="#home_carousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#home_carousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
		<!-- Slider end -->