<html>
   <head>
      <title>PHP Test</title>
      <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
   </head>
   <style>
      .main{
        text-align: center;
        border: 2px solid gray;
        width:300px;
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
      .nextlevel {
        width:800px;
        text-align: center;
        border: 2px solid gray;
        display: block;
        margin-left: auto;
        margin-right: auto;
        padding:30px;
      }
      .zero {
        width:300px;
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
      .btn-link{
        border:none;
        outline:none;
        background:none;
        cursor:pointer;
        color:#0000EE;
        padding:0;
        text-decoration:underline;
        font-family:inherit;
        font-size:inherit;
}
      table.firsttable {
        border-collapse: collapse;
      }
       table.firsttable td,table.firsttable th {
         border: 2px solid #000;
         text-align: center;
         padding: 0 50px 0 50px;
       }
       table.nexttable {
         border-collapse: collapse;
         padding-top: 20px;
       }
        table.nexttable td,table.nexttable th {
          text-align: left;
          padding: 0 30px 0 80px;
        }
   </style>
   <script>
   function changeSelect(obj) {
    var val = document.getElementById("selectid").value;
    var text;
    switch (val) {
        case 'legislators':
            text= "State/Representative*";
            break;
        case 'bills':
            text= "Bill ID*";
            break;
        case 'Committees':
            text= "Committee ID*";
                break;
        case 'amendments':
            text= "Amendment ID*";
                break;
        default :
            text= "keyword*";
    }
    document.getElementById("keywordspace").innerHTML= text;
  }
   </script>
   <body>
     <?php
     function convert_state($name, $to = 'name')
     {
       $states = array(
       array('name'=>'Alabama', 'abbrev'=>'AL'),
       array('name'=>'Alaska', 'abbrev'=>'AK'),
       array('name'=>'Arizona', 'abbrev'=>'AZ'),
       array('name'=>'Arkansas', 'abbrev'=>'AR'),
       array('name'=>'California', 'abbrev'=>'CA'),
       array('name'=>'Colorado', 'abbrev'=>'CO'),
       array('name'=>'Connecticut', 'abbrev'=>'CT'),
       array('name'=>'Delaware', 'abbrev'=>'DE'),
       array('name'=>'Florida', 'abbrev'=>'FL'),
       array('name'=>'Georgia', 'abbrev'=>'GA'),
       array('name'=>'Hawaii', 'abbrev'=>'HI'),
       array('name'=>'Idaho', 'abbrev'=>'ID'),
       array('name'=>'Illinois', 'abbrev'=>'IL'),
       array('name'=>'Indiana', 'abbrev'=>'IN'),
       array('name'=>'Iowa', 'abbrev'=>'IA'),
       array('name'=>'Kansas', 'abbrev'=>'KS'),
       array('name'=>'Kentucky', 'abbrev'=>'KY'),
       array('name'=>'Louisiana', 'abbrev'=>'LA'),
       array('name'=>'Maine', 'abbrev'=>'ME'),
       array('name'=>'Maryland', 'abbrev'=>'MD'),
       array('name'=>'Massachusetts', 'abbrev'=>'MA'),
       array('name'=>'Michigan', 'abbrev'=>'MI'),
       array('name'=>'Minnesota', 'abbrev'=>'MN'),
       array('name'=>'Mississippi', 'abbrev'=>'MS'),
       array('name'=>'Missouri', 'abbrev'=>'MO'),
       array('name'=>'Montana', 'abbrev'=>'MT'),
       array('name'=>'Nebraska', 'abbrev'=>'NE'),
       array('name'=>'Nevada', 'abbrev'=>'NV'),
       array('name'=>'New Hampshire', 'abbrev'=>'NH'),
       array('name'=>'New Jersey', 'abbrev'=>'NJ'),
       array('name'=>'New Mexico', 'abbrev'=>'NM'),
       array('name'=>'New York', 'abbrev'=>'NY'),
       array('name'=>'North Carolina', 'abbrev'=>'NC'),
       array('name'=>'North Dakota', 'abbrev'=>'ND'),
       array('name'=>'Ohio', 'abbrev'=>'OH'),
       array('name'=>'Oklahoma', 'abbrev'=>'OK'),
       array('name'=>'Oregon', 'abbrev'=>'OR'),
       array('name'=>'Pennsylvania', 'abbrev'=>'PA'),
       array('name'=>'Rhode Island', 'abbrev'=>'RI'),
       array('name'=>'South Carolina', 'abbrev'=>'SC'),
       array('name'=>'South Dakota', 'abbrev'=>'SD'),
       array('name'=>'Tennessee', 'abbrev'=>'TN'),
       array('name'=>'Texas', 'abbrev'=>'TX'),
       array('name'=>'Utah', 'abbrev'=>'UT'),
       array('name'=>'Vermont', 'abbrev'=>'VT'),
       array('name'=>'Virginia', 'abbrev'=>'VA'),
       array('name'=>'Washington', 'abbrev'=>'WA'),
       array('name'=>'West Virginia', 'abbrev'=>'WV'),
       array('name'=>'Wisconsin', 'abbrev'=>'WI'),
       array('name'=>'Wyoming', 'abbrev'=>'WY')
       );
         $return = false;
         foreach ($states as $state) {
             if ($to == 'name') {
                 if (strtolower($state['abbrev']) == strtolower($name)) {
                     $return = $state['name'];
                     break;
                 }
             } else if ($to == 'abbrev') {
                 if (strtolower($state['name']) == strtolower($name)) {
                     $return = strtoupper($state['abbrev']);
                     break;
                 }
             }
         }
         return $return;
     }
  $first = 1;
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $select=$_POST["select"];
    $chamber=$_POST["chamber"];
    $keyword=$_POST["keyword"];
    $first++;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["clear"])) {
    $_POST["select"] = "";
    $_POST["chamber"] = "senate";
    $_POST["keyword"] = "";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["submit"])||isset($_POST["second"]))) {
      $errorText = "Please enter the following missing information: ";
      $error = "";
      if(isset($_POST["second"]))
           {
              $chamber = $_POST["chamber"];
              $select = $_POST["select"];
              $keyword = $_POST["keyword"];
            }
      if(!isset($_POST["second"])) {
      $flag = false;
      if (empty($_POST["select"])) {
          $error = "Congress database ";
          $flag = true;
      } else {
          $select = $_POST["select"];
      }
      if (empty($_POST["keyword"])) {

          $error .= "Keyword";
          $flag = true;
      } else {
          $keyword = $_POST["keyword"];
      }
      if($flag){
          $errorText .= $error;
          echo "<script type='text/javascript'>alert('$errorText');</script>";
      }
    }
      if(!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "legislators")) {
        $state    = convert_state($keyword, 'abbrev');
      if(!$state) {
        $url      = "http://congress.api.sunlightfoundation.com/legislators?chamber=" . $chamber . "&query=" . $keyword . "&apikey=7956e02432db4a279f0fa5c1aff1431f";
      }
      else {
        $url      = "http://congress.api.sunlightfoundation.com/legislators?chamber=" . $chamber . "&state=" . $state . "&apikey=7956e02432db4a279f0fa5c1aff1431f";
      }

        $json     = file_get_contents($url);
        $obj      = json_decode($json);
     }
     if(!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "Committees")) {
        $state    = convert_state($keyword, 'abbrev');
        $keyword=strtoupper($keyword);
        $url      = "http://congress.api.sunlightfoundation.com/committees?committee_id=" . $keyword . "&chamber=" . $chamber . "&apikey=7956e02432db4a279f0fa5c1aff1431f";
        $json     = file_get_contents($url);
        $obj      = json_decode($json);
     }
    if(!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "bills")) {
        $state    = convert_state($keyword, 'abbrev');
        $keyword=strtolower($keyword);
        $url      = "http://congress.api.sunlightfoundation.com/bills?bill_id=" . $keyword . "&chamber=" . $chamber . "&apikey=7956e02432db4a279f0fa5c1aff1431f";
        $json     = file_get_contents($url);
        $obj      = json_decode($json);
      }
    if(!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "amendments")) {
        $state    = convert_state($keyword, 'abbrev');
        $url      = "http://congress.api.sunlightfoundation.com/amendments?amendment_id=" . $keyword . "&chamber=" . $chamber . "&apikey=7956e02432db4a279f0fa5c1aff1431f";
        $json     = file_get_contents($url);
        $obj      = json_decode($json);
      }
    }
