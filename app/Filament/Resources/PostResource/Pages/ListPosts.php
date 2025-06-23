<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
	protected static string $resource = PostResource::class;

	protected function getHeaderActions(): array
	{
		return [
			Actions\CreateAction::make(),
		];
	}

	protected function paginateTableQuery(Builder $query): Paginator
	{
		return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
	}
}
