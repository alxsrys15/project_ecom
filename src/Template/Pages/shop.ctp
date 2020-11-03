<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<style type="text/css">
	.card{
		-moz-box-shadow:    inset 0 0 15px #D3D3D3;
   		-webkit-box-shadow: inset 0 0 15px #D3D3D3;
		box-shadow:          0 0 15px #D3D3D3;
	}
	.image{
		margin-top: 25%;
		height: auto;
	}
	IMG.image{
		display: block;
    	margin-left: auto;
    	margin-right: auto;
    	border: 1px solid #ddd;
  		border-radius: 4px;
    	box-shadow: 0 0 15px #D3D3D3; 
	}
	.header{
		position: absolute;
		left: 0;
		background-color: lightblue;
		padding-right:5px;
		width: 100%;
	}
</style>
</head>
<body>
	<br>
	<div class="container">
		<div class="row">
			<!--if-->
			<div class="col-1"></div>
			<div class="card col-sm-6 col-md-5 col-lg-3">
				<div class="header col-12">
					<img src="test.png" width="30px" height="30px">
					<label>Seller's name</label>
				</div>
					<img src="123.png" width="200" height="200" class="image rounded">
						<div class="card-body">
							<h5 class="card-title">name:</h5>
							<p class="card-text">Description</p>
    						<a href="#" class="btn btn-primary">view</a>
						</div>
			</div>

		<div class="col-1"></div>
			<div class="card col-sm-6 col-md-5 col-lg-3">
				<div class="header col-12">
					<img src="test.png" width="30px" height="30px">
					<label>Seller's name</label>
				</div>
					<img src="123.png" width="200" height="200" class="image rounded">
						<div class="card-body">
							<h5 class="card-title">name:</h5>
							<p class="card-text">Description</p>
    						<a href="#" class="btn btn-primary">view</a>
						</div>
			</div>
		<div class="col-1"></div>
			<div class="card col-sm-6 col-md-5 col-lg-3">
				<div class="header col-12">
					<img src="test.png" width="30px" height="30px">
					<label>Seller's name</label>
				</div>
					<img src="123.png" width="200" height="200" class="image rounded">
						<div class="card-body">
							<h5 class="card-title">name:</h5>
							<p class="card-text">Description</p>
    						<a href="#" class="btn btn-primary">view</a>
						</div>
			</div>
		</div>
	</div>
</body>
</html>