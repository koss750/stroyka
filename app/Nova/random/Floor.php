<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Room;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Handleglobal\NestedForm\NestedForm;

class Floor extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Floor>
     */
    public static $model = \App\Models\Floor::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
         return [
            ID::make()->sortable(),
            Select::make('floor')->options([
                0 => 'Цокольный',
                1 => 'Первый',
                2 => 'Второй',
                3 => 'Третий',
            ]),
            Select::make('type')->options([
                "df_room_1" => "Крыльцо",
                "df_room_2" => "Терраса",
                "df_room_3" => "Закрытая терраса",
                "df_room_4" => "Навес",
                "df_room_5" => "Гараж",
                "df_room_6" => "Тамбур",
                "df_room_7" => "Холл",
                "df_room_8" => "Прихожая",
                "df_room_9" => "Прачечная",
                "df_room_10" => "С/У",
                "df_room_11" => "Кухня",
                "df_room_12" => "Кухня-гостиная",
                "df_room_13" => "Гостиная",
                "df_room_14" => "Котельная",
                "df_room_15" => "Гардероб",
                "df_room_16" => "Кабинет",
                "df_room_17" => "Спальня",
                "df_room_18" => "Комната",
                "df_room_19" => "Гараж",
                "df_room_20" => "Кладовая",
                "df_room_21" => "Парная",
                "df_room_22" => "Помывочная",
                "df_room_23" => "Комната отдыха",
                "df_room_24" => "Балкон",
                "df_room_25" => "Антресоль",
                "df_room_26" => "Второй свет",
                "df_room_27" => "Помещение",
                "df_room_28" => "Чердачное помещение",
                "df_room_29" => "Хозблок",
                "df_room_32" => "Коридор",
                "df_room_33" => "Кухня-столовая",
                "df_room_34" => "Столовая"
            ]),
            Number::make("Ширина", "width"),
            Number::make('Длинна', "length"),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
