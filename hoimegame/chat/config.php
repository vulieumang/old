<?php

/* PLEASE DO NOT ALLOW EVEN ONE BLANK SPACE/LINE IN THIS FILE OUTSIDE '<?php' AND '?>' */

$salt='8ssahxigbrk5j0w9';                          // Salt. A salt consists of random chars used as one of the inputs of a one-way function (MD5 hash). DO NOT CHANGE!


/* ------ BLAB! DATABASE SETTINGS ------  */

$dbss=array();
$dbss['type']='mysql';                  // Database type, *lowercase* (options: mysql, mysqli, postgre, sqlite, pdo_sqlite)
$dbss['host']='localhost';                  // Database host (in most cases 'localhost', on Windows systems - use '127.0.0.1' instead of 'localhost' to avoid a php/ipv6 bug)
$dbss['user']='socks_vuchat';                  // Database user (not used with sqlite)
$dbss['pass']='@dlu2012';                  // Database password  (not used with sqlite)
$dbss['name']='socks_vuchat';                  // Database name [mysql, postgre]. Note that the installation script cannot create a database for you!
$dbss['prfx']='blab6';                  // Table prefix for BLAB! tables, default 'blab6'
$dbss['sqlt']='';                  // Database file [sqlite only]: 'path/filename', a file CHMODed to 777 in a dir that is CHMODed to 777
$dbss['sqlp']=0;                   // SQLITE only: PRAGMA synchronous; options: 0|1|2; 0 = OFF /fastest/; 1= NORMAL; 2 = FULL /slowest/
$dbss['pcon']=0;                   // [0 or 1] Establishes a persistent connection to the SQL server. If you are not sure leave it 0.


/* ------- ADDITIONAL SETTINGS ------- */

$skin_dir='skin_default';          // Skin directory, no trailing slashes
$css_file='style_1.css';           // Style file in use, options: 'style_1.css', 'style_2.css', 'style_3.css'

$error_log='errors.txt';           // CHMODed to 777 file to store sql errors if any ( it is recommended to rename this file )
$latest_mssg=20;                   // Messages to display when users enter the chat, recommended value: 0-50.
$bwords=array('fuck','bitch');     // Bad words array: $bwords=array('fuck','bitch','etc');  $bwords=0; -> off. Turn it off to save CPU resources. 
$topic='/topic';                   // Topic. If found, the posted text appears with larger letters and clears the screen.

?>