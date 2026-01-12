<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$aSorgu = $db->prepare("SELECT * FROM hizmetler WHERE seo = ? AND durum = ? AND dil = ?");
	$aSorgu->execute(array($_GET['id'],1,$_SESSION['k_dil']));
	if($aSorgu->rowCount()){
		$aSonuc 		= $aSorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$aSorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$aSorgu->execute(array(1,$_SESSION['k_dil']));
	if($aSorgu->rowCount()){
		$aSonuc 		= $aSorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$onceki	= $db->query("SELECT * FROM hizmetler WHERE id < '{$aSonuc['id']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$sonraki = $db->query("SELECT * FROM hizmetler WHERE id > '{$aSonuc['id']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['hizmetdetayurl']."/".$aSonuc['seo']."' OR link = '".$htc['hizmetdetayurl']."/".$aSonuc['seo']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);		
?>
<section class="vk-content">

    <div class="vk-banner vk-background-image-8" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan9/<?php echo $arkaplan['arkaplan9'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?php echo $aSonuc['adi'];?>
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
				<li class="active"><?php echo $aSonuc['adi'];?></li>
            </ul>
        </nav>
    </div>

    <div class="" data-example-id="media-alignment">
        <div class="vk-blog-wrapper">
            <div class="container">
                <div class="row">
                    <div class="vk-space x-large">
                        <div class="single-blog">
                            <div class="col-md-9">
                                <div class="blog-content">
									<?php if($aSonuc['resim'] != ""){?>
                                    <div class="vk-img-frame">
                                        <img src="<?php echo tema;?>/uploads/hizmetler/<?php echo $aSonuc['resim'];?>" alt="<?php echo $aSonuc['adi']; ?>">
                                    </div>
									<?php }?>
                                    <h4><?php echo $aSonuc['adi']; ?></h4>
                                    <div class="info">
                                        <ul class="vk-list">
                                            <li class="vk-text-capitalize"><?=@$dil['txt21'];?>:<span>&nbsp; <?php echo h43KEsAyau_tarih2($aSonuc['tarih']); ?> </span></li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <?php echo $aSonuc['aciklama']; ?>										
                                    </div>
                                    <div class="share">
                                        <ul class="list-inline">
                                            <li class="hidden-sm hidden-xs">
                                                <h4 class="vk-text-uppercase"><?=@$dil['txt58'];?></h4>
                                            </li>
                                            <div style="display:inline-block;margin-top:8px;position: absolute;" class="sharethis-inline-share-buttons"></div>
                                        </ul>
                                    </div>
                                    <div class="tag">
                                        <ul class="list-inline">
                                            <li class="hidden-sm hidden-xs">
                                                <h4 class="vk-text-uppercase"><?=@$dil['txt45'];?></h4>
                                            </li>
											<?php $parcala = explode(",",$aSonuc['keywords']);
											$last_key = end(array_keys($parcala));
											foreach($parcala as $key => $ozellik){?>
                                            <li class="vk-tag"><a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $aSonuc['seo']; ?><?php echo $html;?>"><?php echo $ozellik;?></a></li>
											<?php }?>
                                        </ul>
                                    </div>
									
									<!-- More Posts -->
									<div class="more-posts">
										<div class="clearfix">
											<?php if($onceki){?>
											<div class="pull-left">
												<a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $onceki['seo']; ?><?php echo $html;?>" class="prev-post">
													<span class="arrow fas fa-chevron-left"></span>
													<?=@$dil['txt24'];?>
													<i><?php echo $onceki['adi']; ?></i>
												</a>
											</div>
											<?php }?>
								
											<?php if($sonraki){?>
											<div class="pull-right">
												<a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $sonraki['seo']; ?><?php echo $html;?>" class="next-post">
													<span class="arrow fas fa-chevron-right"></span>
													<?=@$dil['txt25'];?>
													<i><?php echo $sonraki['adi']; ?></i>
												</a>
											</div>
											<?php }?>
										</div>
									</div>

                                </div>
                            </div>
                            <div class="vk-space x-small hidden-md hidden-lg"></div>
                            <div class="col-md-3 arkarenk1">
                                <div class="sidebar-menu"> 
									<?php if($menubas['menu_isim'] != ""){?>
									<div class="catagory">
										<h4 class="vk-text-uppercase"><?php echo $menubas['menu_isim'];?></h4>
										<ul class="vk-list vk-menu-right">
										<?php $MENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_durum = ? AND menu_ust = ? AND dil = ?  ORDER BY menu_sira ASC");
										$MENUSorgu->execute(array("1",$menubul['menu_ust'],$_SESSION['k_dil']));
										$MENUislem = $MENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
										<?php foreach ( $MENUislem as $MENUSonuc ){?>
											<li class="<?php echo($MENUSonuc['menu_url'] == $aSonuc['seo'] ? 'active' : '' );?>"><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url']); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a></li>
											<li class="vk-divider"></li>
											<?php }?>
										</ul>
									</div>
									<?php }else{?>
									<div class="catagory">
										<h4 class="vk-text-uppercase"><?=@$dil['txt64'];?></h4>
										<ul class="vk-list vk-menu-right">
										<?php $SSorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? ORDER BY id DESC limit 6");
										$SSorgu->execute(array("1",$_SESSION['k_dil']));
										$islem = $SSorgu->fetchALL(PDO::FETCH_ASSOC);?>
										<?php foreach ( $islem as $SSonuc ){?>
											<li class="<?php echo($SSonuc['seo'] == $aSonuc['seo'] ? 'active' : '' );?>"><a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>"><?php echo $SSonuc['adi']; ?></a></li>
											<li class="vk-divider"></li>
											<?php }?>
										</ul>
									</div>
									<?php }?>
									<div class="vk-space x-small"></div>
									
									<div class="faq-contact-widget">
										<div class="widget-content" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan14/<?php echo $arkaplan['arkaplan14'];?>)">
											<h4><?=@$dil['txt60'];?></h4>
											<div class="faq-widget-form">
												<p><?=@$dil['txt61'];?></p>
												<p><a class="theme-btn submit-btn" href="<?php echo $htc['iletisimurl'];?><?php echo $html;?>"><?=@$dil['txt62'];?> <span class="arrow flaticon-right-arrow-1"></span></a></p>
											</div>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="vk-space medium hidden-md hidden-lg"></div>
                    </div>
                </div>
            </div>
            <div class="vk-space x-medium"></div>
        </div>
    </div>

</section>