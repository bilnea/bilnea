<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


class b_f_html_Compression {

	// Settings
	protected $compress_js = false;
	protected $compress_css = false;
	protected $info_comment = true;
	protected $remove_comments = true;

	// Variables
	protected $html;

	public function __construct($html) {

		if (b_f_option('b_opt_minify_js') == 1) {
			$this->compress_js = true;
		}
		if (b_f_option('b_opt_minify_css') == 1) {
			$this->compress_css = true;
		}
		if (!empty($html)) {
			$this->parseHTML($html);
		}

	}

	public function __toString() {
		return $this->html;
	}

	protected function bottomComment($raw, $compressed) {

		$raw = strlen($raw);

		$compressed = strlen($compressed);
		
		$savings = ($raw-$compressed) / $raw * 100;
		
		$savings = round($savings, 2);
		
		return '<script type="text/javascript">console.log(\'Files compressed: '.round(($compressed/1024), 2).'kb (-'.round($savings, 2).'%, -'.round((($raw-$compressed)/1024), 2).'kb)\');</script>';

	}

	protected function minifyHTML($html) {

		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';

		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

		$overriding = false;

		$raw_tag = false;

		// Variable reused for output
		$html = '';

		foreach ($matches as $token) {

			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			
			$content = $token[0];
			
			if (is_null($tag)) {

				if (!empty($token['script'])) {
					if (count($token[0]) <= 2) {
						$strip = false;
					} else {
						$strip = $this->compress_js;
						$regex = '/\/\/.*/';
						$content = preg_replace($regex, '', $content);
					}
				}

				else if (!empty($token['style'])) {
					$strip = $this->compress_css;
				}

				else if ($content == '<!--wp-html-compression no compression-->') {
					$overriding = !$overriding;
					
					// Don't print the comment
					continue;
				}

				else if ($this->remove_comments) {
					if (!$overriding && $raw_tag != 'textarea') {
						// Remove any HTML comments, except MSIE conditional comments
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}

			} else {

				if ($tag == 'pre' || $tag == 'textarea') {
					$raw_tag = $tag;
				} else if ($tag == '/pre' || $tag == '/textarea') {
					$raw_tag = false;
				} else {
					if ($raw_tag || $overriding) {
						$strip = false;
					} else {
						$strip = true;
						
						// Remove any empty attributes, except:
						// action, alt, content, src
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						
						// Remove any space before the end of self-closing XHTML tags
						// JavaScript excluded
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			
			if ($strip) {
				$content = $this->removeWhiteSpace($content);
			}
			
			$html .= $content;
		}
		
		return $html;
	}
		
	public function parseHTML($html) {
		$this->html = $this->minifyHTML($html);
		
		if ($this->info_comment) {
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
	}
	
	protected function removeWhiteSpace($str) {
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		
		return $str;
	}
}

function b_f_html_compression_finish($html) {
	return new b_f_html_Compression($html);
}

function b_f_html_compression_start() {
	ob_start('b_f_html_compression_finish');
}


if (b_f_option('b_opt_minify_js') == 1 || b_f_option('b_opt_minify_css') == 1) {
	add_action('get_header', 'b_f_html_compression_start');
}

?>