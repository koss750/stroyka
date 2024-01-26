<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Design;
use Illuminate\Support\Facades\Http;

class UpdateDesignDetails extends Command
{
    
    protected $signature = 'design:update-details';
    protected $description = 'Update design details using OpenAI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $designs = Design::all();

        foreach ($designs as $design) {
            $design->setImages($design);
            $list = json_encode($design->floorsList);
            // Check if 'details' is empty and 'image_url' is set
            if (empty($design->details) && $design->image_url) {
                $prompt = "Please give me a description of around 100-150 characters about this house plan. It looks like {$design->image_url}, it's area is {$design->size} and here is a description of all its rooms {$list}";

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer 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'
                ])->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ["role" => "user", "content" => $prompt]
                    ],
                    'temperature' => 0.7
                ]);

                if ($response->successful()) {
                    $design->details = $response->json()['choices'][0]['message']['content'];
                    $design->save();
                    $this->info("Updated details for design ID {$design->id}");
                } else {
                    $this->error("Failed to update design ID {$design->id}");
                    var_dump($response);
                }
            }
            die();
        }

        $this->info('Design details update complete.');
    }
}
