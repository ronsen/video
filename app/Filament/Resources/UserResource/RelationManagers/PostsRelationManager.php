<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostsRelationManager extends RelationManager
{
	protected static string $relationship = 'posts';

	public function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('title')->required(),
				Forms\Components\TextInput::make('url')
					->label('URL')
					->url()
					->required(),
				Forms\Components\Select::make('categories')
					->relationship('categories', 'name')
					->required(),
				Forms\Components\Textarea::make('content')
					->columnSpanFull(),
				Forms\Components\Toggle::make('private'),
			]);
	}

	public function table(Table $table): Table
	{
		return $table
			->recordTitleAttribute('title')
			->columns([
				Tables\Columns\TextColumn::make('title')->searchable(),
				Tables\Columns\TextColumn::make('categories.name')->listWithLineBreaks(),
				Tables\Columns\ToggleColumn::make('private'),
			])
			->filters([
				//
			])
			->headerActions([
				Tables\Actions\CreateAction::make(),
			])
			->actions([
				Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}
}
