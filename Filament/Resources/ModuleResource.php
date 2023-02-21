<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Modules\LAM\Models\Module;


class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static function getNavigationGroup(): ?string
    {
        return config('core.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("type")->default(fn($record)=>\Module::find($record->name)->get("type","module")),
                Tables\Columns\TextColumn::make("requirements")->default(fn($record)=>\Module::find($record->name)->get("requirements",[])),
                Tables\Columns\TextColumn::make("version")->default(fn($record)=>\Module::find($record->name)->get("version","dev")),
                Tables\Columns\BooleanColumn::make("enabled")->default(fn($record)=>\Module::find($record->name)->isEnabled()),
                Tables\Columns\BooleanColumn::make("installed")->default(fn($record)=>\Module::find($record->name)->get("installed",false)),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),

//                Action::make('enable')
//                    ->requiresConfirmation()
//                    ->modalHeading(fn($record)=>"Enable {$record->name} Module")
//                    ->action(function ($record){
//                        $module = \Module::find($record->name);
//                        $module->enable();
//                        redirect(request()->header("Referer"));
//                    })
//                    ->color("success")
//                    ->icon('heroicon-o-eye')
//                    ->size('lg')
//                    ->iconButton()
//                    ->visible(function($record){
//                        $module = \Module::find($record->name);
//                        return auth()->user()->can("modules.manager")
//                            && !\Core::isCore($record->name)
//                            && !$module->isEnabled()
//                            && $record->installed;
//                    }),
//                Action::make('disable')
//                    ->requiresConfirmation()
//                    ->modalHeading(fn($record)=>"Disable {$record->name} Module")
//                    ->action(function ($record){
//                        $module = \Module::find($record->name);
//                        $module->disable();
//                        redirect(request()->header("Referer"));
//                    })
//                    ->icon('heroicon-o-eye-off')
//                    ->size('lg')
//                    ->iconButton()
//                    ->color("warning")
//                    ->visible(function($record){
//                        $module = \Module::find($record->name);
//                        return auth()->user()->can("modules.manager")
//                            && !\Core::isCore($record->name)
//                            && $module->isEnabled()
//                            && $record->installed;
//                    }),
//                Action::make('installation')
//                    ->requiresConfirmation()
//                    ->modalHeading()
//                    ->iconButton()
//                    ->icon('heroicon-o-download')
//                    ->size('lg')
//                    ->color('danger')
//                    ->visible(function ($record):bool{
//                        return !\Core::isCore($record->name) && !$record->installed && auth()->user()->can("modules.manager");
//                    })
//                    ->action(function ($record){
//                        $coreModule = new CoreModule($record->name);
//                        $coreModule->install();
//                        //$record->installed = true;
//                        $record->save();
//                        redirect(request()->header("Referer"));
//                    }),
//                Action::make("uninstallation")
//                    ->modalHeading()
//                    ->iconButton()
//                    ->icon('heroicon-o-trash')
//                    ->size('lg')
//                    ->color('danger')
//                    ->visible(function ($record):bool{
//                        return !\Core::isCore($record->name) && $record->installed && auth()->user()->can("modules.manager");
//                    })
//                    ->action(function($record){
//                        \Core::uninstall($record->name);
//                        $record->installed = false;
//                        $record->save();
//                        redirect(request()->header("Referer"));
//                    })
//                    ->requiresConfirmation(),
//                DeleteAction::make()
//                    ->icon(false)
//                    ->button()
//                    ->after(fn($record)=>Artisan::call("module:delete {$record->name}"))
//                    ->visible(fn($record)=>$record->name != "Core" && auth()->user()->can("modules.manager")),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => \Modules\LAM\Filament\Resources\ModuleResource\Pages\ListModules::route('/'),
            //'create' => Pages\CreateModule::route('/create'),
            //'edit' => Pages\EditModule::route('/{record}/edit'),
        ];
    }
}
