{"filter":false,"title":"Media.php","tooltip":"/app/Models/Media.php","undoManager":{"mark":6,"position":6,"stack":[[{"start":{"row":7,"column":6},"end":{"row":7,"column":11},"action":"remove","lines":["Image"],"id":2},{"start":{"row":7,"column":6},"end":{"row":7,"column":7},"action":"insert","lines":["M"]},{"start":{"row":7,"column":7},"end":{"row":7,"column":8},"action":"insert","lines":["e"]},{"start":{"row":7,"column":8},"end":{"row":7,"column":9},"action":"insert","lines":["d"]},{"start":{"row":7,"column":9},"end":{"row":7,"column":10},"action":"insert","lines":["i"]},{"start":{"row":7,"column":10},"end":{"row":7,"column":11},"action":"insert","lines":["a"]}],[{"start":{"row":7,"column":20},"end":{"row":7,"column":25},"action":"remove","lines":["Model"],"id":3},{"start":{"row":7,"column":20},"end":{"row":7,"column":69},"action":"insert","lines":["Spatie\\MediaLibrary\\MediaCollections\\Models\\Media"]}],[{"start":{"row":9,"column":0},"end":{"row":28,"column":1},"action":"remove","lines":["    protected $fillable = ['filename', 'order'];","","    public function design()","    {","        return $this->belongsTo(Design::class);","    }","    ","","public function registerMediaConversions(Media $media = null): void","{","    $this->addMediaConversion('thumb')","        ->width(130)","        ->height(130);","}","","public function registerMediaCollections(): void","{","    $this->addMediaCollection('main')->singleFile();","    $this->addMediaCollection('my_multi_collection');","}"],"id":4}],[{"start":{"row":3,"column":53},"end":{"row":3,"column":54},"action":"insert","lines":[" "],"id":5},{"start":{"row":3,"column":54},"end":{"row":3,"column":55},"action":"insert","lines":["a"]},{"start":{"row":3,"column":55},"end":{"row":3,"column":56},"action":"insert","lines":["s"]}],[{"start":{"row":3,"column":56},"end":{"row":3,"column":57},"action":"insert","lines":[" "],"id":6},{"start":{"row":3,"column":57},"end":{"row":3,"column":58},"action":"insert","lines":["O"]},{"start":{"row":3,"column":58},"end":{"row":3,"column":59},"action":"insert","lines":["r"]},{"start":{"row":3,"column":59},"end":{"row":3,"column":60},"action":"insert","lines":["i"]},{"start":{"row":3,"column":60},"end":{"row":3,"column":61},"action":"insert","lines":["g"]},{"start":{"row":3,"column":61},"end":{"row":3,"column":62},"action":"insert","lines":["i"]},{"start":{"row":3,"column":62},"end":{"row":3,"column":63},"action":"insert","lines":["n"]},{"start":{"row":3,"column":63},"end":{"row":3,"column":64},"action":"insert","lines":["a"]},{"start":{"row":3,"column":64},"end":{"row":3,"column":65},"action":"insert","lines":["l"]}],[{"start":{"row":3,"column":65},"end":{"row":3,"column":66},"action":"insert","lines":["M"],"id":7},{"start":{"row":3,"column":66},"end":{"row":3,"column":67},"action":"insert","lines":["e"]},{"start":{"row":3,"column":67},"end":{"row":3,"column":68},"action":"insert","lines":["d"]},{"start":{"row":3,"column":68},"end":{"row":3,"column":69},"action":"insert","lines":["i"]},{"start":{"row":3,"column":69},"end":{"row":3,"column":70},"action":"insert","lines":["a"]}],[{"start":{"row":7,"column":20},"end":{"row":7,"column":69},"action":"remove","lines":["Spatie\\MediaLibrary\\MediaCollections\\Models\\Media"],"id":8},{"start":{"row":7,"column":20},"end":{"row":7,"column":21},"action":"insert","lines":["O"]},{"start":{"row":7,"column":21},"end":{"row":7,"column":22},"action":"insert","lines":["r"]},{"start":{"row":7,"column":22},"end":{"row":7,"column":23},"action":"insert","lines":["i"]},{"start":{"row":7,"column":23},"end":{"row":7,"column":24},"action":"insert","lines":["g"]},{"start":{"row":7,"column":24},"end":{"row":7,"column":25},"action":"insert","lines":["i"]},{"start":{"row":7,"column":25},"end":{"row":7,"column":26},"action":"insert","lines":["n"]},{"start":{"row":7,"column":26},"end":{"row":7,"column":27},"action":"insert","lines":["a"]},{"start":{"row":7,"column":27},"end":{"row":7,"column":28},"action":"insert","lines":["l"]},{"start":{"row":7,"column":28},"end":{"row":7,"column":29},"action":"insert","lines":["M"]},{"start":{"row":7,"column":29},"end":{"row":7,"column":30},"action":"insert","lines":["e"]},{"start":{"row":7,"column":30},"end":{"row":7,"column":31},"action":"insert","lines":["d"]},{"start":{"row":7,"column":31},"end":{"row":7,"column":32},"action":"insert","lines":["i"]},{"start":{"row":7,"column":32},"end":{"row":7,"column":33},"action":"insert","lines":["a"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":9,"column":0},"end":{"row":9,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1687429483865,"hash":"e81ecd938c12064447d08cdccb6c51227baa2d31"}