<table class="table table-striped table-hover">
    <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
    </thead>
    <tbody>
<?php foreach($list as $v => $row){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
    </tr>
<?php } ?>
    </tbody>
</tbody>
</table>



