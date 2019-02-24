﻿
<div class="row demo-row" style="border-radius: 6px; margin-top:-30px;">
  <div class="col-xs-12">
    <nav class="navbar navbar-inverse navbar-embossed" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01"> <span class="sr-only">Toggle navigation</span> </button>
        <a class="navbar-brand" href="/">juniorAlphabet</a> </div>
      <div class="collapse navbar-collapse" id="navbar-collapse-01">
        <ul class="nav navbar-nav navbar-left">
          <li><a href="lessons.php">Eroi<span class="navbar-unread">1</span></a></li>
        </ul>
		<?php
		if($obj_core->get_from_sesion("is_logged")==1)
		{
		?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Salut, <?php echo $obj_core->get_from_sesion("users_name"); ?> <b class="caret"></b></a> <span class="dropdown-arrow"></span>
            <ul class="dropdown-menu">
			<?php
				if($obj_core->get_from_sesion("users_rang")==1)
				{
					?> <li><a href="/lessons.php?type=add">Adauga lectii</a></li>				
				   <?php
				}
				?>
			  <li><a href="/profile.php">Colectia mea de eroi</a></li>
			  <li class="divider"></li>
			  <li><a href="scripts/class_users.php?type=logout">Iesire</a></li>
            </ul>
          </li>
        </ul>
		<?php
		}
		else
		{
		?>
		<ul class="nav navbar-nav navbar-right">
		     <li><a href="users.php?type=login">Autentificare</a></li>
			 <li><a href="users.php?type=register">Inregistrare</a></li>
		</ul>
		<?php
		}
		?>
      </div>
      <!-- /.navbar-collapse --> 
    </nav>
    <!-- /navbar --> 
  </div>
</div>