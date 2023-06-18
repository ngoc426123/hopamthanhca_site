<?php
if(!function_exists("pr")){
	function pr($arr) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}

if(!function_exists("convent_song")){
	function convent_song($song){
		$partten = "/(\[\w+(|\#)(|\w+)(|\/\w+)\])/";
		$parttenChord = "/\[|\]/";
		$song = preg_replace_callback($partten, function ($chord) use($partten, $parttenChord) {
			return preg_replace_callback($partten, function ($text) use($parttenChord) {
				$chord = preg_replace($parttenChord, '', $text[0]);
				return "<span class='chordOC'>
					<span class='chordPer'>[</span>
					<span class='chord'>{$chord}</span>
					<span class='chordPer'>]</span>
				</span>";
			}, $chord[0]);
		}, $song);

		return $song;
	}
}

if(!function_exists("get_date_now")){
	function get_date_now(){
    return date('d/m/yy h:m:s');
	}
}

if(!function_exists("get_list_date")){
	function get_list_date($option){
		$return = array(
			"day" => [],
			"month" => [],
			"year" => [],
		);
		$date = date('m/d/yy h:m:s');
		switch ($option) {
			// LAST WEEK
			case 'last-month':
				$jday = (int)date("t",strtotime("last month",strtotime($date)));
				$day = (int)date("d",strtotime("last month",strtotime($date)));
				$month = (int)date("m",strtotime("last month",strtotime($date)));
				$year = (int)date("yy",strtotime("last month",strtotime($date)));
				for ($i=1; $i <= $jday; $i++) { 
					$return["day"][]=(int)date("d",mktime(0,0,0,$month,$i,$year));
					$return["month"][]=(int)date("m",mktime(0,0,0,$month,$i,$year));
					$return["year"][]=(int)date("yy",mktime(0,0,0,$month,$i,$year));
				}
				break;
			case 'last-week':
				$first_day = array(
					"day" => (int)date("d", strtotime('monday last week', strtotime($date))),
					"month" => (int)date("m", strtotime('monday last week', strtotime($date))),
					"year" => (int)date("yy", strtotime('monday last week', strtotime($date))),
				);
				
				for ($i=0; $i <= 6; $i++) { 
					$return["day"][]=(int)date("d",mktime(0,0,0,$first_day["month"],$first_day["day"],$first_day["year"]));
					$return["month"][]=(int)date("m",mktime(0,0,0,$first_day["month"],$first_day["day"]+$i,$first_day["year"]));
					$return["year"][]=(int)date("yy",mktime(0,0,0,$first_day["month"],$first_day["day"]+$i,$first_day["year"]));
				}
				break;
			// YESTERDAY
			case 'yesterday':
				$return["day"][] = (int)date('d', strtotime("yesterday",strtotime($date)));
				$return["month"][] = (int)date('m', strtotime("yesterday",strtotime($date)));
				$return["year"][] = (int)date('yy', strtotime("yesterday",strtotime($date)));
				break;
			// TODAY
			case 'today':
				$return["day"][] = (int)date("d",strtotime("today",strtotime($date)));
				$return["month"][] = (int)date("m",strtotime("today",strtotime($date)));
				$return["year"][] = (int)date("yy",strtotime("today",strtotime($date)));
				break;
			// WEEK
			case 'week':
				$first_day = array(
					"day" => (int)date("d", strtotime('monday this week', strtotime($date))),
					"month" => (int)date("m", strtotime('monday this week', strtotime($date))),
					"year" => (int)date("yy", strtotime('monday this week', strtotime($date))),
				);
				for ($i=0; $i <= 6; $i++) {
					$return["day"][]=(int)date("d",mktime(0,0,0,$first_day["month"],$first_day["day"]+$i,$first_day["year"]));
					$return["month"][]=(int)date("m",mktime(0,0,0,$first_day["month"],$first_day["day"]+$i,$first_day["year"]));
					$return["year"][]=(int)date("yy",mktime(0,0,0,$first_day["month"],$first_day["day"]+$i,$first_day["year"]));
				}
				break;
			case 'month':
				$jday = (int)date("t",strtotime("today",strtotime($date)));
				$day = (int)date("d",strtotime("today",strtotime($date)));
				$month = (int)date("m",strtotime("today",strtotime($date)));
				$year = (int)date("yy",strtotime("today",strtotime($date)));
				for ($i=1; $i <= $jday; $i++) { 
					$return["day"][]=(int)date("d",mktime(0,0,0,$month,$i,$year));
					$return["month"][]=(int)date("m",mktime(0,0,0,$month,$i,$year));
					$return["year"][]=(int)date("yy",mktime(0,0,0,$month,$i,$year));
				}
				break;
			// MONTH
			case 'month':
				break;
			// DEFAULT
			default:
				break;				
		}
		return $return;
	}
}

