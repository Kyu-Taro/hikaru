<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひかる掲示板</title>
</head>
<body>
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
        評価:良い<input type="radio" name="review" value="1">普通<input type="radio" name="review" value="2">悪い<input type="radio" name="review" value="3"><br/>
        感想:<br/><textarea name="text" cols="30" rows="10"></textarea><br/>
        <input type="submit" value="投稿">
    </form>
    @endif

    @foreach ($items as $item)
        @if ($item->flg === 1)
            名前:ひかる<br/>
            {{ $item->text }}<br/>
        @else
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
        @endif
    @endforeach

    {{ $items->links() }}

</body>
</html>
