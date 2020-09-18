<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RanNumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 600); // 10 minutes
        $something = [];
        $random = [];

        while(count($something) < $request->something) {
            for($a=count($something)==0? 0: count($something);$a<$request->something;$a++){
                $something[] = Str::random(6);
            }
            array_unique($something);

            if(count($something) == $request->something){
                array_unique($something);
            }
        }
        for($b=0;$b<$request->something;$b++){

            $random[$b]['random'] = $something[$b];
        }
//        dd($something, $random, $request->something, count($something));
        DB::table('randoms')->insert($random);

        return response('200');
    }

    /*
    for more than 50K not yet done
    $counting = count($something)/50000;
        if($counting > 0){
            while(count($something) < $request->something) {
                for($a=count($something)==0? 0: count($something);$a<$request->something;$a++){
                    $something[] = Str::random(6);
                }
                array_unique($something);

                if(count($something) == $request->something){
                    array_unique($something);
                }
            }
            array_chunk($something,$counting);
            $counter = 0;
            for($b=0;$b<$request->something;$b++){
                if($b>0){
                    if(count($something)%$b === 0){
                        $counter++;
                    }
                }
                $random[$counter][$b]['random'] = $something[$b];
            }
            for($c=0;$c<=$counter;$c++){
                DB::table('randoms')->insert($random[$c]);
            }

            return response('200');
        }else{
            for($b=0;$b<$request->something;$b++){

                $random[$b]['random'] = $something[$b];
            }
            DB::table('randoms')->insert($random);

            return response('200');
    */
}
