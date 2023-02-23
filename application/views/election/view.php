
<h2><?php echo $election[0]['name']; ?></h2>
<br>
<h4>Poll Questions Count : <?php echo $poll_count; ?></h4>
<h4>Total Vote Count : <?php echo $vote_count; ?></h4>
<h2>Vote Log</h2>
<div class="w3-row">

        <table id="v_table" style="width: 100%">
            <thead>
            <tr>
                <th>Election ID</th>
                <th>Answer ID</th>
                <th>Vote</th>
                <th>User</th>
                <th>User First Name</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($vote_log as $i){ ?>
                <tr>
                    <td><?php echo $i['poll_id']; ?></td>
                    <td><?php echo $i['answer_id']; ?></td>
                    <td><?php echo $i['vote']; ?></td>
                    <td><?php echo $i['user_id']; ?></td>
                    <td><?php echo $i['first_name']; ?></td>
                </tr>
            <?php } ?>
            </tbody>

        </table>



</div>

<script>
    $(document).ready(function() {
        $('#v_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
        
    } );
</script>
<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
    </div>
</div>


<script>
    var xValues1 = [
        <?php
        foreach($vote_log_chart as $i) {

            echo '"'.$i['answer_id'].'"';
            echo ",";
        }
        ?>
    ];

    var yValues1 = [
        <?php
        foreach($vote_log_chart as $i) {

            echo '"'.$i['vote'].'"';
            echo ",";
        }
        ?>
    ];
    var barColors1 = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart("myChart1", {
        type: "doughnut",
        data: {
            labels: xValues1,
            datasets: [{
                backgroundColor: barColors1,
                data: yValues1
            }]
        },
        options: {
            title: {
                display: true,
                text: "Answer VS Vote"
            }
        }
    });
</script>