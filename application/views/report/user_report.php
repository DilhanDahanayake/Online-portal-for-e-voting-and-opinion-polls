<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<br>
<br>
<h2>User Report</h2>
<form action="<?php echo base_url('report/user_report_search'); ?>" method="post">
  <label for="location">Location:</label>
  <input type="text" id="location" name="location"><br><br>
  <label for="education">Education Level:</label>

	<select name="educationlevel" id="education">
	  <option value="any">ANY</option>
	  <option value="1">OL</option>
	  <option value="2">AL</option>
	  <option value="3">Graduate</option>
	  <option value="4">Post Graduate</option>
	</select>
	
	<label for="income">Monthly Income:</label>

	<select name="incomelevel" id="income">
	  <option value="any">ANY</option>	
	  <option value="1">Rs 0 - 50 000</option>
	  <option value="2">Rs 50 000 - 100 000</option>
	  <option value="3">Rs 100 000 - 250 000</option>
	  <option value="4">Rs 250 000 above</option>
	</select>
	
	 <label for="numofchild">Number of Child:</label>
  	 <input type="text" id="numofchild" name="numofchild">
	
	
	<label for="gender">Gender:</label>
	<select name="gender" id="gender">
	  <option value="any">ANY</option>	
	  <option value="1">Male</option>
	  <option value="2">Female</option>
	</select>
	
  <input type="submit" value="Search">
</form>
<div  class="w3-row">
    <table id="user_table" style="width: 100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
            <th>Mobile</th>
            <th>Admin</th>
            <th>Super User</th>
            <th>Address</th>
            <th>Experience</th>
            <th>Married</th>
            <th>Children</th>
            <th>Education Level</th>
            <th>Monthly income</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($users as $i){ ?>
            <tr>

                <td><?php echo $i['idusers']; ?></td>
                <td><?php echo $i['firstname']; ?></td>
                <td><?php echo $i['lastname']; ?></td>
                <td><?php echo $i['city']; ?></td>
                <td><?php echo $i['mobilenumber']; ?></td>
                <td><?php echo $i['admin']; ?></td>
                <td><?php echo $i['superuser']; ?></td>
                <td><?php echo $i['address']; ?></td>
                <td><?php echo $i['experience']; ?></td>
                <td><?php echo $i['married']; ?></td>
                <td><?php echo $i['numchildren']; ?></td>
                <td>
                    <?php
                    if ($i['education_level'] == 1){echo "OL";}
                    elseif ($i['education_level'] == 2){echo "AL";}
                    elseif ($i['education_level'] == 3){echo "Graduate";}
                    elseif ($i['education_level'] == 4){echo "Post Graduate";}
                    else{
                        echo "Not Set";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($i['monthly_income'] == 1){echo "Rs 0 - 50 000";}
                    elseif ($i['monthly_income'] == 2){echo "Rs 50 000 - 100 000";}
                    elseif ($i['monthly_income'] == 3){echo "Rs 100 000 - 250 000";}
                    elseif ($i['monthly_income'] == 4){echo "Rs 250 000 Above";}
                    else{
                        echo "Not Set";
                    }

                    ?>
                </td>
                <td><?php echo $i['email']; ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>


</div>

<script>
    $(document).ready(function() {
        $('#user_table').DataTable( {
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>
<div class="w3-row">
    <div class="w3-container w3-half w3-padding-16">
        <canvas id="myChart3" style="width:100%;max-width:700px"></canvas>
    </div>
    <div class="w3-container w3-half w3-padding-16">
        <canvas id="myChart2" style="width:100%;max-width:700px"></canvas>
    </div>
	<div class="w3-container w3-half w3-padding-16">
        <canvas id="myChart1" style="width:100%;max-width:700px"></canvas>
    </div>
</div>

<script>		
	 <?php
		$ol = 0;
		$al = 0;
		$grad = 0;
		$postgrad = 0;
        foreach($users as $i) {
		    if($i['education_level'] == 1){
				$ol = $ol + 1;	
			}
			if($i['education_level'] == 2){
				$al = $al + 1;	
			}
			if($i['education_level'] == 3){
				$grad = $grad + 1;	
			}
			if($i['education_level'] == 4){
				$postgrad = $postgrad + 1;	
			}
        }
        ?>
    var yValues3 = [
       <?php echo $ol.", ".$al.", ".$grad.",".$postgrad; ?>
    ];
	
	 var xValues3 = [
       "OL","AL","Graduate","Post graduate"
    ];
    var barColors2 = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart("myChart3", {
        type: "doughnut",
        data: {
            labels: xValues3,
            datasets: [{
                backgroundColor: barColors2,
                data: yValues3
            }]
        },
        options: {
            title: {
                display: true,
                text: "Education level"
            }
        }
    });
</script>

<script>		
	 <?php
		$ol = 0;
		$al = 0;
		$grad = 0;
		$postgrad = 0;
        foreach($users as $i) {
		    if($i['monthly_income'] == 1){
				$ol = $ol + 1;	
			}
			if($i['monthly_income'] == 2){
				$al = $al + 1;	
			}
			if($i['monthly_income'] == 3){
				$grad = $grad + 1;	
			}
			if($i['monthly_income'] == 4){
				$postgrad = $postgrad + 1;	
			}
        }
        ?>
    var yValues3 = [
       <?php echo $ol.", ".$al.", ".$grad.",".$postgrad; ?>
    ];
	
	 var xValues3 = [
       "0k-50k","50k-100k","100k-250k","250k <"
    ];
    var barColors2 = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart("myChart2", {
        type: "doughnut",
        data: {
            labels: xValues3,
            datasets: [{
                backgroundColor: barColors2,
                data: yValues3
            }]
        },
        options: {
            title: {
                display: true,
                text: "Income level"
            }
        }
    });
</script>


<script>		
	 <?php
		$male = 0;
		$female = 0;
        foreach($users as $i) {
		    if($i['gender'] == 1){
				$male = $male + 1;	
			}
			if($i['gender'] == 2){
				$female = $female + 1;	
			}
        }
        ?>
    var yValues3 = [
       <?php echo $male.", ".$female; ?>
    ];
	
	 var xValues3 = [
       "Male","Female"
    ];
    var barColors2 = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
    ];

    new Chart("myChart1", {
        type: "doughnut",
        data: {
            labels: xValues3,
            datasets: [{
                backgroundColor: barColors2,
                data: yValues3
            }]
        },
        options: {
            title: {
                display: true,
                text: "Gender"
            }
        }
    });
</script>