// JavaScript Document

// fist owl start
jQuery(window).load(function() {
var owlFirst = jQuery("#owl-demo");

      owlFirst.owlCarousel({

      items : 3, //10 items above 1000px browser width
	  itemsDesktop : [1199,3],
      itemsDesktopSmall : [991,2], // 3 items betweem 900px and 601px
      itemsTablet: [767,1], //2 items between 600 and 0;
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
      
      });

      // Custom Navigation Events
      jQuery(".next").click(function(){
        owlFirst.trigger('owl.next');
      })
      jQuery(".prev").click(function(){
        owlFirst.trigger('owl.prev');
      })
      jQuery(".play").click(function(){
        owlFirst.trigger('owl.play',1000);
      })
      jQuery(".stop").click(function(){
        owlFirst.trigger('owl.stop');
      })
      
      
      var owlTwo = jQuery("#owl-demo2");

      owlTwo.owlCarousel({

      items : 5, //10 items above 1000px browser width
	  itemsDesktop : [1199,4],
      itemsDesktopSmall : [991,2], // 3 items betweem 900px and 601px
      itemsTablet: [767,1], //2 items between 600 and 0;
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
      
      });

      // Custom Navigation Events
      jQuery(".next2").click(function(){
        owlTwo.trigger('owl.next');
      })
      jQuery(".prev2").click(function(){
        owlTwo.trigger('owl.prev');
      })
      jQuery(".play").click(function(){
        owlTwo.trigger('owl.play',1000);
      })
      jQuery(".stop").click(function(){
        owlTwo.trigger('owl.stop');
      })
      
      
      var owlThree = jQuery("#owl-demo3");

      owlThree.owlCarousel({

      items : 2, //10 items above 1000px browser width
	  itemsDesktop : [1199,2],
      itemsDesktopSmall : [991,2], // 3 items betweem 900px and 601px
      itemsTablet: [767,1], //2 items between 600 and 0;
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
      
      });

      // Custom Navigation Events
      jQuery(".next3").click(function(){
        owlThree.trigger('owl.next');
      })
      jQuery(".prev3").click(function(){
        owlThree.trigger('owl.prev');
      })
      jQuery(".play").click(function(){
        owlThree.trigger('owl.play',1000);
      })
      jQuery(".stop").click(function(){
        owlThree.trigger('owl.stop');
      })
});


// fist owl End


// menu

jQuery(document).ready(function(){
    var winHeight = jQuery(window).height();
    var sideHeader = jQuery(".side_header").height();
   
		 jQuery(".shop").click(function(){
				  jQuery(".menu_box_open").animate({left: '0px'});
                  jQuery(".content_scroll").height(winHeight-sideHeader);
				  jQuery('body').addClass("overlay_body");
                   jQuery(".overlay").addClass("overlay_active");
		   });
    
    jQuery(".cross").click(function(){
					jQuery(".menu_box_open").animate({left: '-405px'});
                     jQuery('body').removeClass("overlay_body");
                     jQuery(".overlay").removeClass("overlay_active");
		   });
    
    //======================login==================================
    
     jQuery("#login").click(function(){
				  jQuery(".login_box_open").animate({right: '0px'});
                  jQuery(".content_scroll").height(winHeight-sideHeader);
				  jQuery('body').addClass("overlay_body");
                   jQuery(".overlay").addClass("overlay_active");
		   });
    
    jQuery(".cross_login").click(function(){
					jQuery(".login_box_open").animate({right: '-405px'});
                     jQuery('body').removeClass("overlay_body");
                     jQuery(".overlay").removeClass("overlay_active");
		   });
    
    //======================login==================================
    
      jQuery(".overlay").click(function(){
					jQuery(".menu_box_open").animate({left: '-405px'});
                     jQuery(".login_box_open").animate({right: '-405px'});
                     jQuery('body').removeClass("overlay_body");
                     jQuery(".overlay").removeClass("overlay_active");
		   });

    
     //var a = false;
    
    jQuery(".menu_section ul li a").click(function(){
        jQuery(this).parent("li").children(".brand_des").show(); 
        jQuery(".main_des_section").height(winHeight-sideHeader);
        
     jQuery(".cross_new, .left_a").click(function(){
          jQuery(".brand_des").hide();

	   });
   
    });

		});

jQuery(document).ready(function(){
    var a = false;
    jQuery("#phone").click(function(){
        if(a == false){
                jQuery(".phone_details").slideDown(500);
                 a = true;
                 }  
         else {
             jQuery(".phone_details").fadeOut();
                  a = false;
         }
    });
    
//    jQuery('body').click(function(){
//        if(jQuery(".phone_details").css("display", "none")){
//            jQuery(".phone_details").hide();
//        }
//        else{
//        jQuery(".phone_details").slideDown();
//        }
//});
    });