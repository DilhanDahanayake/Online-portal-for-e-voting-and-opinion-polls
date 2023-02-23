
<section class="w3-container w3-padding">
    <div>
        <div class="w3-center w3-padding">
            <h1>Login - OTP Verify</h1>
            <form action="<?php echo base_url(); ?>login/verify_otp/<?php echo $user_id; ?>" id="myForm" method="post">

             <label for="username">Mobile Number</label>
             <h4><?php if (isset($error)){
                 echo $error;
             } ?></h4>
             <input type="number" placeholder="OTP" style="color: black" name="otp">

            <button class="w3-button w3-green">Verify</button>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</section>