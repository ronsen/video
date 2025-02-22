<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
	protected static ?string $model = Category::class;

	protected static ?string $navigationIcon = 'heroicon-o-tag';

	protected static ?int $navigationSort = 20;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('name')
					->live(onBlur: true)
					->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state)))
					->required(),
				Forms\Components\TextInput::make('slug')->required(),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('name')
					->sortable()
					->searchable(),
				Tables\Columns\TextColumn::make('slug')
					->sortable()
					->searchable(),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			])
			->defaultSort('name', 'asc');
	}

	public static function getRelations(): array
	{
		return [
			RelationManagers\PostsRelationManager::class,
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListCategories::route('/'),
			'create' => Pages\CreateCategory::route('/create'),
			'edit' => Pages\EditCategory::route('/{record}/edit'),
		];
	}
}
