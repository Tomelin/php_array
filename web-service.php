<?php
/* require the user as the parameter */
if(isset($_GET['domain']) && isset($_GET['software']) && isset($_GET['version'])) {

	/* soak in the passed variable or set our own */
	$version = $_GET['version']; //0 is the default
	$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
	$software = $_GET['software']; //no default
	$domain = $_GET['domain']; //no default

  /* create array */
	$posts = array(
		"version" => $version,
		"software" => $software,
		"domain" => $domain,
	);

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('posts'=>$posts));
	}
	else {
		header('Content-type: text/xml');
		echo '<posts>';
		foreach($posts as $index => $post) {
			if(is_array($post)) {
				foreach($post as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</posts>';
	}
}

?>
