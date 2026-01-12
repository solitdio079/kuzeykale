<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM proje_kategori WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfaproje'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$PROJESorgu = $db->prepare("SELECT * FROM proje_kategori WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$PROJESorgu->execute(array("1",$_SESSION['k_dil']));
$PROJEislem = $PROJESorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['projelerurl']."' OR link = '".$htc['projelerurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan21/<?php echo $arkaplan['arkaplan21'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt233'];?>
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
                <li class="active"><?=@$dil['txt233'];?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-about">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
				<?php if($PROJESorgu->rowCount() != "0"){?>
				<div class="row clearfix">
					<?php foreach ( $PROJEislem as $PROJESonuc ){?>
					<div class="team-block col-lg-<?php echo $limitayar['limit_projeler'];?> col-md-<?php echo $limitayar['limit_projeler'];?> col-sm-12">
						<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
							<div class="image">
								<a href="<?php echo $htc['projekategoriurl']; ?>/<?php echo $PROJESonuc['seo']; ?><?php echo $html;?>" class="urunler">
								<img src="<?php echo tema;?>/uploads/proje_kategoriler/kapak/<?php echo $PROJESonuc['kapak']; ?>" alt="<?php echo $PROJESonuc['adi']; ?>" />
								<!-- Overlay Box -->
								<div class="overlay-box">
									<div class="overlay-inner">
									</div>
								</div>
								</a>
							</div>
							<div class="lower-content">
								<h4><a href="<?php echo $htc['projekategoriurl']; ?>/<?php echo $PROJESonuc['seo']; ?><?php echo $html;?>" class="urunler"><?php echo $PROJESonuc['adi']; ?></a></h4>
							</div>
						</div>
					</div>
					<?php }?>			
				</div>
				
				<?php if($limitayar['limit_sayfaproje'] < $total && $limitayar['limit_sayfaproje'] > 0){?>
				<!-- PAGE NUMBER -->
				<nav class="box-pagination text-center">
					<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfaproje'];?> <?=@$dil['txt50'];?></p>
					<ul class="vk-pagination">
						<?php
						if($limitayar['limit_sayfaproje'] < $total && $limitayar['limit_sayfaproje'] > 0){
						$showing = 3;
						if($page > 1){?>
						<?php $previous = $page - 1;?>
						<li class="back arrow"><a href="<?php echo $htc['projelerurl'];?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
						<?php }
						for($i= $page - $showing; $i < $page + $showing + 1; $i++){
						if($i > 0 and $i <= $page_count){
						if($i == $page){?>
						<li class="active"><?php echo $i; ?></li>
						<?php }else{?>
						<li><a href="<?php echo $htc['projelerurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
						<?php }
						}
						}
						if($page != $page_count){?>
						<?php  $next = $page +1;?>
						<li class="next arrow"><a href="<?php echo $htc['projelerurl'];?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
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