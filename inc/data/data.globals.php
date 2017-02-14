<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

(function_exists('icl_object_id')) ? $b_g_language = ICL_LANGUAGE_CODE : $b_g_language = 'es';

$b_g_sliders = 0;

$b_g_forms = 1;

$b_g_hash = 'Hrjb(_GfXr%zNr_sB+Sf591j|X4A)WHMJdeqW,>(';

$b_g_google_api = 'AIzaSyAMhKy2BWliADhIlYvQHQTaAOVmWFZ--98';

$b_g_months = array(
	__('January', 'bilnea'),
	__('February', 'bilnea'),
	__('March', 'bilnea'),
	__('April', 'bilnea'),
	__('May', 'bilnea'),
	__('June', 'bilnea'),
	__('July', 'bilnea'),
	__('August', 'bilnea'),
	__('September', 'bilnea'),
	__('October', 'bilnea'),
	__('November', 'bilnea'),
	__('December', 'bilnea')
);

$var_curl = curl_init();
curl_setopt($var_curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($var_curl, CURLOPT_URL, 'https://www.googleapis.com/webfonts/v1/webfonts?key='.$b_g_google_api);
curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

$var_temp_url = curl_exec($var_curl);

curl_close($var_curl);

$var_fonts = json_decode($var_temp_url);

if (isset($var_fonts->error)) {
	$var_curl = curl_init();
	curl_setopt($var_curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($var_curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($var_curl, CURLOPT_URL, get_template_directory_uri().'/inc/data/data.google.fonts.json');
	curl_setopt($var_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

	$var_temp_url = curl_exec($var_curl);
	
	curl_close($var_curl);
}

$var_fonts = json_decode($var_temp_url);

$b_g_google_fonts = array();

foreach ($var_fonts->items as $font) {
	$var_sizes = $font->variants;
	foreach ($var_sizes as &$temp) {
		if ($temp == 'regular') { $temp = '400'; }
		if ($temp == 'italic') { $temp = '400italic'; }
	}
	$b_g_google_fonts[str_replace(' ', '+', $font->family)] = array(
		'name' => '"'.$font->family.'", '.$font->category,
		'sizes' => $var_sizes
	);
}

$b_g_icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJmaWxsOiM4Mjg3OGMiPjxnIGlkPSJpY29tb29uLWlnbm9yZSI+PC9nPjxwYXRoIGQ9Ik0yNTYtMC42NGMtMTQxLjU2OCAwLTI1Ni42NCAxMTUuMDcyLTI1Ni42NCAyNTYuNjRzMTE1LjA3MiAyNTYuNjQgMjU2LjY0IDI1Ni42NCAyNTYuNjQtMTE1LjA3MiAyNTYuNjQtMjU2LjY0LTExNS4wNzItMjU2LjY0LTI1Ni42NC0yNTYuNjR6TTI1Ni4zODQgNDE3LjAyNGMtMC44OTYgMS4yOC0yLjU2IDIuMTc2LTQuMzUyIDIuMTc2LTEuMTUyIDAtMi4wNDgtMC4zODQtMi45NDQtMC42NGwtMC4xMjgtMC4xMjhjLTAuNzY4LTAuMjU2LTEuMjgtMC4zODQtMS42NjQtMC4zODRoLTAuMTI4Yy0wLjY0IDAtMS40MDggMC4yNTYtMi4wNDggMC41MTJzLTEuNTM2IDAuNTEyLTIuNTYgMC41MTJoLTIuNjg4bC0xLjUzNi0xLjkyYy0xLjAyNC0xLjAyNC0xLjQwOC0yLjU2LTEuMTUyLTMuOTY4IDAuMjU2LTIuMzA0IDIuMDQ4LTMuODQgMy40NTYtNC44NjQgMS43OTItMS4xNTIgNC4yMjQtMS45MiA2LjUyOC0xLjkyaDAuMjU2YzIuMzA0IDAgNC43MzYgMC43NjggNi42NTYgMi4xNzYgMS45MiAxLjI4IDIuOTQ0IDIuODE2IDMuMiA0LjQ4bDAuMzg0IDIuMTc2LTEuMjggMS43OTJ6TTI4OC4xMjggMzg2LjE3NmwtMC42NCAxLjE1MmMtMC4yNTYgMC4zODQtMC41MTIgMC43NjgtMC43NjggMS4xNTJsLTAuMTI4IDAuMjU2Yy0xLjc5MiAyLjQzMi00LjYwOCA0LjYwOC03LjkzNiA2LjQtMy41ODQgMS45Mi04LjE5MiAzLjU4NC0xMy40NCA0LjczNi01LjEyIDEuMTUyLTExLjAwOCAxLjc5Mi0xNy4yOCAxLjc5Mi02Ljc4NCAwLjEyOC0xMi42NzItMC41MTItMTcuNzkyLTEuNjY0LTUuMjQ4LTEuMTUyLTkuODU2LTIuODE2LTEzLjQ0LTQuNzM2LTMuMzI4LTEuNzkyLTYuMTQ0LTMuOTY4LTcuODA4LTYuMjcybC0wLjI1Ni0wLjM4NGMtMC4yNTYtMC4zODQtMC41MTItMC43NjgtMC43NjgtMS4wMjRsLTAuNjQtMS4xNTJjLTAuMzg0LTAuODk2LTEuNDA4LTMuMDcyLTAuMjU2LTUuNjMybDEuMTUyLTIuNDMyIDMuNDU2LTAuODk2aDAuNjRjMi44MTYgMCA0LjM1MiAxLjkyIDQuOTkyIDIuNTZsMC41MTIgMC42NGMwLjI1NiAwLjI1NiAwLjM4NCAwLjM4NCAwLjUxMiAwLjUxMiAwLjM4NCAwLjM4NCAxLjc5MiAxLjY2NCA0LjQ4IDMuMDcyIDIuNjg4IDEuMjggNi4yNzIgMi40MzIgMTAuMzY4IDMuMzI4IDQuMjI0IDAuODk2IDkuMjE2IDEuNDA4IDE0LjU5MiAxLjQwOCA1LjI0OCAwIDEwLjI0LTAuNTEyIDE0LjQ2NC0xLjQwOCA0LjA5Ni0wLjg5NiA3LjY4LTIuMDQ4IDEwLjM2OC0zLjMyOHM0LjA5Ni0yLjU2IDQuNjA4LTMuMmMwIDAgMC4yNTYtMC4yNTYgMC4zODQtMC4zODRsMC41MTItMC41MTJjMC42NC0wLjc2OCAyLjE3Ni0yLjY4OCA0Ljk5Mi0yLjY4OGgwLjg5NmwzLjIgMC43NjggMS4xNTIgMi40MzJjMS4xNTIgMi41NiAwLjEyOCA0LjczNi0wLjEyOCA1LjUwNHpNMjQ1Ljc2IDM0Mi45MTJjLTMxLjg3MiAwLTU3LjYtMjUuODU2LTU3LjYtNTcuNnMyNS44NTYtNTcuNiA1Ny42LTU3LjYgNTcuNiAyNS44NTYgNTcuNiA1Ny42LTI1Ljg1NiA1Ny42LTU3LjYgNTcuNnpNMzI1LjEyIDE1Ni41NDRjLTE5LjItMTEuNzc2LTQxLjIxNi0xOC45NDQtNjQuNjQtMjAuMjI0IDAuNzY4LTE2Ljc2OCA0Ljg2NC0zMi42NCAxMS4zOTItNDQuMjg4IDYuMDE2LTEwLjYyNCAxMy42OTYtMTYuNzY4IDIwLjg2NC0xNi43NjhzMTQuNzIgNi4xNDQgMjAuODY0IDE2Ljc2OGM3LjI5NiAxMi45MjggMTEuNTIgMzEuMTA0IDExLjUyIDQ5LjkydjE0LjU5MnpNMzk3LjU2OCA0NTQuNHYtMTY1LjM3NmMwLTQ0LjU0NC0xOC4wNDgtODQuNjA4LTQ2Ljg0OC0xMTIuNTEydi0zNC41NmMwLTUxLjcxMi0yNS40NzItOTIuMjg4LTU3Ljk4NC05Mi4yODgtMzEuMzYgMC01Ni4wNjQgMzcuNjMyLTU3Ljg1NiA4Ni41MjgtNzguMzM2IDIuMDQ4LTE0MS4xODQgNjkuNjMyLTE0MS4xODQgMTUyLjgzMnYxNDguNzM2Yy01MC4wNDgtNDQuNjcyLTgxLjUzNi0xMDkuNTY4LTgxLjUzNi0xODEuNzYgMC0xMzQuNCAxMDkuNDQtMjQzLjg0IDI0My44NC0yNDMuODRzMjQzLjg0IDEwOS40NCAyNDMuODQgMjQzLjg0YzAgODEuNjY0LTQwLjQ0OCAxNTQuMTEyLTEwMi4yNzIgMTk4LjR6Ij48L3BhdGg+PHBhdGggZD0iTTI2Ny45MDQgMjc0LjQzMmMwIDUuNTA0LTQuNDggOS44NTYtOS43MjggOS45ODQgMCAwLjUxMiAwLjEyOCAwLjg5NiAwLjEyOCAxLjQwOCAwIDcuMDQwLTUuNzYgMTIuOC0xMi44IDEyLjgtNy4xNjggMC0xMi45MjgtNS43Ni0xMi44LTEyLjggMC03LjA0MCA1Ljc2LTEyLjggMTIuOC0xMi44IDAuODk2IDAgMS42NjQgMC4xMjggMi41NiAwLjI1NiAwLjY0LTUuMTIgNC44NjQtOC44MzIgOS44NTYtOC44MzIgMC41MTIgMCAxLjAyNCAwIDEuNTM2IDAuMTI4LTQuMDk2LTIuNTYtOC44MzItNC4yMjQtMTMuOTUyLTQuMjI0LTE0LjA4MCAwLTI1LjYgMTEuNTItMjUuNiAyNS42czExLjUyIDI1LjYgMjUuNiAyNS42IDI1LjYtMTEuNTIgMjUuNi0yNS42YzAtNC42MDgtMS4xNTItOC45Ni0zLjItMTIuNDE2IDAgMC4zODQgMCAwLjUxMiAwIDAuODk2eiI+PC9wYXRoPjwvc3ZnPg==';

$b_g_languages = array(
	'ab' => array('name' => 'Abkhaz', 'nativeName' => 'аҧсуа'),
	'aa' => array('name' => 'Afar', 'nativeName' => 'Afaraf'),
	'af' => array('name' => 'Afrikaans', 'nativeName' => 'Afrikaans'),
	'ak' => array('name' => 'Akan', 'nativeName' => 'Akan'),
	'sq' => array('name' => 'Albanian', 'nativeName' => 'Shqip'),
	'am' => array('name' => 'Amharic', 'nativeName' => 'አማርኛ'),
	'ar' => array('name' => 'Arabic', 'nativeName' => 'العربية'),
	'an' => array('name' => 'Aragonese', 'nativeName' => 'Aragonés'),
	'hy' => array('name' => 'Armenian', 'nativeName' => 'Հայերեն'),
	'as' => array('name' => 'Assamese', 'nativeName' => 'অসমীয়া'),
	'av' => array('name' => 'Avaric', 'nativeName' => 'авар мацӀ, магӀарул мацӀ'),
	'ae' => array('name' => 'Avestan', 'nativeName' => 'avesta'),
	'ay' => array('name' => 'Aymara', 'nativeName' => 'aymar aru'),
	'az' => array('name' => 'Azerbaijani', 'nativeName' => 'azərbaycan dili'),
	'bm' => array('name' => 'Bambara', 'nativeName' => 'bamanankan'),
	'ba' => array('name' => 'Bashkir', 'nativeName' => 'башҡорт теле'),
	'eu' => array('name' => 'Basque', 'nativeName' => 'euskara, euskera'),
	'be' => array('name' => 'Belarusian', 'nativeName' => 'Беларуская'),
	'bn' => array('name' => 'Bengali', 'nativeName' => 'বাংলা'),
	'bh' => array('name' => 'Bihari', 'nativeName' => 'भोजपुरी'),
	'bi' => array('name' => 'Bislama', 'nativeName' => 'Bislama'),
	'bs' => array('name' => 'Bosnian', 'nativeName' => 'bosanski jezik'),
	'br' => array('name' => 'Breton', 'nativeName' => 'brezhoneg'),
	'bg' => array('name' => 'Bulgarian', 'nativeName' => 'български език'),
	'my' => array('name' => 'Burmese', 'nativeName' => 'ဗမာစာ'),
	'ca' => array('name' => 'Catalan; Valencian', 'nativeName' => 'Català'),
	'ch' => array('name' => 'Chamorro', 'nativeName' => 'Chamoru'),
	'ce' => array('name' => 'Chechen', 'nativeName' => 'нохчийн мотт'),
	'ny' => array('name' => 'Chichewa; Chewa; Nyanja', 'nativeName' => 'chiCheŵa, chinyanja'),
	'zh' => array('name' => 'Chinese', 'nativeName' => '中文 (Zhōngwén), 汉语, 漢語'),
	'cv' => array('name' => 'Chuvash', 'nativeName' => 'чӑваш чӗлхи'),
	'kw' => array('name' => 'Cornish', 'nativeName' => 'Kernewek'),
	'co' => array('name' => 'Corsican', 'nativeName' => 'corsu, lingua corsa'),
	'cr' => array('name' => 'Cree', 'nativeName' => 'ᓀᐦᐃᔭᐍᐏᐣ'),
	'hr' => array('name' => 'Croatian', 'nativeName' => 'hrvatski'),
	'cs' => array('name' => 'Czech', 'nativeName' => 'česky, čeština'),
	'da' => array('name' => 'Danish', 'nativeName' => 'dansk'),
	'dv' => array('name' => 'Divehi; Dhivehi; Maldivian;', 'nativeName' => 'ދިވެހި'),
	'nl' => array('name' => 'Dutch', 'nativeName' => 'Nederlands, Vlaams'),
	'en' => array('name' => 'English', 'nativeName' => 'English'),
	'eo' => array('name' => 'Esperanto', 'nativeName' => 'Esperanto'),
	'et' => array('name' => 'Estonian', 'nativeName' => 'eesti, eesti keel'),
	'ee' => array('name' => 'Ewe', 'nativeName' => 'Eʋegbe'),
	'fo' => array('name' => 'Faroese', 'nativeName' => 'føroyskt'),
	'fj' => array('name' => 'Fijian', 'nativeName' => 'vosa Vakaviti'),
	'fi' => array('name' => 'Finnish', 'nativeName' => 'suomi, suomen kieli'),
	'fr' => array('name' => 'French', 'nativeName' => 'français, langue française'),
	'ff' => array('name' => 'Fula; Fulah; Pulaar; Pular', 'nativeName' => 'Fulfulde, Pulaar, Pular'),
	'gl' => array('name' => 'Galician', 'nativeName' => 'Galego'),
	'ka' => array('name' => 'Georgian', 'nativeName' => 'ქართული'),
	'de' => array('name' => 'German', 'nativeName' => 'Deutsch'),
	'el' => array('name' => 'Greek, Modern', 'nativeName' => 'Ελληνικά'),
	'gn' => array('name' => 'Guaraní', 'nativeName' => 'Avañeẽ'),
	'gu' => array('name' => 'Gujarati', 'nativeName' => 'ગુજરાતી'),
	'ht' => array('name' => 'Haitian; Haitian Creole', 'nativeName' => 'Kreyòl ayisyen'),
	'ha' => array('name' => 'Hausa', 'nativeName' => 'Hausa, هَوُسَ'),
	'he' => array('name' => 'Hebrew (modern)', 'nativeName' => 'עברית'),
	'hz' => array('name' => 'Herero', 'nativeName' => 'Otjiherero'),
	'hi' => array('name' => 'Hindi', 'nativeName' => 'हिन्दी, हिंदी'),
	'ho' => array('name' => 'Hiri Motu', 'nativeName' => 'Hiri Motu'),
	'hu' => array('name' => 'Hungarian', 'nativeName' => 'Magyar'),
	'ia' => array('name' => 'Interlingua', 'nativeName' => 'Interlingua'),
	'id' => array('name' => 'Indonesian', 'nativeName' => 'Bahasa Indonesia'),
	'ie' => array('name' => 'Interlingue', 'nativeName' => 'Originally called Occidental; then Interlingue after WWII'),
	'ga' => array('name' => 'Irish', 'nativeName' => 'Gaeilge'),
	'ig' => array('name' => 'Igbo', 'nativeName' => 'Asụsụ Igbo'),
	'ik' => array('name' => 'Inupiaq', 'nativeName' => 'Iñupiaq, Iñupiatun'),
	'io' => array('name' => 'Ido', 'nativeName' => 'Ido'),
	'is' => array('name' => 'Icelandic', 'nativeName' => 'Íslenska'),
	'it' => array('name' => 'Italian', 'nativeName' => 'Italiano'),
	'iu' => array('name' => 'Inuktitut', 'nativeName' => 'ᐃᓄᒃᑎᑐᑦ'),
	'ja' => array('name' => 'Japanese', 'nativeName' => '日本語 (にほんご／にっぽんご)'),
	'jv' => array('name' => 'Javanese', 'nativeName' => 'basa Jawa'),
	'kl' => array('name' => 'Kalaallisut, Greenlandic', 'nativeName' => 'kalaallisut, kalaallit oqaasii'),
	'kn' => array('name' => 'Kannada', 'nativeName' => 'ಕನ್ನಡ'),
	'kr' => array('name' => 'Kanuri', 'nativeName' => 'Kanuri'),
	'ks' => array('name' => 'Kashmiri', 'nativeName' => 'कश्मीरी, كشميري‎'),
	'kk' => array('name' => 'Kazakh', 'nativeName' => 'Қазақ тілі'),
	'km' => array('name' => 'Khmer', 'nativeName' => 'ភាសាខ្មែរ'),
	'ki' => array('name' => 'Kikuyu, Gikuyu', 'nativeName' => 'Gĩkũyũ'),
	'rw' => array('name' => 'Kinyarwanda', 'nativeName' => 'Ikinyarwanda'),
	'ky' => array('name' => 'Kirghiz, Kyrgyz', 'nativeName' => 'кыргыз тили'),
	'kv' => array('name' => 'Komi', 'nativeName' => 'коми кыв'),
	'kg' => array('name' => 'Kongo', 'nativeName' => 'KiKongo'),
	'ko' => array('name' => 'Korean', 'nativeName' => '한국어 (韓國語), 조선말 (朝鮮語)'),
	'ku' => array('name' => 'Kurdish', 'nativeName' => 'Kurdî, كوردی‎'),
	'kj' => array('name' => 'Kwanyama, Kuanyama', 'nativeName' => 'Kuanyama'),
	'la' => array('name' => 'Latin', 'nativeName' => 'latine, lingua latina'),
	'lb' => array('name' => 'Luxembourgish, Letzeburgesch', 'nativeName' => 'Lëtzebuergesch'),
	'lg' => array('name' => 'Luganda', 'nativeName' => 'Luganda'),
	'li' => array('name' => 'Limburgish, Limburgan, Limburger', 'nativeName' => 'Limburgs'),
	'ln' => array('name' => 'Lingala', 'nativeName' => 'Lingála'),
	'lo' => array('name' => 'Lao', 'nativeName' => 'ພາສາລາວ'),
	'lt' => array('name' => 'Lithuanian', 'nativeName' => 'lietuvių kalba'),
	'lu' => array('name' => 'Luba-Katanga', 'nativeName' => ''),
	'lv' => array('name' => 'Latvian', 'nativeName' => 'latviešu valoda'),
	'gv' => array('name' => 'Manx', 'nativeName' => 'Gaelg, Gailck'),
	'mk' => array('name' => 'Macedonian', 'nativeName' => 'македонски јазик'),
	'mg' => array('name' => 'Malagasy', 'nativeName' => 'Malagasy fiteny'),
	'ms' => array('name' => 'Malay', 'nativeName' => 'bahasa Melayu, بهاس ملايو‎'),
	'ml' => array('name' => 'Malayalam', 'nativeName' => 'മലയാളം'),
	'mt' => array('name' => 'Maltese', 'nativeName' => 'Malti'),
	'mi' => array('name' => 'Māori', 'nativeName' => 'te reo Māori'),
	'mr' => array('name' => 'Marathi (Marāṭhī)', 'nativeName' => 'मराठी'),
	'mh' => array('name' => 'Marshallese', 'nativeName' => 'Kajin M̧ajeļ'),
	'mn' => array('name' => 'Mongolian', 'nativeName' => 'монгол'),
	'na' => array('name' => 'Nauru', 'nativeName' => 'Ekakairũ Naoero'),
	'nv' => array('name' => 'Navajo, Navaho', 'nativeName' => 'Diné bizaad, Dinékʼehǰí'),
	'nb' => array('name' => 'Norwegian Bokmål', 'nativeName' => 'Norsk bokmål'),
	'nd' => array('name' => 'North Ndebele', 'nativeName' => 'isiNdebele'),
	'ne' => array('name' => 'Nepali', 'nativeName' => 'नेपाली'),
	'ng' => array('name' => 'Ndonga', 'nativeName' => 'Owambo'),
	'nn' => array('name' => 'Norwegian Nynorsk', 'nativeName' => 'Norsk nynorsk'),
	'no' => array('name' => 'Norwegian', 'nativeName' => 'Norsk'),
	'ii' => array('name' => 'Nuosu', 'nativeName' => 'ꆈꌠ꒿ Nuosuhxop'),
	'nr' => array('name' => 'South Ndebele', 'nativeName' => 'isiNdebele'),
	'oc' => array('name' => 'Occitan', 'nativeName' => 'Occitan'),
	'oj' => array('name' => 'Ojibwe, Ojibwa', 'nativeName' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ'),
	'cu' => array('name' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic', 'nativeName' => 'ѩзыкъ словѣньскъ'),
	'om' => array('name' => 'Oromo', 'nativeName' => 'Afaan Oromoo'),
	'or' => array('name' => 'Oriya', 'nativeName' => 'ଓଡ଼ିଆ'),
	'os' => array('name' => 'Ossetian, Ossetic', 'nativeName' => 'ирон æвзаг'),
	'pa' => array('name' => 'Panjabi, Punjabi', 'nativeName' => 'ਪੰਜਾਬੀ, پنجابی‎'),
	'pi' => array('name' => 'Pāli', 'nativeName' => 'पाऴि'),
	'fa' => array('name' => 'Persian', 'nativeName' => 'فارسی'),
	'pl' => array('name' => 'Polish', 'nativeName' => 'polski'),
	'ps' => array('name' => 'Pashto, Pushto', 'nativeName' => 'پښتو'),
	'pt' => array('name' => 'Portuguese', 'nativeName' => 'Português'),
	'qu' => array('name' => 'Quechua', 'nativeName' => 'Runa Simi, Kichwa'),
	'rm' => array('name' => 'Romansh', 'nativeName' => 'rumantsch grischun'),
	'rn' => array('name' => 'Kirundi', 'nativeName' => 'kiRundi'),
	'ro' => array('name' => 'Romanian, Moldavian, Moldovan', 'nativeName' => 'română'),
	'ru' => array('name' => 'Russian', 'nativeName' => 'русский язык'),
	'sa' => array('name' => 'Sanskrit (Saṁskṛta)', 'nativeName' => 'संस्कृतम्'),
	'sc' => array('name' => 'Sardinian', 'nativeName' => 'sardu'),
	'sd' => array('name' => 'Sindhi', 'nativeName' => 'सिन्धी, سنڌي، سندھی‎'),
	'se' => array('name' => 'Northern Sami', 'nativeName' => 'Davvisámegiella'),
	'sm' => array('name' => 'Samoan', 'nativeName' => 'gagana faa Samoa'),
	'sg' => array('name' => 'Sango', 'nativeName' => 'yângâ tî sängö'),
	'sr' => array('name' => 'Serbian', 'nativeName' => 'српски језик'),
	'gd' => array('name' => 'Scottish Gaelic; Gaelic', 'nativeName' => 'Gàidhlig'),
	'sn' => array('name' => 'Shona', 'nativeName' => 'chiShona'),
	'si' => array('name' => 'Sinhala, Sinhalese', 'nativeName' => 'සිංහල'),
	'sk' => array('name' => 'Slovak', 'nativeName' => 'slovenčina'),
	'sl' => array('name' => 'Slovene', 'nativeName' => 'slovenščina'),
	'so' => array('name' => 'Somali', 'nativeName' => 'Soomaaliga, af Soomaali'),
	'st' => array('name' => 'Southern Sotho', 'nativeName' => 'Sesotho'),
	'es' => array('name' => 'Spanish; Castilian', 'nativeName' => 'español, castellano'),
	'su' => array('name' => 'Sundanese', 'nativeName' => 'Basa Sunda'),
	'sw' => array('name' => 'Swahili', 'nativeName' => 'Kiswahili'),
	'ss' => array('name' => 'Swati', 'nativeName' => 'SiSwati'),
	'sv' => array('name' => 'Swedish', 'nativeName' => 'svenska'),
	'ta' => array('name' => 'Tamil', 'nativeName' => 'தமிழ்'),
	'te' => array('name' => 'Telugu', 'nativeName' => 'తెలుగు'),
	'tg' => array('name' => 'Tajik', 'nativeName' => 'тоҷикӣ, toğikī, تاجیکی‎'),
	'th' => array('name' => 'Thai', 'nativeName' => 'ไทย'),
	'ti' => array('name' => 'Tigrinya', 'nativeName' => 'ትግርኛ'),
	'bo' => array('name' => 'Tibetan Standard, Tibetan, Central', 'nativeName' => 'བོད་ཡིག'),
	'tk' => array('name' => 'Turkmen', 'nativeName' => 'Türkmen, Түркмен'),
	'tl' => array('name' => 'Tagalog', 'nativeName' => 'Wikang Tagalog, ᜏᜒᜃᜅ᜔ ᜆᜄᜎᜓᜄ᜔'),
	'tn' => array('name' => 'Tswana', 'nativeName' => 'Setswana'),
	'to' => array('name' => 'Tonga (Tonga Islands)', 'nativeName' => 'faka Tonga'),
	'tr' => array('name' => 'Turkish', 'nativeName' => 'Türkçe'),
	'ts' => array('name' => 'Tsonga', 'nativeName' => 'Xitsonga'),
	'tt' => array('name' => 'Tatar', 'nativeName' => 'татарча, tatarça, تاتارچا‎'),
	'tw' => array('name' => 'Twi', 'nativeName' => 'Twi'),
	'ty' => array('name' => 'Tahitian', 'nativeName' => 'Reo Tahiti'),
	'ug' => array('name' => 'Uighur, Uyghur', 'nativeName' => 'Uyƣurqə, ئۇيغۇرچە‎'),
	'uk' => array('name' => 'Ukrainian', 'nativeName' => 'українська'),
	'ur' => array('name' => 'Urdu', 'nativeName' => 'اردو'),
	'uz' => array('name' => 'Uzbek', 'nativeName' => 'zbek, Ўзбек, أۇزبېك‎'),
	've' => array('name' => 'Venda', 'nativeName' => 'Tshivenḓa'),
	'vi' => array('name' => 'Vietnamese', 'nativeName' => 'Tiếng Việt'),
	'vo' => array('name' => 'Volapük', 'nativeName' => 'Volapük'),
	'wa' => array('name' => 'Walloon', 'nativeName' => 'Walon'),
	'cy' => array('name' => 'Welsh', 'nativeName' => 'Cymraeg'),
	'wo' => array('name' => 'Wolof', 'nativeName' => 'Wollof'),
	'fy' => array('name' => 'Western Frisian', 'nativeName' => 'Frysk'),
	'xh' => array('name' => 'Xhosa', 'nativeName' => 'isiXhosa'),
	'yi' => array('name' => 'Yiddish', 'nativeName' => 'ייִדיש'),
	'yo' => array('name' => 'Yoruba', 'nativeName' => 'Yorùbá'),
	'za' => array('name' => 'Zhuang, Chuang', 'nativeName' => 'Saɯ cueŋƅ, Saw cuengh')
);

?>