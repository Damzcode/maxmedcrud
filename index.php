<?php
include "test.php"; 

// Mengambil data dari tabel 'service'
$sql = "SELECT * FROM service";
$result = $test->query($sql); 
$sql = "SELECT * FROM fungsi";
$result1 = $test->query($sql);
$sql = "SELECT * FROM paket";
$result2 = $test->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<!-- site title -->
	<title>Maxmedia</title>
	<!-- Stylesheets css comes here -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nivo-lightbox.css">
	<link rel="stylesheet" href="css/nivo_themes/default/default.css">
	<link rel="stylesheet" href="css/templatemo-style.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700' rel='stylesheet' type='text/css'>
<!-- 
Alpha Template
https://templatemo.com/tm-465-alpha
-->
</head>

<style>
	.whatsapp-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #25d366;
      color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 30px;
      cursor: pointer;
    }
    .whatsapp-button:hover {
      background-color: #128C7E;
      transform: scale(1.1);
    }

    .dropdown {
      position: fixed;
      bottom: 90px;
      right: 20px;
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 5px;
      display: none;
      flex-direction: column;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .dropdown a {
      padding: 10px 20px;
      text-decoration: none;
      color: #333;
      display: block;
      border-bottom: 1px solid #eee;
    }

    .dropdown a:hover {
      background-color: #f1f1f1;
    }

    .dropdown a:last-child {
      border-bottom: none;
    }
</style>
<body data-spy="scroll" data-target=".navbar-collapse">

<!-- preloader section -->
<div class="preloader">
	<div class="sk-spinner sk-spinner-rotating-plane"></div>
</div>

<!-- navigation section -->
<nav class="navbar navbar-default navbar-fixed-top sticky-navigation" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#"><img src="images/1719976548428.png" class="img-responsive site-logo" alt="logo"></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right main-navigation">
				<li><a href="#home" class="smoothScroll">HOME</a></li>
				<li><a href="#about" class="smoothScroll">ABOUT US</a></li>
				<li><a href="#service" class="smoothScroll">SERVICE</a></li>
				<li><a href="#price" class="smoothScroll">PRICE</a></li>
				<li><a href="#contact" class="smoothScroll">LOCATION</a></li>
			</ul>
		</div>
	</div>
</nav>

<!-- home section -->
<section id="home" class="tm-home">
	<div class="container">
		<div class="row">
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br<br><br><br><br><br><br>

		</div>
	</div>
</section>

<!-- social icons section -->
<section id="tm-icons" class="tm-icons">
	<div class="container">
		<div class="row">
			<?php
                if ($result->num_rows > 0) {
                    // Menampilkan data. dari database
                    while($row = $result->fetch_assoc()) {
                        // echo '
                        // <div class="col-md-4 col-sm-4 border-right border-bottom">
                        //     <i class="fa ' . $row["icon"] . ' wow bounceIn" data-wow-delay="0.3s"></i>
                        //     <h3 class="tm-service-h3">' . $row["nama"] . '</h3>
                        //     <p>' . $row["deskripsi"] . '</p>
                        // </div>';
						// <img src="'.$row["icon"].'" alt="" height="50px">
						echo '
						<div class="col-md-4 col-sm-12 tm-icon-1">
							<div class="wow fadeInUp" data-wow-delay="1.3s">
								<div class="media">
									<div class="media-object pull-left">
										<img src="'. $row["image"] .'" alt="" height="50px">
									</div>
									<div class="media-body">
										<h3 class="media-heading">'. $row["nama"] .'<span class="green"></span></h3>
										<p>' . $row["deskripsi"] . '</p>
										
									</div>
								</div>
							</div>
						</div>';
                    }
                } else {
                    echo "<p>No services available.</p>";
                }
            ?>
			

		</div>
	</div>
</section>

<!-- about section -->
<section id="about" class="tm-about">
	<div class="container">
		<div class="row">
			<div class="col-md-1 col-sm-1"></div>
			<div class="col-md-5 col-sm-12">
				<img src="images/profile.png" class="img-responsive wow fadeIn" data-wow-delay="0.6s" alt="about">
			</div>
			<div class="col-md-5 col-sm-12 about-des wow fadeInRight" data-wow-delay="0.9s">
				<h1> Apa itu Maxmedia?</h1>
				<p>Maximum Media (MAXMEDIA) adalah Penyedia Jasa Internet dan IT Development, dengan pengalaman kami di dunia IT kami memberikan layanan dedicated internet untuk Anda pengguna jasa internet.</p>
                <p>Pelayanan kami dapat digunakan untuk keperluan kantor, industri, lembaga pendidikan, game center, cafe maupun instanssi pemerintahan. Kami mempunyai link backbone langsung ke gedung Cyber atau Indonesia Data Center (IDC) sehingga kami dapat memberikan layanan yang baik dan stabil.</p>
			</div>
			<div class="col-md-1 col-sm-1"></div>
			<div class="col-md-12 col-sm-12 about-bottom-des wow bounceIn">
				<div class="col-md-6 col-sm-12">
					<h2 class="tm-about-header">Professional Design</h2>
					<p>Aenean commodo ligula eget dolor. Aenean massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
				</div>
				<div class="col-md-6 col-sm-12 about-skills">
					<strong>HTML5 &AMP; CSS3</strong>
						<span class="pull-right">100%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
							</div>
					<strong>BOOTSTRAP</strong>
						<span class="pull-right">90%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
							</div>
					<strong>UX DESIGN</strong>
						<span class="pull-right">85%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
							</div>
					<strong>WORDPRESS</strong>
						<span class="pull-right">75%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
							</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- service section -->
 
<section id="service" class="tm-service">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Our Producth</h2>
			</div>
			<?php
            if ($result1->num_rows > 0) {
            
                while($row = $result1->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 col-sm-4 border-right border-bottom">
                        <img src="'. $row["image"] .'" alt="" style="height: 50px;" data-wow-delay="0.3s">
                        <h3 class="tm-service-h3">' . $row["nama"] . '</h3>
                    </div>';
                }
            } else {
                echo "<p>No data available.</p>";
            }
            ?>
		</div>
	</div>
</section>

<!-- home section -->
<section id="team" class="tm-team">
	<div class="team-title">
		<h2>Mengapa harus Maxmedia?</h2>
	</div>
	<div class="container">
		<div class="row">
			<div class="container-fluid">
			<div class="col-md-2 col-sm-1"></div>
			<div class="col-md-6 col-sm-10">
				<div class="media wow fadeInUp" data-wow-delay="0.3s">
					<div class="media-object pull-left">
						<img src="images/team7.png" class="img-responsive" alt="team">
					</div>
					<div class="media-body border-right">
						<h3 class="media-heading">Kualitas Terbaik</h3>
						<h4 class="tm-team-member-heading-2"></h4>
						<p>Kami pastikan internet yang anda akses adalah internet dengan kualitas dan stabilitas terjamin dengan monitoring Network Quality Control System.</p>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-10">
				<div class="media wow fadeInUp" data-wow-delay="0.6s">
					<div class="media-object pull-left">
						<img src="images/team6.png" class="img-responsive" alt="team">
					</div>
					<div class="media-body">
						<h3 class="media-heading">Dukungan layanan support 24/7</h3>
						<h4 class="tm-team-member-heading-2"></h4>
						<p>Kami pastikan internet yang anda akses adalah internet dengan kualitas dan stabilitas terjamin dengan monitoring Network Quality Control System. Technical support kami always on 24H / 7D siap menangani network problem hingga level penanganan di End Client.</p>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-10">
				<div class="media wow fadeInUp" data-wow-delay="0.9s">
					<div class="media-object pull-left">
						<img src="images/team5.png" class="img-responsive" alt="team">
					</div>
					<div class="media-body border-right">
						<h3 class="media-heading">Harga terjangkau</h3>
						<h4 class="tm-team-member-heading-2"></h4>
						<p>Kami pastikan internet yang anda akses adalah internet dengan kualitas dan stabilitas terjamin dengan monitoring Network Quality Control System.</p>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>

<!-- portfolio section -->


<!-- price section -->
<section id="price" class="tm-price">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h2 class="tm-price-section-heading">Kami menyediakan</h2>
            </div>
        </div>

        <div class="row">
            <?php
            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 col-sm-3">
                        <div class="plan wow bounceIn" data-wow-delay="0.3s">
                            <h3 class="plan_title">' . $row["nama"] . '</h3>
                            <button class="btn btn-warning">BOOK NOW</button>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No data available.</p>";
            }
            ?>
        </div>
    </div>
