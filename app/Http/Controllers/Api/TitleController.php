<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TitleController extends Controller
{
	public function index(Request $request): JsonResponse
	{
		$request->validate([
			'url' => 'required|url'
		]);

		$html = file_get_contents($request->url);

		if ($html === FALSE) {
			return response()->json([
				'url' => $request->url,
				'message' => 'Something went wrong.',
			], 400);
		}

		if (preg_match('/<title>(.*?)<\/title>/', $html, $matches)) {
			return response()->json([
				'url' => $request->url,
				'title' => $matches[1],
			]);
		} else {
			return response()->json([
				'url' => $request->url,
				'message' => 'Title not found.',
			], 400);
		}
	}
}
