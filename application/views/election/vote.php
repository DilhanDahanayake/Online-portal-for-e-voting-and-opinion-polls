<style>
    .disable{
        cursor: not-allowed;
        pointer-events: none;
    }
</style>

<h1>Poll - Submit Vote</h1>
<br>
<h2>Poll Name : <?php echo $election[0]['name']; ?></h2>
<br>
<h3>Question  : <?php echo $poll_data[0]['name']; ?></h3>
<br>

<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <table class="w3-table-all">
            <thead>
            <tr>
                <th>Answer</th>
                <th>Vote</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($poll_answers as $i){ ?>
                <tr>
                    <td><?php echo $i['answer']; ?></td>
                    <td><a href="<?php
                        if ($answer_id != 0){
                            echo "#";
                        }else{
                            echo site_url('election/vote_submit/'.$i['id']."/".$i['verify_key']."/".$e_id."/".$e_key."/".$poll_id);
                        }


                        ?>"   class="w3-button w3-green <?php if ($answer_id != 0){echo " disable w3-light-gray";} ?>" >
                            <?php
                            if ($answer_id != 0){
                                if($i['id'] == $answer_id){
                                    echo "VOTED";
                                }else{
                                    echo "-";
                                }
                            }else{
                                echo "VOTE";
                            }


                            ?>
                        </a></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
    <div class="w3-container w3-half w3-padding-16 w3-border">
        <h2>Comment</h2>
		
		
        <form action="<?php echo base_url(); ?>election/comment_submit" id="myForm" method="post">

            <label for="username">Your Comment</label>
            <h4><?php if (isset($error)){
                    echo $error;
                } ?></h4>
			
			<ul>
			<?php foreach($comments as $c){ ?>
				<li><?php echo $c->comment; ?></li>
			<?php }?>
			</ul>
			<input type="text" placeholder="Comment" value="<?php echo $poll_data[0]['comment']; ?>" name="comment">
				
            <input type="text" hidden value="<?php echo $e_key; ?>" name="election_key">
            <input type="text" hidden value="<?php echo $election[0]['id']; ?>" name="election_id">
            <input type="text" hidden value="<?php echo $poll_data[0]['id']; ?>" name="poll_id">
            <button>Save</button>
        </form>
    </div>


</div>
<br>

<h2>Other Poll Questions </h2>
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
                    <td><a href="<?php echo site_url('election/vote/'.$e_id."/".$e_key."/".$i['id']); ?>"  class="w3-blue w3-button" >Vote</a></td>
					<td><a href="<?php echo site_url('election/showPollVoteAndResultFromElection/'.$e_id); ?>"  class="w3-blue w3-button" >Result</a></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>


</div>




