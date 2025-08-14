<?php

namespace App\Utils;

class VideoUtil
{
	public static function parse(string $url): string|null
	{
		if (
			!str_contains(strtolower($url), 'youtube.com') && !str_contains(strtolower($url), 'youtu.be')
		) {
			return null;
		}

		return YoutubeUtil::parse($url);
	}
}
