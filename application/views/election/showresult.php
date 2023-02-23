<h2>Vote Result</h2>
<h2><?php echo $electiontitle; ?></h2>
<div class="w3-row">

        <table id="v_table" style="width: 100%">
            <thead>
            <tr>
				<th>Question</th>
                <th>Answer</th>
                <th>Result</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($pollresult as $i){ ?>
                <tr>
					<td><?php echo $i['name']; ?></td>
                    <td><?php echo $i['answer']; ?></td>
                    <td><?php echo $i['point_count']; ?></td>
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
        foreach($pollresult as $i) {

            echo '"'.$i['name'].' - '.$i['answer'].'"';
            echo ",";
        }
        ?>
    ];

    var yValues1 = [
        <?php
        foreach($pollresult as $i) {

            echo '"'.$i['point_count'].'"';
            echo ",";
        }
        ?>
    ];
    var barColors1 = [
        "#F4D03F",
        "#D35400",
        "#E74C3C",
        "#2874A6",
        "#884EA0"
    ];

    new Chart("myChart1", {
        type: "bar",
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