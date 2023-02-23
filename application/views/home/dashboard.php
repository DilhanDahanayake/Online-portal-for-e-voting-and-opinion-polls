<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<h1>
    E Voting System !!!
    <?php echo "<br>Welcome Back ".$this->session->userdata('name'); ?>
</h1>
<br>

<form action="/election/create_election">
    <input type="submit" class="w3-button w3-green" value="New Poll" />
</form>

<h2>Poll List</h2>



<div class="w3-row">
    <div class="w3-container w3-padding-16">
        <table class="w3-table-all">
            <thead>
            <tr>
                <th>Poll NO</th>
                <th>Poll Name</th>
                <th>Created by</th>
                <th>END Date</th>
                <th>Is END?</th>
                <th>VOTE</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($poll as $i){ ?>
                <tr class="<?php if($i['end_status'] == 1){echo "w3-red";}  ?>">
                    <td><a href="<?php echo site_url('election/vote/'.$i['id']."/".$i['verify_key']); ?>"   class="w3-text-blue" target="_blank"><?php echo $i['id']; ?></a></td>
                    <td><?php echo $i['name']; ?></td>
                    <td><?php echo $i['first_name']; ?></td>
                    <td><?php echo $i['expire_date']; ?></td>
                    <td><?php if($i['end_status'] == 1){echo "ENDED";}else{echo "ACTIVE";}  ?></td>
                    <td><a href="<?php echo site_url('election/vote/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-button <?php if($i['end_status'] == 1){echo "w3-light-gray";}else{echo "w3-green";}  ?>" target="_blank" >VOTE </a></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>

<script>
    $(document).ready(function() {
        $('#user_table').DataTable( {
            scrollX: true,
        } );
    } );
</script>