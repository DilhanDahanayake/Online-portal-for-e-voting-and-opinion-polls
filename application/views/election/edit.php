

<h1>POLL - Update</h1>
<br>
<h2>POLL Name : <?php echo $poll[0]['name']; ?></h2>
<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <table class="w3-table-all">
            <thead>
            <tr>
                <th>ID</th>
                <th>Poll ID</th>
                <th>Answer</th>
                <th>Points</th>
                <th>User</th>
                <th>User First Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($poll_answers as $i){ ?>
                <tr>
<!--                    <td><a href="--><?php //echo site_url('poll/edit/'.$i['id']."/".$i['verify_key']); ?><!--"  class="w3-text-blue" target="_blank">--><?php //echo $i['id']; ?><!--</a></td>-->
                    <td><?php echo $i['id']; ?></td>
                    <td><?php echo $i['poll_id']; ?></td>
                    <td><?php echo $i['answer']; ?></td>
                    <td><?php echo $i['point_count']; ?></td>
                    <td><?php echo $i['user_id']; ?></td>
                    <td><?php echo $i['first_name']; ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>
<br>
<form action="<?php echo base_url(); ?>poll/add_question" id="myForm" method="post">

    <label for="username">Add Question</label>
    <h4><?php if (isset($error)){
            echo $error;
        } ?></h4>
    <input type="text" placeholder="question" value="<?php echo $poll_id; ?>" name="id" hidden>
    <input type="text" placeholder="question" value="<?php echo $poll_key; ?>" name="key" hidden>
    <input type="text" placeholder="question" value="" name="answer">

    <button>ADD</button>
</form>