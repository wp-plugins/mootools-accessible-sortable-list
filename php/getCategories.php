<?php

if (!function_exists('getCategories'))
{
    function getCategories($args)
    {
        define('ABSPATH', dirname(__FILE__) . '/../../../');
        require_once(ABSPATH . "wp-config.php");
        require_once(ABSPATH . "wp-includes/category.php");
        
		$categories = get_categories($args);
		$output = '';
		
		if($categories)
		{
			foreach($categories as $category)
			{
				$output.= '<li><span href="'.get_category_link($category->term_id).'" title="'.sprintf(__("View all posts in %s"), $category->name).'" >'.$category->name.'</span></li> ';
			}
        }
        
        return $output;
    }
}

?>
