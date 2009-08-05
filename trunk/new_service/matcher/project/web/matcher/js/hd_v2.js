//滑动菜单效果
function tabit(tabName,btnId,tabNumber){
	for(i=0;i<tabNumber;i++){
	document.getElementById(tabName+"_div"+i).style.display = "none";
	document.getElementById(tabName+"_btn"+i).className = "btu_off";
}
	document.getElementById(tabName+"_div"+btnId).style.display = "block";
	document.getElementById(tabName+"_btn"+btnId).className = "btu_on";	
}