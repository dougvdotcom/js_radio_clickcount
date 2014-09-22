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
	if(isset($_POST['color_name'])) {
		// create array of acceptable values
		$ok = array('red', 'green', 'blue', 'black');
		// if we have an acceptable value for color_name ...
		if(in_array($_POST['color_name'], $ok)) {
			// update the counter for that color
			$q = mysql_query("UPDATE click_table SET color_count = color_count + 1 WHERE color_name = '" . $_POST['color_name'] . "'") or die ("Error updating count for " . $_POST['color_name']);
		}
	}

	// get current color click counts
	$rs = mysql_query("SELECT * FROM click_table") or die ('Cannot process SQL count totals query');
	if(mysql_num_rows($rs) > 0) {
		while($row = mysql_fetch_array($rs)) {
			$count[$row['color_name']] = $row['color_count'];
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN 
"http://www.w3.org/TR/xhtml1/DTD/xhtml-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			How To Increment A Counter In MySQL Based On A Radio Button Click Example 1: Post Back To Same PHP Page
		</title>
		<link rel="stylesheet" type="text/css" href="../demo.css" />
	</head>
	<body>
		<h2>
			How To Increment A Counter In MySQL Based On A Radio Button Click<br />
			Example 1: Post Back To Same PHP Page
		</h2>
		
		<p class="notice">Selecting a radio button below will cause the form to post and increment the count for the respective color choice.</p>
		
		<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<p>Select a color:</p>
			<label id="l_red"><input type="radio" id="r_red" name="color_name" value="red" onclick="this.form.submit();" />Red</label> (<label id="c_red"><?php echo $count['red']; ?></label>) | 
			<label id="l_green"><input type="radio" id="r_green" name="color_name" value="green" onclick="this.form.submit();" />Green</label> (<label id="c_green"><?php echo $count['green']; ?></label>) | 
			<label id="l_blue"><input type="radio" id="r_blue" name="color_name" value="blue" onclick="this.form.submit();" />Blue</label> (<label id="c_blue"><?php echo $count['blue']; ?></label>) | 
			<label id="l_black"><input type="radio" id="r_black" name="color_name" value="black" onclick="this.form.submit();" />Black</label> (<label id="c_black"><?php echo $count['black']; ?></label>)
		</form>
		
		<p>
			<a href="example2.htm">How To Increment A Counter In MySQL Based On A Radio Button Click Example 2: Using jQuery and AJAX</a>
		</p>
		<p>
			<a href="https://www.dougv.com/2012/04/06/how-to-increment-a-counter-in-mysql-based-on-a-radio-button-click">How To Increment A Counter In MySQL Based On A Radio Button Click</a>
		</p>
	</body>
</html>
