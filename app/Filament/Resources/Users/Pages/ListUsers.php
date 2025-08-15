<?php

namespace App\Filament\Resources\Users\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
	protected static string $resource = UserResource::class;

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
