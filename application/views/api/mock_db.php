
<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    } );
</script>
<h1>Mock Database for API</h1>


<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <table id="table_id" class="w3-table-all">
            <thead>
            <tr>
                <th>ID</th>
                <th>NIC</th>
                <th>Name</th>
                <th>Death</th>
                <th>City</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($db as $i){ ?>
                <tr>
                    <td><?php echo $i['id']; ?></td>
                    <td><?php echo $i['nic']; ?></td>
                    <td><?php echo $i['name']; ?></td>
					<?php if($i['death'] == 1){ ?>
                    	<td>true</td>
					<?php }else{ ?>
						<td>false</td>
					<?php } ?>
                    <td><?php echo $i['city']; ?></td>
                 </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>
