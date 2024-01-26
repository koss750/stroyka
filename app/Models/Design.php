<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Floor;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use HasTranslations;
use Vanilo\Product\Models\Product;
use App\Moodels\DesignPrice;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Design extends Model implements HasMedia
{
	use InteractsWithMedia;
	 /**
	 *      * The table associated with the model.
	 *           *
	 *                * @var string
	 *                     */
	protected $table = 'designs';
	
	public $timestamps = true;

    // Fillable fields for mass assignment
    protected $fillable = [
        'details',
        'created_at',
        'updated_at',
        'category',
        'size',
        'mMetrics',
        'length',
        'width',
        'code',
        'numOrders',
        'materialType',
        'floorsList',
        'baseType',
        'roofType',
        'roofSquare',
        'mainSquare',
        'baseLength',
        'baseD20',
        'baseD20F',
        'baseD20Rub',
        'baseD20RubF',
        'baseBalk1',
        'baseBalkF',
        'baseBalk2',
        'wallsOut',
        'wallsIn',
        'wallsPerOut',
        'wallsPerIn',
        'rubRoof',
        'skatList',
        'krovlaList',
        'stropList',
        'stropValue',
        'endovList',
        'metaList',
        // ... include other fields as needed
    ];

	protected $casts = [
	    'floorsList' => 'json',
	    'category' => 'json',
	    'skatList' => 'json',
	    'stropList' => 'json',
        'endovList' => 'json',
        'metaList' => 'json',
        'krovlaList' => 'json',
        'pvParts' => 'json', // or 'object' if you prefer
        'mvParts' => 'json' // or 'object' if you prefer
    ];
    
    public function designPrices()
    {
        return $this->hasMany(DesignPrice::class);
    }

	/**
	 *      * The attributes that are mass assignable.
	 *           *
	 *                * @var array
	 *                     */
	public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(130)
        ->height(130);
    $this->addMediaConversion('mild')
        ->width(1000)
        ->height(2000);
}

public function registerMediaCollections(): void
{
    $this->addMediaCollection('main')->singleFile();
    $this->addMediaCollection('my_multi_collection');
}

public function setImages(Design $design)
    {
        // Get media entries for this design
        $mediaEntries = Media::where('model_type', 'App\Models\Design')
                             ->where('model_id', $design->id)
                             ->orderBy('order_column')
                             ->get();

        // Initialize an array to hold image URLs
        $imageUrls = [];

        foreach ($mediaEntries as $entry) {
            $fileName = str_replace(' ', '-', $entry->name);
            $url = 'storage/' . $entry->order_column . '/conversions/' . $fileName . '-mild.jpg';
            if ($entry->order_column == 1) {
                // Set the main image URL
                $design->image_url = $url;
            } else {
                // Add to the images array
                $imageUrls[] = $url;
            }
        }

        // Set the images property
        $design->images = $imageUrls;
    }
    
    public function setTitle(Design $design) {
        $homeCategories = [1, 3, 4, 9, 10, 12, 17, 19, 20, 21, 22];
        $saunaCategories = [2, 5, 6, 7, 11, 13, 14, 15, 16];
        $mixedCategories = [18, 8];
    
        $hasHome = false;
        $hasSauna = false;
        $hasMixed = false;
        
        $size = $design->size; // Assuming $size is a property of the design

    $categories = $design->category;
    
        foreach ($categories as $category) {
            $categoryId = intval(str_replace('df_cat_', '', $category)); // Extract the numeric part
    
            if (in_array($categoryId, $mixedCategories)) {
                $hasMixed = true;
                break;
            }
    
            if (in_array($categoryId, $homeCategories)) {
                $hasHome = true;
            } elseif (in_array($categoryId, $saunaCategories)) {
                 $hasSauna = true;
            }
                
        }
    
        if ($hasMixed || ($hasHome && $hasSauna)) {
            $design->title = "Дом/Баня-$size";
        } elseif ($hasHome) {
            $design->title = "Дом-$size";
        } elseif ($hasSauna) {
            $design->title = "Баня-$size";
        }
    }
    
    public function setPrice(Design $design) {
        $price[0] = $design->size*9870;
        //$step = $price[0]/20;
        //for ($x=1;$x++;$x<3) {
        //    $price[$x] = $price[0]+$step*($x+1);
        //}
        $design->price = $price[0];
    }
    
    
    /*
    public function setMainCategory(Design $design) {
        dd($design->category);
        $design->main_category = $design->category[0]["category"];
    }
    */

 public function mainPicture()
    {
        return $this->getFirstMediaUrl('pictures');
    }

public function getShortDescriptionAttribute()
{
        return $this->meta->short_description;
}

public function setShortDescriptionAttribute($values)
{
        $this->meta->short_description = $values;
}

public function foundationExcel($width)
    {
        // Load the template file
        $tapeLength = $tape[0];
        $tapeLength = $tapeLength/10-0.1;
        $tapeWidth = $tape[4];
        if ($tapeWidth == 1) {
             $tapeWidth = 10;
        }
        $tapeWidth = $tapeWidth/10;
        $spreadsheet = IOFactory::load(storage_path('app/foundation.xlsx'));
        
        // Manipulate the spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('D4', $this->lfLength);
        $sheet->setCellValue('D5', $tapeWidth);
        $sheet->setCellValue('D8', $tapeLength);
        $sheet->setCellValue('D9', $this->lfAngleX);
        $sheet->setCellValue('D10', $this->lfAngleT);
        $sheet->setCellValue('D11', $this->lfAngleG);
        $sheet->setCellValue('D12', $this->lfAngle45);
        $sheet->setCellValue('D14', 0.2);
        $sheet->setCellValue('D16', $this->mfSquare);
        
        // Create a writer to save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        
        // Define the file name and path in the storage
        $fileName = 'foundation_' . $this->id . "_" . rand(0,100) . '.xlsx';
        $filePath = "app/public/$fileName";

        // Save the file to storage
        $writer->save(storage_path("$filePath"));
        
        // Return a response for download
        return ("$fileName");
    }
    
    
}

