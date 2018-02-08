<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php require('partials/html-head.php'); ?>
	<link rel="stylesheet" href="/css/styleteam.css">
</head>
<body>
	<?php require('partials/header.php'); ?>

	<section id="team" class="grid">

        <div class="card kirthi">
          <img src="/images/team/kirthi.jpg" alt="">
          <div class="card-content">
            <h3 class="card-title">Chief Executive Officer, CEO</h3>
            <p>Kirthi has a wealth of experience in businesses.
							Over the last decade, he provided advisory and strategy guidance
							to a multitude of high net worth clients and corporations worldwide.</p>
						<p>He has developed high quality business strategies and plans
							to ensure the business succeed in its short-term and long-term objectives.
							He has the ability to oversee all operations and business activities
							to ensure they produce the desired results and are consistent with
							the overall strategy and mission.</p>
          </div>
        </div>

        <div class="card john">
          <img src="/images/team/john.jpg" alt="">
          <div class="card-content">
            <h3 class="card-title">Chief Technology Officer, CTO</h3>
						<p>John has extensive experience in software development and is currently the CTO at EventWeb.</p>
            <p>He consulted on large scale enterprise deployment for MNCs and government Agencies.
							He has over 10 years of experience in the design, development and implementation of
							custom applications, mobile app development, website and eCommerce platforms,
							helping startups and businesses build their products.</p>
						<p>
							He is very enthusiast about technologies and its potential applications that
							can revolutionize the world.</p>
          </div>
        </div>

        <div class="card alfred">
          <img src="/images/team/alfred.jpg" alt="">
          <div class="card-content">
            <h3 class="card-title">Lead Fullstack Developer</h3>
            <p>Alfred is an enthusiast technologist. He has experienced developing and designing many complex websites.</p>
						<p>He can understand complex database concepts as well as the implications of different database designs.
							He has proven ability to identify, analyze and solve problem.
							He is able to provide users with a safe, interactive and memorable experience </p>
          </div>
        </div>

        <div class="card gan">
          <img src="/images/team/gan.jpg" alt="">
          <div class="card-content">
            <h3 class="card-title">UI/UX Designer</h3>
            <p>Gan is an experienced UX and web designer with over 5 years of experience.
							He started to learn design and code way back when he was still in school.<p/>
						<p>He enjoys learning more about his craft and likes to push himself
							to the limit to create beautiful and fresh designs.</p>
          </div>
        </div>

				<div class="card hafridz">
					<img src="/images/team/hafridz.jpg" alt="">
					<div class="card-content">
						<h3 class="card-title">Marketing Manager</h3>
						<p>Hafridz is an experienced Marketing Manager with a demonstrated history of working in the information technology and services industry.
							Skilled in Digital Marketing, Consumer Behavior, Business Analytics, and Microsoft Excel.</p>
						<p/>He loves connecting with marketing professionals, digital experts, and world changers.
							He believes that if we want to change the world, we have to just do it and not debating which is the correct method.</p>
					</div>
				</div>

  </section>

	<?php require('partials/footer.php'); ?>
	<script src="js/script.js"></script>
</body>
</html>
