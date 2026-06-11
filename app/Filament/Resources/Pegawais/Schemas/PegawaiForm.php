<?php

namespace App\Filament\Resources\Pegawais\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PegawaiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('nim')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Select::make('gender')
                    ->options(['Laki-laki' => 'Laki laki', 'Perempuan' => 'Perempuan'])
                    ->required(),
                Select::make('divisi_id') // Sudah diubah ke Select agar mendukung relationship
                    ->relationship('divisi', 'nama_divisi')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('jabatan_id') // Sudah diubah ke Select agar mendukung relationship
                    ->relationship('jabatan', 'nama_jabatan')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('tmp_lahir')
                    ->required(),
                DatePicker::make('tgl_lahir')
                    ->required(),
                TextInput::make('hp')
                    ->required(),
                Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('foto') // Koma yang merusak method chain sudah dihapus
                    ->label('Foto Pegawai')
                    ->image()
                    ->directory('pegawai')
                    ->imageEditor()
                    ->maxSize(2048) // Sudah diperbaiki ke camelCase
                    ->nullable(),
            ]);
    }
}