if(!function_exists("pagination")){
	function pagination($pagecurrent, $perpage, $total, $link, $prefix){
		$number_pagination = ceil($total / $perpage);
		$max_node = 3;
		$max_node_left = $max_node;
		$max_node_left_edge = $max_node_left * 2 - 1;

		$max_node_right = $number_pagination - $max_node + 1;
		$max_node_right_edge = $number_pagination - ( $max_node * 2 ) + 1;

		// JUST <= 1
		if ( $number_pagination <= 1 ) {
			return [];
		}

		// JUST < $max_node
		if ( $number_pagination <= 9 ) {
			$max_node_left = $number_pagination;
			for ( $i = 1 ; $i <= $max_node_left ; $i++) {
				$active = $i == $pagecurrent ? 1: 0;
				$return[] = [
					"type" => "node",
					"number" => $i,
					"link" => base_url("{$link}?{$prefix}={$i}"),
					"active" => $active,
				];
			}
			return $return;
		}

		// LEFT
		if ( $max_node_left <= $pagecurrent && $pagecurrent < $max_node_left_edge ) {
			$max_node_left = $pagecurrent + 1; ;
		}
		for ( $i = 1 ; $i <= $max_node_left ; $i++) {
			$active = $i == $pagecurrent ? 1: 0;
			$return[] = [
				"type" => "node",
				"number" => $i,
				"link" => base_url("{$link}?{$prefix}={$i}"),
				"active" => $active,
			];
		}

		// MID
		if ( $max_node_left_edge <= $pagecurrent && $pagecurrent <= $max_node_right_edge ) {
			$return[] = [
				"type" => "dot",
			];
			for ( $i = ($pagecurrent - 1) ; $i <= ($pagecurrent +1) ; $i++) {
				$active = $i == $pagecurrent ? 1: 0;
				$return[] = [
					"type" => "node",
					"number" => $i,
					"link" => base_url("{$link}?{$prefix}={$i}"),
					"active" => $active,
				];
			}
			$return[] = [
				"type" => "dot",
			];
		} else {
			$return[] = [
				"type" => "dot",
			];
		}
		
		// RIGHT
		if ( $max_node_right_edge < $pagecurrent && $pagecurrent <= $max_node_right ) {
			$max_node_right = $pagecurrent - 1;
		}
		for ($i = $max_node_right; $i <= $number_pagination; $i++) { 
			$active = $i == $pagecurrent ? 1: 0;
			$return[] = [
				"type" => "node",
				"number" => $i,
				"link" => base_url("{$link}?{$prefix}={$i}"),
				"active" => $active,
			];
		}

    return $return;
	}
}

if(!function_exists("date4sitemap")){
	function date4sitemap ($date) {
		$day = substr($date, 0, 2);
		$month = substr($date, 3, 2);
		$year = substr($date, 6, 4);
		$time = substr($date, -8);
		return $year.'-'.$month.'-'.$day;
	}
}

if(!function_exists("is_home")){
	function is_home() {
		$CI =& get_instance();
		return (!$CI->uri->segment(1))? TRUE: FALSE;
	}
}

if (!function_exists('mb_ucfirst')) {
	function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
		$first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
		$str_end = "";
		if ($lower_str_end) {
			$str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
		}
		else {
			$str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
		}
		$str = $first_letter . $str_end;
		return $str;
	}
}

if (!function_exists('breadcrumb')) {
	function breadcrumb($data) {
	?>
		<div class="breadcrumb">
      <ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
      <?php
        foreach($data as $key => $value) {
        ?>
          <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
						<a itemprop="item" href="<?php echo $value["link"] ?>">
							<?php echo ($key === 0) ? '<i class="fa fa-home"></i>' : ''; ?>
							<span itemprop="name"><?php echo $value["title"] ?></span>
						</a>
						<meta itemprop="position" content="1">
					</li>
        <?php
        }
      ?>
      </ul>
    </div>
	<?php
	}
}

if (!function_exists('check_IP_ban_list')) {
	function check_IP_ban_list($ipCheck) {
		$check = false;
		$json = file_get_contents("https://developers.google.com/search/apis/ipranges/googlebot.json");
		$obj = json_decode($json, true);

		foreach ($obj["prefixes"] as $key => $value) {
			foreach($value as $item) {
				if (preg_match("/({$ipCheck})/", $item) == 1) {
					$check = true;
					break;
				}
			}
		}

		return $check;
	}
}

if (!function_exists('IP_writer')) {
	function IP_writer($server) {
		$line = "";
		$myfile = fopen("ip_list.txt", "w") or die("Unable to open file!");
		foreach ($server as $key => $value) {
			$line .= "{$key} => {$value}.\n";
		}
		fwrite($myfile, $line);
		fclose($myfile);
	}
}