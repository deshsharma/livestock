    function usersvideo_add(product_id, pack_id, pack_price, qty){
	//var dataString  = { p_id: p_id, p_price: p_price};
		$.ajax({
			type: "POST",
			url: app_url+"/users_video_cart_sess",
			data: { product_id: product_id, pack_id: pack_id, pack_price: pack_price, qty: qty},
			dataType: "json",
			cache : false,
			success: function(data){
			location.reload();
			} 
		});
	}
	
	function removeusersvideo(id){
		
		var x = confirm("Are you sure you want to Remove?");
		if (x){
		$.ajax({
		type:"POST",
		url: app_url+"/removeusers_video_cart_sess",
		data:{id:id},
		success:function(data){
		//if(data=='Success'){
		location.reload();
		/*}else{
		alert('Selected service already in your checkout list.');
		} */
		}
		});
		}else{
		return false;
		}
	}