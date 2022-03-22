<div>
    <? echo $flash;?>
    <? echo $flashDelete; ?>
    <? echo $flashRestore; ?>
</div>

<div>
    <a href="/DB/trashedPosts">Trashed posts</a>
</div>
<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>desc</th>
        <th>date</th>
    </tr>

    <? foreach ($posts as $post){?>
    <tr>
        <td><? echo $post->id; ?></td>
        <td><a href="/DB/eloqPostOne/{{$post->id}}"><? echo $post->title; ?></a></td>
        <td><? echo $post->desc; ?></td>
        <td><? echo $post->date; ?></td>
        <td><a href="/DB/editPost/{{$post->id}}">redact</a></td>
        <td><a href="/DB/delPost/{{$post->id}}">delete</a></td>

    </tr>
    <? } ?>
</table>
