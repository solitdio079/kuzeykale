<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<section class="vk-content">

    <div class="vk-banner vk-background-image-3">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt16'];?>
            </div>
        </div>
    </div>
    <!--./vk-banner-->
    <div class="vk-breadcrumb">
        <nav class="container">
            <ul>
                <li><a href="./"><?=@$dil['txt17'];?></a></li>
                <li class="active"><?=@$dil['txt16'];?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-404">
        <div class="container">
            <div class="row">
                <div class="col-md-9 left">
                    <div class="vk-img-frame">
                        <img class="img-responsive" src="<?php echo tema;?>/images/404/404.png" alt="">
                    </div>
                    <div class="vk-search-form">
						<form method="get" action="ara<?php echo $html;?>">
							<div class="form-group">
								<input type="text" name="kelime" placeholder="<?=@$dil['txt81'];?>" class="form-control" required>
								<button class="vk-btn vk-btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
                        <div class="vk-buttons">
                            <a href="javascript:void(0);" onclick="goBack()" class="vk-btn vk-btn-l text-uppercase vk-btn-go-back"><i class="fa fa-long-arrow-left"></i> <?=@$dil['txt56'];?></a>
                            <a href="./" class="vk-btn vk-btn-l vk-btn-default text-uppercase"><i class="fa fa-home"></i> <?=@$dil['txt18'];?></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 right">
                    <ul class="vk-list vk-menu-right">
					<?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
					$FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
					$FMENUislem = $FMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
						<?php foreach ( $FMENUislem as $FMENUSonuc ){?>
						<li><a <?php echo($FMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>"><?php echo $FMENUSonuc['menu_isim']; ?></a></li>
						<?php }?> 
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
<!--./content-->