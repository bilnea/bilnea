<?php

$wordfence = 'wfvt_XXXXXX';
foreach ($_COOKIE as $name => $content) {
	if (strpos($name, 'wfvt_') === 0) {
		$wordfence = $name;
	}
}

$cookies_list = array(
	'PHPSESSID' => array(
		get_bloginfo('name'),
		get_site_url(),
		'Utilizzato dal linguaggio di programmazione PHP, crea una sessione di navigazione unica che salvare le variabili di sessione. Scade alla fine la navigazione del sito.'
	),
	$wordfence => array(
		'WordFence',
		'https://www.wordfence.com/terms-of-use-and-privacy-policy/',
		'Cookie utilizzato per garantire la sicurezza del sito e prevenire l\'accesso indesiderato. Raccoglie le informazioni dei visitatori e blocca l\'accesso da quelle che possono compromettere la stabilità e la sicurezza del sito.'
	),
	'_ga' => array(
		'Google',
		'https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage',
		'Salvare dati anonimi di navigazione como il tempo della sessione di navegazione è pagine visitate al fine di rendere le statistiche globali sulle visite al sitio web.'
	),
	'_icl_current_language' => array(
		'WPML',
		'https://wpml.org/purchase/privacy-and-security-information/',
		'Usato per visualizzare il contenuto nella lingua selezionata dall\'utente. Passare tra le diverse lingue.'
	)

);

