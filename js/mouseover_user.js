var $j = jQuery.noConflict();
$j(document).ready(function(){	
	$j('.flip-image img').hover(function(){
										
	   var tab    = 'target="'+$j(this).parent().attr('target')+'"';
	   var title  = $j(this).attr('title');
	   
	  if(($j(this).parent()).is('a')){
		  var hrf    = $j(this).parent().attr('href');
		  var url    = addhttp(hrf);
	  }
	  

      if(($j(this).parent()).is('a')){
	 	 $j('.image-flip-text').html('<a href="'+url+'"'+tab+'>'+title+'</a>');
	  }else{
		  $j('.image-flip-text').html(title);
	  }
	  
	});
});

function addhttp(url) { 
	if(url.substr(0,7) != 'http://' && url != ''){
		url = 'http://' + url;
	}
	return url;
}