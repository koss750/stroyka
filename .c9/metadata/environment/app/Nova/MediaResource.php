{"filter":false,"title":"MediaResource.php","tooltip":"/app/Nova/MediaResource.php","undoManager":{"mark":1,"position":1,"stack":[[{"start":{"row":41,"column":8},"end":{"row":43,"column":10},"action":"remove","lines":["return [","            ID::make()->sortable(),","        ];"],"id":2},{"start":{"row":41,"column":8},"end":{"row":46,"column":10},"action":"insert","lines":["return [","            ID::make()->sortable(),","            Image::make('File', 'file_name')->thumbnail('thumb')->preview('full'),","            Text::make('File Name', 'file_name')->onlyOnDetail(),","            Text::make('Size', 'human_readable_size')->exceptOnForms(),","        ];"]}],[{"start":{"row":4,"column":0},"end":{"row":7,"column":0},"action":"remove","lines":["use Illuminate\\Http\\Request;","use Laravel\\Nova\\Fields\\ID;","use Laravel\\Nova\\Http\\Requests\\NovaRequest;",""],"id":3},{"start":{"row":4,"column":0},"end":{"row":8,"column":26},"action":"insert","lines":["use Illuminate\\Http\\Request;","use Laravel\\Nova\\Fields\\ID;","use Laravel\\Nova\\Fields\\Image;","use Laravel\\Nova\\Fields\\Text;","use Laravel\\Nova\\Resource;"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":8,"column":26},"end":{"row":8,"column":26},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1687420104442,"hash":"1306b9ce001c97777ec60825e79e607f41f65395"}