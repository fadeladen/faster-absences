<page backtop="8mm" backbottom="8mm" backleft="10mm" backright="10mm">
	<style>
		*,
		p,
		td,
		th,
        ol,
        ul,
        li {
			font-size: 12px;
            padding: 0;
            margin: 0;
		}

        .qr-container {
            margin: 100px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
	</style>
	<img src="<?php echo FCPATH . 'assets/images/logos/FHI_360.png' ?>" style='width:120px;position:absolute;left:0px'>

	<div class="qr-container">
    	<img style="margin-left: 40px;" src="<?=  FCPATH . 'assets/images/qrcode/' . $detail['qr_file'] ?>">	
	</div>
</page>
