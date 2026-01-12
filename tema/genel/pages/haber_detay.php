<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$DETAYSorgu = $db->prepare("SELECT * FROM haberler WHERE seo = ? AND dil = ?");
	$DETAYSorgu->execute(array($_GET['id'],$_SESSION['k_dil']));
	if($DETAYSorgu->rowCount())
	{
		$DETAYSonuc = $DETAYSorgu->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$DETAYSorgu = $db->prepare("SELECT * FROM haberler WHERE dil = ? ORDER BY id ASC");
	$DETAYSorgu->execute(array($_SESSION['k_dil']));
	if($DETAYSorgu->rowCount())
	{
		$DETAYSonuc = $DETAYSorgu->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url."/404.html");
		exit();
	}
}
$onceki	= $db->query("SELECT * FROM haberler WHERE id < '{$DETAYSonuc['id']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$sonraki = $db->query("SELECT * FROM haberler WHERE id > '{$DETAYSonuc['id']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['haberurl']."' OR link = '".$htc['haberurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);		
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-8" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan13/<?php echo $arkaplan['arkaplan13'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?php echo $DETAYSonuc['adi'];?>
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
				<li><a href="<?php echo $htc['haberurl'];?><?php echo $html;?>"><?=@$dil['txt59'];?></a></li>
				<li class="active"><?php echo $DETAYSonuc['adi'];?></li>
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
                                    <div class="vk-img-frame">
                                        <img src="<?php echo tema;?>/uploads/haberler/<?php echo $DETAYSonuc['resim'];?>" alt="<?php echo $DETAYSonuc['adi']; ?>">
                                    </div>
                                    <h4><?php echo $DETAYSonuc['adi']; ?></h4>
                                    <div class="info">
                                        <ul class="vk-list">
                                            <li class="vk-text-capitalize"><?=@$dil['txt21'];?>:<span>&nbsp; <?php echo h43KEsAyau_tarih2($DETAYSonuc['tarih']); ?> </span></li>
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <?php echo $DETAYSonuc['aciklama']; ?>
										
										<?php if($DETAYSonuc['videoid']){?>                           
										<iframe style="width:100%;height:500px;margin-bottom:20px;" src="https://www.youtube.com/embed/<?php echo $DETAYSonuc['videoid']; ?>?rel=0&amp;showinfo=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
										<?php }?>
										
										<?php $ISorgu = $db->prepare("SELECT * FROM haberfoto WHERE resimid = ? ORDER BY id ASC");
										$ISorgu->execute(array($DETAYSonuc['id']));
										$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
										<?php if($ISorgu->rowCount() != "0"){?>
										<div class="row clearfix mb-3">
											<?php foreach ( $Iislem as $ISonuc ){?>
											<div class="col-lg-4 col-md-4 blog-col mb-3">
												<div class="card p-2">
													<div class="blog-img haber-diger">
														<a href="<?php echo tema;?>/uploads/haberler/fotogaleri/<?php echo $ISonuc['resim']; ?>" class="swipebox" title="<?php echo $DETAYSonuc['adi']; ?>">
															<img class="w-100" src="<?php echo tema;?>/uploads/haberler/fotogaleri/<?php echo $ISonuc['resim']; ?>" alt="<?php echo $DETAYSonuc['adi']; ?>" />
														</a>
													</div>
												</div>
											</div>
											<?php }?>
										</div>
										<?php }?>
										
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
											<?php $parcala = explode(",",$DETAYSonuc['keywords']);
											$last_key = end(array_keys($parcala));
											foreach($parcala as $key => $ozellik){?>
                                            <li class="vk-tag"><a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $DETAYSonuc['seo']; ?><?php echo $html;?>"><?php echo $ozellik;?></a></li>
											<?php }?>
                                        </ul>
                                    </div>
									
									<!-- More Posts -->
									<div class="more-posts">
										<div class="clearfix">
											<?php if($onceki){?>
											<div class="pull-left">
												<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $onceki['seo']; ?><?php echo $html;?>" class="prev-post">
													<span class="arrow fas fa-chevron-left"></span>
													<?=@$dil['txt24'];?>
													<i><?php echo $onceki['adi']; ?></i>
												</a>
											</div>
											<?php }?>
								
											<?php if($sonraki){?>
											<div class="pull-right">
												<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $sonraki['seo']; ?><?php echo $html;?>" class="next-post">
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
                                    <div class="recentpots">
                                        <h4 class="vk-text-uppercase"><?=@$dil['txt59'];?></h4>										
                                        <div class="row">
										<?php $SSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? ORDER BY id DESC limit 6");
										$SSorgu->execute(array("1",$_SESSION['k_dil']));
										$islem = $SSorgu->fetchALL(PDO::FETCH_ASSOC);?>
											<?php foreach ( $islem as $SSonuc ){?>	
                                            <div class="recent-box col-sm-6 col-md-12">
                                                <div class="vk-img-frame">
                                                    <a class="vk-img" href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>">
                                                        <img src="<?php echo tema;?>/uploads/haberler/<?php echo $SSonuc['resim']; ?>" alt="<?php echo $SSonuc['adi']; ?>">
                                                    </a>
                                                </div>
                                                <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>" class="vk-title"><?php echo $SSonuc['adi']; ?></a>
                                                <span><?php echo h43KEsAyau_tarih2($SSonuc['tarih']); ?></span>
                                            </div>
											<?php }?>											
                                        </div>
                                    </div>
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