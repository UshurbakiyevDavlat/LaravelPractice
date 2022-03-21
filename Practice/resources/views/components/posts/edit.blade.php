<form method="POST" action="">
    @csrf
    <input name="title" value="{{$post->title}}">
    <br>
    <input name="date" value="{{$post->date}}">
    <br>
    <textarea name="desc">{{$post->desc}}</textarea>
    <br>
    <tr>
{{--        <button type="submit"><a href="/DB/eloqStart">Back</a></button>--}}
        <input name="submit" type="submit">
    </tr>
</form>
