<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$bulundu = false;
if($_GET['kelime'] != ""){
	$kelime = trim(htmlspecialchars(strip_tags($_GET['kelime'])));
}?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan22/<?php echo $arkaplan['arkaplan22'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt263'];?>
            </div>
        </div>
    </div>

    <div class="vk-breadcrumb">
        <nav class="container">
            <ul>
                <li><a href="./"><?=@$dil['txt17'];?></a></li>
                <li class="active"><?=@$dil['txt263'];?></li>
            </ul>
        </nav>
    </div>

    <div class="vk-page vk-page-about">
        <div class="vk-who-we-are vk-section vk-section-style-1">
            <div class="container">
				<?php if (strlen($kelime) > 3){?>
				<div class="row clearfix">
					<?php $Sorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?></h3>
							<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM video_galeri WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['videodetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM sayfalar WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY id DESC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['sayfaurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM foto_galeri WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['fotodetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM proje_kategori WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['projekategoriurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['urundetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM urun_kategori WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo $htc['urunkategoriurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					
					<?php $Sorgu = $db->prepare("SELECT * FROM ekibimiz WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a <?php if($Sonuc['detay'] == 1){?>href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="read-more-btn" <?php }else{?> class="swipebox read-more-btn" href="<?php echo tema;?>/uploads/ekibimiz/<?php echo $Sonuc['resim']; ?>" title="<?php echo $Sonuc['adi']; ?>"  <?php }?>><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					
					<?php $Sorgu = $db->prepare("SELECT * FROM belgeler WHERE durum = ? AND dil = ? AND adi LIKE ? ORDER BY sira ASC");
					$Sorgu->execute(array("1",$_SESSION['k_dil'],"%".$kelime."%"));
					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php if($Sorgu->rowCount() != "0"){$bulundu = true;}?>
					<?php foreach ( $islem as $Sonuc ){?>
					<div class="col-lg-6 col-md-6 col-sm-6 p-0">
						<div class="single-services-box">
							<h3><?php echo h43KEsAyau_ilkbuyuk($Sonuc['adi']);?> </h3>
							<a href="<?php echo tema;?>/uploads/belgeler/<?php echo $Sonuc['resim']; ?>" title="<?php echo $Sonuc['adi'];?>" class="swipebox read-more-btn"><?=@$dil['txt23'];?> <i class="flaticon-next"></i></a>
						</div>
					</div>
					<?php }?>
					

				</div>
				
				<?php if($bulundu == false ){?>
				<div class="alert alert-warning" style="width:100%;" role="alert">
					<p><?=@$dil['txt51'];?></p>
					<?=@$dil['txt52'];?></br>
					<?=@$dil['txt53'];?>
				</div>
				<?php }?>
				<?php }else{?>
				<div class="alert alert-warning" style="width:100%;" role="alert">
					<p><?=@$dil['txt264'];?></p>
					<?=@$dil['txt265'];?>
				</div>
				<?php }?>
            </div>
        </div>

    </div>
</section>