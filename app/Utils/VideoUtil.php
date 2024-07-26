<?php

namespace App\Utils;

use Exception;

class VideoUtil
{
	public static function parse($url): string|bool
	{
		try {
			if (strpos(strtolower($url), 'youtube.com') !== false || strpos(strtolower($url), 'youtu.be') !== false) {
				$videoId = '';

				if (strpos(strtolower($url), '/shorts/') !== false) {
					$urlPath = parse_url($url, PHP_URL_PATH);
					$videoId = substr($urlPath, strrpos($urlPath, '/') + 1, strlen($urlPath));
				} else {
					preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
					$videoId = $matches[0];
				}

				$html = '<iframe class="w-full aspect-video" src="https://www.youtube.com/embed/%s" '
					. 'allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

				return sprintf($html, $videoId);
			}
		} catch (Exception $e) {
			return false;
		}

		return false;
	}
}
