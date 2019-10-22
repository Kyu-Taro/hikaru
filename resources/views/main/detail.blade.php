<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/detail.css">
    <title>ひかる掲示板 | 返信</title>
</head>
<body>
    <div class="container">
        <div class="site-width">
            @if (Auth::check())
                <form action="/return" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $item->id }}" name="board_id">
                    <input type="hidden" value="1" name="flg">
                    <textarea name="text" cols="30" rows="10"></textarea><br/>
                    <input type="submit" value="送信">
                </form>
            @else
                <form action="/return" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $item->id }}" name="board_id">
                    <textarea name="text" cols="30" rows="10"></textarea><br/>
                    <input type="submit" value="返信">
                </form>
            @endif
                <div class="main">
                    No.{{ $item->id }}<br/>
                    名前:匿名ひかちゅう<br/>
                    評価:
                        @if ($item->review === 1)
                            良い<br/>
                        @elseif($item->review === 2)
                            普通<br/>
                        @else
                            悪い<br/>
                        @endif
                    感想:{{ $item->text }}<br/>
                    {{ date('Y年m月d日 H時i分',strtotime($item->created_at)) }}<br/>
                </div>
            @foreach ($return as $retu)
                @if ($retu->flg === 1)
                    <div class="orner">
                        {{ $retu->text }}<br/>
                        {{ date('Y年m月d日 H時i分',strtotime($retu->created_at)) }}<br/>
                    </div>
                @else
                    <div class="post">
                        {{ $retu->text }}<br/>
                        {{ date('Y年m月d日 H時i分',strtotime($retu->created_at)) }}<br/>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</body>
</html>
