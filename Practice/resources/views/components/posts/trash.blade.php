<table>
    <tr>
        <th>id</th>
        <th>title</th>
        <th>desc</th>
        <th>created_at</th>
        <th>deleted_at</th>
    </tr>

    <?php foreach ($trashed as $trash) { ?>

    <tr>
        <td><?php echo $trash->id;?></td>
        <td><?php echo $trash->title;?></td>
        <td><?php echo $trash->desc;?></td>
        <td><?php echo $trash->created_at;?></td>
        <td><?php echo $trash->deleted_at;?></td>
        <td><a href="/DB/restorePosts/{{$trash->id}}">restore</a></td>

    </tr>
    <?php }?>

    <a href="/DB/eloqStart">Back</a>
</table>
