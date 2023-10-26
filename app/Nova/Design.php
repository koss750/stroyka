<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use App\Nova\Filters\CategoryFilter;
use Illuminate\Support\Facades\Lang;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\MorphToMany;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Http\Requests\NovaRequest;
use Handleglobal\NestedForm\NestedForm;
use InteractionDesignFoundation\HtmlCard\HtmlCard;
use Laravel\Nova\Card;
use Laravel\Nova\Panel;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;
use HasTranslations;

class Design extends Resource
{
	/**
	 * The model the resource corresponds to.
	 *
	 * @var class-string<\App\Models\Design>
	 */
	public static $model = 'App\Models\Design';

    public static $title = ('title');

    public static $search = [
        'id', 'title', 'category', 'code'
    ];
    
    private function translateCode($cat,$key) {
        return $this->translatedSelects($cat)[$key] ?? null;
    }
    
    public function trimZero($value) {
        $output = (float)$value;
        if ($output == null) {
            return " ";
        } else return $output;
    }
    
    public function translatedSelects($cat)
{
    switch ($cat) {
        case "category":
            return [
                "df_cat_1" => "Дома из профилированного бруса",
                  "df_cat_2" => "Бани из клееного бруса",
                  "df_cat_3" => "Дома из блоков",
                  "df_cat_4" => "Дома из оцилиндрованного бревна",
                  "df_cat_5" => "Бани из бруса камерной сушки",
                  "df_cat_6" => "Бани из бруса сосна/ель",
                  "df_cat_7" => "Бани из оцилиндрованного бревна",
                  "df_cat_8" => "Дом-баня из бруса",
                  "df_cat_9" => "Дома из бруса камерной сушки",
                  "df_cat_10" => "Дома из клееного бруса",
                  "df_cat_11" => "Бани с бассейном",
                  "df_cat_12" => "Каркасные дома",
                  "df_cat_13" => "Бани из бревна кедра",
                  "df_cat_14" => "Бани из бревна лиственницы",
                  "df_cat_15" => "Бани из бруса кедра",
                  "df_cat_16" => "Бани из бруса лиственницы",
                  "df_cat_17" => "Дачные дома",
                  "df_cat_18" => "Дом-баня из бревна",
                  "df_cat_19" => "Дома из бревна кедра",
                  "df_cat_20" => "Дома из бревна лиственницы",
                  "df_cat_21" => "Дома из бруса кедра",
                  "df_cat_22" => "Дома из бруса лиственницы"
                ];
        case "rooms":
            return [
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
                    ];
        case "materialType":
            return [
                    "Не установлено" => "Не установлено",
                    "Бревно" => "Бревно",
                    "Брус" => "Брус",
                    "Блочный" => "Блочный",
                    "Каркасный" => "Каркасный",
                    "Фарферк" => "Фарферк"
                    ];
        case "baseType":
            return [
                    '1 этаж' => '1 этаж',
                '2 этажа' => '2 этажа',
                '2 этажа (мансарда)' => '2 этажа (мансарда)',
                '2 этажа + мансарда' => '2 этажа + мансарда',
                '3 этажа' => '3 этажа'
                    ];
    }
    
    //public function generatePanel 
}



