<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language;?>" lang="<?php echo Yii::app()->language;?>" dir="ltr">
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="Content-type" content="text/html; charset=<?php echo Yii::app()->charset;?>" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" type="text/css" />	
	<!--[if IE 6]>
	        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie6.css" type="text/css" media="all"/>
        <![endif]-->
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.4.2.min.js"></script> 
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.jcarousel.js"></script> 
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-func.js"></script> 
</head>
<body>
<!-- Header -->
<div id="header">
	<!-- Shell -->
	<div class="shell">
		
		<!-- Navigation -->
		<div id="navigation">
			
			<?php $this->widget('zii.widgets.CMenu',array(
			'id'=>'topnav',
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),				
				array('label'=>'Ciudad', 'url'=>array('/ciudad/index')),
				array('label'=>'Experiencia', 'url'=>array('/experiencia/index')),
				array('label'=>'Estudios', 'url'=>array('/estudios/index')),
				array('label'=>'Folio', 'url'=>array('/folio/index')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
		</div>
		<!-- end Navigation -->
		
		<!-- Contact -->
		<div id="contact">
			<div class="slide-area">
				<form action="home_submit" method="get" accept-charset="utf-8">
					<div class="field-left">
						<div class="field-row">
							<label for="field1">Your Name <em>(Required)</em></label>
							<span><input name="text" class="field" id="field1"></input></span>
						</div>
						<div class="field-row">
							<label for="field2">E-Mail Address <em>(Required)</em></label>
							<span><input name="text" class="field" id="field2"></input></span>
						</div>						
					</div>
					<div class="field-row field-right">
						<label for="text-field">Message <em>(Required)</em></label>
						<span class="textarea-bg"><textarea name="text"  id="text-field" cols="20" rows="4"></textarea></span>
					</div>
					<p><input type="submit" value="SUBMIT" /></p>
					<div class="cl">&nbsp;</div>
				</form>
			</div>
			<div class="slide-area-info">
				<div class="green">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/green-light.gif" alt="green light" />
					<p>I am currently: <strong>AVAILABLE</strong></p>
				</div>
				<a class="slide-down" href="#">slide-down</a>
				
			</div>
			<div class="cl">&nbsp;</div>
		</div>
		<!-- end Contact -->
	
		<!-- Intro -->
		<div id="intro">
			
			<div class="info">
				<h1>Personal Portfolio</h1>
				<h2>Howdy!  Turpis turpis, dignissim elementum ornare ut, pretium sed orci. Nulla a ante massa, eget consequat mauris.</h2>
				<p class="quote">&laquo; Everything you can imagine is real. &raquo;</p>
				<p class="author">Pablo Picasso</p>
			</div>
			
			<!-- Slider -->
			<div class="slider" id="big-slider">
				<!-- Slider-carousel -->
				<div class="slider-carousel">
					<ul>						
						<li>
					    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/slider1.jpg" alt="slide image" /></a>
					    </li>
					    <li>
					    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/slider1.jpg" alt="slide image" /></a>
					    </li>
					     <li>
					    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/slider1.jpg" alt="slide image" /></a>
					    </li>
					</ul>   
					<div class="cl">&nbsp;</div> 		
				</div>
				<!-- end Slider-carousel -->
				<div class="slider-navigation">
		    		<ul>
		    		    <li><a class="active" href="#">1</a></li>
		    		    <li><a href="#">2</a></li>
		    		    <li><a href="#">3</a></li>
		    		</ul>
		    	</div>
			    	
				<ul class="buttons">
					<li><a class="button" href="#">VIEW LIVE</a></li>
					<li><a class="button" href="#">CASE STUDY</a></li>
				</ul>
					
			</div>
			<!-- end Slider -->
			
			<div class="cl">&nbsp;</div>
			
			
			
		</div>
		<!-- end Intro -->
		
	
	</div>
	<!-- end Shell -->
</div>
<!-- end Header -->

<!-- Main -->
<div id="main">
	<div id="main-in">
		<!-- Shell -->
		<div class="shell">
			
			<!-- Works -->
			<div id="works">
				<div class="head">
					<h3>Selected Works</h3> <a class="red" href="#">see all &raquo;</a>
				</div>
				<!-- Project -->
				<div class="project">
					<div class="slider-carousel">
						<ul>						
							<li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project1.jpg" alt="slide image" /></a>
						    	<span class="project-info">Molestie facilisis risus arcu </span>
						    </li>
						    <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project2.jpg" alt="slide image" /></a>
						    	<span class="project-info">Molestie facilisis risus arcu</span>
						    </li>
						     <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project3.jpg" alt="slide image" /></a>
						    	<span class="project-info">Molestie facilisis risus arcu </span>
						    </li>
						    <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project1.jpg" alt="slide image" /></a>
						    	<span class="project-info">Molestie facilisis risus arcu </span>
						    </li>
						</ul>    	
					</div>
				<div class="slider-navigation">
		    		<ul>
		    		    <li><a class="active" href="#">1</a></li>
		    		    <li><a href="#">2</a></li>
		    		    <li><a href="#">3</a></li>
		    		    <li><a href="#">4</a></li>
		    		</ul>
		    	</div>
					
				<ul class="buttons">
					<li><a class="button" href="#">VIEW LIVE</a></li>
					<li><a class="button" href="#">CASE STUDY</a></li>
				</ul>
				</div>
				<!-- end Project -->
				
				<!-- Project -->
				<div class="project">
					<div class="slider-carousel">
						<ul>						
							<li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project2.jpg" alt="slide image" /></a>
						    	<span class="project-info">Etiam semper libero quis</span>
						    </li>
						    <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project1.jpg" alt="slide image" /></a>
						    	<span class="project-info">Etiam semper libero quis</span>
						    </li>
						    <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project3.jpg" alt="slide image" /></a>
						    	<span class="project-info">Etiam semper libero quis</span>
						    </li>
						</ul>    	
					</div>
					<div class="slider-navigation">
			    		<ul>
			    		    <li><a class="active" href="#">1</a></li>
			    		    <li><a href="#">2</a></li>
			    		    <li><a href="#">3</a></li>
			    		</ul>
		    		</div>
				<ul class="buttons">
					<li><a class="button" href="#">VIEW LIVE</a></li>
					<li><a class="button" href="#">CASE STUDY</a></li>
				</ul>
				</div>
				<!-- end Project -->
				
				<!-- Project -->
				<div class="project">
					<div class="slider-carousel">
						<ul>						
							<li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project3.jpg" alt="slide image" /></a>
						    </li>
						    <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project2.jpg" alt="slide image" /></a>
						    </li>
						    <li>
						    	<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/project1.jpg" alt="slide image" /></a>
						    	
						    </li>
						</ul>    	
					</div>
					<div class="slider-navigation">
			    		<ul>
			    		    <li><a class="active" href="#">1</a></li>
			    		    <li><a href="#">2</a></li>
			    		    <li><a href="#">3</a></li>
			    		</ul>
		    		</div>
				<ul class="buttons">
					<li><a class="button" href="#">VIEW LIVE</a></li>
					<li><a class="button" href="#">CASE STUDY</a></li>
				</ul>
				</div>
				<!-- end Project -->
				
			</div>
			<!-- end Works -->
			
			<!-- Blogroll -->
			<div id="blogroll">
				<div class="head">
					<h3>Blogroll></h3> <a class="rss" title="subscribe to RSS" href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/rss.gif" alt="rss" /></a>
				</div>
				<div class="box">
					<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
					<div class="comment">
						<span>30 Jun 2009 - 02:32 AM by Martina</span>
						<p class="text-right">32 <a href="#">Comments</a></p>
					</div>
					<div class="content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean faucibus, felis quis convallis vestibulum, libero ligula ultrices tortor, vitae molestie erat lacus et nunc. Etiam semper, libero quis molestie facilisis, risus arcu pellentesque metus, accumsan pharetra ipsum metus vel tortor.</p>
					</div>
					<a class="red"  href="#">read more &raquo;</a>
				</div>
				
				<div class="box">
					<h4>Molestie facilisis risus arcu </h4>
					<div class="comment">
						<span>30 Jun 2009 - 02:32 AM by Martina</span>
						<p class="text-right">32 <a href="#">Comments</a></p>
					</div>
					<div class="content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean faucibus, felis quis convallis vestibulum, libero ligula ultrices tortor, vitae molestie erat lacus et nunc. Etiam semper</p>
					</div>
					<a class="red" href="#">read more &raquo;</a>
				</div>
				
				<div class="box">
					<h4>Tortor vitae felis lorem convallis</h4>
					<div class="comment">
						<span>30 Jun 2009 - 02:32 AM by Martina</span>
						<p class="text-right">12 <a href="#">Comments</a></p>
					</div>
					<div class="content">
						<p>Etiam semper, libero quis molestie facilisis, risus arcu pellentesque metus, accumsan pharetra ipsum metus vel tortor.</p>
					</div>
					<a class="red" href="#">read more &raquo;</a>
				</div>
				
				<div class="box">
					<h4>Molestie facilisis risus arcu </h4>
					<div class="comment">
						<span>30 Jun 2009 - 02:32 AM by Martina</span>
						<p class="text-right">12 <a href="#">Comments</a></p>
					</div>
					<div class="content">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean faucibus, felis quis convallis vestibulum, libero ligula ultrices tortor, vitae molestie erat lacus et nunc. Etiam semper, libero quis molestie facilisis, risus arcu pellentesque metus.</p>
					</div>
					<a class="red" href="#">read more &raquo;</a>
				</div>
				
				
				
			</div>
			<!-- end Blogroll -->
			<div class="cl">&nbsp;</div>
		</div>
		<!-- end Shell -->			
	</div>
</div>
<!--  end Main -->

<!-- Fotoer -->
<div id="footer">
	<!-- Shell -->
	<div class="shell">
		<p>&copy; Sitename.com. Design by <a href="http://chocotemplates.com" target="_blank" title="The Sweetest CSS Templates WorldWide">ChocoTemplates.com</a></p>
	</div>
	<!-- end Shell -->
</div>
<!-- end Footer -->
</body>
</html>