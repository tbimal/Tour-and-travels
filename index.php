<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'filter') {
    $destination = $_POST['destination'];
    $maxPrice = $_POST['maxPrice'];

    $sql = "SELECT * FROM tbltourpackages WHERE PackagePrice <= :maxPrice";
    if (!empty($destination)) {
        $sql .= " AND PackageLocation LIKE :destination";
    }
    $sql .= " ORDER BY rand() LIMIT 4";

    $query = $dbh->prepare($sql);
    $query->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);

    if (!empty($destination)) {
        $dest = "%" . $destination . "%";
        $query->bindParam(':destination', $dest, PDO::PARAM_STR);
    }

    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            echo '<div class="rom-btm">
                <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                    <img src="admin/pacakgeimages/' . htmlentities($result->PackageImage) . '" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                    <h4>Package Name: ' . htmlentities($result->PackageName) . '</h4>
                    <h6>Package Type: ' . htmlentities($result->PackageType) . '</h6>
                    <p><b>Package Location:</b> ' . htmlentities($result->PackageLocation) . '</p>
                    <p><b>Features:</b> ' . htmlentities($result->PackageFetures) . '</p>
                </div>
                <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                    <h5>USD ' . htmlentities($result->PackagePrice) . '</h5>
                    <a href="package-details.php?pkgid=' . htmlentities($result->PackageId) . '" class="view">Details</a>
                </div>
                <div class="clearfix"></div>
            </div>';
        }
    } else {
        echo "<p>No packages found matching your criteria.</p>";
    }
    exit;
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Tourism Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
 <script>
      $(document).ready(function(){
          $(".scroll-top").click(function() {
              $("html, body").animate({ 
                  scrollTop: 0 
              }, "slow");
              return false;
          });
      });
   </script>

</head>
<body>
<?php include('includes/header.php');?>
<!-- <div class="banner">
	<div class="container">
	
	</div>
</div> -->

<div class="home">
	<div class="overlay">
<video class="video-background" autoplay muted loop playsinline>
    <source src="./images/mountain.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  </div>
<!-- 
   <div class="title">
                <h1>ADVENTOUR</h1>
                <p>See the World for Less! Explore Amazing Destinations with Our Budget-Friendly Packages.  </p>

                <div class="wrapper">
                    <form action="#">
                        <div class="h5 font-weight-bold text-center mb-3" >Search your Destination</div>
                        <div class="destination">
                            <label for="city" >Enter your destination</label>
                          </div>
                          
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="Enter Your Name">
                        </div>
                        <div class="destination">
                            <label for="city" >Enter your date</label>
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" type="date" class="form-control" placeholder="Select your date">
                        </div>
                        <div class="form-group">
                            <div class="lable_total flex">
                                  <label class="destination"  for="price">Max Price : <span id="result">2500</span> 
                                </label>
                            </div>
                            <input id="mySlider" type="range" min="0" max="10000" value="2500"  style="width: 215px;">
                            <script>
                                mySlider.oninput = showSliderValue;
                                function showSliderValue() {
                                    result.innerText = this.value;
                                }
                            </script>
                        </div>
                    </form>
                </div>
				 <a href="./package-list.php" class="button">
                    <span class="material-symbols-outlined">
                        Search
                    </span>
                </a>
   </div> -->
							</div>
							</div>

  <!-- <div class="homeContent_Container">
	<div class="textDiv">
		<span class="smallText">Our Packages</span>
		<h1 class="homeTitle">Search Your Holiday</h1>
	</div>
	<div class="cardDiv_grid">
			<div class="destinationInput">
			<label for="city">Search Your destination :<i class="fa-solid fa-location-dot" style="font-size: 20px;"></i></label>
			<div class="input_flex">
		<input type="text" id="destination" placeholder="Enter name here....">
		</div>
		</div>

		<div class="dateInput">
			<label for="date">Select Your date:</label>
			<div class="input_flex">
			<input type="date" >
		</div>
		</div>

	<div class="priceInput">
		<div class="label_total_flex">
			<label for="price">Max price: <span id="priceValue">5000</span></label>
	
		</div>
		<div class="input_flex">
<input type="range" max="5000" min="1000" id="maxPrice" oninput="document.getElementById('priceValue').innerText = this.value;">

		</div>
			
		</div>
<div class="searchOptions_flex" id="searchBtn">
  <i style="color: blue;" class="fa-solid fa-filter"></i>
  <span>Check It Out</span>
</div>
	


  </div>
  </div>
</div> -->
<div id="packageResults">
<?php
// existing package PHP code here
?>
</div>





<!---holiday---->
<div class="container">
	<div class="holiday">
	



	
	<h3>Package List</h3>

					
<?php $sql = "SELECT * from tbltourpackages order by rand() limit 4";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
			<div class="rom-btm">
				<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
					<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
				</div>
				<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
					<h4>Package Name: <?php echo htmlentities($result->PackageName);?></h4>
					<h6>Package Type : <?php echo htmlentities($result->PackageType);?></h6>
					<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
					<p><b>Features</b> <?php echo htmlentities($result->PackageFetures);?></p>
				</div>
				<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
					<h5>USD <?php echo htmlentities($result->PackagePrice);?></h5>
					<a href="package-details.php?pkgid=<?php echo htmlentities($result->PackageId);?>" class="view">Details</a>
				</div>
				<div class="clearfix"></div>
			</div>

<?php }} ?>
			
		
<div><a href="package-list.php" class="view">View More Packages</a></div>
</div>
			<div class="clearfix"></div>
	</div>



<!--- routes ---->
<div class="routes">
	<div class="container">
		<div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
			<div class="rou-left">
				<a href="#"><i class="glyphicon glyphicon-list-alt"></i></a>
			</div>
			<div class="rou-rgt wow fadeInDown animated" data-wow-delay=".5s">
				<h3>8000</h3>
				<p>Enquiries</p>
			</div>
				<div class="clearfix"></div>
		</div>
		<div class="col-md-4 routes-left">
			<div class="rou-left">
				<a href="#"><i class="fa fa-user"></i></a>
			</div>
			<div class="rou-rgt">
				<h3>1900</h3>
				<p>Registered users</p>
			</div>
				<div class="clearfix"></div>
		</div>
		<div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
			<div class="rou-left">
				<a href="#"><i class="fa fa-ticket"></i></a>
			</div>
			<div class="rou-rgt">
				<h3>7,00,00,000+</h3>
				<p>Booking</p>
			</div>
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>		
<script>
document.getElementById('searchBtn').addEventListener('click', function () {
    let destination = document.getElementById('destination').value;
    let maxPrice = document.getElementById('maxPrice').value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "", true); // Same page request
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('packageResults').innerHTML = this.responseText;
        }
    };

    xhr.send("action=filter&destination=" + encodeURIComponent(destination) + "&maxPrice=" + maxPrice);
});
</script>





<!-- scrollup -->

<button type="button" class="scroll-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></button>

<!-- //write us -->
</body>
</html>