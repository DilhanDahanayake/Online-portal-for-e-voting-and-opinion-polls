
<section class="w3-container w3-padding">
    <div>
        <div class="w3-center w3-padding">
            <h1>EMAIL - OTP Verify</h1>
            <form action="<?php echo base_url(); ?>user/verify_email_otp/<?php echo $id; ?>" id="myForm" method="post">

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