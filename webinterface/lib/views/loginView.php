<html lang="en">
	<title>Student - Login </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Web Portal to Handle DB behind Upishi Food App">
    <meta name="author" content="Naftal Mataro">
    <link href="../../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>
    <body>
    	<div class="container-fluid" style="margin-top:65px">
			<div class="row-fluid">
				<div class="span2">
					<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="#">Welcome</a></li>
						<li><a href="#">Other Options</a></li>
					</ul>
				</div>
				<div class="span9">
					<form class="form-signin">
				    	<h2 class="form-signin-heading">Please sign in</h2>
				        <input type="text" class="input-block-level" placeholder="Email address">
				        <input type="password" class="input-block-level" placeholder="Password">
				        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
				    </form>
				</div>
			</div>
		</div>
    </body>
    <script src="../../js/jquery.js"></script>
	<script src="../../js/bootstrap.js"></script>
</html>