</section>


<!-- contact section -->
<section id="contact" class="tm-contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Informasi Kantor</h2>
			</div>
			<div class="col-md-4 col-sm-5 address wow fadeInUp" data-wow-delay="0.6s">
				<div>
					<h3 class="tm-contact-h3">Address</h3>
					<p>Perkantoran Multiguna,
						Jl. Bintaro Utama 3A No. 8M,
						Pondok Karya, Pondok Aren,
						Kota Tangerang Selatan, Banten 15225.</p>
				</div>
				<div>
					<h3 class="tm-contact-h3">Email</h3>
					<p><a href="mailto:hello@company.com" class="tm-contact-link">info@maxmedia.co.id</a></p>
				</div>
				<div>
					<h3 class="tm-contact-h3">Phone</h3>
					<p><a href="tel:0102003400" class="tm-contact-link">0812-8704-2331</a> | <a href="tel:0807006500" class="tm-contact-link">(021) 7300-056</a></p>
				</div>		
			</div>	
			<div class="col-md-8 col-sm-7 contact-form wow fadeInRight position-relative" data-wow-delay="0.9s">
    <iframe class="position-relative"
        src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Pt%20Bangsawan%20Cyberindo%20Tangerang+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
        frameborder="0" style="height: calc(100vh - 7cm); width: 100%; border:0;" 
        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>




		</div>
	</div>
