<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource {
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-c-chat-bubble-bottom-center-text';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Blog Management';

    public static function getNavigationBadge(): ?string {
        $count = static::getModel()::whereDate( 'created_at', Carbon::today() )->count();
        return $count > 0 ? ( string ) $count : null;
    }

    public static function form( Form $form ): Form {
        return $form
        ->schema( [
            Forms\Components\Card::make( [
                Forms\Components\Grid::make( 2 )
                ->schema( [
                    Forms\Components\Select::make( 'user_id' )
                    ->relationship( 'user', 'name' )
                    ->required(),

                    Forms\Components\Select::make( 'post_id' )
                    ->relationship( 'post', 'title' )
                    ->required(),
                ] ),

                Forms\Components\Textarea::make( 'comment' )
                ->required()
                ->columnSpanFull(),

                Forms\Components\Toggle::make( 'status' )
                ->required(),
            ] ),
        ] );

    }

    public static function table( Table $table ): Table {
        return $table
        ->columns( [
            Tables\Columns\TextColumn::make( 'user.name' )
            ->searchable()
            ->numeric()
            ->sortable(),
            Tables\Columns\ToggleColumn::make( 'status' )
            ->sortable()
            ->onColor( 'success' )
            ->offColor( 'danger' ),
            Tables\Columns\TextColumn::make( 'post.title' )
            ->numeric()
            ->searchable()
            ->sortable(),
            Tables\Columns\TextColumn::make( 'comment' )
            ->limit( 50 )
            ->sortable(),
            Tables\Columns\TextColumn::make( 'created_at' )
            ->dateTime()
            ->sortable()
            ->toggleable( isToggledHiddenByDefault: true ),
            Tables\Columns\TextColumn::make( 'updated_at' )
            ->dateTime()
            ->sortable()
            ->toggleable( isToggledHiddenByDefault: true ),
        ] )
        ->filters( [
            //
        ] )
        ->actions( [
            Tables\Actions\EditAction::make(),
        ] )
        ->bulkActions( [
            Tables\Actions\BulkActionGroup::make( [
                Tables\Actions\DeleteBulkAction::make(),
            ] ),
        ] );
    }

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListComments::route( '/' ),
            'create' => Pages\CreateComment::route( '/create' ),
            'edit' => Pages\EditComment::route( '/{record}/edit' ),
        ];
    }
}
