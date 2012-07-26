window.addEvent('domready', function()
{
	var $j = jQuery.noConflict();
	
	if($j('#sortablelist').length>0)
    {
		var sortablelist = new SortableList('#sortablelist');
		
		// open the corresponding link with enter key
		$j('#sortablelist').bind('keydown', function(e)
		{		
			if(!($j(this).find('li:focus span').attr('href')==undefined) && e.which==13)
			{
				window.location = $j(this).find('li:focus span').attr('href');
			}
		});
	}
});
