<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Topic;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Question;
use Auth;
use PDF;

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
        return Order::with('topic')->where('user_id',Auth::user()->id)->get();
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
    $order=Order::with('topic','questions')->find($request->id);
      PDF::SetTitle('quiz');
      PDF::AddPage();
      // set some language dependent data:
      $lg = Array();
      $lg['a_meta_charset'] = 'UTF-8';
      $lg['a_meta_dir'] = 'rtl';
      $lg['a_meta_language'] = 'fa';
      $lg['w_page'] = 'page';

      // set some language-dependent strings (optional)
      PDF::setLanguageArray($lg);
      PDF::SetFont('xkoodak', '', 18);
      $file='<!DOCTYPE html>
      <html lang="en" dir="rtl">
        <head>
          <meta charset="UTF-8" />
          <meta http-equiv="X-UA-Compatible" content="IE=edge" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <link rel="stylesheet" href="./style.css/style.css" />
          <title>Document</title>
        </head>
        <body>
          <div class="container">
            <header class="header">
              <ul class="d-flex jus-flex infoList">
                <li>نام:</li>
                <li>نام خانوادگی :</li>
                <li>موضوع :'.$order->topic->name.'</li>
                <li>زمان:'.$order->time.'</li>
              </ul>
            </header>
            <div>
              <ul class="d-flex jus-flex quizList">';
              
              foreach ($order->questions as $q){
                $file=$file.'<li>'.$q->question.' (1نمره)</li>';
              }
              $file=$file.'</ul></div></div></body></html>';


      $file=$file.'<Style>* {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }
      ul,
      li {
        list-style-type: none;
      }
      .container {
        margin: 40px;
        padding: 25px;
        border: 2px solid;
        border-radius: 10px;
        height: 1000px;
        background-color: #f1f3f5;
      }
      .d-flex {
        display: flex;
        align-items: center;
      }
      
      .jus-flex {
        flex-direction: row;
        justify-content: space-evenly;
      }
      .header {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 60px;
      }
      
      .infoList {
        width: 100%;
      }
      
      .quizList {
        padding: 10px;
        flex-direction: column;
        align-items: start;
        gap: 50px;
        font-size: 20px;
      }
      </Style>';
      PDF::writeHTML($file);
      
      return PDF::Output('quiz.pdf');
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
