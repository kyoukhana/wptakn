<?php

// define blog default setting & any other static 
class Jeg_Sidebar {
	public static $_RIGHT = "right";
	public static $_LEFT = "left";
	public static $_FULLWIDTH = "fullwidth";
	
	public static function get_sidebar($sidebar) 
	{
		if($sidebar == "right") 	return Jeg_Sidebar::$_RIGHT;
		if($sidebar == "left") 		return Jeg_Sidebar::$_LEFT;
		if($sidebar == "fullwidth") return Jeg_Sidebar::$_FULLWIDTH;
	}
}

class Jeg_Porto_Layout {
	public static $_MASONRY = 'masonry';
	public static $_CLEAN 	= 'clean';
}


define('JEG_DEFAULT_SIDEBAR'			, 'Default Sidebar');
define('JEG_DEFAULT_LAYOUT'				, Jeg_Sidebar::$_RIGHT);
define('JEG_DEFAULT_PORTO_LAYOUT'		, Jeg_Porto_Layout::$_MASONRY);