<?php

/*
Plugin Name: Mini RSS reader
Version: 1.0
Plugin URI: http://www.stratos.me
Description: Reads an RSS feed and displays the last one's the time, title (url clickable) and first characters of the description. The function has to be called directly from your code. The plugin must be activated before.
Author: stratosg
Author URI: http://www.stratos.me
*/

/*  Copyright 2008  Geroulis Efstratios (stratosg2002@yahoo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('MAGPIE_CACHE_AGE', 120);

/*
* $url The rss feed URL to read from
* $date_format Which way to display the date according to the php's date function
* $description_chars How many characters to display from the description
* $items How many items to display
*/
function read_rss_mini($url, $date_format = 'D @ g:i a', $description_chars = 140, $items = 1){
	include_once(ABSPATH . WPINC . '/rss.php');
	$messages = fetch_rss($url);
	if(count($messages->items) == 0){
		return 'Nothing there!';
	}
	if($items > count($messages->items)){
		return 'Not so many items!';
	}
	$output = '';
	for($i = 0; $i < $items; $i++){
		$output .= '<span class="micro_head">['.date($date_format, strtotime($messages->items[$i]['pubdate']));
		$output .= '] <a href="'.$messages->items[$i]['link'].'">'.$messages->items[$i]['title'].'</a></span><br>';
		$output .= '<span class="micro_body">'.substr($messages->items[$i]['description'], 0, $description_chars).'...</span><br>';
	}
	
	return $output;
}

?>