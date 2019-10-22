<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/board.css">
    <title>ひかる掲示板</title>
</head>
<body>
    <div class="container">
        <div class="site-width">
            <div class="sarch-container">
                <form action="/" post="GET">
                    良い<input type="radio" name="review" value="1">
                    普通<input type="radio" name="review" value="2">
                    悪い<input type="radio" name="review" value="3"><br/>
                    古い順<input type="radio" name="sort" value="asc">
                    新しい順<input type="radio" name="sort" value="desc"><br/>
                    <input type="submit" value="並び替え">
                </form>
            </div>
            <div class="post-container">
                @if (Auth::check())
                    <form action="/admin" method="POST">
                        @csrf
                        <textarea name="text" cols="30" rows="10"></textarea><br/>
                        <input type="hidden" name="flg" value="1">
                        <input type="submit" value="投稿">
                    </form>
                @else
                <form action="/" method="POST">
                    @csrf
                    @error('review')
                        {{ $message }}<br/>
                    @enderror
                    評価:良い<input type="radio" name="review" value="1">普通<input type="radio" name="review" value="2">悪い<input type="radio" name="review" value="3"><br/>
                    @error('text')
                        {{ $message }}<br/>
                    @enderror
                    感想:<br/><textarea name="text" cols="30" rows="10"></textarea><br/>
                    <input type="submit" value="投稿">
                </form>
            </div>
            @endif

            @foreach ($items as $item)
                @if ($item->flg === 1)
                    <div class="orner">
                       名前:ひかる<br/>
                        {{ $item->text }}<br/>
                    </div>
                @else
                    <div class="post">
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
                        <form action="/board/{{ $item->id }}" method="GET">
                            <input type="submit" value="返信"><br/>
                        </form>
                    </div>
                    @foreach ($return as $retu)
                        @if ($retu->board_id == $item->id)
                            @if ($retu->flg === 1)
                                <div class="orner">
                                    {{ $retu->text }}<br/>
                                    {{ date('Y年m月d日 H時i分',strtotime($retu->created_at)) }}<br/>
                                </div>
                            @endif
                            <div class="return">
                                {{ $retu->text }}<br/>
                                {{ date('Y年m月d日 H時i分',strtotime($retu->created_at)) }}<br/>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <div class="paginate">
                {{ $items->appends(['sort' => $sort])->links() }}
            </div>
        </div>
    </div>
</body>
</html>
