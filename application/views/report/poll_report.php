<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<br>
<br>
<h2>Poll Reports</h2>

<div class="w3-row">
    <table id="election_table" style="width: 100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User</th>
            <th>User First Name</th>
            <th>End Date</th>
            <th>Description</th>
            <th>End Status</th>
            <th>Result</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($poll as $i){ ?>
            <tr>
                <td><?php echo $i['id']; ?></td>
                <td><?php echo $i['name']; ?></td>
                <td><?php echo $i['user_id']; ?></td>
                <td><?php echo $i['first_name']; ?></td>
                <td><?php echo $i['expire_date']; ?></td>
                <td><?php echo $i['description']; ?></td>
                <td><?php echo $i['end_status']; ?></td>
                <td><a href="<?php echo site_url('election/view/'.$i['id']."/".$i['verify_key']); ?>"  class="w3-green w3-button" target="_blank">Results</a></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>


</div>
<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
    </div>
    <div class="w3-container w3-half w3-padding-16">
        <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#election_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>

<script>
    var xValues1 = [
        <?php
        foreach($poll_count as $i) {

            echo '"'.$i['first_name'].'"';
            echo ",";
        }
        ?>
    ];

    var yValues1 = [
        <?php
        foreach($poll_count as $i) {

            echo '"'.$i['election_count'].'"';
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
                text: "Poll By Users"
            }
        }
    });
</script>