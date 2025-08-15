<?php

namespace App\Filament\Resources\Posts\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Posts\PostResource;
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
			CreateAction::make(),
		];
	}

	protected function paginateTableQuery(Builder $query): Paginator
	{
		return $query->simplePaginate(($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage());
	}
}
