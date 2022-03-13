<table>
    <tr>
        <th>Работники</th>
        <th>Должность</th>
        <th>Зарплата</th>
    </tr>

    <?php foreach ($employees as $employee) { ?>
    <tr>
        <td><? echo $employee->name?></td>
        <td><? echo $employee->position?></td>
        <td><? echo $employee->salary ?></td>
    </tr>
    <?php } ?>
</table>
