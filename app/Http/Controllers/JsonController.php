<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonController extends Controller
{
	const $server_url = "https://jp1.api.riotgames.com/lol"

	const $challengers_url = $server_url . "/league/v3/challengerleagues/by-queue/RANKED_SOLO_5x5?api_key=[APIKEY]"
	const $masters_url = $server_url . "/league/v3/masterleagues/by-queue/RANKED_SOLO_5x5?api_key=[APIKEY]"

 	const $account_url = $server_url . "/summoner/v3/summoners/by-name/[SUMMONERNAME]?api_key=[APIKEY]";

	// const $account_url = $server_url . "/summoner/v3/summoners/[SUMMONERID]?api_key=[APIKEY]"
	const $match_url = $server_url . "/match/v3/matchlists/by-account/[ACCOUNTID]?queue=420&season=11&api_key=[APIKEY]"
	const $game_info_url = $server_url . "/match/v3/matches/[GAMEID]?api_key=[APIKEY]"
	const $game_timeline_url = $server_url . "/match/v3/timelines/by-match/[GAMEID]?api_key=[APIKEY]"

	# バージョンはとりあえず決め打ち。　呼び出し元で最新のバージョン取得し、URLを変更する方式に切り替える
	const $champion_url = "http://ddragon.leagueoflegends.com/cdn/8.16.1/data/ja_JP/champion.json"
	const $item_url = "http://ddragon.leagueoflegends.com/cdn/8.16.1/data/ja_JP/item.json"

	public function setAPIKey(string $url) {
		return str_replace("[APIKEY]", config('riotGamesApiKey'), $url);
	}

    public function account(string $summoner_name) {
    	$url = $this->setAPIKey($account_url);
    	$url = str_replace("[SUMMONERNAME]", $summoner_name, $url);
    	return $this->get_json_data($url);
    }

    // https://jp1.api.riotgames.com/lol/match/v3/matchlists/by-account/{ACCOUNTID]?beginIndex=0&champion=75&champion=102&endIndex=50&api_key=[APIKEY]
    public function matches(int $account_id, int[] $champion_ids) {
    	$data = [];

    	foreach($champion_ids as $champion_id) {
    		$url = $this->setAPIKey($match_url);
    		$url = str_replace("[ACCOUNTID]", $champions_ids)
    		$data[] = $this->get_json_data($url);
    	}
    	$url = $this->setAPIKey($match_url);
    	$url = str_replace()
    	return $this->get_json_data($url);
    }

    public function get_json_data(string $url) {

    	$cnt = 0;

    	while(true) {

    		try {
    			if($cnt > 4) {
    				return "";
    			}

		    	sleep(2);

		    	$curl = curl_init();

				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_HEADER, true);   // ヘッダーも出力する

				$response = curl_exec($curl);

				// ステータスコード取得
				$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

				switch($code) {
					// ok
					case 200:
						// header & body 取得
						$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE); // ヘッダサイズ取得
						$header = substr($response, 0, $header_size); // headerだけ切り出し
						$body = substr($response, $header_size); // bodyだけ切り出し
						curl_close($curl);

						// reference: https://qiita.com/re-24/items/bfdd533e5dacecd21a7a
						// ヘッダから必要な要素を取得
						// preg_match('/Total-Count: ([0-9]*)/', $header, $matches); // 取得記事要素数
						// $total_count = $matches[1];

						// json形式で返ってくるので、配列に変換
						return json_decode($body, true);

					// not found
					case 404:
						return "";

					// beyond the rate limit?
					case 429:
						sleep(10);
						break;

					case $code >= 500 and $code <= 599:
						sleep(5);
						break;

					case default:
						return "";

				}

				curl_close($curl);
				$cnt += 1;

			} catch (Exception $e) {
				echo "Exception-" . $e->getMessage();
				$cnt += 1;
			}
		}
	}
}
