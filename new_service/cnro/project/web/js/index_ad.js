// JavaScript Document
$(document).ready(function(){
	
	var interval = window.setInterval(function(){
		changeAuto();
	}, 7000);
	var current_ad_number=1;
	setHover();
	$("#btn_showad1").mouseover(function () { 
		current_ad_number=1;
		$("#big_ad2").hide(); 
		$("#big_ad3").hide(); 
		$("#big_ad4").hide(); 
		$("#big_ad1").fadeIn("slow"); 
		clearInterval(interval);
		interval = window.setInterval(function(){     
			changeAuto();     
		}, 7000); 
		setHover();
	});
	
	$("#btn_showad2").mouseover(function () { 
		current_ad_number=2;
		$("#big_ad1").hide(); 
		$("#big_ad3").hide(); 
		$("#big_ad4").hide(); 
		$("#big_ad2").fadeIn("slow"); 
		clearInterval(interval);
		interval = window.setInterval(function(){     
			changeAuto();     
		}, 7000); 
		setHover();
	});
	
	$("#btn_showad3").mouseover(function () { 
		current_ad_number=3;
		$("#big_ad1").hide(); 
		$("#big_ad2").hide(); 
		$("#big_ad4").hide(); 
		$("#big_ad3").fadeIn("slow"); 
		clearInterval(interval);
		interval = window.setInterval(function(){     
			changeAuto();     
		}, 7000); 
		setHover();
	});

	$("#btn_showad4").mouseover(function () { 
		current_ad_number=4;
		$("#big_ad1").hide(); 
		$("#big_ad2").hide(); 
		$("#big_ad3").hide(); 
		$("#big_ad4").fadeIn("slow"); 
		clearInterval(interval);
		interval = window.setInterval(function(){     
			changeAuto();     
		}, 7000); 
		setHover();
	});	
	
	
	function changeAuto(){   
		if(current_ad_number==1){
			current_ad_number=2;
			$("#big_ad1").hide(); 
			$("#big_ad3").hide(); 
			$("#big_ad4").hide(); 
			$("#big_ad2").fadeIn("slow"); 
			setHover();
		}else if(current_ad_number==2){
			current_ad_number=3;
			$("#big_ad1").hide(); 
			$("#big_ad2").hide(); 
			$("#big_ad4").hide(); 
			$("#big_ad3").fadeIn("slow"); 
			setHover();
		}else if(current_ad_number==3){
			current_ad_number=4;
			$("#big_ad1").hide(); 
			$("#big_ad2").hide(); 
			$("#big_ad3").hide(); 
			$("#big_ad4").fadeIn("slow"); 
			setHover();
		}else if(current_ad_number==4){
			current_ad_number=1;
			$("#big_ad2").hide(); 
			$("#big_ad3").hide(); 
			$("#big_ad4").hide(); 
			$("#big_ad1").fadeIn("slow"); 
			setHover();
		}
	}   
	
	function setHover(){   
		if(current_ad_number==1){
			$("#btn_showad1 > img").attr("src","images/btn_bigad_num1_on.gif");
			$("#btn_showad2 > img").attr("src","images/btn_bigad_num2.gif");
			$("#btn_showad3 > img").attr("src","images/btn_bigad_num3.gif");
			$("#btn_showad4 > img").attr("src","images/btn_bigad_num4.gif");
		}else if(current_ad_number==2){
			$("#btn_showad1 > img").attr("src","images/btn_bigad_num1.gif");
			$("#btn_showad2 > img").attr("src","images/btn_bigad_num2_on.gif");
			$("#btn_showad3 > img").attr("src","images/btn_bigad_num3.gif");
			$("#btn_showad4 > img").attr("src","images/btn_bigad_num4.gif");
		}else if(current_ad_number==3){
			$("#btn_showad1 > img").attr("src","images/btn_bigad_num1.gif");
			$("#btn_showad2 > img").attr("src","images/btn_bigad_num2.gif");
			$("#btn_showad3 > img").attr("src","images/btn_bigad_num3_on.gif");
			$("#btn_showad4 > img").attr("src","images/btn_bigad_num4.gif");
		}else if(current_ad_number==4){
			$("#btn_showad1 > img").attr("src","images/btn_bigad_num1.gif");
			$("#btn_showad2 > img").attr("src","images/btn_bigad_num2.gif");
			$("#btn_showad3 > img").attr("src","images/btn_bigad_num3.gif");
			$("#btn_showad4 > img").attr("src","images/btn_bigad_num4_on.gif");
		}
	}   
	

	$("#big_ad1").hover(     
		function(){      
			clearInterval(interval);          
		},     
		function(){     
			interval = window.setInterval(function(){     
				changeAuto();     
			}, 7000);        
		}   
	);   

	$("#big_ad2").hover(     
		function(){      
			clearInterval(interval);          
		},     
		function(){     
			interval = window.setInterval(function(){     
				changeAuto();     
			}, 7000);        
		}   
	);  
	
	$("#big_ad3").hover(     
		function(){      
			clearInterval(interval);          
		},     
		function(){     
			interval = window.setInterval(function(){     
				changeAuto();     
			}, 7000);        
		}   
	);  
	
	$("#big_ad4").hover(     
		function(){      
			clearInterval(interval);          
		},     
		function(){     
			interval = window.setInterval(function(){     
				changeAuto();     
			}, 7000);        
		}   
	);  
	
	
	
});
