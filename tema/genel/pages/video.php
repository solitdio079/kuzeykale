<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM video_galeri WHERE seo = ? AND durum = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],"1",$_SESSION['k_dil']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$Sorgu = $db->prepare("SELECT * FROM video_galeri WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$Sorgu->execute(array("1",$_SESSION['k_dil']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['videourl']."' OR link = '".$htc['videourl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan12/<?php echo $arkaplan['arkaplan12'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?php echo $Sonuc['adi'];?>
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
				<li><a href="<?php echo $htc['videourl'];?><?php echo $html;?>"><?=@$dil['txt85'];?></a></li>
                <li class="active"><?php echo $Sonuc['adi']; ?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-about">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
               
				<div class="video-detail-showcase">
					<div class="row no-gutters">		
						
					
						<div class="video-detail-player col-lg-9 col-md-8">
							<iframe src="https://www.youtube.com/embed/<?php echo $Sonuc['kod']; ?>?rel=0&amp;autoplay=1" frameborder="0" allowfullscreen=""></iframe>
						</div>
						
						<div class="video-detail-other-videos col-lg-3 col-md-4">
							<div class="heading">
								 <?=@$dil['txt86'];?><a class="all-videos" href="<?php echo $htc['videourl'];?><?php echo $html;?>"><?=@$dil['txt87'];?></a>
							</div>
							<ul class="video-detail-list">
							<?php $DETAYSorgu = $db->prepare("SELECT * FROM video_galeri WHERE durum = ? AND dil = ? ORDER BY id DESC");
							$DETAYSorgu->execute(array("1",$_SESSION['k_dil']));
							$DETAYislem = $DETAYSorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<?php foreach ( $DETAYislem as $DETAYSonuc ){?>
								<li>
									<a href="<?php echo $htc['videodetayurl']; ?>/<?php echo $DETAYSonuc['seo']; ?><?php echo $html;?>">
										<div class="video-left col-auto">
											<img src="<?php echo tema;?>/uploads/videogaleri/kapak/<?php echo $DETAYSonuc['resim']; ?>">
											<span class="icon"><i class="fab fa-youtube"></i></span>
										</div>
										<div class="video-right col">
											<h3 class="title"><?php echo $DETAYSonuc['adi']; ?></h3>
										</div>
									</a>
								</li>
								<?php }?>
							</ul>
						</div>
						
						<?php echo $Sonuc['aciklama']; ?>
					</div>
				</div>	
			   
            </div>
            <!--./container-->
        </div>
        <!--./vk-who-we-are-->

    </div>
    <!--./vk-page-->
</section>