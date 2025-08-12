<?php

namespace App\Utils;

class VideoUtil
{
	public static function parse(string $url): string|null
	{
		$url = strtolower($url);

		if (!str_contains($url, 'youtube.com') && !str_contains($url, 'youtu.be')) {
			return null;
		}

		return YoutubeUtil::parse($url);
	}
}
