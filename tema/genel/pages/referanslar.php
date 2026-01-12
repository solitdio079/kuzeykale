<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM referanslar WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfareferans'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM referanslar WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['refurl']."' OR link = '".$htc['refurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan5/<?php echo $arkaplan['arkaplan5'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt83'];?>
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
                <li class="active"><?=@$dil['txt83'];?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-about" id="workers">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
                <?php if($BSorgu->rowCount() != "0"){?>
				<div class="row clearfix">
					<?php foreach ( $Bislem as $BSonuc ){?>
					<div class="col-lg-<?php echo $limitayar['limit_referanslar'];?> col-md-<?php echo $limitayar['limit_referanslar'];?> col-6">
						<div class="card">
							<div class="referanslar">
								<a <?php if($BSonuc['detay'] == 1){?> class="d-ortala" href="<?php echo $htc['refdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>" <?php }else{?> class="d-ortala swipebox" href="<?php echo tema;?>/uploads/referanslar/<?php echo $BSonuc['resim']; ?>" alt="<?php echo $BSonuc['adi'];?>" title="<?php echo $BSonuc['adi'];?>" <?php }?>>
									<img class="w-100" src="<?php echo tema;?>/uploads/referanslar/<?php echo $BSonuc['resim']; ?>" alt="<?php echo $BSonuc['adi']; ?>" />
								</a>
							</div>
						</div>
					</div>
					<?php }?>		
				</div>
                <!--./row-->
				
				<?php if($limitayar['limit_sayfareferans'] < $total && $limitayar['limit_sayfareferans'] > 0){?>
				<!-- PAGE NUMBER -->
				<nav class="box-pagination text-center">
					<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfareferans'];?> <?=@$dil['txt50'];?></p>
					<ul class="vk-pagination">
						<?php
						if($limitayar['limit_sayfareferans'] < $total && $limitayar['limit_sayfareferans'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
						<li class="back arrow"><a href="<?php echo $htc['refurl'];?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
						<?php }
						for($i= $page - $showing; $i < $page + $showing + 1; $i++){
						if($i > 0 and $i <= $page_count){
						if($i == $page){?>
						<li class="active"><?php echo $i; ?></li>
						<?php }else{?>
						<li><a href="<?php echo $htc['refurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
						<?php }
						}
						}
						if($page != $page_count){?>
						<?php  $next = $page +1;?>
						<li class="next arrow"><a href="<?php echo $htc['refurl'];?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
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