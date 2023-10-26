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

class Design extends Model implements HasMedia
{
	use InteractsWithMedia;
	 /**
	 *      * The table associated with the model.
	 *           *
	 *                * @var string
	 *                     */
	protected $table = 'designs';

	protected $casts = [
	    'floorsList' => 'json',
	    'skatList' => 'json',
	    'stropList' => 'json',
        'endovList' => 'json',
        'metaList' => 'json',
        'krovlaList' => 'json',
        'pvParts' => 'json', // or 'object' if you prefer
        'mvParts' => 'json' // or 'object' if you prefer
    ];
    
    

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

public function getShortDescriptionAttribute()
{
        return $this->meta->short_description;
}

public function setShortDescriptionAttribute($values)
{
        $this->meta->short_description = $values;
}
    
}

