<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Periode;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\Classroom;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Resources\RelationManagers\RelationManager;

class ClassroomRelationManager extends RelationManager
{
    protected static string $relationship = 'classroom';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('classroom_id')
                    ->label('Pilih Kelas')
                    ->searchable()
                    ->options(Classroom::all()->pluck('name', 'id'))
                    // ->relationship(name: 'classroom', titleAttribute: 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', \Str::slug($state))),
                        Hidden::make('slug'),

                    ]),
                Select::make('periode_id')
                    ->label('Pilih Periode')
                    ->options(Periode::all()
                        ->pluck('name', 'id'))
                    ->searchable()
                    // ->relationship(name: 'periode', titleAttribute: 'name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', \Str::slug($state))),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('classroom.name'),
                Tables\Columns\TextColumn::make('periode.name'),
                ToggleColumn::make('is_open'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
