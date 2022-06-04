/*$.ajaxSetup(
{
   crossDomain: true
});*/

var ajaxloader = {
    type:'GET',
	dataType:"html",
	headers: {"X-HTTP-Method-Override": "PUT"},
	async: true,
	jsonres:'',
	inprocess:[],
	loadURL: function (url, vars, callback){
		if(ajaxloader.inprocess[url]) return false;
		ajaxloader.inprocess[url] = true;
		$.post(url,
          vars,
		  function (response){
			   try {
				   ajaxloader.jsonres = $.parseJSON(response);    
				   if(ajaxloader.jsonres['system_error'] == 1){
					  console.log('Network error...');
				   }
			      } catch (e) {
			    	  ajaxloader.jsonres = eval(response);
			      }
			   callback(ajaxloader.jsonres);
			   ajaxloader.inprocess[url] = false;
		 });
	},
   load: function (url, callback, callbackparams, vars){
       if(typeof vars == 'undefined') vars=null;
            if(ajaxloader.inprocess[url]) return false;
		    ajaxloader.inprocess[url] = true; 
			$.ajax({
				  url: url,
				  data : vars,
				  type: ajaxloader.type,
				  async: ajaxloader.async,
				  success: function (response){
					   ajaxloader.inprocess[url] = false;
					   callback = eval(callback);
					   callback(response, callbackparams);
				  },
				  dataType: ajaxloader.dataType,
				  error: ajaxloader.errorHandler
		   });
   },
   errorHandler: function (jqXHR, textStatus,  errorThrown){
		console.log('Network error...');
   }
}