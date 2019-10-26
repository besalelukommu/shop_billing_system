<?php

$servername='db539689740.db.1and1.com';

// username and password to log onto db server
$dbusername='dbo539689740';
$dbpassword='tNDqb64Y390O0iT';

// name of database
$dbname='db539689740';

////////////////////////////////////////
////// DONOT EDIT BELOW  /////////
///////////////////////////////////////

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;

$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
}

?>