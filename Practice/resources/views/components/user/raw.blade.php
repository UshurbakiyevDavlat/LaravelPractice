<table>
    <tr>
        <th>Имя</th>
        <th>Возраст</th>
    </tr>

    <?php foreach ($users as $user){ ?>
    <tr>
        <td><?echo $user->name?></td>
        <td><?echo $user->age?></td>
    </tr>
    <?php } ?>
</table>
