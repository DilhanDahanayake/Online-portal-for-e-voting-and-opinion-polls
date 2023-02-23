
<section class="w3-container w3-padding">
    <div>
        <div class="w3-center w3-padding">
            <br>
            <br>
            <br>
            <h2>Login By Email</h2>
            <form action="<?php echo base_url(); ?>login/verify" id="myForm" method="post">


                <h4 class="w3-text-red"><?php if (isset($error)){
                        echo $error;
                        
                    } ?></h4>
                <input type="email" placeholder="Email" style="color: black" value="<?php if (isset($user_name)){echo $user_name;} ?>" name="email" required>

                <button class="w3-button w3-green">Log In</button>
            </form>
            <br>
            <h2>Login By Mobile</h2>
            <form action="<?php echo base_url(); ?>login/verify_mobile" id="myForm" method="post">
                <h4 class="w3-text-red"><?php if (isset($error)){
                        
                    } ?></h4>
                <input type="number" placeholder="Mobile" style="color: black" value="<?php if (isset($user_name)){echo $user_name;} ?>" name="mobile" required>

                <button class="w3-button w3-green">Log In</button>
            </form>
            <br>
            <h2>Login By NIC</h2>
            <form action="<?php echo base_url(); ?>login/verify_nic" id="myForm" method="post">
                <h4 class="w3-text-red"><?php if (isset($error)){
                        
                    } ?></h4>
                <input type="text" placeholder="NIC" style="color: black" value="<?php if (isset($user_name)){echo $user_name;} ?>" name="mobile"required>

                <button class="w3-button w3-green">Log In</button>
            </form>
            <br>
            <br>
            <br>
            <br>
            <br>
            <form class="w3-padding" action="<?php echo base_url(); ?>login/register" id="myForm" method="post">

                <h1>Sign Up</h1>
                <label for="register_mobile">Register via Mobile Number</label>
                <h4><?php if (isset($error_r)){
                        echo $error_r;
                    } ?></h4>
                <!-- <div class="w3-center w3-padding"> 
                <div class="col-sm-2">-->
                <input type="text" placeholder="First Name"  value="" name="firstname" required><br>
              <!--  </div>
                </div> -->
                <input type="text" placeholder="Last Name" value="" name="lastname" required><br>
                <input type="email" placeholder="Email"  value="" name="email" required><br>
                <input type="number" placeholder="Mobile" style="color: black" value="<?php if (isset($user_name)){echo $user_name;} ?>" name="mobile" required><br>
              <!--  <input type="tel" placeholder="Mobile" pattern="[0-9]{10}" style="color: black" value="<?php if (isset($user_name)){echo $user_name;} ?>" name="mobile" required><br>
               --> <br>
                <button class="w3-button w3-green">Register</button>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
</section>

