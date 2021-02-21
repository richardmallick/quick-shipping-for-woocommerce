<div class="wrap">
	<div class="wrap">
		<h1></h1>
		<div class="wppool-qs-header">
			<h1><span class="wppool-qs-logo"><img src="<?php echo WPPOOL_QS_ASSETS ?>/img/logo.png" /></span><?php echo  esc_html__('Quick Shipping for Woocommerce Settings', WPPOOL_QS_TEXTDOMAIN); ?></h1>
		</div>
		<div class="wppool-qs-tabs">
				<ul class="wppool-qs-tab-button">
					<li class="btn active"><a href="#general"><i class="demo-icon icon-settings"></i> <?php echo  esc_html__('General Settings', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
					<li class="btn"><a href="#shipping"><i class="demo-icon icon-shipping"></i> <?php echo  esc_html__('Add Shipping', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
					<li class="btn"><a href="#style"><i class="demo-icon icon-ok"></i> <?php echo  esc_html__('Customize', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
					<li class="btn"><a href="#status"><i class="demo-icon icon-status"></i> <?php echo  esc_html__('System Status', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
					<li class="btn"><a href="#tutorial"><i class="demo-icon icon-doc"></i> <?php echo  esc_html__('Documentation', WPPOOL_QS_TEXTDOMAIN); ?></a></li>
				</ul>
				<div class="wppool-qs-tab-content">
					<div id="general" class="tab-item active">
						<h2> <i class="demo-icon icon-settings"></i> <?php echo  esc_html__('General Settings', WPPOOL_QS_TEXTDOMAIN); ?></h2>
						<hr>
						<div class="wppool-tab-content">
							<?php
								if (file_exists(__DIR__ . "/wppool-qs-general.php")) {

									include __DIR__ . "/wppool-qs-general.php";

								}
							?>
						</div>
					</div>
					<div id="shipping" class="tab-item active">

							<?php
								if (file_exists(__DIR__ . "/wppool-qs-add-shipping.php")) {

									include __DIR__ . "/wppool-qs-add-shipping.php";

								}
							?>
					</div>
					<div id="style" class="tab-item active">
						<h2> <i class="demo-icon icon-ok"></i> <?php echo  esc_html__('Customize', WPPOOL_QS_TEXTDOMAIN); ?></h2>
						<hr>
						<div class="wppool-tab-content">
							<?php
								if (file_exists(__DIR__ . "/wppool-qs-style.php")) {

									include __DIR__ . "/wppool-qs-style.php";

								}
							?>
						</div>
					</div>
					<div id="status" class="tab-item">
						<h2> <i class="demo-icon icon-status"></i>  <?php echo  esc_html__('System Status', WPPOOL_QS_TEXTDOMAIN); ?></h2>
						<hr>
						<div class="wppool-tab-content">
							<?php
								if (file_exists(__DIR__ . "/wppool-qs-status.php")) {

									include __DIR__ . "/wppool-qs-status.php";

								}
							?>
						</div>
					</div>
				
					<div id="tutorial" class="tab-item">
						<h2> <i class="demo-icon icon-doc"></i> <?php echo esc_html__('Documentation', WPPOOL_QS_TEXTDOMAIN); ?></h2>
						<hr>
						<div class="wppool-tab-content">
							<?php
								if (file_exists(__DIR__ . "/wppool-qs-doc.php")) {

									include __DIR__ . "/wppool-qs-doc.php";

								}
							?>
						</div>
					</div>
					
				</div>
		</div>
	</div>
</div>