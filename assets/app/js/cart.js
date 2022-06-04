    function cart_add(product_id, pack_id, pack_price, qty, users_id, type){
	//var dataString  = { p_id: p_id, p_price: p_price};
		$.ajax({
			type: "POST",
			url: app_url+"/cart_sess",
			data: { product_id: product_id, pack_id: pack_id, pack_price: pack_price, qty: qty, users_id: users_id, type: type},
			dataType: "json",
			cache : false,
			success: function(data){
				if(data.flag == '1'){
					alert(data.msg);
					location.reload();
				}else{
					alert(data.msg);
				}
			} 
		});
	}
	
	function removecart(id){
		
		var x = confirm("Are you sure you want to Remove?");
		if (x){
		$.ajax({
		type:"POST",
		url: app_url+"/removecart_sess",
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