<?php

namespace App\Utils;

use Exception;

class YoutubeUtil
{
	public static function getVideoId(string $url): string|bool
	{
		if (strpos(strtolower($url), 'youtube.com') !== false || strpos(strtolower($url), 'youtu.be') !== false) {
			$videoId = '';

			if (strpos(strtolower($url), '/shorts/') !== false) {
				$urlPath = parse_url($url, PHP_URL_PATH);
				$videoId = substr($urlPath, strrpos($urlPath, '/') + 1, strlen($urlPath));
			} else {
				preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
				$videoId = $matches[0];
			}

			return $videoId;
		}

		return false;
	}

	public static function parse(string $url): string|bool
	{
		try {
			$videoId = static::getVideoId($url);

			$html = '<iframe class="w-full aspect-video" src="https://www.youtube.com/embed/%s?autoplay=1" '
				. 'allow="accelerometer; autoplay; encrypted-media; gyroscope; gyroscope; picture-in-picture; web-share" '
				. 'referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>'
				. '</iframe>';

			return sprintf($html, $videoId);
		} catch (Exception $e) {
			return false;
		}

		return false;
	}

	public static function getThumbnailURL(string $url, string $quality = 'default'): string
	{
		try {
			$videoId = static::getVideoId($url);

			if ($quality == 'high') {
				return sprintf('https://img.youtube.com/vi/%s/maxresdefault.jpg', $videoId);
			}

			return sprintf('https://img.youtube.com/vi/%s/mqdefault.jpg', $videoId);
		} catch (Exception $e) {
			return null;
		}
	}
}
