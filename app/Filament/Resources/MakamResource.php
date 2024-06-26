<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakamResource\Pages;
use App\Models\Makam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;


class MakamResource extends Resource
{
    protected static ?string $model = Makam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Data Makam';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nik')
                    ->label('NIK')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'laki-laki' => 'Laki-Laki',
                        'perempuan' => 'Perempuan',
                    ])
                    ->required(),
                Forms\Components\Select::make('agama')
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'katolik' => 'Katolik',
                        'hindu' => 'Hindu',
                        'buddha' => 'Buddha',
                        'khonghucu' => 'khonghucu',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_meninggal')
                    ->required(),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('provinsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kabupaten')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kecamatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kelurahan')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('ahliwaris_id')
                    ->label('Ahli Waris')
                    ->relationship('ahliwaris', 'nama')
                    ->searchable()
                    ->required(),
                    Forms\Components\Select::make('tpu_id')
                    ->relationship('tpu', 'nama_tpu')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('blok')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor')
                    ->required()
                    ->numeric(),
                    Forms\Components\Section::make('foto')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('media')->hiddenLabel()
                            ->collection('makam/foto')
                            ->multiple()
                            ->reorderable()
                            ->required(),
                    ])
                    ->collapsible(),
                Forms\Components\Textarea::make('catatan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('agama'),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tanggal_meninggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kelurahan')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ahliwaris.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tpu.nama_tpu')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('blok')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor')
                    ->numeric()
                    ->sortable(),
                    SpatieMediaLibraryImageColumn::make('media')->label('Foto')
                    ->collection('makam/foto')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->hiddenLabel()->tooltip('Detail'),
                Tables\Actions\EditAction::make()->hiddenLabel()->tooltip('Edit'),
                Tables\Actions\DeleteAction::make()->hiddenLabel()->tooltip('Delete'),
                Tables\Actions\Action::make('QrCode')
                ->url( fn (Makam $record): string => "/pemakaman/makam/qr?id=".$record->id, )
                ->hiddenLabel()
                ->tooltip('Print QR Code')
                ->icon('heroicon-o-qr-code'),
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
            'index' => Pages\ListMakams::route('/'),
            'create' => Pages\CreateMakam::route('/create'),
            'edit' => Pages\EditMakam::route('/{record}/edit'),
        ];
    }
    public static function getWidgets(): array
{
    return [
        MakamResource\Widgets\totalMakam::class,
    ];
}
}
