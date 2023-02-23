
<h3>Update User Additional Data </h3>
<br>
<div class="padding-16">
    <form action="<?php echo base_url(); ?>user/update_user_additional" id="myForm" method="post">
        <input type="text" hidden value="<?php echo $user_add[0]['idadditionaldata']; ?>" name="user_add_id">
        <input type="text" hidden value="<?php echo $user[0]['idusers']; ?>" name="user_id">


        <h4><?php if (isset($error)){
                echo $error;
            } ?></h4>
        <div class="col-md-3">
            <label for="username">Office Name</label><br>
            <input type="text" placeholder="Office" class="form-control" value="<?php echo $user_add[0]['office']; ?>" name="office"><br>
            <label for="username">Experience</label><br>
            <input type="number" placeholder="Experience" class="form-control" value="<?php echo $user_add[0]['experience']; ?>" name="experience"><br>   
            <label for="username">Birthday</label><br>
            <input type="date" placeholder="birthday" class="form-control" value="<?php echo $user_add[0]['birthday']; ?>" name="birthday"><br>
            <label for="username">Marital status (Yes = 1/No =0)</label><br>
            <input type="number" placeholder="Yes = 1/No =0" class="form-control" value="<?php echo $user_add[0]['married']; ?>" maxlength="1" name="married"><br>
            <label for="username">Children Count</label><br>
            <input type="number" placeholder="Children Count" class="form-control" value="<?php echo $user_add[0]['numchildren']; ?>" name="numchildren"><br>
				
		<label for="gender">Gender : <?php if($user_add[0]['gender']==1){echo "Male";}elseif($user_add[0]['gender']==2){echo "Female";}else{echo "Please select the gender";} ?></label><br>
		<select class="form-select" name="gender" id="gender">
		  <option value="1">Male</option>
		  <option value="2">Female</option>
		</select>
		
        
        <br>
        <h6>Highest Educational Level</h6>
        <input type="radio" id="ed1" name="education" <?php if ($user_add[0]['education_level'] == 1){echo " checked ";} ?> value="1">
        <label for="ol">OL</label><br>
        <input type="radio" id="ed2" name="education" <?php if ($user_add[0]['education_level'] == 2){echo " checked ";} ?> value="2">
        <label for="al">AL</label><br>
        <input type="radio" id="ed3" name="education" <?php if ($user_add[0]['education_level'] == 3){echo " checked ";} ?> value="3">
        <label for="udegree">Graduate</label><br>
        <input type="radio" id="ed4" name="education"  <?php if ($user_add[0]['education_level'] == 4){echo " checked ";} ?> value="4">
        <label for="pdegree">Post Graduate</label><br><br>

        <h6>Income Level</h6>
        <input type="radio" id="mi1" name="monthly_income" <?php if ($user_add[0]['monthly_income'] == 1){echo " checked ";} ?>  value="1">
        <label for="ol">Rs 0 - 50 000</label><br>
        <input type="radio" id="mi2" name="monthly_income" <?php if ($user_add[0]['monthly_income'] == 2){echo " checked ";} ?> value="2">
        <label for="al">Rs 50 000 - 100 000</label><br>
        <input type="radio" id="mi3" name="monthly_income" <?php if ($user_add[0]['monthly_income'] == 3){echo " checked ";} ?> value="3">
        <label for="udegree">Rs 100 000 - 250 000</label><br>
        <input type="radio" id="mi4" name="monthly_income" <?php if ($user_add[0]['monthly_income'] == 4){echo " checked ";} ?> value="4">
        <label for="pdegree">Rs 250 000 Above</label><br><br>
        <button class="w3-button w3-green">Update</button>
    </div>
    </form>
</div>
