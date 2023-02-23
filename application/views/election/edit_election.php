<style>
    .disable{
        cursor: not-allowed;
        pointer-events: none;
    }
</style>


<h1>Poll - Update</h1>
<br>
<h2>Poll Name : <?php echo $election[0]['name']; ?></h2>
<h2><?php if($poll_empty == 0){ echo "Poll Question  : ".$poll_data[0]['name'];} ?></h2>
<br>
<form action="<?php echo base_url(); ?>election/create_poll/<?php echo $e_id; ?>/<?php echo $e_key; ?>" id="myForm" method="post">
    <button class="w3-button w3-green " >Add Question for poll</button>
</form>
<br>

<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <table class="w3-table-all">
            <thead>
            <tr>
                <th>Answer</th>
                <th>Points</th>
                <th>User First Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($poll_answers as $i){ ?>
                <tr>
                    <td><?php echo $i['answer']; ?></td>
                    <td><?php echo $i['point_count']; ?></td>
                    <td><?php echo $i['first_name']; ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>
<br>
<form action="<?php echo base_url(); ?>election/add_question" id="myForm" method="post">
<div class="col-md-3">
    <b><label for="username" >Add Answer</label></b>
    <h4><?php if (isset($error)){
            echo $error;
        } ?></h4>
    <input type="text" placeholder="question" value="<?php echo $poll_id; ?>" name="id" hidden>
    <input type="text" placeholder="question" value="<?php echo $poll_key; ?>" name="key" hidden>
    <input type="text" placeholder="question" value="<?php echo $e_id; ?>" name="election_id" hidden>
    <input type="text" placeholder="question" value="<?php echo $e_key; ?>" name="election_key" hidden>
    <input type="text" class="form-control" placeholder="answer" value="" name="answer">
    <br>
    <button class="<?php if($poll_empty != 0){ echo "disable w3-light-green";}  ?>w3-button w3-green" >ADD</button>
</div>
</form>
<br>
<h2>Questions </h2>
<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <table class="w3-table-all">
            <thead>
            <tr>
                <th>Name</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($polls as $i){ ?>
                <tr class="<?php if ($poll_id ==$i['id'] ){ echo "w3-green";} ?>">
                    <td><?php echo $i['name']; ?></td>
                    <td><a href="<?php echo site_url('election/edit_election/'.$e_id."/".$e_key."/".$i['id']); ?>"  class="w3-blue w3-button" >Edit</a></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>