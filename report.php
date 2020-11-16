<?php 
  include 'db.php';

  $sql = "SELECT DATE(date_updated) date_updated, CASE WHEN emp_status = 0 THEN 'Rejected' WHEN emp_status = 1 THEN 'Approved' WHEN emp_status = 2 THEN 'Ongoing' WHEN emp_status = 3 THEN 'Voicemail' WHEN emp_status = 4 THEN 'Escalation' WHEN emp_status = 0 THEN 'Rejected' ELSE emp_status END status, count(emp_status) count FROM `bm_employee` where DATE(date_updated) = current_date GROUP BY 1,2 ORDER BY DATE(date_updated) DESC ";
  $result = $conn->query($sql);

  $totalCount = "SELECT * from bm_employee where emp_status != -1 and DATE(date_updated) = current_date";
  if ($data=mysqli_query($conn,$totalCount)){
    $rowcount=mysqli_num_rows($data);
    echo "<h5><b>Total Calls Made Today ". number_format($rowcount). "</b></h5>";
  }

 $sqls = "SELECT  CONCAT(b.first_name, ' ' ,b.last_name) agent, count(CONCAT(b.first_name, ' ',b.last_name)) counts FROM `bm_employee` a, user b
    where a.user_id=b.id and DATE(a.date_updated) = current_date
    group by 1
    order by 2 DESC";
  $results = $conn->query($sqls);

  $sqlss = "SELECT  CONCAT(b.first_name,' ',b.last_name) agent, 
    CASE WHEN emp_status = 0 THEN 'Rejected' 
    WHEN emp_status = 1 THEN 'Approved'
    WHEN emp_status = 2 THEN 'Ongoing'
    WHEN emp_status = 3 THEN 'Voicemail'
    WHEN emp_status = 4 THEN 'Escalation'
    WHEN emp_status = 0 THEN 'Rejected' ELSE emp_status END State_status, count(a.emp_status) counts FROM `bm_employee` a, user b
    where a.user_id=b.id and DATE(a.date_updated) = current_date
    group by 1,2
    order by 1,3 DESC";
  $resultss = $conn->query($sqlss);
?>

<div class="container">
<div class="row">
    <div class="col-sm-6">

      <div class="row">
        <div class="col-sm-8">
          <h3>Today's Call (Employee) </h3> 
        </div>
        <div class="col-sm-4">
          <button class="btn btn-success btn-lg" id="todaycall">Export</button>
        </div>
      </div>
      

    <table class="table table-hover todaycallcount">
      <thead class="thead-dark noExl">
        <tr class="">
          <th>ID</th>
          <th>Call Date</th>
          <th>Status</th>
          <th>Count</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $i = 1;
          while ($row = $result->fetch_assoc()) { 

            echo "<tr>        
                    <th > ". $i ." </th>
                    <td>". $row['date_updated'] ."</td>
                    <td>". $row['status'] ."</td>
                    <td>". $row['count'] ."</td>
                  </tr>";
            $i++; 
             
          }
        } else {
            echo "0 results";
        }

        // $conn->close();
        ?>
       </tbody>
      </table>

    <div class="row">
      <div class="col-sm-12">

        <div class="row">
          <div class="col-sm-8">
            <h3>Agents Call Per Status</h3> 
          </div>
          <div class="col-sm-4">
            <button class="btn btn-success btn-lg" id="agentstatus">Export</button>
          </div>
        </div>
          
          <table class="table table-hover agentstatuscount">
          <thead class="thead-dark noExl"> 
            <tr>
              <th>ID</th>
              <th>Agent</th>
              <th>Status</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>

          <?php
            if ($resultss->num_rows > 0) {
              $i = 1;
              while ($rowss = $resultss->fetch_assoc()) { 

                echo "<tr>        
                        <th > ". $i ." </th>
                        <td>". $rowss['agent'] ."</td>
                        <td>". $rowss['State_status'] ."</td>
                        <td>". $rowss['counts'] ."</td>
                      </tr>";
                $i++; 
                 
              }
            } else {
                echo "0 results";
            }

            // $conn->close();
            ?>
           </tbody>
          </table>
      </div>
    </div>
  </div>

  <div class="col-sm-6">

    <div class="row">
      <div class="col-sm-12">

        <div class="row">
          <div class="col-sm-8">
            <h3>Agent Call Count</h3>
          </div>
          <div class="col-sm-4">
            <button class="btn btn-success btn-lg" id="agentcount">Export</button>
          </div>
        </div>

      <table class="table table-hover agentcallcount">
        <thead class="thead-dark noExl">
          <tr>
          <th>ID</th>
          <th>Agent</th>
          <th>Count</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($results->num_rows > 0) {
          $i = 1;
          while ($rows = $results->fetch_assoc()) { 


          echo "<tr>        
          <th > ". $i ." </th>
          <td>". $rows['agent'] ."</td>
          <td>". $rows['counts'] ."</td>
          </tr>";
          $i++; 

          }
          } else {
          echo "0 results";
          }
          // $conn->close();
          ?>
        </tbody>
      </table>

      </div>
    </div>

    

  </div>

</div>
</div>
<!-- <div class="container">
  <div class="row">
    <div class="col-sm-6">
      
    </div>
    <div class="col-sm-6">
      
    </div>
   
  </div>
</div> -->