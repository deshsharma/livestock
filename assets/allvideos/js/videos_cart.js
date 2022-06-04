    function video_cart_add(video_id, price, users_id, title, qty){
	//var dataString  = { p_id: p_id, p_price: p_price};
		$.ajax({
			type: "POST",
			url: app_url+"/video_cart_sess",
			data: { video_id: video_id, price: price, users_id: users_id, title: title, qty: qty},
			dataType: "json",
			cache : false,
			success: function(data){
				location.reload();
			} 
		});
	}
	
	function videoremovecart(id){
		var x = confirm("Are you sure you want to Remove?");
		if (x){
			$.ajax({
			type:"POST",
			url: app_url+"/video_removecart_sess",
			data:{id:id},
			success:function(data){
				location.reload();
			 }
			});
		}else{
			return false;
		}
	}