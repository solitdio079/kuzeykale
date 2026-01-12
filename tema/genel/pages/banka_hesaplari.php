<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM banka_hesaplari WHERE durum = ?");
$ttsorgu->execute(array("1"));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfabhesaplari'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM banka_hesaplari WHERE durum = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1"));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['bankahesapurl']."' OR link = '".$htc['bankahesapurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan17/<?php echo $arkaplan['arkaplan17'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt38'];?>
            </div>
        </div>
    </div>
    <!--./vk-banner-->

    <div class="vk-breadcrumb">
        <nav class="container">
            <ul>
                <li><a href="./"><?=@$dil['txt17'];?></a></li>
				<?php if($menubas['menu_isim'] != ""){?>
				<li><a href="<?php echo($menubas['menu_url'] == "0" ? $menubas['link'] : $menubas['menu_url'].$html);?>"><?php echo h43KEsAyau_ilkbuyuk($menubas['menu_isim']);?></a></li>
				<?php }?>
                <li class="active"><?=@$dil['txt38'];?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-about">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
                <?php if($BSorgu->rowCount()){?>
				<div class="row clearfix">
					<?php foreach ( $Bislem as $BSonuc ){?>
					<div class="col-lg-<?php echo $limitayar['limit_bhesaplari'];?> col-md-<?php echo $limitayar['limit_bhesaplari'];?> col-12 workers-col">
						<div class="card card-active">
							<div class="row">
								<div class="col-md-3 col-3">
									<div style="display: table-cell;vertical-align: middle;height: 144px;padding: 10px;">
										<img src="<?php echo tema;?>/uploads/bankalar/<?php echo $BSonuc['resim']; ?>" alt="<?php echo $BSonuc['banka']; ?>">
									</div>
								</div>
								<div class="col-md-9 col-9">
									<div class="blog-info text-left" style="display: table-cell;vertical-align: middle;height: 144px;">
										<p><?php echo $BSonuc['banka']; ?>, <?php echo $BSonuc['hesap']; ?>,<br> 
											<strong><?php echo $BSonuc['iban']; ?></strong><br>
											<?=@$dil['txt39'];?> <strong><?php echo $BSonuc['sube']; ?></strong><br>
											<?=@$dil['txt40'];?> <strong><?php echo $BSonuc['hnumara']; ?></strong></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php }?>				
				</div>
                <!--./row-->
				
				<?php if($limitayar['limit_sayfabhesaplari'] < $total && $limitayar['limit_sayfabhesaplari'] > 0){?>
				<!-- PAGE NUMBER -->
				<nav class="box-pagination text-center">
					<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfabhesaplari'];?> <?=@$dil['txt50'];?></p>
					<ul class="vk-pagination">
						<?php
						if($limitayar['limit_sayfabhesaplari'] < $total && $limitayar['limit_sayfabhesaplari'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
						<li class="back arrow"><a href="<?php echo $htc['bankahesapurl'];?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
						<?php }
						for($i= $page - $showing; $i < $page + $showing + 1; $i++){
						if($i > 0 and $i <= $page_count){
						if($i == $page){?>
						<li class="active"><?php echo $i; ?></li>
						<?php }else{?>
						<li><a href="<?php echo $htc['bankahesapurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
						<?php }
						}
						}
						if($page != $page_count){?>
						<?php  $next = $page +1;?>
						<li class="next arrow"><a href="<?php echo $htc['bankahesapurl'];?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
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
            <!--./container-->
        </div>
        <!--./vk-who-we-are-->

    </div>
    <!--./vk-page-->
</section>