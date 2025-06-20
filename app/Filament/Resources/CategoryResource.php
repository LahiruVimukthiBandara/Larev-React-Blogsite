<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource {
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-m-adjustments-horizontal';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Category Management';

    public static function getNavigationBadge(): ?string {
        $count = static::getModel()::whereDate( 'created_at', Carbon::today() )->count();
        return $count > 0 ? ( string ) $count : null;
    }

    public static function form( Form $form ): Form {
        return $form
        ->schema( [

            Card::make()
                ->schema([
                    Forms\Components\TextInput::make( 'name' )
                        ->required()
                        ->reactive()
                        ->live(onBlur:true)
                        ->afterStateUpdated(function($state, callable $set){
                            $set('slug', Str::slug($state));
                        })
                        ->maxLength( 255 ),
                    Forms\Components\TextInput::make( 'slug' )
                        ->required()
                        ->reactive()
                        ->maxLength( 255 ),
                    ])
                ->columns(2),

        ] );
    }

    public static function table( Table $table ): Table {
        return $table
        ->columns( [
            Tables\Columns\TextColumn::make( 'name' )
                ->label('Category')
                ->searchable(),
            Tables\Columns\TextColumn::make( 'slug' )
                ->label('Slug')
                ->searchable(),
            Tables\Columns\TextColumn::make( 'created_at' )
                ->label('Create Date')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make( 'updated_at' )
                ->label('Update Date')
                ->dateTime()
                ->sortable()
                ->toggleable( isToggledHiddenByDefault: true ),
        ] )
        ->filters( [
            //
        ] )
        ->actions( [
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCategories::route( '/' ),
            'create' => Pages\CreateCategory::route( '/create' ),
            'edit' => Pages\EditCategory::route( '/{record}/edit' ),
        ];
    }
}
