<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM foto_galeri WHERE seo = ? AND durum = ? AND dil = ?");
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
	$Sorgu = $db->prepare("SELECT * FROM foto_galeri WHERE durum = ? AND dil = ? ORDER BY id ASC");
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
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['fotourl']."' OR link = '".$htc['fotourl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan11/<?php echo $arkaplan['arkaplan11'];?>)">
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
				<li><a href="<?php echo $htc['fotourl'];?><?php echo $html;?>"><?=@$dil['txt57'];?></a></li>
                <li class="active"><?php echo $Sonuc['adi'];?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-about" id="foto">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">                
				<div class="row clearfix">
					<div class="col-lg-12 mb-4">
						<?php echo $Sonuc['aciklama'];?>
					</div>
					<?php $ISorgu = $db->prepare("SELECT * FROM fotograflar WHERE resimid = ? ORDER BY id ASC");
					$ISorgu->execute(array($Sonuc['id']));
					$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php foreach ( $Iislem as $ISonuc ){?>
					<!-- Blog -->
					<div class="col-lg-3 col-md-3 blog-col">
						<div class="card">
							<div class="blog-img">
								<a href="<?php echo tema;?>/uploads/fotogaleri/diger/<?php echo $ISonuc['resim']; ?>" class="swipebox" title="<?php echo $Sonuc['adi'];?>">
									<img class="w-100" src="<?php echo tema;?>/uploads/fotogaleri/diger/<?php echo $ISonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>" />
								</a>
							</div>
						</div>
					</div>
					<?php }?>
				</div>				
            </div>
            <!--./container-->
        </div>
        <!--./vk-who-we-are-->

    </div>
    <!--./vk-page-->
</section>