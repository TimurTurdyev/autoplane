<?php

namespace App\Orchid\Screens\Setting;

use anlutro\LaravelSettings\Facades\Setting;
use App\Http\Requests\SettingRequest;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SettingScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {

        return [
            'phone' => Setting::get('phone'),
            'email' => Setting::get('email'),
            'instagram' => Setting::get('instagram'),
            'working_hours' => Setting::get('working_hours'),
            'location_map' => Setting::get('location_map'),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Настройки';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(
                Layout::rows([
                    Input::make('phone')
                        ->mask('(999) 999-9999')
                        ->title('Телефон'),
                    Input::make('email')
                        ->title('Почта'),
                    Input::make('instagram')
                        ->title('Инстаграм'),
                    Input::make('working_hours')
                        ->title('Время работы'),
                    Input::make('location_map')
                        ->title('Ссылка на карту'),
                ]))
                ->title(__('Связь'))
                ->description(__('Телефон, почта и т.д'))
        ];
    }

    public function save(SettingRequest $request)
    {
        setting()->forgetAll();
        setting()->save();
        setting($request->validated())->save();

        Toast::info(__('Настройки успешно сохранены.'));

        return redirect()->route('settings');
    }
}