$txt = '';
$txt .= '<div class="legal">'."\n";
$txt .= '<p>Questo sito, come la maggior parte dei portali Internet, utilizza i cookie per migliorare l\'esperienza di navigazione degli utenti. I cookie personalizzano i servizi offerti dal sito, offrendo ogni informazione sull\'utente che potrebbe essere di interesse, in risposta al vostro uso di questo sito. Di seguito troverete informazioni su cosa sono i cookie, che tipo di cookie sono utilizzati in questo sito, come è possibile disabilitare i cookie nel proprio browser o come specificamente disabilitare l\'installazione di cookie di terze parti e cosa succede se vengono disabilitati.</p>'."\n";
$txt .= '<h3>Che cosa sono i cookie?</h3>'."\n";
$txt .= '<p>I cookie sono piccoli file che alcune piattaforme, come ad esempio le pagine web, possono installare sul suo computer, smartphone, tablet o televisore collegato, per accedervi. Le sue funzioni possono essere molteplici: memorizzare le preferenze di navigazione, raccogliere informazioni statistiche, permettere certe funzionalità tecniche, archiviare e recuperare informazioni su abitudini di navigazione o le preferenze di un utente o del suo computer al tal punto che, a volte, a seconda delle informazioni ivi contenute e il modo in cui si utilizza il computer, si può essere in grado di riconoscerlo. Un cookie viene memorizzato su un computer per personalizzare e facilitare al massimo la navigazione e facilità d\'uso. I cookie sono associati solo con un utente e il suo computer e non forniscono riferimenti per dedurre i dati degli utenti. L\'utente può configurare il browser per comunicare o rifiutare l\'installazione dei cookie inviati dal sito web.</p>'."\n";
$txt .= '<h3>Perché sono importanti?</h3>'."\n";
$txt .= '<p>Cookie sono utili per diversi motivi. Da un punto di vista tecnico, permettono alle pagine web di lavorare in modo più agile e su misura sulle preferenze dell\'utente, per esempio, per memorizzare la lingua o la valuta del vostro paese. Aiutano anche i responsabili dei siti web a migliorare i servizi che offrono, grazie alle informazioni statistiche raccolte grazie ai cookie. Infine, servono a rendere la pubblicità che vi mostriamo più efficiente, e grazie alla quale siamo in grado di offrire servizi in forma gratuita.</p>'."\n";
$txt .= '<h3>Come utilizziamo i cookies?</h3>'."\n";
$txt .= '<p>Navigare su questo sito significa che è possibile installare i seguenti tipi di cookie:</p>'."\n";
$txt .= '<h4>Cookies di miglioramento delle prestazioni</h4>'."\n";
$txt .= '<p>Questo tipo di cookie mantiene le vostre preferenze per determinati strumenti o servizi che non dovete reimpostare ogni volta che si visita il nostro sito, e in alcuni casi può essere fornito da terze parti. Esempi di questo tipo di cookie sono: il volume impostato per i lettori multimediali, la gestione delle preferenze di articoli o velocità di riproduzione dei video compatibili. Nel caso di sito e-commerce, sono in grado di mantenere le informazioni del carrello.</p>'."\n";
$txt .= '<h4>Cookies di analisi statistica</h4>'."\n";
$txt .= '<p>Sono quelli che, trattati con cura da noi o da terzi, permettono di quantificare il numero di visitatori e statisticamente analizzare come gli utenti utilizzano i nostri servizi. Grazie a loro siamo in grado di studiare la navigazione nel nostro sito web e migliorare l\'offerta di prodotti o servizi offerti. Questi cookies non saranno associati a tutti i dati personali che possano identificare l\'utente, fornendo informazioni sul comportamento di navigazione in forma anonima.</p>'."\n";
$txt .= '<h4>Cookies di geolocalizzazione</h4>'."\n";
$txt .= '<p>Estas cookies son usadas por programas que intentan localizar geográficamente la situación del ordenador, smartphone, tableta o televisión conectada, para de manera totalmente anónima ofrecerle contenidos y servicios más adecuados.</p>'."\n";
$txt .= '<h4>Cookies di registrazione</h4>'."\n";
$txt .= '<p>Questi sono i cookie che si identificano l’utente registrato e indicano quando si è identificato sul web. Questi cookie vengono utilizzati per identificare l\'account utente e i suoi servizi associati, facilitando in tal modo la sua navigazione. Questi cookies sono mantenuti finché non lasciate l\'account, chiudete il browser o spegnete il dispositivo. Questi cookie possono essere utilizzati in combinazione con i dati analitici per identificare le preferenze individuali sul nostro portale.</p>'."\n";
$txt .= '<h4>Cookie pubblicitari</h4>'."\n";
$txt .= '<p>Sono quelli che, trattati con cura da noi o da terzi, permettono di gestire in modo efficace spazi pubblicitari sul nostro sito web, adattando il contenuto degli annunci al contenuto del servizio richiesto o per l\'utilizzo del nostro sito web. Grazie a questi cookie siamo in grado di conoscere le sue abitudini di navigazione internet e mostrarle pubblicità legata al suo profilo di navigazione.</p>'."\n";
$txt .= '<h4>Altri cookie di terze parti</h4>'."\n";
$txt .= '<p>In alcune delle nostre pagine possono essere installati cookie di terze parti che permettono di gestire e migliorare i servizi offerti. Un esempio di questo uso sono i link ai social network per condividere i nostri contenuti.</p>'."\n";
$txt .= '<h3></h3>'."\n";
$txt .= '<p>Come posso impostare le mie preferenze?</p>'."\n";
$txt .= '<p>È possibile consentire, bloccare o eliminare i cookie installati nel computer mediante la configurazione delle opzioni del tuo browser di internet.</p>'."\n";
$txt .= '<p>Ecco i link dove potrete trovare le informazioni su come è possibile trasformare le proprie preferenze nei principali browser:</p>'."\n";
$txt .= '<ul>'."\n";
$txt .= '<li>Internet Explorer <a href="http://support.microsoft.com/kb/196955/it" target="_blank" rel="nofollow" title="Internet Explorer 5">5</a> / <a href="http://support.microsoft.com/kb/283185/it" target="_blank" rel="nofollow" title="Internet Explorer 6">6</a> / <a href="http://windows.microsoft.com/it-IT/windows-vista/Block-or-allow-cookies" target="_blank" rel="nofollow" title="Internet Explorer 7">7</a> / <a href="http://windows.microsoft.com/it-IT/windows-vista/Block-or-allow-cookies" target="_blank" rel="nofollow" title="Internet Explorer 8">8</a> / <a href="http://windows.microsoft.com/it-IT/windows7/How-to-manage-cookies-in-Internet-Explorer-9" target="_blank" rel="nofollow" title="Internet Explorer™ 9">9</a> / <a href="http://windows.microsoft.com/it-it/internet-explorer/ie-security-privacy-settings#ie=ie-10" target="_blank" rel="nofollow" title="Internet Explorer™ 10">10</a> / <a href="http://windows.microsoft.com/it-it/internet-explorer/ie-security-privacy-settings#ie=ie-11" target="_blank" rel="nofollow" title="Internet Explorer™ 11">11</a></li>'."\n";
$txt .= '<li>Safari <a href="http://www.apple.com/it/support/mac-apps/safari/" target="_blank" rel="nofollow" title="Safari 5">5</a> / <a href="http://www.apple.com/it/support/mac-apps/safari/" target="_blank" rel="nofollow" title="Safari 6">6</a> / <a href="http://support.apple.com/kb/PH17191?viewlocale=it_IT&amp;locale=it_IT" target="_blank" rel="nofollow" title="Safari 7">7</a> / <a href="http://support.apple.com/kb/PH19214?viewlocale=it_IT&amp;locale=it_IT" target="_blank" rel="nofollow" title="Safari 8">8</a> / <a href="http://support.apple.com/kb/HT1677?viewlocale=it_IT" target="_blank" rel="nofollow" title="Safari para iOS">iOS</a></li>'."\n";
$txt .= '<li><a href="https://support.google.com/chrome/answer/95647?hl=it&amp;hlrm=it" target="_blank" rel="nofollow" title="Google Chrome">Google Chrome</a></li>'."\n";
$txt .= '<li><a href="http://support.mozilla.org/it/kb/cookies-informacion-que-los-sitios-web-guardan-en-?redirectlocale=en-US&amp;redirectslug=Cookies" target="_blank" rel="nofollow" title="Mozilla Firefox">Mozilla Firefox</a></li>'."\n";
$txt .= '<li><a href="http://help.opera.com/Windows/11.50/it-IT/cookies.html" target="_blank" rel="nofollow" title="Opera">Opera</a></li>'."\n";
$txt .= '<li><a href="http://support.google.com/android/?hl=it" target="_blank" rel="nofollow" title="">Android</a></li>'."\n";
$txt .= '<li><a href="http://www.windowsphone.com/it-IT/how-to/wp7/web/changing-privacy-and-other-browser-settings" target="_blank" rel="nofollow" title="">Windows Phone</a></li>'."\n";
$txt .= '<li><a href="http://docs.blackberry.com/en/smartphone_users/deliverables/18578/Turn_off_cookies_in_the_browser_60_1072866_11.jsp" target="_blank" rel="nofollow" title="">Blackberry</a></li>'."\n";
$txt .= '</ul>'."\n";
$txt .= '<h3>Che cosa succede se i cookie sono disabilitati?</h3>'."\n";
$txt .= '<p>In caso di blocco o di non accettazione dell\'installazione dei cookie, è possibile che alcuni servizi offerti dal nostro sito web, che hanno bisogno del loro uso, rimangano disabilitate e, di conseguenza, non disponibili per voi così non potrete trarre il massimo vantaggio dal nostro sito web e dalle applicazioni offerte. È anche possibile che le prestazioni del sito possano diminuire.</p>'."\n";
if (b_f_option('b_opt_create-cookies-table') == 1) {
	$txt .= '<h3>Tipos de cookies</h3>'."\n";
	foreach ($_COOKIE as $cookie => $value) {
		if (array_key_exists($cookie, $cookies_list)) {
			$name = get_bloginfo('name');
			if ($cookies_list[$cookie][0] != '') {
				$name = $cookies_list[$cookie][0];
			}
			if ($name == '_ga') {
				$name .= ', _gat';
			}
			if ($name == '_icl_current_language' && isset($_COOKIE['wpml_referer_url'])) {
				$name .= ', wpml_referer_url';
			}
			if ($cookies_list[$cookie][1] != '') {
				$url = '<strong>'.$name.'</strong> <a href="'.$cookies_list[$cookie][1].'" rel="nofollow,noindex" title="Politica de cookies '.$name.'"><strong>[+]</strong></a>';
			} else {
				$url = '<strong>'.$name.'</strong>';
			}
			$txt .= '<table class="cookie_def">'."\n";
			$txt .= '<tr>'."\n";
			$txt .= '<td><strong>'.$cookie.'</strong></td>'."\n";
			$txt .= '<td>'.$url.'</td>'."\n";
			$txt .= '</tr>'."\n";
			$txt .= '<tr>'."\n";
			$txt .= '<td colspan="2">'.$cookies_list[$cookie][2].'</td>'."\n";
			$txt .= '</tr>'."\n";
			$txt .= '</table>'."\n";
		}
	}
}
$txt .= '<h3>L\'accettazione dei cookies</h3>'."\n";
$txt .= '<p>Se si continua la navigazione dopo essere stati informati sulla nostra politica dei Cookie si intende di accettare l\'uso dei cookie.</p>'."\n";
$txt .= '<p>Accedendo a questo sito web o applicazione per la prima volta, verrà visualizzata una finestra in cui si viene informati dell\'uso dei cookie e dove si può vedere questa politica dei cookie. Se l\'utente acconsente all\'utilizzo dei cookie, si continua a navigare o si fa clic su un link sarà considerato che ha acconsentito alla nostra politica dei cookie e quindi a installarli sul suo computer o dispositivo.</p>'."\n";
$txt .= '<p>Oltre a utilizzare i nostri cookie, permettiamo a terzi di impostare i cookie e ad accedervi sul suo computer. Il consenso all\'utilizzo dei cookies da parte di questa azienda è legato alla consultazione di questo sito.</p>'."\n";
$txt .= '<p>Per qualsiasi informazione sull\'utilizzo dei cookie sul nostro sito web si può telefonare al <a href="tel://'.b_f_option('user_phone').'" title="Telefono">'.b_f_option('user_phone').'</a> o mandare un\'e-mail a <a href="mailto:'.b_f_option('user_email').'" title="E-mail">'.b_f_option('user_email').'</a></p>'."\n";
$txt .= '</div>'."\n";

?>