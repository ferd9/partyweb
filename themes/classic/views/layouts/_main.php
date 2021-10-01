<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language;?>" lang="<?php echo Yii::app()->language;?>" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo CHtml::encode($this->pageTitle).' - '.Yii::app()->params['empresa']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset;?>" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/layout.css" type="text/css" />
</head>
<body id="top">
<div class="wrapper col1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="index.html"><?php echo CHtml::encode(Yii::app()->name); ?></a></h1>
      <p><?php echo Yii::app()->params['slogan']; ?></p>
    </div>
    <div class="fl_right"><a href="#"><?php echo CHtml::image(Yii::app()->theme->baseUrl."/images/468x60.gif","468x60");?></a></div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="topbar" class="clear">
    
		<?php $this->widget('zii.widgets.CMenu',array(
			'id'=>'topnav',
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Usuarios', 'url'=>array('/usuarios/index'),
						'items'=>array(
							array('label'=>'Nuevo', 'url'=>array('/usuarios/create')),
							array('label'=>'Listado usarios', 'url'=>array('/usuarios/index')),
							array('label'=>'Administrar', 'url'=>array('/usuarios/admin')),
						),
				),
				array('label'=>'Ciudad', 'url'=>array('/ciudad/index')),
				array('label'=>'Experiencia', 'url'=>array('/experiencia/index')),
				array('label'=>'Estudios', 'url'=>array('/estudios/index')),
				array('label'=>'Folio', 'url'=>array('/folio/index')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
    
	<form action="#" method="post" id="search">
      <fieldset>
        <legend>Site Search</legend>
        <input type="text" value="Search Our Website&hellip;" onfocus="this.value=(this.value=='Search Our Website&hellip;')? '' : this.value ;" />
        <input type="image" id="go" src="images/search.gif" alt="Search" />
      </fieldset>
    </form>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="container" class="clear">
    <!-- ####################################################################################################### -->
    <div id="content">
      <h1>&lt;h1&gt; to &lt;h6&gt; - Headline Colour and Size Are All The Same</h1>
      <img class="imgr" src="images/demo/imgr.gif" alt="" width="125" height="125" />
      <p>Aliquatjusto quisque nam consequat doloreet vest orna partur scetur portortis nam. Metadipiscing eget facilis elit sagittis felisi eger id justo maurisus convallicitur.</p>
      <p>Dapiensociis <a href="#">temper donec auctortortis cumsan</a> et curabitur condis lorem loborttis leo. Ipsumcommodo libero nunc at in velis tincidunt pellentum tincidunt vel lorem.</p>
      <img class="imgl" src="images/demo/imgl.gif" alt="" width="125" height="125" />
      <p>This is a W3C compliant free website template from <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a>. This template is distributed using a <a href="http://www.os-templates.com/template-terms">Website Template Licence</a>.</p>
      <p>You can use and modify the template for both personal and commercial use. You must keep all copyright information and credit links in the template and associated files. For more CSS templates visit <a href="http://www.os-templates.com/">Free Website Templates</a>.</p>
      <p>Portortornec condimenterdum eget consectetuer condis consequam pretium pellus sed mauris enim. Puruselit mauris nulla hendimentesque elit semper nam a sapien urna sempus.</p>
      <h2>Table(s)</h2>
      <table summary="Summary Here" cellpadding="0" cellspacing="0">
        <thead>
          <tr>
            <th>Header 1</th>
            <th>Header 2</th>
            <th>Header 3</th>
            <th>Header 4</th>
          </tr>
        </thead>
        <tbody>
          <tr class="light">
            <td>Value 1</td>
            <td>Value 2</td>
            <td>Value 3</td>
            <td>Value 4</td>
          </tr>
          <tr class="dark">
            <td>Value 5</td>
            <td>Value 6</td>
            <td>Value 7</td>
            <td>Value 8</td>
          </tr>
          <tr class="light">
            <td>Value 9</td>
            <td>Value 10</td>
            <td>Value 11</td>
            <td>Value 12</td>
          </tr>
          <tr class="dark">
            <td>Value 13</td>
            <td>Value 14</td>
            <td>Value 15</td>
            <td>Value 16</td>
          </tr>
        </tbody>
      </table>
      <div id="comments">
        <h2>Comments</h2>
        <ul class="commentlist">
          <li class="comment_odd">
            <div class="author"><img class="avatar" src="images/demo/avatar.gif" width="32" height="32" alt="" /><span class="name"><a href="#">A Name</a></span> <span class="wrote">wrote:</span></div>
            <div class="submitdate"><a href="#">August 4, 2009 at 8:35 am</a></div>
            <p>This is an example of a comment made on a post. You can either edit the comment, delete the comment or reply to the comment. Use this as a place to respond to the post or to share what you are thinking.</p>
          </li>
          <li class="comment_even">
            <div class="author"><img class="avatar" src="images/demo/avatar.gif" width="32" height="32" alt="" /><span class="name"><a href="#">A Name</a></span> <span class="wrote">wrote:</span></div>
            <div class="submitdate"><a href="#">August 4, 2009 at 8:35 am</a></div>
            <p>This is an example of a comment made on a post. You can either edit the comment, delete the comment or reply to the comment. Use this as a place to respond to the post or to share what you are thinking.</p>
          </li>
          <li class="comment_odd">
            <div class="author"><img class="avatar" src="images/demo/avatar.gif" width="32" height="32" alt="" /><span class="name"><a href="#">A Name</a></span> <span class="wrote">wrote:</span></div>
            <div class="submitdate"><a href="#">August 4, 2009 at 8:35 am</a></div>
            <p>This is an example of a comment made on a post. You can either edit the comment, delete the comment or reply to the comment. Use this as a place to respond to the post or to share what you are thinking.</p>
          </li>
        </ul>
      </div>
      <h2>Write A Comment</h2>
      <div id="respond">
        <form action="#" method="post">
          <p>
            <input type="text" name="name" id="name" value="" size="22" />
            <label for="name"><small>Name (required)</small></label>
          </p>
          <p>
            <input type="text" name="email" id="email" value="" size="22" />
            <label for="email"><small>Mail (required)</small></label>
          </p>
          <p>
            <textarea name="comment" id="comment" cols="100%" rows="10"></textarea>
            <label for="comment" style="display:none;"><small>Comment (required)</small></label>
          </p>
          <p>
            <input name="submit" type="submit" id="submit" value="Submit Form" />
            &nbsp;
            <input name="reset" type="reset" id="reset" tabindex="5" value="Reset Form" />
          </p>
        </form>
      </div>
    </div>
    <div id="column">
      <div class="subnav">
        <h2>Secondary Navigation</h2>
        <ul>
          <li><a href="#">Open Source Templates</a></li>
          <li><a href="#">Free CSS Templates</a>
            <ul>
              <li><a href="#">Free XHTML Templates</a></li>
              <li><a href="#">Free Website Templates</a></li>
            </ul>
          </li>
          <li><a href="#">Open Source Layouts</a>
            <ul>
              <li><a href="#">Open Source Software</a></li>
              <li><a href="#">Open Source Webdesign</a>
                <ul>
                  <li><a href="#">Open Source Downloads</a></li>
                  <li><a href="#">Open Source Website</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="#">Open Source Themes</a></li>
        </ul>
      </div>
      <div class="holder">
        <h2 class="title"><img src="images/demo/60x60.gif" alt="" />Nullamlacus dui ipsum conseque</h2>
        <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna. Urnaultrices quis curabitur phasellentesque.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
      <div id="featured">
        <ul>
          <li>
            <h2>Indonectetus facilis</h2>
            <p class="imgholder"><img src="images/demo/240x90.gif" alt="" /></p>
            <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna. Urnaultrices quis curabitur phasellentesque congue magnis vestibulum quismodo nulla et feugiat. Adipisciniapellentum leo ut consequam ris felit elit id nibh sociis malesuada.</p>
            <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
          </li>
        </ul>
      </div>
      <div class="holder">
        <h2>Lorem ipsum dolor</h2>
        <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p>
        <ul>
          <li><a href="#">Lorem ipsum dolor sit</a></li>
          <li>Etiam vel sapien et</li>
          <li><a href="#">Etiam vel sapien et</a></li>
        </ul>
        <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. Condimentumsantincidunt dui mattis magna intesque purus orci augue lor nibh.</p>
        <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
      </div>
    </div>
    <!-- ####################################################################################################### -->
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="footer" class="clear">
    <div class="footbox">
      <h2>About Us</h2>
      <p>Lornunc tincidunt nec nequat risus convallisis elit vestiquat justo et volutpat. Urnanec monterdum turistibus semportis non vivamus justo pellus ac integestiquat eros. Turet cursuspend ero nulla dapienteger quisque nullamcorper lorem in ut pellus.</p>
      <p>Atmaecenas nec non nam nullamcorper magna id id nisl ac in. Sedfauctortis fuscetus estibus gravida id dui curabitur commodo facilisi loborttitorttitor vitae.</p>
    </div>
    <div class="footbox">
      <h2>Our Skillset</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Amet consectetur</a></li>
        <li><a href="#">Praesent vel sem id</a></li>
        <li><a href="#">Curabitur hendrerit est</a></li>
        <li><a href="#">Aliquam eget erat nec sapien</a></li>
        <li><a href="#">Cras id augue nunc</a></li>
        <li><a href="#">In nec justo non</a></li>
        <li><a href="#">Vivamus mollis enim ut</a></li>
        <li class="last"><a href="#">Sed a nulla urna</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Blog Links</h2>
      <ul>
        <li><a href="#">Lorem ipsum dolor sit</a></li>
        <li><a href="#">Amet consectetur</a></li>
        <li><a href="#">Praesent vel sem id</a></li>
        <li><a href="#">Curabitur hendrerit est</a></li>
        <li><a href="#">Aliquam eget erat nec sapien</a></li>
        <li><a href="#">Cras id augue nunc</a></li>
        <li><a href="#">In nec justo non</a></li>
        <li><a href="#">Vivamus mollis enim ut</a></li>
        <li class="last"><a href="#">Sed a nulla urna</a></li>
      </ul>
    </div>
    <div class="footbox last">
      <h2>Keep in Touch</h2>
      <ul>
        <li><a href="#">Check out our Facebook page</a></li>
        <li><a href="#">Get the latest Tweets</a></li>
        <li><a href="#">Grab our latest Deviants</a></li>
        <li><a href="#">View our LinkedIn profile</a></li>
      </ul>
      <h2>Contact Us</h2>
      <ul>
        <li><strong class="title">Tel:</strong><br />
          xxxxx xxxxxxxxxx</li>
        <li><strong class="title">Email:</strong><br />
          <a href="#">contact@mydomain.com</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2011 - All Rights Reserved - <a href="#">Domain Name</a></p>
    <p class="fl_right">Template by <a href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
  </div>
</div>
</body>
</html>