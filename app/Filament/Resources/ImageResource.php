<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;


class ImageResource extends Resource
{
    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required(),

                Textarea::make('description'),

                FileUpload::make('file_path')
                    ->label('Image')
                    ->image()
                    ->directory('images')    
                    ->disk('public')  
                    ->visibility('public')          
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),

                ImageColumn::make('file_path')
                    ->label('Image')    
                    ->square()
                    ->height(40)    
                    ->url(function ($record) {
                        return $record->fullImgFileUrl();
                    })
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                ->limit(20)
                ->tooltip(function ($record) {
                    return $record->description;
                })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Time')
                    ->dateTime('y-m-d h:i')
                    ->sortable(),
            ])

            ->recordUrl(false)
            
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
                Tables\Actions\Action::make('view')
                ->label('view')
                ->url(function (Image $poto) {
                    return $poto->fullImgFileUrl();                  
                })
                ->openUrlInNewTab(),  
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
