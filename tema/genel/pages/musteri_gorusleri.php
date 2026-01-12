<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM musteri_gorusleri WHERE durum = ?");
$ttsorgu->execute(array("1"));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfayorumlar'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM musteri_gorusleri WHERE durum = ? ORDER BY id DESC LIMIT $show,$limit");
$BSorgu->execute(array("1"));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['musteriurl']."' OR link = '".$htc['musteriurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">

    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan8/<?php echo $arkaplan['arkaplan8'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt75'];?>
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
                <li class="active"><?=@$dil['txt75'];?></li>
            </ul>
        </nav>
    </div>

    <div class="vk-page vk-page-testimonial">
        <div class="container">
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 mt-4">
					<a href="javascript:void(0);" data-remodal-target="musteri_gorusleri" data-remodal-backdrop="static" data-remodal-keyboard="false" class="vk-btn vk-btn-icon vk-btn-l vk-border-bottom vk-btn-turquoise text-uppercase float-right mb-4">
						<span class="title"><?=@$dil['txt232'];?></span>
						<span class="icon">
							<i class="fa fa-arrow-right"></i>
						</span>
					</a>
				</div>
			</div>
			<?php if($BSorgu->rowCount() != "0"){?>
            <div class="row">
                <div class="vk-testimonial-list vk-masonry-layout">
					<?php foreach ( $Bislem as $BSonuc ){?>
                    <div class="col-lg-<?php echo $limitayar['limit_yorum'];?> col-md-<?php echo $limitayar['limit_yorum'];?> col-sm-12 item">
                        <div class="vk-testimonial">
                            <div class="avatar">
                                <div class="vk-img-frame">
                                    <a href="javascript:void(0);" class="vk-img arkarenk1">
                                        <img src="<?php echo tema;?>/images/unnamed.png" alt="<?php echo $BSonuc['isim'];?>">
                                    </a>
                                </div>
                                <div class="profile">
                                    <span class="name"><?php echo $BSonuc['isim'];?></span>
                                    <span class="position"><?php echo $BSonuc['meslek'];?> - <?php echo h43KEsAyau_tarih($BSonuc['tarih']);?></span>
                                </div>
                            </div>
                         

                            <div class="content">
                                <i class="fa fa-quote-left"></i>
                                <p class="vk-text"><?php echo $BSonuc['yorum'];?></p>
                            </div>
     
                        </div>

                    </div>
					<?php }?>
                </div>
            </div>
            
			<?php if($limitayar['limit_sayfayorumlar'] < $total && $limitayar['limit_sayfayorumlar'] > 0){?>
			<!-- PAGE NUMBER -->
			<nav class="box-pagination text-center">
				<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfayorumlar'];?> <?=@$dil['txt50'];?></p>
				<ul class="vk-pagination">
					<?php
					if($limitayar['limit_sayfayorumlar'] < $total && $limitayar['limit_sayfayorumlar'] > 0){
					$showing = 3;
					if($page > 1){?>
					<?php $previous = $page - 1;?>
					<li class="back arrow"><a href="<?php echo $htc['musteriurl'];?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
					<?php }
					for($i= $page - $showing; $i < $page + $showing + 1; $i++){
					if($i > 0 and $i <= $page_count){
					if($i == $page){?>
					<li class="active"><?php echo $i; ?></li>
					<?php }else{?>
					<li><a href="<?php echo $htc['musteriurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
					<?php }
					}
					}
					if($page != $page_count){?>
					<?php  $next = $page +1;?>
					<li class="next arrow"><a href="<?php echo $htc['musteriurl'];?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
					<?php }} ?>
				</ul>
			</nav>
			<?php }?>
			
			<?php }else{?>	
			<div class="col-12">
				<div class="alert alert-warning text-left " style="width:100%;" role="alert">
					<p><strong><?=@$dil['txt51'];?></strong></p>
					<?=@$dil['txt52'];?></br>
					<?=@$dil['txt53'];?>
				</div>
			</div>
			<?php }?>
			
        </div>
        <!--./container-->
    </div>
    <!--./vk-page-->

</section>
<!--./content-->

<!--Müşteri Görüşleri -->
<div class="remodal p-0 popupform" data-remodal-id="musteri_gorusleri" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
    <a href="javascript:void(0);" data-remodal-action="close" class="remodal-close bg-white"></a>
    <form action="_class/site_islem.php" class="form-column yorum-form" method="post" autocomplete="off">
        <div class="inner-column-1 mt-0 rounded-0">
			<h2><?=@$dil['txt76'];?></h2>
			<!--Default Form-->
			<div class="default-form">
				<div class="row clearfix">

					<div class="form-group col-md-12 col-sm-12 col-xs-12">
						<input type="text" name="isim" placeholder="<?=@$dil['txt5'];?>" required="">
					</div>

					<div class="form-group col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="meslek" placeholder="<?=@$dil['txt77'];?>">
					</div>

					<div class="form-group col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="sehir" placeholder="<?=@$dil['txt78'];?>">
					</div>

					<div class="form-group col-md-12 col-sm-12 col-xs-12">
						<textarea name="yorum" placeholder="<?=@$dil['txt79'];?>" required=""></textarea>
					</div>

					<div class="form-group text-center btn-column col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" name="kontrol" value="" id="kontrol">	
						<input type="hidden" name="yorumurl" value="<?php echo $sayfalink;?>" />
						<button class="vk-btn vk-border-bottom vk-btn-s vk-btn-default text-uppercas" type="submit" name="yorumbtn"><span class="title"><?=@$dil['txt74'];?></span></button>
					</div>

				</div>
			</div>

		</div>
    </form>
</div>