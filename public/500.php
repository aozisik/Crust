<html>
<head>

  <script type="text/javascript" language="javascript" src="<?php echo URL; ?>public/javascript/jquery.js"></script>

  <link rel="stylesheet" href="<?php echo URL; ?>public/stylesheets/bootstrap.css" />

  <style type="text/css">
    body
    {
      background-color:#FFFFFF;

      font-size:12pt;
    }

    #wrapper
    {
      margin-top:50px;
      width:600px;
      margin-left:auto;
      margin-right: auto;
      padding:10px;
      border:1px solid #b4b4b4;
    }

    a
    {
      text-decoration: none;
      color:#D64E29;
    }

    #server{
      
      width:600px;
      margin-left:auto;
      margin-right: auto;
      padding:10px;
      margin-top:5px;
      border:1px dotted #999;
      overflow: hidden;
      font-size:10px !important;
      height:40%;
      overflow-y:scroll;
      
    }

    .detailed_data
    {
      font-size: 10px;
    }
  </style>
</head>
<body> 


  <div id="wrapper">

  <h1>Something Went Wrong :/</h1>

  <div class="alert alert-danger">
    <?php echo $errstr; ?>
  </div>

<br><br>

  Show
  <script type="text/javascript">
    $('#server').hide();
  </script>
  <a href="javascript:void(0);" onclick="$('#server').fadeToggle()" title="Click to list Php Server parameters">SERVER</a> parameters
  <br>
  
  <p>
  
    <small>
      Controller: <?php echo CrustRouter::$controller; ?>,
      action: <?php echo CrustRouter::$action; ?>
      params: <?php echo join(CrustRouter::$params, '/'); ?>
    </small>
  </p>

  <br>
  <small>Debug pages will not be shown when ENVIRONMENT parameter in app/config.php is set as "production"</small>

  </div>
  <div id="server" style="display:none;">
    <table class="detailed_data table">
      <?php 
      foreach($_SERVER as $x => $y)
      {
        $str = (!is_array($y)) ? $y : join($y, ',');
        echo '<tr><th>'.$x.'</th><td>'.$str.'</td></tr>';
      }
      ?>
    </table>
  </div>
  
</body>
</html>