    public function fields(Request $request)
    {
  
        return [
            ID::make()->sortable()->hide(),
            
            
            
            Panel::make('Главное', [
                
                Text::make($this->translateKey('title'), 'title')->sortable(),
                
                Boolean::make('Активен', 'active')
            ->trueValue(true)
            ->falseValue(false),
                
                Text::make(__('Category'), function () {
                return $this->translateCode("category", $this->category);
                    })->exceptOnForms(),
                Select::make(__('Category'), 'category')->options($this->translatedSelects("category"))->onlyOnForms(),
                
                //size (Площадь)
                Text::make($this->translateKey('size'), 'size')->onlyOnForms()->hideFromIndex(),
                Number::make($this->translateKey('size'), 'size')->sortable()->displayUsing(function ($value) {
                    return (float)($value);
                })->exceptOnForms(),
                
                //length
                Text::make($this->translateKey('length'), 'length')->onlyOnForms()->hideFromIndex(),
                Number::make($this->translateKey('length'), 'length')->sortable()->displayUsing(function ($value) {
                    return (float)($value);
                })->exceptOnForms()->hideFromIndex(),
                //width
                Text::make($this->translateKey('width'), 'width')->onlyOnForms()->hideFromIndex(),
                Number::make($this->translateKey('width'), 'width')->displayUsing(function ($value) {
                    return (float)($value);
                })->exceptOnForms()->hideFromIndex(),
                
                Text::make($this->translateKey('code'), 'code')->hideFromIndex(),
                Text::make($this->translateKey('numOrders'), 'numOrders')->hideFromIndex(),
                Select::make(__('materialType'), 'materialType')->options($this->translatedSelects("materialType"))->hideFromIndex(),
                Select::make(__('baseType'), 'baseType')->options($this->translatedSelects("baseType"))->hideFromIndex(),
                //Text::make($this->translateKey('baseType'), 'baseType')->exceptOnForms()->hideFromIndex(),
                //Text::make($this->translateKey('roofType'), 'roofType'),
                Text::make($this->translateKey('roofSquare'), 'roofSquare')->hideFromIndex(),
                Text::make($this->translateKey('mainSquare'), 'mainSquare')->hideFromIndex(),
                Text::make($this->translateKey('baseLength'), 'baseLength')->hideFromIndex(),
                Text::make($this->translateKey('baseD20'), 'baseD20')->hideFromIndex(),
                Text::make($this->translateKey('baseD20F'), 'baseD20F')->hideFromIndex(),
                Text::make($this->translateKey('baseD20Rub'), 'baseD20Rub')->hideFromIndex(),
                Text::make($this->translateKey('baseD20RubF'), 'baseD20RubF')->hideFromIndex(),
                Text::make($this->translateKey('baseBalk1'), 'baseBalk1')->hideFromIndex(),
                ]),
                
            Panel::make('Помещения', [
                
                SimpleRepeatable::make('Помещения', 'floorsList', [
            Select::make('Этаж', 'floors')->options([
                'Цокольный' => 'Цокольный',
                'Первый' => 'Первый',
                'Второй' => 'Второй',
                'Третий' => 'Третий',
                'Чердак' => 'Чердак'
            ])->placeholder('Оставить пустым, если как выше'),
                Select::make('Тип пом-я', 'roomTypes')->options([
                "Крыльцо"    => "Крыльцо",
                "Терраса"    => "Терраса",
                "Закрытая терраса"    => "Закрытая терраса",
                "Навес"    => "Навес",
                "Гараж"    => "Гараж",
                "Тамбур"    => "Тамбур",
                "Холл"    => "Холл",
                "Прихожая"    => "Прихожая",
                "Прачечная"    => "Прачечная",
                 "С/У"     => "С/У",
                 "Кухня"     => "Кухня",
                 "Кухня-гостиная"     => "Кухня-гостиная",
                 "Гостиная"     => "Гостиная",
                 "Котельная"     => "Котельная",
                 "Гардероб"     => "Гардероб",
                 "Кабинет"     => "Кабинет",
                 "Спальня"     => "Спальня",
                 "Комната"     => "Комната",
                 "Гараж"     => "Гараж",
                 "Кладовая"     => "Кладовая",
                 "Парная"     => "Парная",
                 "Помывочная"     => "Помывочная",
                 "Комната отдыха"     => "Комната отдыха",
                 "Балкон"     => "Балкон",
                 "Антресоль"     => "Антресоль",
                 "Второй свет"     => "Второй свет",
                 "Помещение"     => "Помещение",
                 "Чердачное помещение"     => "Чердачное помещение",
                 "Хозблок"     => "Хозблок",
                 "Коридор"     => "Коридор",
                 "Кухня-столовая"     => "Кухня-столовая",
                 "Столовая"     => "Столовая"
                    ]),
                    Text::make("Ширина", "width"),
                    Text::make("Длина", "length"),
                    ])
                  
                    //NestedForm::make('Rooms'),
                
                ]),
            
            Panel::make('Стены и перерубы', [
                
                Text::make($this->translateKey('wallsOut'), 'wallsOut')->hideFromIndex(),
                Text::make($this->translateKey('wallsIn'), 'wallsIn')->hideFromIndex(),
                Text::make($this->translateKey('wallsPerOut'), 'wallsPerOut')->hideFromIndex(),
                Text::make($this->translateKey('wallsPerIn'), 'wallsPerIn')->hideFromIndex(),
                Text::make($this->translateKey('rubRoof'), 'rubRoof')->hideFromIndex(),
                
                ]),
                
            Panel::make('Скаты крыши', [
                SimpleRepeatable::make($this->translateKey('skatLabel'), 'skatList', [
                Text::make("Ширина", "width"),
                Text::make('Длина', "length"),
              ])
                  ->canAddRows(true) // Optional, true by default
                  ->canDeleteRows(true)
                  ->addRowLabel("+ скат"),
            ]),
            
            Panel::make('Пирог кровли', [
                
                Text::make($this->translateKey('stropValue'), 'stropValue')->hideFromIndex(),
                ]),
                
            Panel::make('Стропила', [
                SimpleRepeatable::make($this->translateKey('stropLabel'), 'stropList', [
                Text::make("Скаты стропила, шт", "width"),
                Text::make('Длина', "length"),
              ])
                  ->canAddRows(true) // Optional, true by default
                  ->canDeleteRows(true)
                  ->addRowLabel("+ стропила"),
            ]),
            
            Panel::make('Ендовы', [
                SimpleRepeatable::make($this->translateKey('endovLable'), 'endovList', [
                Text::make("Скаты, шт	", "quantity"),
                Text::make('Длина', "length"),
              ])
                  ->canAddRows(true) // Optional, true by default
                  ->canDeleteRows(true)
                  ->addRowLabel("+ ендовы"),
            ]),
            
            Panel::make('Кровля из металлочерепицы', [
                SimpleRepeatable::make($this->translateKey('metaLabel'), 'metaList', [
                Text::make("Длина листа", "width"),
                Text::make('Количество', "quantity"),
              ])
                  ->canAddRows(true) // Optional, true by default
                  ->canDeleteRows(true)
                  ->addRowLabel("+ лист"),
                
        Text::make($this->translateKey('srKonShir'), 'srKonShir')->hideFromIndex(),
        Text::make($this->translateKey('srKonOneSkat'), 'srKonOneSkat')->hideFromIndex(),
        Text::make($this->translateKey('srPlanVetr'), 'srPlanVetr')->hideFromIndex(),
        Text::make($this->translateKey('srPlanK'), 'srPlanK')->hideFromIndex(),
        Text::make($this->translateKey('srKapelnik'), 'srKapelnik')->hideFromIndex(),
        Text::make($this->translateKey('srEndn'), 'srEndn')->hideFromIndex(),
        Text::make($this->translateKey('srEndv'), 'srEndv')->hideFromIndex(),
        Text::make($this->translateKey('mrSam35'), 'mrSam35')->hideFromIndex(),
        Text::make($this->translateKey('srSam70'), 'srSam70')->hideFromIndex(),
        Text::make($this->translateKey('srPack'), 'srPack')->hideFromIndex(),
        Text::make($this->translateKey('srIzospanAM'), 'srIzospanAM')->hideFromIndex(),
        Text::make($this->translateKey('srIzospanAM35'), 'srIzospanAM35')->hideFromIndex(),
        Text::make($this->translateKey('srLenta'), 'srLenta')->hideFromIndex(),
        Text::make($this->translateKey('srRokvul'), 'srRokvul')->hideFromIndex(),
        Text::make($this->translateKey('srIzospanB'), 'srIzospanB')->hideFromIndex(),
        Text::make($this->translateKey('srIzospanB35'), 'srIzospanB35')->hideFromIndex(),
        Text::make($this->translateKey('srPrimUgol'), 'srPrimUgol')->hideFromIndex(),
        Text::make($this->translateKey('srPrimNakl'), 'srPrimNakl')->hideFromIndex(),
        Text::make($this->translateKey('srUtep150'), 'srUtep150')->hideFromIndex(),
        Text::make($this->translateKey('srUtep200'), 'srUtep200')->hideFromIndex(),
                
            ]),
                
            Panel::make('Кровля мягкая', [
                
            Text::make($this->translateKey('srCherep'), 'srCherep')->hideFromIndex(),
            Text::make($this->translateKey('srKover'), 'srKover')->hideFromIndex(),
            Text::make($this->translateKey('srKonK'), 'srKonK')->hideFromIndex(),
            Text::make($this->translateKey('srMastika1'), 'srMastika1')->hideFromIndex(),
            Text::make($this->translateKey('srMastika'), 'srMastika')->hideFromIndex(),
            Text::make($this->translateKey('mrKon'), 'mrKon')->hideFromIndex(),
            Text::make($this->translateKey('mrEndn'), 'mrEndn')->hideFromIndex(),
            Text::make($this->translateKey('mrPlanVetr'), 'mrPlanVetr')->hideFromIndex(),
            Text::make($this->translateKey('mrPlanKar'), 'mrPlanKar')->hideFromIndex(),
            Text::make($this->translateKey('mrKapelnik'), 'mrKapelnik')->hideFromIndex(),
            Text::make($this->translateKey('mrEndv'), 'mrEndv')->hideFromIndex(),
            Text::make($this->translateKey('srGvozd'), 'srGvozd')->hideFromIndex(),
            Text::make($this->translateKey('mrSam70'), 'mrSam70')->hideFromIndex(),
            Text::make($this->translateKey('mrPack'), 'mrPack')->hideFromIndex(),
            Text::make($this->translateKey('mrIzospanAM'), 'mrIzospanAM')->hideFromIndex(),
            Text::make($this->translateKey('mrIzospanAM35'), 'mrIzospanAM35')->hideFromIndex(),
            Text::make($this->translateKey('mrLenta'), 'mrLenta')->hideFromIndex(),
            Text::make($this->translateKey('mrRokvul'), 'mrRokvul')->hideFromIndex(),
            Text::make($this->translateKey('mrIzospanB'), 'mrIzospanB')->hideFromIndex(),
            Text::make($this->translateKey('mrIzospanB35'), 'mrIzospanB35')->hideFromIndex(),
            Text::make($this->translateKey('mrPrimUgol'), 'mrPrimUgol')->hideFromIndex(),
            Text::make($this->translateKey('mrPrimNakl'), 'mrPrimNakl')->hideFromIndex(),
            Text::make($this->translateKey('srOSB'), 'srOSB')->hideFromIndex(),
            Text::make($this->translateKey('srAero'), 'srAero')->hideFromIndex(),
            Text::make($this->translateKey('srAeroSkat'), 'srAeroSkat')->hideFromIndex(),
            Text::make($this->translateKey('mrUtep200'), 'mrUtep200')->hideFromIndex(),
            Text::make($this->translateKey('mrUtep150'), 'mrUtep150')->hideFromIndex(),
            
            
                
                ]),
                
            Panel::make('Водосточка пластиковая', [
                
                Text::make(__($this->translateKey('pvPart1')), 'pvPart1')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart2')), 'pvPart2')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart3')), 'pvPart3')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart4')), 'pvPart4')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart5')), 'pvPart5')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart6')), 'pvPart6')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart7')), 'pvPart7')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart8')), 'pvPart8')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart9')), 'pvPart9')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart10')), 'pvPart10')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart11')), 'pvPart11')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart12')), 'pvPart12')->hideFromIndex(),
                Text::make(__($this->translateKey('pvPart13')), 'pvPart13')->hideFromIndex(),
                
                
                ]),
                
            Panel::make('Водосточка металлическая', [
                
                Text::make(__($this->translateKey('mvPart1')), 'mvPart1')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart2')), 'mvPart2')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart3')), 'mvPart3')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart4')), 'mvPart4')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart5')), 'mvPart5')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart6')), 'mvPart6')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart7')), 'mvPart7')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart8')), 'mvPart8')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart9')), 'mvPart9')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart10')), 'mvPart10')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart12')), 'mvPart12')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart11')), 'mvPart11')->hideFromIndex(),
                Text::make(__($this->translateKey('mvPart13')), 'mvPart13')->hideFromIndex(),
                
                ]),
                
            Panel::make('Фундамент ленточный', [
                
                 Text::make($this->translateKey('lfLength'), 'lfLength')->hideFromIndex(),
                Text::make($this->translateKey('lfAngleG'), 'lfAngleG')->hideFromIndex(),
                Text::make($this->translateKey('lfAngleT'), 'lfAngleT')->hideFromIndex(),
                Text::make($this->translateKey('lfAngleX'), 'lfAngleX')->hideFromIndex(),
                Text::make($this->translateKey('lfAngle45'), 'lfAngle45')->hideFromIndex(),
                
                ]),
                
            Panel::make('Фундамент винтовой/жб', [
                
                Text::make($this->translateKey('vfLength'), 'vfLength')->hideFromIndex(),
                Text::make($this->translateKey('vfCount'), 'vfCount')->hideFromIndex(),
                Text::make($this->translateKey('vfBalk'), 'vfBalk')->hideFromIndex(),
                
                ]),
                
            Panel::make('Фундамент монолитная плита', [
                
                 Text::make($this->translateKey('mfSquare'), 'mfSquare')->hideFromIndex(),
                
                ]),
                
            Panel::make('Изображения', [
                Images::make('Изображения', 'images') // second parameter is the media collection name
            ->conversionOnIndexView('thumb')
        /*    ->withMeta(['extraAttributes' => [
        'fileInfo' => [
            'name' => function ($value, $disk, $resource) {
                return $resource->filename; // Replace 'name' with the actual attribute name of the file name
            }
            ]]]),*/
         // conversion used to display the image
            //->conversionOnDetailView('mild')
            //->singleImageRules('dimensions:min_width=1000')
            //->rules('required'), // validation rules
    //    NestedForm::make('Floors')->heading("helo")
                ]),
                
        ];
    }

    public function filters(Request $request)
        {
            return [
                new CategoryFilter(),
            ];
        }

	private function translateKey($key) {
		$translations = [
		    "title" => "Название Проекта",
			"category" => "Категория",
"size" => "Площадь",
"length" => "Длина",
"width" => "Ширина",
"code" => "ID проекта",
"numOrders" => "Количество заказов",
"popular" => "",
"prefix" => "",
"price" => "",
"materialType" => "Тип материала",
"floors" => "Брев",
"baseType" => "Этажность",
"roofType" => "Тип Крыши",
"roofSquare" => "S крыши",
"mainSquare" => "Фундамент м.пог",
"baseLength" => "База ОЦБ 200 раб",
"baseD20" => "База ОЦБ 200 с отходом",
"baseD20F" => "База рубленное 200 раб",
"baseD20Rub" => "База рубленное 200 с отходом",
"baseD20RubF" => "База брус 145x140 раб",
"baseBalk1" => "База брус 145x140 с отходом",
"baseBalkF" => "База брус 145x140 раб",
"baseBalk2" => "База брус 145x140 с отходом",
"floorDown" => "Цокольный этаж",
"firstFloorSquare" => "Площадь 1й этаж",
"floorMid" => "Средний этаж",
"skatLabel" => "Скат",
"metaLabel" => "Лист",
"endovLable" => "Ендовы",
"secondFloorSquare" => "Площадь средний этаж",
"floorMid2" => "Второй этаж",
"thrirdFloorSquare" => "Площадь",
"floorUp" => "Верхний этаж",
"roofFloorSquare" => "Крыша площадь",
"wallsOut" => "ОЦБ Стены м2",
"wallsIn" => "ПБ стены м2",
"wallsPerOut" => "ПБ Перерубы пог.м",
"wallsPerIn" => "ОЦБ перерубы пог.м",
"rubRoof" => "Кровля рубероид м2",
"stropValue" => "Объем стропил, м3",
"mrKon" => "Конек широкий шт",
"mrKonOneSkat" => "Конек односкатной крыши шт",
"mrPlanVetr" => "Планка ветровая шт",
"mrPlanKar" => "Карнизная планка шт",
"mrKapelnik" => "Капельники шт",
"mrEndn" => "Конек односкатной крыши шт",
"mrEndv" => "Ендова шт",
"stropLabel" => "Стропила",
"mrSam70" => "Саморез 70 уп",
"mrPack" => "Упаковка шт",
"mrIzospanAM" => "Изоспан АМ 70м2, шт",
"mrIzospanAM35" => "Изоспан АМ 35м2, шт",
"mrLenta" => "Лента клеещая двухсторонняя шт",
"mrRokvul" => "Роквул скандик уп",
"mrIzospanB" => "Изоспан В 70м2, шт",
"mrIzospanB35" => "Изоспан В 35м2, шт",
"mrPrimUgol" => "Примыкание угловое, шт",
"mrPrimNakl" => "Примыкание накладное, шт",
"mrUtep200" => "Утепление кровли 150мм уп",
"mrUtep150" => "Утепление кровли 200мм уп",
"srCherep" => "Гибкая черепица Shnglas коллекция Сальса",
"srKover" => "Подкладочный ковер рул",
"srKonK" => "Конек карниз шт",
"srMastika1" => "Мастика 3.6 кг шт",
"srMastika" => "Мастика 12 кг шт",
"srKonShir" => "Конек широкий шт",
"srKonOneSkat" => "Конек односкатной крыши",
"srPlanVetr" => "Планка ветровая шт",
"srPlanK" => "Карнизная планка шт",
"srKapelnik" => "Капельники шт",
"srEndn" => "Ендова нижняя шт",
"srEndv" => "Ендова верхняя шт",
"srGvozd" => "Гвоздь кровельный уп",
"mrSam35" => "Саморез 35 уп",
"srSam70" => "Саморез 70 уп",
"srPack" => "Упаковка шт",
"srIzospanAM" => "Изоспан АМ 70м2, шт",
"srIzospanAM35" => "Изоспан АМ 35м2, шт",
"srLenta" => "Лента клеещая двухстороняя шт",
"srRokvul" => "Роквул скандик уп",
"srIzospanB" => "Изоспан В 70м2, шт",
"srIzospanB35" => "Изоспан В 35м2, шт",
"srPrimUgol" => "Примыкание угловое, шт",
"srPrimNakl" => "Примыкание накладное, шт",
"srOSB" => "OSB-3 9 мм лист",
"srAero" => "Аэратор конька шт",
"srAeroSkat" => "Аэратор скатный шт",
"srUtep150" => "Утепление кровли 150мм уп",
"srUtep200" => "Утепление кровли 200мм уп",
"pvPart1" => "Желоб 3м, шт",
"pvPart2" => "Соединитель желоба, шт",
"pvPart3" => "Кронштейн желоба, шт",
"pvPart4" => "Заглушка, шт",
"pvPart5" => "Воронка, шт",
"pvPart6" => "Колено, шт",
"pvPart7" => "Отвод, шт",
"pvPart8" => "Труба 3м, шт",
"pvPart9" => "Труба 1м, шт",
"pvPart10" => "Хомут трубы, шт",
"pvPart11" => "Муфта трубы, шт",
"pvPart12" => "Угол желоба 90*, шт",
"mvPart1" => "Желоб 3м, шт",
"mvPart2" => "Соединитель желоба, шт",
"mvPart3" => "Кронштейн желоба, шт",
"mvPart4" => "Заглушка, шт",
"mvPart5" => "Воронка, шт",
"mvPart6" => "Колено, шт",
"mvPart7" => "Отвод, шт",
"mvPart8" => "Труба 3м, шт",
"mvPart9" => "Труба 1м, шт",
"mvPart10" => "Хомут трубы, шт",
"mvPart12" => "Угол желоба 90* внутренний, шт",
"mvPart11" => "Угол желоба 90* внешний, шт",
"pvPart13" => "Угол желоба 135 гр, шт",
"mvPart13" => "Угол желоба наружный 135 гр, шт",
"lfLength" => "Длина, пог. м",
"lfAngleG" => "Углы Г-образные, шт",
"lfAngleT" => "Углы Т-образные, шт",
"lfAngleX" => "Перекрестия +, шт",
"lfAngle45" => "Углы 45 градусов, шт",
"vfLength" => "Длина, пог.м",
"vfCount" => "количество свай, шт",
"vfBalk" => "объем бруса, м3",
"file" => "Изображение",
"mfSquare" => "площадь, м2",
"MetaTitle" => "МЕТА заголовок",
"MetaKeywords" => "META ключевые слова",
"MetaDesc" => "META описание",
"MetaHeader" => "Заголовок элемента",
"rooms" => "Комнаты"
		];
		if ($translations[$key]) {
			return $translations[$key];
		} else return $key;
	}
}