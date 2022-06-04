<link rel="stylesheet" href="<?= base_url() ?>assets/app/css/livestoc.css">
<style type="text/css">
	    body {
	            font-family: sans-serif;
	            font-size: 14px;
	      		}
	</style>
<div class="content-wrapper">
<section class="content">
	          	<div class="box-header with-border">
		              <h3 class="box-title">Location</h3>
                  <?php if($_SESSION['type'] == '5' || $_SESSION['type'] == '1' || $_SESSION['type'] == '10' || $_SESSION['type'] == '11'){?>
		             <!--  <a class="white" href="<?= base_url('admin/add_bull'); ?>"><div class="btn btn-info but_set">
					  		    Add Bull
		              </div></a> -->
                  <?php } ?>
                  <br />
              	  <br />
				  <form method="post" id="" action="<?= base_url() ?>admin/set_location_dis" enctype="multipart/form-data">					 
					   <p><label>Enter your Location</label><br>
					   <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
					    <input type="hidden" id="doctor_id" name="doctor_id" value="<?php $doctor_id; echo $doctor_id; ?>" />
					    <input type="hidden" id="city2" name="city2" />
					    <input type="hidden" value="<?= $cityLat; ?>" id="cityLat" name="cityLat" />
					    <input type="hidden" value="" id="cityLng" name="cityLng" /></p>
						<input type="submit" name="location" value="submit" class="btn btn-info" />
				  </form>
				  <div class="col-md-12">
				  	<div class="col-md-3">latitude</div>
				  	<div class="col-md-9 lat"></div>
				  	<div class="col-md-3">longitude</div>
				  	<div class="col-md-9 long"></div>
				  	<div class="col-md-3">Address</div>
				  	<div class="col-md-9 add"></div>
				  	<div class="col-md-12 map"></div>
				  </div>
				 
	            </div>
	           <?php 
	            	//$data = $this->api_model->get_address_lat_data_districtmanager();
	            	//print_r($data);
	            ?> 
	             <div class="box-body">
		         	<!-- <table id="tabdata" class="table table-bordered table-striped">
		                <thead>
			                <tr>
                              <th>ID</th>
			                  <th>Address</th>
			                  <th>latitude</th>
			                  <th>longitude</th>
			                </tr>
		                </thead>
		                <tbody>
		                	
		                </tbody>		                
		            </table> -->
		            <?php //echo $cityLat; print_r('this is testng');?>
		            <div class="col-md-12" aling="center">
				         <div id="Pagination" style="text-align: center;"></div> 
				         <input type="hidden" value="<?= ITEMS_PER_PAGE ?>" name="items_per_page" id="items_per_page">
				         <input type="hidden" value="<?= NUM_DISPLAY_ENTRIES ?>" name="num_display_entries" id="num_display_entries">
				         <input type="hidden" value="Prev" name="prev_text" id="prev_text">
				         <input type="hidden" value="Next" name="next_text" id="next_text">
				    </div>
		         </div>
		         <div id="map">
		         </div>
	    
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6heA3hIbyRkDhtWf9aJrlEPYMphWWH9w=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
       <script>
       	$.ajax({
		  url: "https://www.livestoc.com/harpahu_merge/api/get_lat_long_dist_manger?admin_id=<?=  $doctor_id;?>",
		  cache: false,
		  success: function(html){
		   // html = JSON.parse(html)
		    console.log(html)
		    console.log(html.data[0]['latitude']);
		    console.log(html.data[0]['longitude']);
		    console.log(html.data[0]['address_full']);
		    $('.lat').html(html.data[0]['latitude']);
		    $('.long').html(html.data[0]['longitude']);
		    $('.add').html(html.data[0]['address_full']);
		    $('#map').html('<iframe width="100%" height="450" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q='+html.data[0]['latitude']+','+html.data[0]['longitude']+'&amp;key=AIzaSyD6heA3hIbyRkDhtWf9aJrlEPYMphWWH9w" id="map" style="border:0" ></iframe>');
		     //$("#map").attr("src", "https://www.google.com/maps/embed/v1/place?q="+html.data[0]['latitude']+","+html.data[0]['longitude']+"&amp;key=AIzaSyD6heA3hIbyRkDhtWf9aJrlEPYMphWWH9w");
		  }
		});
		$(function(){
		    $('.map-btn').click(function(event) {
		      var lat = $(this).data('lat');
		      var lng = $(this).data('lng');
		      showMap(lat,lng);
		    });
		});

 </script>
  <script>
       	$.ajax({
		  url: "https://www.livestoc.com/harpahu_merge/api/get_address_lat_data?admin_id=<?= $_SESSION['user_id'] ?>",
		  cache: false,
		  success: function(html){
		    //html = JSON.parse(html)
		    console.log(html)
		    console.log(html.data[0]['latitude']);
		    console.log(html.data[0]['longitude']);
		    console.log(html.data[0]['complete_addr']);
		    $('.lat').html(html.data[0]['latitude']);
		    $('.long').html(html.data[0]['longitude']);
		    $('.add').html(html.data[0]['complete_addr']);
		    var iframe = document.createElement("iframe");
			iframe.onload = function() {
			   var doc = iframe.contentDocument;

			   iframe.contentWindow.showNewMap = function() {
			    var mapContainer =  doc.createElement('div');
			    mapContainer.setAttribute('style',"width: 100%; height: 500px");
			    doc.body.appendChild(mapContainer);

			    var mapOptions = {
			        center: new this.google.maps.LatLng(-35.000009, -58.197645),
			        zoom: 5,
			        mapTypeId: this.google.maps.MapTypeId.ROADMAP
			    }

			    var map = new this.google.maps.Map(mapContainer,mapOptions);
			}

			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=showNewMap';
			iframe.contentDocument.getElementsByTagName('head')[0].appendChild(script);
			};
			$('.map').html(iframe);
		  }
		});
       </script>
       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBKXAzms3AOjKJz4hjMlPdFreKAryub2U&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
