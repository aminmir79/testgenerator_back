<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Topic;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Question;
use Auth;


class ApiController extends Controller
{
   public function get_sections()
   {
        return Section::all();
   }

   public function get_topics(Request $request)
   {
        return Section::find($request->id)->topics;
   }

   public function orders(Request $request)
   {
        return Order::where('user_id',Auth::user()->id)->get();
   }

   public function send_comment(Request $request)
   {
    try
    {
        $c = Comment::create([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'address'=>$request->address,
            'number'=>$request->number,
            'comment'=>$request->comment
        ]);
    }
    catch(Exception $e)
    {
        return "error";
    }
   }

   public function get_Quiz(Request $request)
   {
    return Order::find($request->id)->questions;
   }

   public function order(Request $request)
   {

    try
    {
        $o = Order::create([
            'user_id'=>Auth::id(),
            'topic_id'=>$request->topic_id,
            'type'=>$request->type,
            'level'=>$request->level,
            'time'=>$request->time,
            'max_scoure'=>$request->max_scoure,
        ]);

        $l = $request->lectures;

        $questions=Question::where('topic_id',$request->topic_id)->whereIn('lecture',$l)->where('level',$request->level)->get()->shuffle()->shuffle()->take($request->max_scoure);

        $o->questions()->sync($questions);

        return $o->id;
    }
    catch(Exception $e)
    {
        return "error";
    }

   }

   public function get_lecture(Request $request)
   {
        return Topic::find($request->id)->num_of_lessons;

   }

}
