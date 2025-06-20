<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource {
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Blog Management';

    public static function getNavigationBadge(): ?string {
        $count = static::getModel()::whereDate( 'created_at', Carbon::today() )->count();
        return $count > 0 ? ( string ) $count : null;
    }

    public static function form( Form $form ): Form {
        return $form
        ->schema( [

            Card::make()
            ->schema( [

                Grid::make( 2 )
                ->schema( [
                    Forms\Components\TextInput::make( 'title' )
                    ->required()
                    ->live( onBlur:true )
                    ->afterStateUpdated( function( $state, callable $set ) {
                        $set( 'slug', Str::slug( $state ) );
                    }
                )
                ->maxLength( 255 ),
                Forms\Components\TextInput::make( 'slug' )
                ->required()
                ->maxLength( 255 ),
            ] ),
            Forms\Components\RichEditor::make( 'body' )
            ->required()
            ->columnSpanFull(),

            Forms\Components\DateTimePicker::make( 'published_date' )
            ->required(),
            Forms\Components\Toggle::make( 'active' )
            ->required(),
            Forms\Components\Toggle::make( 'featured' )
            ->required(),

        ] )->columnSpan( 8 ),

        Card::make()
        ->schema( [
            Forms\Components\FileUpload::make( 'thumbnail' ),
            Forms\Components\Select::make( 'category_id' )
            ->relationship( 'categories', 'name' )
            ->multiple()
            ->preload()
            ->required(),
        ] )->columnSpan( 4 )

    ] )->columns( 12 );
}

public static function table( Table $table ): Table {
    return $table
    ->columns( [
            Tables\Columns\ImageColumn::make( 'thumbnail' )
            ->label( 'Thumbnail' ),
            Tables\Columns\TextColumn::make( 'title' )
            ->label( 'Title' )
            ->searchable()
            ->sortable(),
            Tables\Columns\ToggleColumn::make( 'active' )
            ->label( 'Status' )
            ->onColor('success')
            ->offColor('gray')
            ->sortable(),
            ToggleColumn::make('featured')
            ->label('Featured')
            ->onColor('danger')
            ->offColor('gray')
            ->sortable(),
            Tables\Columns\TextColumn::make( 'categories.name' )
            ->label( 'Category' )
            ->badge()
            ->toggleable( isToggledHiddenByDefault: true ),
            Tables\Columns\TextColumn::make( 'published_date' )
            ->label( 'Published Date' )
            ->dateTime()
            ->sortable(),
            Tables\Columns\TextColumn::make( 'user.name' )
            ->label( 'Author' )
            ->numeric()
            ->sortable(),
            Tables\Columns\TextColumn::make( 'created_at' )
            ->label( 'Create Date' )
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
            Tables\Actions\ViewAction::make(),
            // Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPosts::route( '/' ),
            'create' => Pages\CreatePost::route( '/create' ),
            'edit' => Pages\EditPost::route( '/{record}/edit' ),
        ];
    }
}
