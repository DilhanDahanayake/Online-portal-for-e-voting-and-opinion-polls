<title>Create Poll</title>
<h1>Create Questions</h1>
<form action="<?php echo base_url(); ?>election/save_create_poll" id="myForm" method="post">

<div class="col-md-3">
    <label for="username">Question </label>
    <h4><?php if (isset($error)){
            echo $error;
        } ?></h4>
    <input type="text" placeholder="question" class="form-control" value="" name="name">
    <input type="text" hidden value="<?php echo $election[0]['id']; ?>" name="election_id">
    <input type="text" hidden value="<?php echo $election[0]['verify_key']; ?>" name="election_key">
    <br>
    <button class="w3-button w3-green">Create</button>
</div>
</form>