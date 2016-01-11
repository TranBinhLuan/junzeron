<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Test component
 */
class TestComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    
    public function getTimeNowWithGMT() {
    	return gmdate ( "Y-m-d H:i:s", time () + TIME_GMT * 3600 );
    }
    public function getHolidays($year) {
    	$holidays = array();
    
    	//Googleカレンダーから、指定年の祝日情報をJSON形式で取得するためのURL
    	$url = sprintf(
    			'http://www.google.com/calendar/feeds/%s/public/full?alt=json&%s&%s',
    			'japanese__ja%40holiday.calendar.google.com',
    			'start-min='.$year.'-01-01',
    			'start-max='.$year.'-12-31'
    	);
    
    	//JSON形式で取得した情報を配列に変換
    	$results = json_decode(file_get_contents($url), true);
    
    	foreach ($results['feed']['entry'] as $value) {
    		$date = str_replace('-', '', $value['gd$when'][0]['startTime']);
    		$holidays[] = $date;
    	}
    
    	//並び替え
    	sort($holidays);
    
    	//配列として祝日を返す
    	return $holidays;
    }
    public function get_holidays_this_month($year, $month){
    	// 月初日
    	$first_day = mktime(0, 0, 0, intval($month), 1, intval($year));
    	// 月末日
    	$last_day = strtotime('-1 day', mktime(0, 0, 0, intval($month) + 1, 1, intval($year)));
    	$api_key = 'YOUR API KEY HERE';
    	$holidays_id = 'outid3el0qkcrsuf89fltf7a4qbacgt9@import.calendar.google.com';  // mozilla.org版
    	//$holidays_id = 'japanese__ja@holiday.calendar.google.com';  // Google 公式版日本語
    	//$holidays_id = 'japanese@holiday.calendar.google.com';  // Google 公式版英語
    	$holidays_url = sprintf(
    			'https://www.googleapis.com/calendar/v3/calendars/%s/events?'.
    			'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
    			$holidays_id,
    			$api_key,
    			date('Y-m-d', $first_day).'T00:00:00Z' ,  // 取得開始日
    			date('Y-m-d', $last_day).'T00:00:00Z' ,   // 取得終了日
    			31            // 最大取得数
    	);
    	if ( $results = file_get_contents($holidays_url) ) {
    		$results = json_decode($results);
    		$holidays = array();
    		foreach ($results->items as $item ) {
    			$date  = strtotime((string) $item->start->date);
    			$title = (string) $item->summary;
    			$holidays[date('Y-m-d', $date)] = $title;
    		}
    		ksort($holidays);
    	}
    	return $holidays;
    }
}
