<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Retu;
use App\Http\Requests\PostRequest;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $review = $request->query('review');
        $sort = $request->query('sort');

        if($review == 1){
            if(!empty($sort)){
                $items = Board::where('review',1)->orderBy('created_at',$sort)->paginate(10);
            }else{
                $items = Board::where('review', 1)->paginate(10);
            }
        }else if($review == 2){
            if(!empty($sort)){
                $items = Board::where('review',2)->orderBy('created_at',$sort)->paginate(10);
            }else{
                $items = Board::where('review', 2)->paginate(10);
            }
        }else if($review == 3){
            if(!empty($sort)){
                $items = Board::where('review',3)->orderBy('created_at',$sort)->paginate(10);
            }else{
                $items = Board::where('review', 3)->paginate(10);
            }
        }else{
            if(!empty($sort)){
                $items = Board::orderBy('created_at',$sort)->paginate(10);
            }else{
                $items = Board::paginate(10);
            }
        }

        $return = Retu::get();

        $data = [
            'sort' => $sort,
            'items' => $items,
            'return' => $return,
        ];

        return view('main.board',$data);
    }

    public function post(Request $request,PostRequest $validate)
    {
        $board = new Board;
        $form = $request->all();
        unset($form['_token']);
        $board->fill($form)->save();

        return redirect()->route('index');
    }

    public function admin(Request $request)
    {
        $text = $request->input('text');
        $flg = $request->input('flg');

        $board = new Board;
        $board->review = 0;
        $board->text = $text;
        $board->flg = $flg;
        $board->save();

        return redirect()->route('index');
    }
}
