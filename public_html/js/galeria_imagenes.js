	$(document).ready(function(){
		
		$('.gallery_demo_unstyled').addClass('gallery_demo'); // adds new class name to maintain degradability
		$('.nav').css('display','none'); // hides the nav initially
		
		$('ul.gallery_demo').galleria({
			history   : false, // deactivates the history object for bookmarking, back-button etc.
			clickNext : false, // helper for making the image clickable. Let's not have that in this example.
			insert    : undefined, // the containing selector for our main image. 
								   // If not found or undefined (like here), galleria will create a container 
								   // before the ul with the class .galleria_container (see CSS)
			onImage   : function() { $('.nav').css('display','block'); } // shows the nav when the image is showing
		});
	});
