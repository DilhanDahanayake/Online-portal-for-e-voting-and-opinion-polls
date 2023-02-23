
<h1>Poll Creation</h1>
<form action="<?php echo base_url(); ?>election/save_create_election" id="myForm" method="post">

<div class="col-md-3">
    <b>POll Name</b>
    <h4><?php if (isset($error)){
            echo $error;
        } ?></h4>
    <input type="text" placeholder="Name" class="form-control" value="" name="name">
    <br>
    <b>END Date </b>
    <br>
    <input type="date"  class="form-control" value="" name="expire_date">
    <br>
    <b>Description </b>
	<br>
    <input type="text" placeholder="Description" class="form-control" value="" name="description">
	<br>
	<button class="w3-button w3-green">Create</button>
</div>
</form>