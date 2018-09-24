<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\champion;

class DBRegisterController extends Controller
{
    public function champion() {
    	$url = "http://ddragon.leagueoflegends.com/cdn/8.18.2/data/ja_JP/champion.json";

    	$json = file_get_contents($url);
    	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

    	$arr = json_decode($json, true);

    	// var_dump($arr['data']);

    	$champions = $arr['data'];

    	Champion::truncate();

    	foreach($champions as $target_champion) {
    		// レク=サイやリー・シンなどにある特殊記号を削除
			$formated_championName =
				preg_replace("/[^ぁ-んァ-ンーa-zA-Z0-9一-龠０-９\-\r]+/u",'' ,$target_champion['name']);

			$champion = new Champion;
			$champion->championId = $target_champion['key'];
			$champion->championName = $formated_championName;
			$champion->championKey = $target_champion['id'];

			$champion->save();
    	}

    	print("ended");
    }
}
