$(document).ready(function(){
 
  // validate login Form on keyup and submit
       $("#loginForm").validate({
   			rules: {
				email: {
					required: true,
					  },
				password:{
                    required: true,
				     } 	
			},
			messages: {
				email:{
				required: "Please enter Email Address / Username",
				      },
			     password:"Please enter Password", 
			}
		});

   // validation for Staff management (Add Admin Role) Page // 
       $("#staffmang_create").validate({
			rules: {
				role_name: {
					required: true,
					},
				'module[]': {
		             required: true,
		             }	
				},
			messages: {
				role_name:{
					   required: "Please enter Role Name",
				      },
				'module[]': {
                required: "You must check at least 1 box",
                       }     
				 }
		});

       // validation for Admin User management (Add Admin User) Page // 
       $("#user_create").validate({
			rules: {
				username: {
					required: true,
					},
				password: {
					required: true,
					},
				fname: {
					required: true,
					},
				lname: {
					required: true,
					},
				email: {
					required: true,
					email   : true,
					},
				role: {
					required: true,
					min:0,
					},		
				},
			messages: {
				username:{
					   required: "Please enter User Name",
				      },
				password:{
					   required: "Please enter Password",
				      },
				fname:{
					   required: "Please enter First Name",
				      },
				lname:{
					   required: "Please enter Last Name",
				      },
				email:{
					   required: "Please enter email",
				      }, 
				role:{
					   required: "Please enter User Role",
					   min : "Please enter User Role"
				      },                               
				 }
		});

   // validation for Language management Page // 
       $("#Language_form").validate({
         rules: {
            Language: {
                       required: true,
                      },
            'language[]' : {
                       required: true,
                      },        
            menu_label: {
                         required: true,
                        },
            menu_key: {
           	           required: true,
                      },
                },
         messages: {
            Language:{
                      required: "Please Select any Language",
                     },
            language:{
                      required: "Please enter required field",
                     },
            menu_label:{
                        required: "Please enter the menu label",
                       },
            menu_key: {
              	       required: "Please enter the menu key",
                      },
                    }
        });

       $("#change_password").validate({

         rules: {
            Password: {
                       required: true,
                      },
            New_password: {
                         required: true,
                        },
            Conf_password: {
           	           required: true,
                      },
                },
         messages: {
            Password:{
                      required: "Please enter old password",
                     },
            New_password:{
                        required: "Please enter new password",
                       },
            Conf_password: {
              	       required: "Please enter confirm password",
                      },
                    }
        });

       $("#schools_create").validate({

         rules: {
            school_name: {
                       required: true,
                      },
            address: {
                         required: true,
                        },
            city: {
                       required: true,
                      },
            state: {
                       required: true,
                      },
            country: {
                       required: true,
                      },
            pincode: {
                       required: true,
                      },
            email_id: {
                       required: true,
                      },
            phone: {
                       required: true,
                      },

                },
         messages: {
            school_name:{
                      required: "Please enter school name",
                     },
            address:{
                        required: "Please enter address",
                       },
            city: {
                       required: "Please enter city",
                      },
            state: {
                       required: "Please enter state",
                      },
            country: {
                       required: "Please enter country",
                      },
            pincode: {
                       required: "Please enter pincode",
                      },
            email_id: {
                       required: "Please enter email_id",
                      },
            phone: {
                       required: "Please enter phone",
                      },
                    }
        });



      $("#ckform").validate({

         rules: {
            page_name: {
                       required: true,
                      },
            page_url: {
                         required: true,
                        },
            page_title: {
           	           required: true,
                      },
            editor1: {
           	           required: true,
                      },
                },
         messages: {
            page_name:{
                      required: "Please enter Page Name",
                     },
            page_url:{
                        required: "Please enter Page Url",
                       },
            page_title: {
              	       required: "Please enter Page Title",
                      },
            editor1: {
              	       required: "Please enter Description",
                      },
                    }
        });
		
  //image  for class validate  
      $("#classimg_create").validate({

         rules: {
             image:{
                required: true,
                   },
            title: {
                       required: true,
                   },
            order: {
                       required: true,
                   },
            
                },
         messages: {
            image:{
                  required: "Please Select Image",
                 },
            title:{
                      required: "Please enter Title",
                     },
            order:{
                        required: "Please enter Order",
                       },
            
                    }
        });

		$("#ckformforemailupdate").validate({

         rules: {
            type12: {
                       required: true,
                      },
            from_email: {
                         required: true,
                        },
            subject: {
           	           required: true,
                      },
            editor1: {
           	           required: true,
                      },
			 editor2: {
           	           required: true,
                      },		  
                },
         messages: {
            type12:{
                      required: "This field is required",
                     },
            from_email:{
                        required: "This field is required",
                       },
            subject: {
              	       required: "This field is required",
                      },
            editor1: {
              	       required: "This field is required",
                      },
			 editor2: {
              	       required: "This field is required",
                      },		  
                    }
        });
		
				$("#ckformforemailsave").validate({

         rules: {
            type12: {
                       required: true,
                      },
            from_email: {
                         required: true,
                        },
            subject: {
           	           required: true,
                      },
            editor1: {
           	           required: true,
                      },
			 editor2: {
           	           required: true,
                      },		  
                },
         messages: {
            type12:{
                      required: "This field is required",
                     },
            from_email:{
                        required: "This field is required",
                       },
            subject: {
              	       required: "This field is required",
                      },
            editor1: {
              	       required: "This field is required",
                      },
			 editor2: {
              	       required: "This field is required",
                      },		  
                    }
        });
		
		
   }); 