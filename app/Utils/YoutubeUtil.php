<?php

namespace App\Utils;

class YoutubeUtil
{
	public static function getVideoId(string $url): string|null
	{
		if (!static::valid($url)) {
			return null;
		}

		$host = parse_url($url, PHP_URL_HOST);

		$videoId = '';

		if (strpos($host, 'youtube.com') !== false) {
			if (strpos($url, 'shorts') !== false) {
				$path = parse_url($url, PHP_URL_PATH);
				$segments = explode('/', trim($path, '/'));
				$videoId = $segments[1];
			} else {
				parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
				$videoId = $queryParams['v'];
			}
		}

		if ($host === 'youtu.be') {
			$path = parse_url($url, PHP_URL_PATH);
			$videoId = ltrim($path, '/');
		}

		return $videoId;
	}

	public static function parse(string $url): string|null
	{
		if (!static::valid($url)) {
			return null;
		}

		$videoId = static::getVideoId($url);

		if (!$videoId) {
			return null;
		}

		$html = '<iframe class="w-full aspect-video" src="https://www.youtube.com/embed/%s?autoplay=1" '
			. 'allow="accelerometer; autoplay; encrypted-media; gyroscope; gyroscope; picture-in-picture; web-share" '
			. 'referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>'
			. '</iframe>';

		return sprintf($html, $videoId);
	}

	public static function getThumbnailURL(string $url, string $quality = 'default'): string|null
	{
		if (!static::valid($url)) {
			return null;
		}

		$videoId = static::getVideoId($url);

		if (!$videoId) {
			return null;
		}

		if ($quality == 'high') {
			return sprintf('https://img.youtube.com/vi/%s/maxresdefault.jpg', $videoId);
		}

		return sprintf('https://img.youtube.com/vi/%s/mqdefault.jpg', $videoId);
	}

	private static function valid(string $url): bool
	{
		return str_contains(strtolower($url), 'youtube.com')
			|| str_contains(strtolower($url), 'youtu.be');
	}
}
