<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use stdClass;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nis')->label('NIS'),
                TextInput::make('name')->label('Nama')->required(),
                Select::make('gender')->label('Jenis Kelamin')->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                ]),
                DatePicker::make('birthday')->label('Tanggal Lahir'),
                Select::make('religion')->label('Agama')->options([
                    'Islam' => 'Islam',
                    'Katolik' => 'Katolik',
                    'Protestan' => 'Protestan',
                    'Hindu' => 'Hindu',
                    'Budha' => 'Budha',
                    'Khonghucu' => 'Khonghucu',
                ]),
                TextInput::make('contact')->label('Nomor HP'),
                FileUpload::make('profile')->directory('Students'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('nis')->label('NIS'),
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('gender')->label('Jenis Kelamin'),
                TextColumn::make('birthday')->label('Tanggal Lahir'),
                TextColumn::make('religion')->label('Agama'),
                TextColumn::make('contact')->label('Nomor HP'),
                ImageColumn::make('profile'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
        // ->headerActions([
        //     Tables\Actions\CreateAction::make(),
        // ]);
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        $locale = app()->getLocale();
        if ($locale == 'id') {
            return 'Siswa';
        } else {
            return 'Students';
        }
    }
}
