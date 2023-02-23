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
            <th>City</th>
            <th>Email</th>
            <th>Email Verify</th>
            <th>More Data</th>
            <th>Set Admin</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($user as $i){ ?>
            <tr>
                <td><?php echo $i['idusers']; ?></td>
                <td><?php echo $i['firstname']; ?></td>
                <td><?php echo $i['lastname']; ?></td>
                <td><?php echo $i['nic']; ?></td>
                <td><?php echo $i['mobilenumber']; ?></td>
                <td><?php echo $i['admin']; ?></td>
                <td><?php echo $i['superuser']; ?></td>
                <td><?php echo $i['address']; ?></td>
                <td><?php echo $i['city']; ?></td>
                <td><?php echo $i['email']; ?></td>
                <td><?php if ($i['email_valid'] == 0){echo "Not Verified";}else{echo "Verified";} ?>
                    <a <?php if ($i['email_valid'] == 0){echo "";}else{echo " hidden ";} ?>  href="<?php echo site_url('user/verify_email/'.$i['idusers']); ?>"  class="w3-button w3-green " target="_blank">Verify Email</a>
                </td>
                <td ><a href="<?php echo site_url('user/additional_data/'.$i['idusers']); ?>"  class="w3-button w3-yellow <?php if ($i['status'] == 0) {echo "btn-disabled";}?>" target="_blank">More Data</a></td>
                <td ><a href="<?php echo site_url('user/set_admin/'.$i['idusers']); ?>"  class="w3-button w3-green <?php if ($i['status'] == 0) {echo "btn-disabled";}?>" target="_blank">Set Admin</a></td>
                <td ><a href="<?php echo site_url('user/delete/'.$i['idusers']); ?>"  class="w3-button w3-red <?php if ($i['status'] == 0) {echo "btn-disabled";}?>" >Delete</a></td>
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
<br>
<h3>Update User</h3>
<div class="w3-padding-16">
    <form action="<?php echo base_url(); ?>user/update_user" id="myForm" method="post">

        <h4><?php if (isset($error)){
                echo $error;
            } ?></h4>

        <input type="text" hidden value="<?php echo $user[0]['idusers']; ?>" name="user_id">
    <div class="col-md-3">
        <label for="username">First name</label><br>
        <input type="text" placeholder="Office" class="form-control" value="<?php echo $user[0]['firstname']; ?>" name="firstname"><br>
        <label for="username">Last Name</label><br>
        <input type="text" placeholder="lastname" class="form-control" value="<?php echo $user[0]['lastname']; ?>" name="lastname"><br>
        <label for="username">NIC</label><br>
        <input type="text" placeholder="nic" class="form-control" value="<?php echo $user[0]['nic']; ?>" name="nic"><br>
        <label for="username">E-Mail</label><br>
        <input type="text" placeholder="email" class="form-control" value="<?php echo $user[0]['email']; ?>" name="email"><br>
        <label for="username">Mobile Number</label><br>
        <input type="text" placeholder="mobilenumber" class="form-control" value="<?php echo $user[0]['mobilenumber']; ?>" name="mobilenumber"><br>
        <label for="username">Address</label><br>
        <input type="text" placeholder="address" class="form-control" value="<?php echo $user[0]['address']; ?>" name="address"><br>
        <label for="username">City</label><br>
        <input type="text" placeholder="city" class="form-control" value="<?php echo $user[0]['city']; ?>" name="city"><br>
        
        <button class="w3-button w3-green">UPDATE</button>
    </form>
    <div class="w3-padding-16"> <br>
        <h4>User Profile Photo</h4>
        <img src="<?php echo base_url(); ?>uploads\user_<?php echo $this->session->userdata('id'); ?>.png" class="img-radius" alt="User-Profile-Image" height="100" width="100">
        <form action="<?php echo base_url(); ?>user/pic_upload" method="post" enctype="multipart/form-data">
            Select image to upload
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br> <br>
            <input type="submit" class="w3-button w3-green" value="Upload Image" name="submit">
        </form>
    </div>
    <br>
    <a href="<?php echo site_url('user/additional_data/'.$this->session->userdata('id')); ?>"  class="w3-button w3-yellow " target="_blank">Additional Data</a>
    </div>
</div>


