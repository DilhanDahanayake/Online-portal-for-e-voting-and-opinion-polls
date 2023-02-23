
<h3>Add User Additional Data</h3>
<br>
<div class="padding-16">
<form action="<?php echo base_url(); ?>user/save_user_add" id="myForm" method="post">
    <input type="text" hidden value="<?php echo $user[0]['idusers']; ?>" name="user_id">


    <h4><?php if (isset($error)){
            echo $error;
        } ?></h4>
    <div class="col-md-3">
    <label for="username">Office Name</label>
    <input type="text" placeholder="Office" class="form-control" value="" name="office"><br>
    <label for="username">Experience</label>
    <input type="number" placeholder="Experience" class="form-control" value="" name="experience"><br>
    <label for="username">Birthday</label>
    <input type="date" placeholder="birthday" class="form-control" value="" name="birthday"><br>
    <label for="username">Marital status (Yes = 1/No =0)</label>
    <input type="number" placeholder="Yes = 1/No =0" class="form-control" value="" maxlength="1" name="married"><br>
    <label for="username">Children Count</label>
    <input type="number" placeholder="Children Count" class="form-control" value="" name="numchildren"><br>
	
	
	<label for="gender">Gender:</label>

	<select class="form-select" name="gender" id="gender">
	  <option value="1">Male</option>
	  <option value="2">Female</option>
	</select>
    <br>
    <h6>Highest Educational Level</h6>
    <input type="radio" id="ed1" name="education" value="1">
    <label for="ol">OL</label><br>
    <input type="radio" id="ed2" name="education" value="2">
    <label for="al">AL</label><br>
    <input type="radio" id="ed3" name="education"  value="3">
    <label for="udegree">Graduate</label><br>
    <input type="radio" id="ed4" name="education"  value="4">
    <label for="pdegree">Post Graduate</label><br><br>

    <h6>Income Level</h6>
    <input type="radio" id="mi1" name="monthly_income" value="1">
    <label for="ol">Rs 0 - 50 000</label><br>
    <input type="radio" id="mi2" name="monthly_income" value="2">
    <label for="al">Rs 50 000 - 100 000</label><br>
    <input type="radio" id="mi3" name="monthly_income"  value="3">
    <label for="udegree">Rs 100 000 - 250 000</label><br>
    <input type="radio" id="mi4" name="monthly_income"  value="4">
    <label for="pdegree">Rs 250 000 Above</label><br><br>
    <button class="w3-button w3-green">Save</button>
    </div>
</form>
</div>