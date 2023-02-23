

<h1>POLL Management</h1>

<form action="/election/create_election">
    <input class="w3-button w3-green" type="submit" value="Create New Poll" />
</form>

<div class="w3-row">
    <div class="w3-container w3-padding-16">
        <table id="table_id" class="w3-table-all">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>User</th>
                <th>User First Name</th>
                <th>End Date</th>
                <th>Description</th>
                <th>Email Invitations</th>
                <th>Result</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>End POLL</th>
                <th>Approve Poll</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($poll as $i){ ?>
                <tr>
                    <td><a href="<?php echo site_url('election/edit_election/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-text-blue" target="_blank"><?php echo $i['id']; ?></a></td>
                    <td><?php echo $i['name']; ?></td>
                    <td><?php echo $i['user_id']; ?></td>
                    <td><?php echo $i['first_name']; ?></td>
                    <td><?php echo $i['expire_date']; ?></td>
                    <td><?php echo $i['description']; ?></td>
                    <td><a href="<?php echo site_url('election/invite_email/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-green w3-button" target="_blank">Invitation - Email</a></td>
					<!--
                    <td><a href="<?php echo site_url('election/view/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-green w3-button" target="_blank">Results</a></td>
					-->
					<td><a href="<?php echo site_url('election/showPollVoteAndResultFromElection/'.$i['id']."/".$i['name']."/".$i['verify_key']); ?>"  class="w3-green w3-button" target="_blank">Results</a></td>
                    <td><a href="<?php echo site_url('election/edit_election/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-blue w3-button" target="_blank">Edit</a></td>
                    <td><a href="<?php echo site_url('election/remove/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-red w3-button" target="_blank">Delete</a></td>
                    <td><a href="<?php echo site_url('election/end_election/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-yellow w3-button" target="_blank">END</a></td>
                    <td><a href="<?php echo site_url('election/approve_election/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-yellow w3-button" target="_blank">Approve</a></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>
<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            scrollX: true,
        });
    } );
</script>