?>
         <h2 align="center">Congress Information Search</h2>
         <form action="congress.php" method="post">
           <div class="main">Congress Database :
             <select id="selectid" name="select" onchange="changeSelect()">
                <option value="" <?php if (isset($_POST['select']) && $_POST['select'] == "") echo 'selected="selected" '; ?>  >Select your option</option>
                <option value="legislators" <?php if (isset($_POST['select']) && $_POST['select'] == "legislators") echo 'selected="selected" '; ?> >Legislators</option>
                <option value="Committees" <?php if (isset($_POST['select']) && $_POST['select'] == "Committees") echo 'selected="selected" '; ?> >Committees</option>
                <option value="bills" <?php if (isset($_POST['select']) && $_POST['select'] == "bills") echo 'selected="selected" '; ?>  >Bills</option>
                <option value="amendments"  <?php if (isset($_POST['select']) && $_POST['select'] == "amendments") echo 'selected="selected" '; ?> >Amendments</option>
             </select><br>
             Chamber <input type="radio" name="chamber" value="senate" <?php if ((isset($_POST['chamber']) && $_POST['chamber'] == "senate")|| $first == 1) echo 'checked'; ?>> senate
             <input type="radio" name="chamber"  value="house" <?php if (isset($_POST['chamber']) && $_POST['chamber'] == "house") echo 'checked'; ?>> house<br>
             <div style="display:inline-block; height:30px;" id="keywordspace"><?php echo "<script>changeSelect();</script>" ?></div> <input id="keytext" type="text" name="keyword" value="<?php if(isset($_POST['keyword'])) { echo $_POST['keyword']; }?>"><br>
             <input type="submit" name="submit">
             <input type="submit" name="clear" value="Clear"><br>
             <a target="_blank" href="https://sunlightfoundation.com/">Powered by Sunlight Foundation</a>
          </div>
      <br><br>
      <div id="table" >
        <?php
          if(!isset($_POST["second"])) {
        if (!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "legislators") && ($obj->count!=0) ) { ?>
          <table align="center" class="firsttable">
            <tr>
              <th>Name</th>
              <th>State</th>
              <th>Chamber</th>
              <th>Details</th>
            </tr>
        <?php  foreach($obj->results as $data) { ?>
        <tr>
          <td><?php echo $data->first_name . " " . $data->last_name ?></td>
          <td><?php echo $data->state_name; ?></td>
          <td><?php echo $data->chamber; ?></td>
          <td>
              <button type="submit" name="second" value="<?php echo $data->bioguide_id ?>" class="btn-link">View Details</button>
          </td>
        </tr>

        <?php } echo "</table></div></form>";   }
        elseif (!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "Committees") && ($obj->count!=0)) { ?>
          <table align="center" class="firsttable">
            <tr>
              <th>Committe ID</th>
              <th>Committe Name</th>
              <th>Chamber</th>
            </tr>
        <?php  foreach($obj->results as $data) { ?>
        <tr>
          <td><?php echo $data->committee_id ?></td>
          <td><?php echo $data->name; ?></td>
          <td><?php echo $data->chamber; ?></td>
        </tr>

        <?php } echo "</table></div></form>";   }
        elseif (!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "bills") && ($obj->count!=0)) { ?>
          <table align="center" class="firsttable">
            <tr>
              <th>Bill ID</th>
              <th>Short Title</th>
              <th>Chamber</th>
              <th>Details</th>
            </tr>
        <?php  foreach($obj->results as $data) { ?>
        <tr>
          <td><?php echo $data->bill_id ?></td>
          <td><?php echo $data->short_title; ?></td>
          <td><?php echo $data->chamber; ?></td>
          <td>
            <button type="submit" name="second" value="<?php echo $data->bill_id ?>" class="btn-link">View Details</button>
          </td>
        </tr>

        <?php } echo "</table></div></form>";   }
        elseif (!empty($_POST['keyword']) && isset($_POST['chamber']) && ($_POST['select'] == "amendments")&& ($obj->count!=0)) { ?>
          <table align="center" class="firsttable">
            <tr>
              <th>Amendment ID</th>
              <th>Amendment Type</th>
              <th>Chamber</th>
              <th>Introduced on</th>
            </tr>
        <?php  foreach($obj->results as $data) { ?>
        <tr>
          <td><?php echo $data->amendment_id ?></td>
          <td><?php echo $data->amendment_type; ?></td>
          <td><?php echo $data->chamber; ?></td>
          <td><?php echo $data->introduced_on; ?></td>
        </tr>

        <?php }  echo "</table></div></form>";  }
        elseif (!empty($_POST['keyword']) && isset($_POST["submit"]) &&$_POST['select'] != ""&& isset($_POST['chamber']) &&($obj->count==0)) { ?>
        <span class="zero"><b>The API returned zero results for the request</b></span>
        <?php  } }
          if(isset($_POST["second"])) {
            $billflag = false;
            $passedid= $_POST["second"];
            foreach($obj->results as $data)
            {
              if($_POST['select'] == "legislators")
                {
                  if($data->bioguide_id == $passedid) {
                    $faceurl = "https://theunitedstates.io/images/congress/225x275/" . $passedid . ".jpg";
                    $fullname = $data->title ." ". $data->first_name ." ". $data->last_name;
                    $terms = $data->term_end;
                    $website = $data->website;
                    $office = $data->office;
                    $facebook = "https://www.facebook.com/" . $data->facebook_id;
                    $twitter = "https://twitter.com/" . $data->twitter_id;
                  }

                }
                else {
                  if($data->bill_id == $passedid) {
                    $billflag=true;
                    $title = $data->short_title;
                    $sponser = $data->sponsor->title . " " . $data->sponsor->first_name . " " . $data->sponsor->last_name;
                    $intro = $data->introduced_on;
                    $lastaction = $data->last_version->version_name . "," . $data->last_action_at;
                    $billurl = $data->last_version->urls->pdf;
                  }
                }
            }
          if(!$billflag) {
            ?>
          <div class="nextlevel">
          <img style="padding-bottom:20px;" src="<?php echo $faceurl; ?>" alt="icon" width="242" height="242"><br>
          <table class="nexttable" align="center">
            <tr>
              <td>Full Name</td>
              <td><?php echo $fullname; ?></td>
            </tr>
            <tr>
              <td>Term Ends on</td>
              <td><?php echo $terms; ?></td>
            </tr>
            <tr>
              <td>Website</td>
              <td><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></td>
            </tr>
            <tr>
              <td>Office</td>
              <td><?php echo $office; ?></td>
            </tr>
            <tr>
              <td>Facebook</td>
              <td><a target="_blank" href="<?php echo $facebook; ?>"><?php echo $data->first_name ." ". $data->last_name; ?></a></td>
            </tr>
            <tr>
              <td>Twitter</td>
              <td><a target="_blank" href="<?php echo $twitter; ?>"><?php echo $data->first_name ." ". $data->last_name; ?></a></td>
            </tr>
          </table>
          </div>
          <?php echo "</div></form>"; }
          else { ?>
            <div class="nextlevel">

            <table class="nexttable" align="center">
              <tr>
                <td>Bill ID</td>
                <td><?php echo $passedid; ?></td>
              </tr>
              <tr>
                <td>Bill Title</td>
                <td><?php echo $title; ?></td>
              </tr>
              <tr>
                <td>Sponsor</td>
                <td><?php echo $sponser; ?></td>
              </tr>
              <tr>
                <td>Introduced on</td>
                <td><?php echo $intro; ?></td>
              </tr>
              <tr>
                <td>Last action with date</td>
                <td><?php echo $lastaction; ?></td>
              </tr>
              <tr>
                <td>Bill URL</td>
                <td><a target="_blank" href="<?php echo $billurl; ?>"><?php echo $data->short_title; ?></a></td>
              </tr>
            </table>
            </div>

      <?php  }} ?>
</html>
