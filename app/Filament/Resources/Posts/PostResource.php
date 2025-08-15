<?php

namespace App\Filament\Resources\Posts;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
	protected static ?string $model = Post::class;

	protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static ?int $navigationSort = 10;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('title')->required(),
				TextInput::make('url')
					->label('URL')
					->url()
					->required(),
				Select::make('categories')
					->relationship('categories', 'name')
					->required(),
				Select::make('user_id')
					->relationship('user', 'name')
					->required(),
				Textarea::make('content')
					->columnSpanFull(),
				Toggle::make('private'),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('title')->searchable(),
				TextColumn::make('categories.name')->listWithLineBreaks(),
				TextColumn::make('user.name'),
				ToggleColumn::make('private'),
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
			->defaultSort('id', 'desc');
	}

	public static function getRelations(): array
	{
		return [
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListPosts::route('/'),
			'create' => CreatePost::route('/create'),
			'edit' => EditPost::route('/{record}/edit'),
		];
	}
}
