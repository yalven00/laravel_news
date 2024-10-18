<?php

namespace App\Console\Commands;
use App\Models\News;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateDataCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-data-cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get News Api Data and saved into database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    
        $newsAPIkey=env('NEWS_API_KEY');
        $client = new Client();
        $response = $client->request('GET','https://newsapi.org/v1/articles?source=the-verge&apiKey='.$newsAPIkey);
        $body = $response->getBody();
        $data = json_decode($body, true);     
        foreach($data['articles'] as $new_data){     
        $news = new News;
        $news->author = $new_data['author'];
        $news->title = $new_data['title'];
        $news->description = $new_data['description'];
        $news->url = $new_data['url'];
        $news->urlToImage = $new_data['urlToImage'];
        $news->publishedAt = $new_data['publishedAt'];
        $news->save();
          }

    }
}
