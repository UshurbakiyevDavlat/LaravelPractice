<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>surname</th>
        <th>age</th>
        <th>email</th>
    </tr>
    <?php foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user->id; ?></td>
        <td><?php echo $user->name; ?></td>
        <td><?php echo $user->profile->surname; ?></td>
        <td><?php echo $user->age; ?></td>
        <td><?php echo $user->email; ?></td>
        <td><?php echo $user->city->name; ?></td>
        <td><?php echo $user->city->country->name; ?></td>
    </tr>
    <?php } ?>
</table>
