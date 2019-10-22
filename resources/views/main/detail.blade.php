<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひかる掲示板 | 返信</title>
</head>
<body>
    <form action="/return" method="POST">
        @csrf
        <input type="hidden" value="{{ $item->id }}" name="board_id">
        <textarea name="text" cols="30" rows="10"></textarea><br/>
        <input type="submit" value="返信">
    </form>
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
    @foreach ($return as $retu)
        {{ $retu->text }}<br/>
        {{ date('Y年m月d日 H時i分',strtotime($retu->created_at)) }}<br/>
    @endforeach
</body>
</html>
