<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostsRelationManager extends RelationManager
{
	protected static string $relationship = 'posts';

	public function form(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('title')->required(),
				TextInput::make('url')
					->label('URL')
					->url()
					->required(),
				Select::make('user_id')
					->relationship('user', 'name')
					->required(),
				Textarea::make('content')
					->columnSpanFull(),
				Toggle::make('private'),
			]);
	}

	public function table(Table $table): Table
	{
		return $table
			->recordTitleAttribute('title')
			->columns([
				TextColumn::make('title')->searchable(),
				TextColumn::make('user.name'),
				ToggleColumn::make('private'),
			])
			->filters([
				//
			])
			->headerActions([
				CreateAction::make(),
			])
			->recordActions([
				EditAction::make(),
				DeleteAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
