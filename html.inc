<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 <head>
  <script src='js/jquery-2.0.3.min.js'></script>
  <script src='js/script.js'></script>
  <link rel='stylesheet' type='text/css' href='css/style.css'>
  <link rel='icon' type='image/ico' href='favicon.ico'>
  <title>Follow Friday Creator</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
 </head>
 <body>
<!-- Show the Tweetbox Span only if this file is called from Index.php -->
   <?php if(strpos($_SERVER["PHP_SELF"],'index') !== false){ ?>
   <h2>Select all the friend to insert and press tweet</h2>
   <hr />
   <div id='tweetformwrapper'>
    <form action='' id='tweetform' method='post'>
     <textarea cols='25' rows='10' id='tweetarea'disabled></textarea><br>
     <span id='count'>140</span>
     <button type='submit' id='submit' disabled><img id='twittericon' src='images/bird_gray_16.png'> Tweet</button>
     <p><a href='./clearsessions.php'>clearing your session</a>.</p>
    </form>
   </div>
<!-- Show the site greetings only if this file is called from connect.php -->
   <?php } else if (strpos($_SERVER["PHP_SELF"],'connect') !== false){ ?>
   <h2>Welcome to Follow Friday Creator Click on the button to start</h2>
   <?php } ?>
  <p>
   <div id='friendlist'>
   <?php print_r($content); ?>
   </div>
  </p>
 </body>
</html>
