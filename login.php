<?php
	session_start();
	include 'class/connection.php';

  if(isset($_SESSION['u_id'])){
  
    //echo "<meta http-equiv=refresh content=0;url=$server/login.php>";
    echo "<meta http-equiv=refresh content=0;url=./index.php>";
  }else{
?>


<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Student Management System</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="css/my_style.css"/>
        <!-- EOF CSS INCLUDE -->    
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <p class="login-box-msg">

<?php 
  if(isset($_POST['login'])){
      $user = $_POST['user'];
      $pass = $_POST['pass'];
      $pass = sha1($pass);
      
      $query= mysql_query("SELECT id FROM tbl_user_info WHERE user_name='$user' AND password='$pass' AND IsActive = 1 ");
      //$result=mysql_fetch_array($query);
      $row= mysql_num_rows($query);
      $user = mysql_fetch_array($query);
      if($row == 1){
        $_SESSION['u_id']=$user['id'];
        echo "<p class='msg_success'>Login Successful</p>";
        echo "<meta http-equiv=refresh content=1;url=./index.php>";
      }else{
        echo "<p class='msg_error'>Login Failed. Invalid user name or password</h3></p></center>";
      }
    }

?>
                      

                    </p>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="user" class="form-control" 
              <?php
                if(isset($_POST['user'])){
                  echo "value='".$_POST['user']."'";
                }else{
                  echo "placeholder='User Name'";
                }
              ?>
            />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass" class="form-control"
            <?php
                if(isset($_POST['user'])){
                  echo "value='".$_POST['pass']."'";
                }else{
                  echo "placeholder='Password'";
                }
              ?>
            />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group">
            
              <input type="submit" name="login" class="btn btn-info btn-block" value="Login"/>
            
          </div>
        </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 Web Portal
                    </div>
                    <div class="pull-right">
                        <!--<a href="wsdindex.html#">About</a> |
                        <a href="wsdindex.html#">Privacy</a> -->
                        <a href="wsdindex.html#">IT Team</a>
                    </div>
                </div>
            </div>
            
        </div>
    
    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
        <script type="text/javascript">
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-36783416-1', 'aqvatarius.com');
          ga('send', 'pageview');
        </script>        
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter25836617 = new Ya.Metrika({id:25836617,
                            webvisor:true,
                            accurateTrackBounce:true});
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="http://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>     
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
        
    </body>
</html>


<?php
  }
?>
