{"filter":false,"title":"DailyAverageRateController.php","tooltip":"/app/Http/Controllers/DailyAverageRateController.php","undoManager":{"mark":29,"position":29,"stack":[[{"start":{"row":8,"column":5},"end":{"row":8,"column":6},"action":"remove","lines":["/"],"id":2},{"start":{"row":8,"column":4},"end":{"row":8,"column":5},"action":"remove","lines":["/"]}],[{"start":{"row":8,"column":4},"end":{"row":21,"column":5},"action":"insert","lines":["public function index()","    {","        $this->rate = new ExchangeRate;","        $this->rate->btc_rate_supplier = $this->btc_rate_supplier;","        $this->rate->rub_rate_supplier = $this->rub_rate_supplier;","        ","        try {","            $this->fetchRates();","            $this->rate->save();","        } catch (\\Exception $e) {","            return null;","        }","        ","    }"],"id":3}],[{"start":{"row":10,"column":8},"end":{"row":19,"column":9},"action":"remove","lines":["$this->rate = new ExchangeRate;","        $this->rate->btc_rate_supplier = $this->btc_rate_supplier;","        $this->rate->rub_rate_supplier = $this->rub_rate_supplier;","        ","        try {","            $this->fetchRates();","            $this->rate->save();","        } catch (\\Exception $e) {","            return null;","        }"],"id":6},{"start":{"row":10,"column":8},"end":{"row":31,"column":29},"action":"insert","lines":["$averages = DB::table('exchange_rates')","            ->select([","                DB::raw('AVG(btc_buy_rate) as avg_btc_buy_rate'),","                DB::raw('AVG(btc_sell_rate) as avg_btc_sell_rate'),","                DB::raw('AVG(rub_buy_rate) as avg_rub_buy_rate'),","                DB::raw('AVG(rub_sell_rate) as avg_rub_sell_rate'),","                DB::raw('AVG(effective_gbp_to_rub) as avg_effective_gbp_to_rub'),","                DB::raw('AVG(effective_rub_to_gbp) as avg_effective_rub_to_gbp'),","                DB::raw('AVG(spread_percentage) as avg_spread_percentage'),","            ])","            ->whereDate('created_at', '=', date('Y-m-d'))","            ->first();","","        $averageRate = new DailyAverageRate;","        $averageRate->btc_buy_rate = $averages->avg_btc_buy_rate;","        $averageRate->btc_sell_rate = $averages->avg_btc_sell_rate;","        $averageRate->rub_buy_rate = $averages->avg_rub_buy_rate;","        $averageRate->rub_sell_rate = $averages->avg_rub_sell_rate;","        $averageRate->effective_gbp_to_rub = $averages->avg_effective_gbp_to_rub;","        $averageRate->effective_rub_to_gbp = $averages->avg_effective_rub_to_gbp;","        $averageRate->spread_percentage = $averages->avg_spread_percentage;","        $averageRate->save();"]}],[{"start":{"row":10,"column":8},"end":{"row":31,"column":29},"action":"remove","lines":["$averages = DB::table('exchange_rates')","            ->select([","                DB::raw('AVG(btc_buy_rate) as avg_btc_buy_rate'),","                DB::raw('AVG(btc_sell_rate) as avg_btc_sell_rate'),","                DB::raw('AVG(rub_buy_rate) as avg_rub_buy_rate'),","                DB::raw('AVG(rub_sell_rate) as avg_rub_sell_rate'),","                DB::raw('AVG(effective_gbp_to_rub) as avg_effective_gbp_to_rub'),","                DB::raw('AVG(effective_rub_to_gbp) as avg_effective_rub_to_gbp'),","                DB::raw('AVG(spread_percentage) as avg_spread_percentage'),","            ])","            ->whereDate('created_at', '=', date('Y-m-d'))","            ->first();","","        $averageRate = new DailyAverageRate;","        $averageRate->btc_buy_rate = $averages->avg_btc_buy_rate;","        $averageRate->btc_sell_rate = $averages->avg_btc_sell_rate;","        $averageRate->rub_buy_rate = $averages->avg_rub_buy_rate;","        $averageRate->rub_sell_rate = $averages->avg_rub_sell_rate;","        $averageRate->effective_gbp_to_rub = $averages->avg_effective_gbp_to_rub;","        $averageRate->effective_rub_to_gbp = $averages->avg_effective_rub_to_gbp;","        $averageRate->spread_percentage = $averages->avg_spread_percentage;","        $averageRate->save();"],"id":7},{"start":{"row":10,"column":8},"end":{"row":31,"column":25},"action":"insert","lines":["$averages = DB::table('exchange_rates')","        ->select([","            DB::raw('AVG(btc_buy_rate) as avg_btc_buy_rate'),","            DB::raw('AVG(btc_sell_rate) as avg_btc_sell_rate'),","            DB::raw('AVG(rub_buy_rate) as avg_rub_buy_rate'),","            DB::raw('AVG(rub_sell_rate) as avg_rub_sell_rate'),","            DB::raw('AVG(effective_gbp_to_rub) as avg_effective_gbp_to_rub'),","            DB::raw('AVG(effective_rub_to_gbp) as avg_effective_rub_to_gbp'),","            DB::raw('AVG(spread_percentage) as avg_spread_percentage'),","        ])","        ->where('created_at', '>=', now()->subHours(23))","        ->first();","","    $averageRate = new DailyAverageRate;","    $averageRate->btc_buy_rate = $averages->avg_btc_buy_rate;","    $averageRate->btc_sell_rate = $averages->avg_btc_sell_rate;","    $averageRate->rub_buy_rate = $averages->avg_rub_buy_rate;","    $averageRate->rub_sell_rate = $averages->avg_rub_sell_rate;","    $averageRate->effective_gbp_to_rub = $averages->avg_effective_gbp_to_rub;","    $averageRate->effective_rub_to_gbp = $averages->avg_effective_rub_to_gbp;","    $averageRate->spread_percentage = $averages->avg_spread_percentage;","    $averageRate->save();"]}],[{"start":{"row":10,"column":0},"end":{"row":10,"column":4},"action":"insert","lines":["    "],"id":8},{"start":{"row":11,"column":0},"end":{"row":11,"column":4},"action":"insert","lines":["    "]},{"start":{"row":12,"column":0},"end":{"row":12,"column":4},"action":"insert","lines":["    "]},{"start":{"row":13,"column":0},"end":{"row":13,"column":4},"action":"insert","lines":["    "]},{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":4},"action":"insert","lines":["    "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":4},"action":"insert","lines":["    "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":4},"action":"insert","lines":["    "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":4},"action":"insert","lines":["    "]},{"start":{"row":26,"column":0},"end":{"row":26,"column":4},"action":"insert","lines":["    "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":4},"action":"insert","lines":["    "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":4},"action":"insert","lines":["    "]},{"start":{"row":29,"column":0},"end":{"row":29,"column":4},"action":"insert","lines":["    "]},{"start":{"row":30,"column":0},"end":{"row":30,"column":4},"action":"insert","lines":["    "]},{"start":{"row":31,"column":0},"end":{"row":31,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":10,"column":8},"end":{"row":10,"column":12},"action":"remove","lines":["    "],"id":9}],[{"start":{"row":4,"column":28},"end":{"row":5,"column":0},"action":"insert","lines":["",""],"id":10}],[{"start":{"row":5,"column":0},"end":{"row":7,"column":32},"action":"insert","lines":["use Illuminate\\Console\\Command;","use Illuminate\\Support\\Facades\\DB;","use App\\Models\\DailyAverageRate;"],"id":11}],[{"start":{"row":19,"column":38},"end":{"row":19,"column":39},"action":"remove","lines":["_"],"id":12},{"start":{"row":19,"column":37},"end":{"row":19,"column":38},"action":"remove","lines":["e"]},{"start":{"row":19,"column":36},"end":{"row":19,"column":37},"action":"remove","lines":["v"]},{"start":{"row":19,"column":35},"end":{"row":19,"column":36},"action":"remove","lines":["i"]},{"start":{"row":19,"column":34},"end":{"row":19,"column":35},"action":"remove","lines":["t"]},{"start":{"row":19,"column":33},"end":{"row":19,"column":34},"action":"remove","lines":["c"]},{"start":{"row":19,"column":32},"end":{"row":19,"column":33},"action":"remove","lines":["e"]},{"start":{"row":19,"column":31},"end":{"row":19,"column":32},"action":"remove","lines":["f"]},{"start":{"row":19,"column":30},"end":{"row":19,"column":31},"action":"remove","lines":["f"]},{"start":{"row":19,"column":29},"end":{"row":19,"column":30},"action":"remove","lines":["e"]}],[{"start":{"row":20,"column":29},"end":{"row":20,"column":39},"action":"remove","lines":["effective_"],"id":13}],[{"start":{"row":19,"column":39},"end":{"row":19,"column":40},"action":"insert","lines":["_"],"id":14},{"start":{"row":19,"column":40},"end":{"row":19,"column":41},"action":"insert","lines":["r"]},{"start":{"row":19,"column":41},"end":{"row":19,"column":42},"action":"insert","lines":["a"]},{"start":{"row":19,"column":42},"end":{"row":19,"column":43},"action":"insert","lines":["t"]},{"start":{"row":19,"column":43},"end":{"row":19,"column":44},"action":"insert","lines":["e"]}],[{"start":{"row":20,"column":39},"end":{"row":20,"column":40},"action":"insert","lines":["_"],"id":15},{"start":{"row":20,"column":40},"end":{"row":20,"column":41},"action":"insert","lines":["r"]},{"start":{"row":20,"column":41},"end":{"row":20,"column":42},"action":"insert","lines":["a"]},{"start":{"row":20,"column":42},"end":{"row":20,"column":43},"action":"insert","lines":["t"]},{"start":{"row":20,"column":43},"end":{"row":20,"column":44},"action":"insert","lines":["e"]}],[{"start":{"row":21,"column":45},"end":{"row":21,"column":46},"action":"remove","lines":["e"],"id":16},{"start":{"row":21,"column":44},"end":{"row":21,"column":45},"action":"remove","lines":["g"]},{"start":{"row":21,"column":43},"end":{"row":21,"column":44},"action":"remove","lines":["a"]},{"start":{"row":21,"column":42},"end":{"row":21,"column":43},"action":"remove","lines":["t"]},{"start":{"row":21,"column":41},"end":{"row":21,"column":42},"action":"remove","lines":["n"]},{"start":{"row":21,"column":40},"end":{"row":21,"column":41},"action":"remove","lines":["e"]},{"start":{"row":21,"column":39},"end":{"row":21,"column":40},"action":"remove","lines":["c"]},{"start":{"row":21,"column":38},"end":{"row":21,"column":39},"action":"remove","lines":["r"]},{"start":{"row":21,"column":37},"end":{"row":21,"column":38},"action":"remove","lines":["e"]},{"start":{"row":21,"column":36},"end":{"row":21,"column":37},"action":"remove","lines":["p"]},{"start":{"row":21,"column":35},"end":{"row":21,"column":36},"action":"remove","lines":["_"]}],[{"start":{"row":7,"column":32},"end":{"row":8,"column":0},"action":"insert","lines":["",""],"id":17}],[{"start":{"row":8,"column":0},"end":{"row":8,"column":18},"action":"insert","lines":["use Carbon\\Carbon;"],"id":18}],[{"start":{"row":27,"column":44},"end":{"row":28,"column":0},"action":"insert","lines":["",""],"id":20},{"start":{"row":28,"column":0},"end":{"row":28,"column":8},"action":"insert","lines":["        "]},{"start":{"row":28,"column":8},"end":{"row":28,"column":9},"action":"insert","lines":["$"]},{"start":{"row":28,"column":9},"end":{"row":28,"column":10},"action":"insert","lines":["a"]},{"start":{"row":28,"column":10},"end":{"row":28,"column":11},"action":"insert","lines":["v"]},{"start":{"row":28,"column":11},"end":{"row":28,"column":12},"action":"insert","lines":["e"]},{"start":{"row":28,"column":12},"end":{"row":28,"column":13},"action":"insert","lines":["r"]},{"start":{"row":28,"column":13},"end":{"row":28,"column":14},"action":"insert","lines":["a"]},{"start":{"row":28,"column":14},"end":{"row":28,"column":15},"action":"insert","lines":["g"]},{"start":{"row":28,"column":15},"end":{"row":28,"column":16},"action":"insert","lines":["e"]},{"start":{"row":28,"column":16},"end":{"row":28,"column":17},"action":"insert","lines":["R"]}],[{"start":{"row":28,"column":17},"end":{"row":28,"column":18},"action":"insert","lines":["a"],"id":21},{"start":{"row":28,"column":18},"end":{"row":28,"column":19},"action":"insert","lines":["t"]},{"start":{"row":28,"column":19},"end":{"row":28,"column":20},"action":"insert","lines":["e"]}],[{"start":{"row":28,"column":20},"end":{"row":28,"column":21},"action":"insert","lines":[" "],"id":22},{"start":{"row":28,"column":21},"end":{"row":28,"column":22},"action":"insert","lines":["="]}],[{"start":{"row":28,"column":22},"end":{"row":28,"column":23},"action":"insert","lines":[" "],"id":23}],[{"start":{"row":28,"column":22},"end":{"row":28,"column":23},"action":"remove","lines":[" "],"id":24},{"start":{"row":28,"column":21},"end":{"row":28,"column":22},"action":"remove","lines":["="]},{"start":{"row":28,"column":20},"end":{"row":28,"column":21},"action":"remove","lines":[" "]}],[{"start":{"row":28,"column":20},"end":{"row":28,"column":21},"action":"insert","lines":["-"],"id":25},{"start":{"row":28,"column":21},"end":{"row":28,"column":22},"action":"insert","lines":[">"]},{"start":{"row":28,"column":22},"end":{"row":28,"column":23},"action":"insert","lines":["d"]},{"start":{"row":28,"column":23},"end":{"row":28,"column":24},"action":"insert","lines":["a"]},{"start":{"row":28,"column":24},"end":{"row":28,"column":25},"action":"insert","lines":["t"]},{"start":{"row":28,"column":25},"end":{"row":28,"column":26},"action":"insert","lines":["e"]}],[{"start":{"row":28,"column":26},"end":{"row":28,"column":27},"action":"insert","lines":[" "],"id":26},{"start":{"row":28,"column":27},"end":{"row":28,"column":28},"action":"insert","lines":["="]}],[{"start":{"row":28,"column":28},"end":{"row":28,"column":29},"action":"insert","lines":[" "],"id":27}],[{"start":{"row":28,"column":29},"end":{"row":28,"column":58},"action":"insert","lines":["Carbon::now()->format('dmy');"],"id":28}],[{"start":{"row":28,"column":53},"end":{"row":28,"column":54},"action":"insert","lines":["/"],"id":29}],[{"start":{"row":28,"column":55},"end":{"row":28,"column":56},"action":"insert","lines":["/"],"id":30}],[{"start":{"row":28,"column":22},"end":{"row":28,"column":26},"action":"remove","lines":["date"],"id":31},{"start":{"row":28,"column":22},"end":{"row":28,"column":31},"action":"insert","lines":["datestamp"]}],[{"start":{"row":38,"column":5},"end":{"row":39,"column":0},"action":"insert","lines":["",""],"id":32},{"start":{"row":39,"column":0},"end":{"row":39,"column":4},"action":"insert","lines":["    "]},{"start":{"row":39,"column":4},"end":{"row":40,"column":0},"action":"insert","lines":["",""]},{"start":{"row":40,"column":0},"end":{"row":40,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":40,"column":4},"end":{"row":64,"column":1},"action":"insert","lines":["public function markSuspiciousEntries()","{","    $yesterday = Carbon::now()->subDays(1);","    $dayBeforeYesterday = Carbon::now()->subDays(2);","","    // Get all entries from between 12 and 24 hours ago","    $entries = ExchangeRate::whereBetween('created_at', [$dayBeforeYesterday, $yesterday])->get();","","    // Calculate the mean btc_rate","    $mean = $entries->avg('btc_rate');","","    // Calculate the standard deviation of btc_rate","    $stdDev = sqrt($entries->sum(function ($entry) use ($mean) {","        return pow($entry->btc_rate - $mean, 2);","    }) / $entries->count());","","    // Mark as suspicious any entries where btc_rate > mean + stdDev","    $entries->filter(function ($entry) use ($mean, $stdDev) {","        return $entry->btc_rate > $mean + $stdDev;","    })->each(function ($entry) {","        $entry->update(['suspicious' => true]);","    });","","    // ...the rest of your controller method...","}"],"id":33}],[{"start":{"row":40,"column":4},"end":{"row":64,"column":1},"action":"remove","lines":["public function markSuspiciousEntries()","{","    $yesterday = Carbon::now()->subDays(1);","    $dayBeforeYesterday = Carbon::now()->subDays(2);","","    // Get all entries from between 12 and 24 hours ago","    $entries = ExchangeRate::whereBetween('created_at', [$dayBeforeYesterday, $yesterday])->get();","","    // Calculate the mean btc_rate","    $mean = $entries->avg('btc_rate');","","    // Calculate the standard deviation of btc_rate","    $stdDev = sqrt($entries->sum(function ($entry) use ($mean) {","        return pow($entry->btc_rate - $mean, 2);","    }) / $entries->count());","","    // Mark as suspicious any entries where btc_rate > mean + stdDev","    $entries->filter(function ($entry) use ($mean, $stdDev) {","        return $entry->btc_rate > $mean + $stdDev;","    })->each(function ($entry) {","        $entry->update(['suspicious' => true]);","    });","","    // ...the rest of your controller method...","}"],"id":34}]]},"ace":{"folds":[],"scrolltop":9.6,"scrollleft":0,"selection":{"start":{"row":40,"column":4},"end":{"row":40,"column":4},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":11,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1689371052486,"hash":"129bed3e8e4bc2f8e35a37ff9e743f0cd163d452"}