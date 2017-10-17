<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Pagetranslation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Lang;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
                $this->middleware('jwt.auth', ['except' => ['login', 'store','pages','yes']]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return response()->json(['name' => 'Glen Small'], 200);
    }
    
    public function test()
    {
        $userd = Auth::user();
        $usd['usd'] = User::all();
        $usd['current'] = $userd->display_name;
                return response()->json($usd);
    }
    
    public function pages($item = 'welcome')
    {
        
        /*
        $users = DB::select('select  pt.content
from default_pages_pages P
LEFT JOIN  default_pages_default_pages_translations pt
ON P.id = pt.entry_id
where P.parent_id=1');
        */
        
    $itemRtn  = DB::select('select  pt.content,P.slug
from default_pages_pages P
LEFT JOIN  default_pages_default_pages_translations pt
ON P.id = pt.entry_id
where P.slug=\''.$item.'\'');
        
        $users[$item] =$itemRtn;
        
        
          $itemRtn = DB::select('select  pt.content
from default_pages_pages P
LEFT JOIN  default_pages_default_pages_translations pts
ON P.id = pt.entry_id
where P.parent_id=1');
 
        $users['yellow_btn'] = \Lang::get('pages.yellow_btn');
        $users['green_btn'] = \Lang::get('pages.green_btn');
        //return response()->json($users);
        
         /*
        $details = Page::where('slug', 'welcome')->get();
        $out['details'] = $details[0];
        $details =  json_decode($details, true);
        $pageid =  $details[0]['entry_id'];
        
        $out[$details[0]['slug']] = Pagetranslation::find($pageid);
        $pageArray  = Page::where('parent_id', $pageid)->whereNull('deleted_at')->get();
        foreach ($pageArray as $pageArrayRtn) {
            $out[$pageArrayRtn->id] = Pagetranslation::find($pageArrayRtn->id);
        }
            return response()->json($out);
            
            */
        
        
        
        
    }
    
    function yes(){
        /*
          $itemRtns  = DB::select('select dt.updated_by_id, ds.* from default_users_users ds
LEFT JOIN default_pages_pages_translations dt
ON ds.id = dt.updated_by_id');
            $itemRtn  = DB::select('SELECT id, created_at,updated_at, 
            array_to_json(array_agg(default_pages_pages) ) as u  
            FROM default_pages_pages  
            group by 1,2 
            order by id  
            limit 5');  
        
        */
      
        
           // return response()->json(array('usd' => $itemRtn));
        
       $out =  json_decode(  '[{
    "base_url": "http://mysearch.net:8080/",
    "date": "2016-11-09",
    "lname": "MY PROJ",
    "name": "HELLO",
    "description": "The Test Project",
    "id": 10886789,
    "creationDate": null,
    "version": "2.9",
    "metrics": [{
        "val": 11926.0,
        "frmt_val": "11,926",
        "key": "lines"
    },
    {
        "val": 7893.0,
        "frmt_val": "7,893",
        "key": "ncloc"
    }],
    "key": "FFDFGDGDG"
}]');
    
        
        
        
    
  return response()->json(array('usd' => $out)); 
}
}
