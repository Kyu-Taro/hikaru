<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class MainController extends Controller
{
    public function index()
    {
        $items = Board::paginate(10);
        return view('main.board',compact('items'));
    }

    public function post(Request $request)
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
