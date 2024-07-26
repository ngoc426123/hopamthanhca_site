<?php
if (!function_exists('pr')) {
  function pr($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
  }
}

if (!function_exists('getListDate')) {
	function getListDate($option){
		$return = array(
			'day' => [],
			'month' => [],
			'year' => [],
		);
		$date = date('m/d/yy h:m:s');
		switch ($option) {
			// LAST WEEK
			case 'last-month':
				$jday = (int)date('t', strtotime('last month', strtotime($date)));
				$month = (int)date('m', strtotime('last month', strtotime($date)));
				$year = (int)date('yy', strtotime('last month', strtotime($date)));
				for ($i=1; $i <= $jday; $i++) { 
					$return['day'][]=(int)date('d',mktime(0, 0 ,0, $month, $i, $year));
					$return['month'][]=(int)date('m',mktime(0, 0 ,0, $month, $i, $year));
					$return['year'][]=(int)date('yy',mktime(0, 0 ,0, $month, $i, $year));
				}
				break;
			case 'last-week':
				$first_day = array(
					'day' => (int)date('d', strtotime('monday last week', strtotime($date))),
					'month' => (int)date('m', strtotime('monday last week', strtotime($date))),
					'year' => (int)date('yy', strtotime('monday last week', strtotime($date))),
				);
				
				for ($i=0; $i <= 6; $i++) { 
					$return['day'][]=(int)date('d',mktime(0, 0, 0, $first_day['month'], $first_day['day']+$i, $first_day['year']));
					$return['month'][]=(int)date('m',mktime(0, 0, 0, $first_day['month'], $first_day['day']+$i, $first_day['year']));
					$return['year'][]=(int)date('yy',mktime(0, 0, 0, $first_day['month'], $first_day['day']+$i, $first_day['year']));
				}
				break;
			// YESTERDAY
			case 'yesterday':
				$return['day'][] = (int)date('d', strtotime('yesterday', strtotime($date)));
				$return['month'][] = (int)date('m', strtotime('yesterday', strtotime($date)));
				$return['year'][] = (int)date('yy', strtotime('yesterday', strtotime($date)));
				break;
			// TODAY
			case 'today':
				$return['day'][] = (int)date('d',strtotime('today', strtotime($date)));
				$return['month'][] = (int)date('m',strtotime('today', strtotime($date)));
				$return['year'][] = (int)date('yy',strtotime('today', strtotime($date)));
				break;
			// WEEK
			case 'week':
				$first_day = array(
					'day' => (int)date('d', strtotime('monday this week', strtotime($date))),
					'month' => (int)date('m', strtotime('monday this week', strtotime($date))),
					'year' => (int)date('yy', strtotime('monday this week', strtotime($date))),
				);
				for ($i=0; $i <= 6; $i++) {
					$return['day'][]=(int)date('d',mktime(0, 0, 0, $first_day['month'], $first_day['day']+$i, $first_day['year']));
					$return['month'][]=(int)date('m',mktime(0, 0, 0, $first_day['month'], $first_day['day']+$i, $first_day['year']));
					$return['year'][]=(int)date('yy',mktime(0, 0, 0, $first_day['month'], $first_day['day']+$i, $first_day['year']));
				}
				break;
			case 'month':
				$jday = (int)date('t',strtotime('today', strtotime($date)));
				$month = (int)date('m',strtotime('today', strtotime($date)));
				$year = (int)date('yy',strtotime('today', strtotime($date)));
				for ($i=1; $i <= $jday; $i++) { 
					$return['day'][]=(int)date('d',mktime(0, 0, 0, $month, $i, $year));
					$return['month'][]=(int)date('m',mktime(0, 0, 0, $month, $i, $year));
					$return['year'][]=(int)date('yy',mktime(0, 0, 0, $month, $i, $year));
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

if (!function_exists('renderAuthor')) {
	function renderAuthor($arrayAuthor) {
		$author = '';

		foreach ($arrayAuthor as $key => $value) {
			$author .= ($key > 0 ? ', ' : '') . $value['cat_name'];
		}

		return $author;
	}
}
?>