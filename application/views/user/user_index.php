<style>
    .btn-disabled,
    .btn-disabled[disabled] {
        opacity: .4;
        cursor: default !important;
        pointer-events: none;
    }
</style>
<h1>User Management</h1>
<br>
<div class="w3-padding-16">
    <!--    <h2>User Profile Photo</h2>-->
    <img src="<?php echo base_url(); ?>uploads\user_<?php echo $this->session->userdata('id'); ?>.png" class="img-radius" alt="User-Profile-Image" height="100" width="100">
    <!--    <form action="--><?php //echo base_url(); ?><!--user/pic_upload" method="post" enctype="multipart/form-data">-->
    <!--        Select image to upload:-->
    <!--        <input type="file" name="fileToUpload" id="fileToUpload">-->
    <!--        <br>-->
    <!--        <input type="submit" class="w3-button w3-green" value="Upload Image" name="submit">-->
    <!--    </form>-->
</div>
<!--<br>-->
<!--<br>-->
<!--<br>-->
<br>
<div class="w3-row">
    <table tyle="width:100%" id="user_table" >
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>NIC</th>
            <th>Mobile</th>
            <th>Admin</th>
            <th>Super User</th>
            <th>Address</th>
            <th>Email</th>
            <th>Email Verify</th>
            <th>Status</th>
            <th>Update</th>
            <th>More Data</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $i){ ?>
            <tr class=" <?php if ($i['status'] == 0) {
                echo "w3-red";
            }
            ?>">

                <td><?php echo $i['idusers']; ?></td>
                <td><?php echo $i['firstname']; ?></td>
                <td><?php echo $i['lastname']; ?></td>
                <td><?php echo $i['nic']; ?></td>
                <td><?php echo $i['mobilenumber']; ?></td>
                <td><?php echo $i['admin']; ?></td>
                <td><?php echo $i['superuser']; ?></td>
                <td><?php echo $i['address']; ?></td>
                <td><?php echo $i['email']; ?></td>
                <td><?php if ($i['email_valid'] == 0){echo "Not Verified";}else{echo "Verified";} ?>
                    <a <?php if ($i['email_valid'] == 0){echo "";}else{echo " hidden ";} ?>  href="<?php echo site_url('user/verify_email/'.$i['idusers']); ?>"  class="w3-button w3-green " target="_blank">Verify Email</a>
                </td>
                <td><?php echo $i['status']; ?></td>
                <td ><a href="<?php echo site_url('user/edit_user/'.$i['idusers']); ?>"  class="w3-button w3-yellow <?php if ($i['status'] == 0) {echo "btn-disabled";}?>" target="_blank">Update</a></td>
                <td ><a href="<?php echo site_url('user/additional_data/'.$i['idusers']); ?>"  class="w3-button w3-yellow <?php if ($i['status'] == 0) {echo "btn-disabled";}?>" target="_blank">More Data</a></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>


</div>
<script>
    $(document).ready(function() {
        $('#user_table').DataTable( {
            scrollX: true,
        } );
    } );
</script>