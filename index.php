<!DOCTYPE html>
<html>
<head>
	<title>Verification Report</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="bower_components\jquery-table2excel\dist\jquery.table2excel.min.js"></script>
  <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
</head>
<body>
	
	<div class="container page-heading mb-4">
		<?php echo '<center><h1>Verification Report</h1></center><br>'; ?></h3>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 20px;"><button class="btn btn-success float-right" id="emp">Employee</button></div>
			<div class="col-xs-6"><button class="btn btn-success float-left" id="bus">Business</button></div>
		</div>
	</div>

  	<div class="container" id="loadDashboard">
    <center>
    	<img src="loader2.gif" alt="Loading..." id="loader" >
    </center>
  </div>

	<script type="text/javascript">
		$(document).ready(function(){

		  setTimeout(function(){
		    loadDashboard();
		  }, 1000);

		  // setInterval(function(){
		  //   loadDashboard();
		  // }, 30000);
		  
		  let reportLink = "report.php";

		  $('#emp').click(function(){
		  	reportLink = "report.php";
		  	loadDashboard();
		  });
		  $('#bus').click(function(){
		  	reportLink = "bus_report.php";
		  	loadDashboard();
		  });

		  async function loadDashboard(){ 
		    let result = await $.ajax({
	          url:reportLink,
	          method:"GET",
	          beforeSend: function(){
	            // Show image container
	            $("#loader").show();
	          },
	          success:function(data){
	            $('#loadDashboard').html(data);
	          },
	          complete:function(){
	              // Hide image container
	              $("#loader").hide();
	            }
	        });

		    return result;
		  }

		var date = new Date().getDate()+"_"+ new Date().getMonth()+"_"+ new Date().getFullYear()
		$('body').on('click', '#todaycall', function() {

			$(".todaycallcount").table2excel({
			    exclude: ".noExl",
			    name: "todaycallcount",
			    filename: "todaycallcount-" + date + ".xls", // do include extension
			    preserveColors: false // set to true if you want background colors and font colors preserved
			});

		});

		$('body').on('click', '#agentstatus', function() {

			$(".agentstatuscount").table2excel({
			    exclude: ".noExl",
			    name: "agentstatus",
			    filename: "agentstatus-" + date + ".xls", // do include extension
			    preserveColors: false // set to true if you want background colors and font colors preserved
			});

		});
		$('body').on('click', '#agentcount', function() {

			$(".agentcallcount").table2excel({
			    exclude: ".noExl",
			    name: "Agent Call Count",
			    filename: "AgentCount-" + date + ".xls", // do include extension
			    preserveColors: false // set to true if you want background colors and font colors preserved
			});

		});


});

	</script>
</body>
</html>