<?php
	/*
		How To Increment A Counter In MySQL Based On A Radio Button Click 
		Copyright (C) 2012 Doug Vanderweide

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*/
	
	$link = mysql_connect('server', 'username', 'password') or die('Cannot connect to database server');
	mysql_select_db('database') or die('Cannot select database');
	
	// if this is a postback ...
	if(isset($_GET['color'])) {
		// create array of acceptable values
		$ok = array('red', 'green', 'blue', 'black');
		// if we have an acceptable value for color_name ...
		if(in_array($_GET['color'], $ok)) {
			// update the counter for that color
			$q = mysql_query("UPDATE click_table SET color_count = color_count + 1 WHERE color_name = '" . $_GET['color'] . "'") or die ("Error updating count for " . $_GET['color']);
		}
	}
?>
