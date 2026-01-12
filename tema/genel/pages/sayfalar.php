<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM sayfalar WHERE seo = ? AND durum = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],1,$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc 		= $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$Sorgu = $db->prepare("SELECT * FROM sayfalar WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$Sorgu->execute(array(1,$_SESSION['k_dil']));
	if($Sorgu->rowCount()){
		$Sonuc 		= $Sorgu->fetch(PDO::FETCH_ASSOC);
	}else{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}	
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['sayfaurl']."/".$Sonuc['seo']."' OR link = '".$htc['sayfaurl']."/".$Sonuc['seo']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan3/<?php echo $arkaplan['arkaplan3'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?php echo $Sonuc['adi']; ?>
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
                <li class="active"><?php echo $Sonuc['adi']; ?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-about">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
                <div class="row">
					<?php if($Sonuc['resim'] != ""){?>
                    <div class="col-md-6 left-content">
                        <div class="vk-img-frame">
                            <img src="<?php echo tema;?>/uploads/sayfalar/<?php echo $Sonuc['resim'];?>" alt="<?php echo $Sonuc['adi'];?>" />
                        </div>
                    </div>
                    <!--./left-->

                    <div class="col-md-6 right-content">
                        <div class="content">
                            <h4 class="text-uppercase vk-title"><?php echo $Sonuc['adi'];?></h4>
                            <?php echo $Sonuc['aciklama'];?>
							<div class="sharethis-inline-share-buttons"></div>
                        </div>
                    </div>
                    <!--./right-->
					
					<?php }else{?>
					  <div class="col-md-12 right-content">
                        <div class="content">
                            <h4 class="text-uppercase vk-title"><?php echo $Sonuc['adi'];?></h4>
                            <?php echo $Sonuc['aciklama'];?>
							<div class="sharethis-inline-share-buttons"></div>
                        </div>
                    </div>
                    <!--./right-->
					<?php }?>
					
                </div>
                <!--./row-->
            </div>
            <!--./container-->
        </div>
        <!--./vk-who-we-are-->

    </div>
    <!--./vk-page-->
</section>