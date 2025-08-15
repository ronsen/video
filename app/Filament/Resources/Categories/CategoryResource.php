<?php

namespace App\Filament\Resources\Categories;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Categories\RelationManagers\PostsRelationManager;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
	protected static ?string $model = Category::class;

	protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-tag';

	protected static ?int $navigationSort = 20;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('name')
					->live(onBlur: true)
					->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
					->required(),
				TextInput::make('slug')->required(),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('name')
					->sortable()
					->searchable(),
				TextColumn::make('slug')
					->sortable()
					->searchable(),
			])
			->filters([
				//
			])
			->recordActions([
				EditAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			])
			->defaultSort('name', 'asc');
	}

	public static function getRelations(): array
	{
		return [
			PostsRelationManager::class,
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListCategories::route('/'),
			'create' => CreateCategory::route('/create'),
			'edit' => EditCategory::route('/{record}/edit'),
		];
	}
}
