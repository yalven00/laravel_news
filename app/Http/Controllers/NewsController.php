<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $newsinfo = News::inRandomOrder()->distinct()->paginate(5);
        return view('news.index',compact('newsinfo'));
    }

     public function news_details($id)
    {
        $news = News::findOrFail($id);
        return view('news.details',compact('news'));
    }


    public function autocmplete(Request $request): JsonResponse
    {  
        $search = $request->get('title');
        $result = News::where('title', 'LIKE', '%'. $search. '%')->get();
        return response()->json($result);
    }
}
