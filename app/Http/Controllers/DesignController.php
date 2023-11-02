<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use App\Models\Image;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    public function exportToCsv($headers, $data)
    {
        // Define the CSV filename
        $fileName = 'test.csv';

        // Define the directory where you want to save the CSV file
        $filePath = public_path($fileName);

        // Open the file for writing
        $file = fopen($filePath, 'w');

        // Write the CSV header
        fputcsv($file, $headers["formatted"]);

        // Write each data row as a CSV row
        foreach ($data as $rowData) {
            // Write the row to the CSV
            fputcsv($file, $rowData);
        }

        // Close the file
        fclose($file);
        
        $response['path'] = $filePath;
        $response['fileName'] = $fileName;

        // Generate a response to download the file
        return $response;
    }
    
    public function getHeaders() {
        $designs = Design::first();

        // Get the original column names
        $originalHeader = [];
        foreach ($designs->first()->getAttributes() as $column => $value) {
            $originalHeader[] = $column;
        }
    
        // Translate and add the headers
        $headerRow = [];
        foreach ($originalHeader as $column) {
            $headerRow[] = $this->translateKey($column); // Replace with your translation logic
            }
        return $headerRow;
    }
    
    public function exportAll()
{
    
    $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>';
    // Define the JSON fields
    $jsonFields = ['floorsList', 'metaList', 'stropList', 'skatList', 'endovList'];

    // Retrieve all designs from the database
    $designs = Design::all();
    
    // Convert the data to an HTML table
    $html .= '<table class="table table-striped table-bordered">';
$html .= '<thead class="thead-dark">';

    // Get the original column names
    $originalHeader = [];
    foreach ($designs->first()->getAttributes() as $column => $value) {
        $originalHeader[] = $column;
    }

    // Translate and add the headers
    $headerRow = [];
    foreach ($originalHeader as $column) {
        $headerRow[] = $this->translateKey($column); // Replace with your translation logic
    }
    $html .= '<th>' . implode('</th><th>', $headerRow) . '</th>';
    $html .= '</tr></thead>';
    $html .= '<tbody>';
    
    $formattedRows = [];
    $translatedHeadersArray = $originalHeader;

    foreach ($designs as $design) {
        // Initialize a row for this design
        $rowData = [];
        $headers["original"] = [];
        $headers["formatted"] = [];
        // Add data for each column
        foreach ($originalHeader as $column) {
            $headers["original"][] = $column;
            $headers["formatted"][] = $this->translateKey($column);
            $formattedRows[$design->id][$column] = $design->$column;
            // If it's a JSON field, decode it and format it
            if (in_array($column, $jsonFields)) {
                $jsonValue = json_decode(json_encode($design->$column), true);
                if (is_array($jsonValue)) {
                    $formattedValue = [];
                    foreach ($jsonValue as $floorData) {
                        $formattedFloor = [];
                        foreach ($floorData as $propKey => $propVal) {
                            $formattedFloor[] = $this->translateKey($propKey) . ': ' . $propVal;
                        }
                        $formattedValue[] = '--- ' . implode(', ', $formattedFloor);
                    }
                    $formattedRows[$design->id][$column] = implode('<br>', $formattedValue);
                } else {
                    $formattedRows[$design->id][$column] = '';
                }
            } else {
                if ($column === 'category') {
                $formattedRows[$design->id][$column] = $this->translateKey($design->category);
                }
                else $formattedRows[$design->id][$column] = $design->$column;
            }
            //$formattedRows[] = $rowData;
        }

        // Add the row to the HTML table
        $html .= '<tr>';
        $html .= '<td>' . implode('</td><td>', $rowData) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    // Output the HTML table
    //echo $html;
    
    //dd($originalHeader);
    
    
    echo '</body>
</html>';
    
    $file = $this->exportToCsv($headers, $formattedRows);
    return Response::download($file['path'], $file['fileName'], ['Content-Type: text/csv']);
}


    
    /**
     * Show the form for creating a new resource.*/
    
    public function create(Request $request)
    {
        $title = $request->input('title');
        $pvParts = [
            $request->input('pvPart1'),
            $request->input('pvPart2'),
            $request->input('pvPart3'),
            $request->input('pvPart4'),
            $request->input('pvPart5'),
            $request->input('pvPart6'),
            $request->input('pvPart7'),
            $request->input('pvPart8'),
            $request->input('pvPart9'),
            $request->input('pvPart10'),
            $request->input('pvPart11'),
            $request->input('pvPart12')
            ];
        $serializePv = json_encode($pvParts);
        $mvParts = [
            $request->input('mvPart1'),
            $request->input('mvPart2'),
            $request->input('mvPart3'),
            $request->input('mvPart4'),
            $request->input('mvPart5'),
            $request->input('mvPart6'),
            $request->input('mvPart7'),
            $request->input('mvPart8'),
            $request->input('mvPart9'),
            $request->input('mvPart10'),
            $request->input('mvPart11'),
            $request->input('mvPart12')
            ];
        $meta = [
            $request->input('MetaTitle'),
            $request->input('MetaKeywords'),
            $request->input('MetaDesc'),
            $request->input('MetaHeader')
        ];
        $serializeMv = json_encode($mvParts);
        $serializeMeta = json_encode($meta);
        
        // Create a new Design instance
        $design = new Design();
        $design->title = $title;
        $design->pvPart1 = $serializePv;
        $design->mvPart1 = $serializeMv;
        $design->Meta = $serializeMeta;
        

        // Save the design to the database
        $design->save();
        
        // Upload and save the associated imagesy
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
    
                $imageModel = new Image();
                $imageModel->filename = $path;
                // Set any additional image properties...
                
                $design->images()->save($imageModel);
            }
        }
    }
         
 public function store(Request $request)
    {
        /*Validate and process the request data*/
        $validatedData = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'size' => 'required|string',
            'length' => 'required|string',
            'width' => 'required|string',
            'code' => 'required|string',
            'numOrders' => 'required|integer',
            // ... Add validation rules for other properties ...
        ]);

        // Create a new design instance
        $design = Design::create($validatedData);

        // Process and save rooms data
        if ($request->has('rooms')) {
            $roomsData = $request->input('rooms');
            $rooms = [];

            foreach ($roomsData as $roomData) {
                $room = new Room($roomData);
                $rooms[] = $room;
            }

            $design->rooms()->saveMany($rooms);
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Design saved successfully!');
    }

    public function updateOrder(Request $request, $id)
    {
        
        $design = Design::findOrFail($id);
        $design->order = $request->input('order');
        $design->save();

        return response()->json(['message' => 'Order updated successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Design $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Design $design)
    {
        //
    }
    
    public function translateKey ($key) {
        
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
            "floors" => "Этаж",
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
            "roomTypes" => "помещение",
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
            "rooms" => "Комнаты",
            "created_at" => "Создано",
            "updated_at" => "Обновлено",
            "width" => "Ширина",
            "Types" => "Комната",
            "length" => "Длина",
            "id" => 'ID',
            "floorsList" => "Список этажей",
            "quantity" => "Кол-во",
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
		if ($key && !(is_array($key))) {
		if (isset($translations[$key])) {
			return $translations[$key];
		} else {
		    return $key;
		}}
    }
    
}
