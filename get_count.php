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
	mysql_select_db('dougv_demo') or die('Cannot select database');
						
	// get new count totals, pass as JSON
	$rs = mysql_query("SELECT * FROM click_table") or die('Cannot get updated click counts');
	if(mysql_num_rows($rs) > 0) {
		$out = "{ ";
		while($row = mysql_fetch_array($rs)) {
			$out .= "\"$row[color_name]\" : $row[color_count], ";
		}
		$out = substr($out, 0, strlen($out) - 2);
		$out .= " }";
		
		header("Content-type: application/json");
		echo $out;
	}
?>
