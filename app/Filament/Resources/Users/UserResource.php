<?php

namespace App\Filament\Resources\Users;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Users\RelationManagers\PostsRelationManager;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
	protected static ?string $model = User::class;

	protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

	protected static ?int $navigationSort = 100;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('name')->required(),
				TextInput::make('email')
					->email()
					->unique(ignoreRecord: true)
					->required(),
				TextInput::make('password')
					->password()
					->dehydrateStateUsing(fn($state) => Hash::make($state))
					->dehydrated(fn($state) => filled($state))
					->required(fn(string $context): bool => $context === 'create')
					->rule(Password::default()),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('name')
					->sortable()
					->searchable(),
				TextColumn::make('email')
					->sortable()
					->searchable(),
				TextColumn::make('created_at')
					->date(),
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
			]);
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
			'index' => ListUsers::route('/'),
			'create' => CreateUser::route('/create'),
			'edit' => EditUser::route('/{record}/edit'),
		];
	}
}
