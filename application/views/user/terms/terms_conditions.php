<div class="breadcrumb-bar">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="breadcrumb-title">
					<?php 
                        foreach ($terms_language as $terms) { ?>
    						<h2 style="text-transform: capitalize;"><?php echo(!empty($terms['title']))?($terms['title']) : 'Terms Condition';  ?></h2>

                    <?php } ?>
					
				</div>
			</div>
			<div class="col-auto float-right ml-auto breadcrumb-menu">
				<nav aria-label="breadcrumb" class="page-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>"><?php echo (!empty($user_language[$user_selected]['lg_home'])) ? $user_language[$user_selected]['lg_home'] : $default_language['en']['lg_home']; ?></a></li>
						<?php 
                        foreach ($terms_language as $terms) { ?>
    						<li class="breadcrumb-item active" aria-current="page"><?php echo(!empty($terms['title']))?($terms['title']) : 'Terms Condition';  ?></li>

                    	<?php } ?>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="about-blk-content">
				<?php foreach ($terms_language as $terms) { 
					if($terms['content']) {
				?>
					<p><?php echo(!empty($terms['content']))?($terms['content']) : 'help page content';  ?></p>	
					<?php }  else {?>
					<p><?php echo (!empty($user_language[$user_selected]['lg_details_not_found'])) ? $user_language[$user_selected]['lg_details_not_found'] : $default_language['en']['lg_details_not_found']; ?></p>
				<?php } } ?>
					
				</div>
			</div>
		</div>
	</div>
</div>