</section>

<div class="whatsapp-button">
	<i class="fa fa-whatsapp"></i>
  </div>
  <div class="dropdown">
	<a href="https://wa.me/6281287042331">Nomor 1</a>
	<a href="https://wa.me/6281234567890">Nomor 2</a>
	<a href="https://wa.me/6281123456789">Nomor 3</a>
  </div>
</div>

<!-- footer section -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<p>Copyright &copy; 2024 maxmedia</p>
				<hr>
				<ul class="social-icon">
					<li class="wow bounceIn" data-wow-delay="0.3s"><a href="#" class="fa fa-facebook"></a></li>
					<li class="wow bounceIn" data-wow-delay="0.6s"><a href="#" class="fa fa-twitter"></a></li>
					<li class="wow bounceIn" data-wow-delay="0.9s"><a href="#" class="fa fa-instagram"></a></li>
					<li class="wow bounceIn" data-wow-delay="1s"><a href="#" class="fa fa-dribbble"></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<!-- javascript js comes here -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.nav.js"></script>
<script src="js/isotope.js"></script>
<script src="js/imagesloaded.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
<script>
	  document.querySelector('.whatsapp-button').addEventListener('click', function() {
      var dropdown = document.querySelector('.dropdown');
      if (dropdown.style.display === 'none' || dropdown.style.display === '') {
        dropdown.style.display = 'flex';
      } else {
        dropdown.style.display = 'none';
      }
    });

    window.addEventListener('click', function(e) {
      if (!document.querySelector('.whatsapp-button').contains(e.target) && !document.querySelector('.dropdown').contains(e.target)) {
        document.querySelector('.dropdown').style.display = 'none';
      }
	});
</script>
</html>