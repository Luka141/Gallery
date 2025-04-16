<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Video;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteAction;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->required(),
                
                Textarea::make('description'),

                FileUpload::make('file_path')
                ->label("video")
                ->directory('videos')
                ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/x-msvideo'])
                ->required(),

                FileUpload::make('thumbnail_path')
                ->label('Thumbnail')
                ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable(),

                ImageColumn::make('thumbnail_path')
                ->label('Thumbnail')
                ->url(function ($record) {
                    return $record->getThumbnailFullUrl();
                })
                ->square(),

                TextColumn::make('title')
                ->searchable()
                ->sortable(),

                TextColumn::make('description')   
                ->limit(20)
                ->tooltip(function ($record) {
                    return $record->description;
                })
                ->searchable(),

                TextColumn::make('created_at')
                ->label('Created')
                ->dateTime('y-m-d')
                ->sortable(),
                
            ])
            // ->filters([
            //     //
            // ])
            ->recordUrl(false)
            
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
                Tables\Actions\Action::make('view')
                ->label('view')
                ->url(function (Video $record) {
                    return $record->getVideoFullUrl();
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
