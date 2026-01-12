<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM ekibimiz WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfaekibimiz'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM ekibimiz WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['ekiburl']."' OR link = '".$htc['ekiburl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan10/<?php echo $arkaplan['arkaplan10'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt55'];?>
            </div>
        </div>
    </div>

    <div class="vk-breadcrumb">
        <nav class="container">
            <ul>
                <li><a href="./"><?=@$dil['txt17'];?></a></li>
				<?php if($menubas['menu_isim'] != ""){?>
				<li><a href="<?php echo($menubas['menu_url'] == "0" ? $menubas['link'] : $menubas['menu_url'].$html);?>"><?php echo h43KEsAyau_ilkbuyuk($menubas['menu_isim']);?></a></li>
				<?php }?>
                <li class="active"><?=@$dil['txt55'];?></li>
            </ul>
        </nav>
    </div>

    <div class="vk-page vk-page-about">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
				<?php if($BSorgu->rowCount() != "0"){?>
				<div class="row clearfix">			
					<?php foreach ( $Bislem as $BSonuc ){?>
					<!-- Team Block -->
					<div class="team-block col-lg-<?php echo $limitayar['limit_ekip'];?> col-md-<?php echo $limitayar['limit_ekip'];?> col-sm-12">
						<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
							<div class="image">
								<img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $BSonuc['resim']; ?>" alt="<?php echo $BSonuc['adi']; ?>" />
								<!-- Overlay Box -->
								<div class="overlay-box">
									<div class="overlay-inner">
										<div class="content">
											<!-- Social Box -->
											<ul class="social-box">
												<?php if($BSonuc['facebook']){?><li class="facebook"><a target="_blank" href="<?php echo $BSonuc['facebook']; ?>" class="fab fa-facebook-f" title="facebook"></a></li><?php }?>
												<?php if($BSonuc['twitter']){?><li class="twitter"><a target="_blank" href="<?php echo $BSonuc['twitter']; ?>" class="fab fa-twitter" title="twitter"></a></li><?php }?>
												<?php if($BSonuc['instagram']){?><li class="instagram-sosyal"><a target="_blank" href="<?php echo $BSonuc['instagram']; ?>" class="fab fa-instagram" title="instagram"></a></li><?php }?>
												<?php if($BSonuc['linkedin']){?><li class="linkedin"><a target="_blank" href="<?php echo $BSonuc['linkedin']; ?>" class="fab fa-linkedin" title="linkedin"></a></li><?php }?>
												<?php if($BSonuc['youtube']){?><li class="youtube"><a target="_blank" href="<?php echo $BSonuc['youtube']; ?>" class="fab fa-youtube" title="youtube"></a></li><?php }?>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="lower-content">
								<h4><a <?php if($BSonuc['detay'] == 1){?>href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>" <?php }else{?> class="swipebox" title="<?php echo $BSonuc['adi']; ?>" href="<?php echo tema;?>/uploads/ekibimiz/<?php echo $BSonuc['resim']; ?>" <?php }?>> <?php echo $BSonuc['adi']; ?> </a></h4>
								<div class="designation"><?php echo $BSonuc['gorev']; ?></div>
							</div>
						</div>
					</div>
					<?php }?>			
				</div>
				
				<?php if($limitayar['limit_sayfaekibimiz'] < $total && $limitayar['limit_sayfaekibimiz'] > 0){?>
				<!-- PAGE NUMBER -->
				<nav class="box-pagination text-center">
					<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfaekibimiz'];?> <?=@$dil['txt50'];?></p>
					<ul class="vk-pagination">
						<?php
						if($limitayar['limit_sayfaekibimiz'] < $total && $limitayar['limit_sayfaekibimiz'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
						<li class="back arrow"><a href="<?php echo $htc['ekiburl'];?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
						<?php }
						for($i= $page - $showing; $i < $page + $showing + 1; $i++){
						if($i > 0 and $i <= $page_count){
						if($i == $page){?>
						<li class="active"><?php echo $i; ?></li>
						<?php }else{?>
						<li><a href="<?php echo $htc['ekiburl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
						<?php }
						}
						}
						if($page != $page_count){?>
						<?php  $next = $page +1;?>
						<li class="next arrow"><a href="<?php echo $htc['ekiburl'];?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
						<?php }} ?>
					</ul>
				</nav>
				<?php }?>
				
				<?php }else{?>
				<div class="alert alert-warning text-left " style="width:100%;" role="alert">
					<p><strong><?=@$dil['txt51'];?></strong></p>
					<?=@$dil['txt52'];?></br>
					<?=@$dil['txt53'];?>
				</div>
				<?php }?>				
            </div>
        </div>
    </div>
</section>