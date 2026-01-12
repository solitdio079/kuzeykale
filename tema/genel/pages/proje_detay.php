<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$DETAYSorgu = $db->prepare("SELECT projeler.*, proje_kategori.adi AS katadi, proje_kategori.seo AS katseo, proje_kategori.id AS katid FROM projeler LEFT JOIN proje_kategori ON proje_kategori.id = projeler.kategori WHERE projeler.seo = ? AND projeler.dil = ?");
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
	$DETAYSorgu = $db->prepare("SELECT projeler.*, proje_kategori.adi AS katadi, proje_kategori.seo AS katseo, proje_kategori.id AS katid FROM projeler LEFT JOIN proje_kategori ON proje_kategori.id = projeler.kategori WHERE projeler.dil = ? ORDER BY projeler.id ASC");
	$DETAYSorgu->execute(array($_SESSION['k_dil']));
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
$onceki	= $db->query("SELECT * FROM projeler WHERE id < '{$DETAYSonuc['id']}' AND kategori = '{$DETAYSonuc['kategori']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$sonraki = $db->query("SELECT * FROM projeler WHERE id > '{$DETAYSonuc['id']}' AND kategori = '{$DETAYSonuc['kategori']}' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['projekategoriurl']."/".$DETAYSonuc['katseo']."' OR link = '".$htc['projekategoriurl']."/".$DETAYSonuc['katseo']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);	
?>
<section class="vk-content">

    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan20/<?php echo $arkaplan['arkaplan20'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?php echo $DETAYSonuc['adi']; ?>
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
				<li><a href="<?php echo $htc['projelerurl'];?><?php echo $html;?>"><?=@$dil['txt233'];?></a></li>
				<li><a href="<?php echo $htc['projekategoriurl'];?>/<?php echo $DETAYSonuc['katseo'];?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($DETAYSonuc['katadi']);?></a></li>
                <li class="active"><?php echo $DETAYSonuc['adi']; ?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-project vk-single-project">
        <div class="container">
            <div class="vk-slider-project">

                <div class="slider-for project-img">
					<?php if($DETAYSonuc['kapak']){?>
					<a style="display:block;" href="<?php echo tema;?>/uploads/projeler/<?php echo $DETAYSonuc['kapak']; ?>" class="swipebox" title="<?php echo $DETAYSonuc['adi']; ?>">
						<img src="<?php echo tema;?>/uploads/projeler/<?php echo $DETAYSonuc['kapak']; ?>" class="projedetay-img" alt="<?php echo $DETAYSonuc['adi']; ?>">
					</a>
					<?php }?>
					<?php $ISorgu = $db->prepare("SELECT * FROM projeresim WHERE pid = ? ORDER BY id ASC");
					$ISorgu->execute(array($DETAYSonuc['id']));
					$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php foreach ( $Iislem as $ISonuc ){?>
                    <a style="display:block;" href="<?php echo tema;?>/uploads/projeler/diger/<?php echo $ISonuc['resim']; ?>" class="swipebox" title="<?php echo $DETAYSonuc['adi']; ?>">
						<img src="<?php echo tema;?>/uploads/projeler/diger/<?php echo $ISonuc['resim']; ?>" class="projedetay-img" alt="<?php echo $DETAYSonuc['adi']; ?>">
					</a>
					<?php }?>
                </div>
                <div class="slider-nav row">
					<?php if($DETAYSonuc['kapak']){?>
                    <div class="col-md-2">
                        <div class="vk-img-frame">
                            <img src="<?php echo tema;?>/uploads/projeler/<?php echo $DETAYSonuc['kapak']; ?>" class="projedetay-kucuk-img" alt="<?php echo $DETAYSonuc['adi']; ?>">
                        </div>
                    </div>
					<?php }?>
					
					<?php $ISorgu = $db->prepare("SELECT * FROM projeresim WHERE pid = ? ORDER BY id ASC");
					$ISorgu->execute(array($DETAYSonuc['id']));
					$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
					<?php foreach ( $Iislem as $ISonuc ){?>
                    <div class="col-md-2">
                        <div class="vk-img-frame">
                            <img src="<?php echo tema;?>/uploads/projeler/diger/<?php echo $ISonuc['resim']; ?>" class="projedetay-kucuk-img" alt="<?php echo $DETAYSonuc['adi']; ?>">
                        </div>
                    </div>
					<?php }?>
                </div>

            </div>
            <!--./vk-slider-project-->

            <div class="vk-content-single-project">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info">
                            <h4 class="vk-title text-uppercase"><?=@$dil['txt256'];?></h4>
                            <table>
                                <tr>
                                    <th><?=@$dil['txt12'];?></th>
                                    <td><?php echo $DETAYSonuc['adi']; ?></td>
                                </tr>
                                <tr>
                                    <th><?=@$dil['txt88'];?></th>
                                    <td><?php echo h43KEsAyau_tarih2($DETAYSonuc['tarih']); ?></td>
                                </tr>
                                <tr>
                                    <th><?=@$dil['txt11'];?></th>
                                    <td><?php echo h43KEsAyau_ilkbuyuk($DETAYSonuc['katadi']); ?></td>
                                </tr>
								 <tr>
                                    <th><?=@$dil['txt45'];?></th>
                                    <td>
									<?php $parcala = explode(",",$DETAYSonuc['keywords']);
									$last_key = end(array_keys($parcala));
									foreach($parcala as $key => $ozellik){?>
										<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $DETAYSonuc['seo']; ?><?php echo $html;?>"><?php echo $ozellik;?></a><?php echo($key == $last_key ? '' : ',');?>
									<?php }?>
									</td>
                                </tr>
                            </table>
                        </div>
                        <!-- ./info-->
						<?php if($DETAYSonuc['videoid']){?>
						<div class="info">
                            <h4 class="vk-title text-uppercase"><?=@$dil['txt266'];?></h4>
							<iframe style="width:100%;height:300px;" src="https://www.youtube.com/embed/<?php echo $DETAYSonuc['videoid']; ?>?rel=0&amp;showinfo=0" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
                        </div>
						<?php }?>
                        <!-- ./info-->
                    </div>
                    <!-- ./left-->

                    <div class="col-md-6">
                        <div class="info description">
                            <h4 class="vk-title text-uppercase"><?=@$dil['txt89'];?></h4>
                            <?php echo $DETAYSonuc['aciklama']; ?>
							<div class="sharethis-inline-share-buttons"></div>
                        </div>
                        <!-- ./des-->
                    </div>
                    <!-- ./right-->
                </div>
                <!-- ./row-->
            </div>
            
			<?php $SSorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND kategori = ? AND dil = ? ORDER BY id DESC LIMIT 6");
			$SSorgu->execute(array("1",$DETAYSonuc['katid'],$_SESSION['k_dil']));
			$islem = $SSorgu->fetchALL(PDO::FETCH_ASSOC);?>
			<?php if($SSorgu->rowCount() != "0"){?>
			<div class="related vk-shop-related">
				<div class="clearfix"></div>
				<div class="vk-space small"></div>
				<h2 class="vk-heading vk-heading-border vk-heading-border-left">
					<span><?=@$dil['txt267'];?></span>
				</h2>
				<div class="row">				
					<?php foreach ( $islem as $SSonuc ){?>	
					<div class="col-lg-4 col-md-4 col-sm-12">
						<div class="projects-item"> 
							<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>" class="projects-item-image">
								<figure> <img alt="<?php echo $SSonuc['adi']; ?>" src="<?php echo tema;?>/uploads/projeler/kapak/<?php echo $SSonuc['kapak']; ?>"> </figure> <cite></cite>
							</a>
							<div class="projects-item-title"> 
								<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $SSonuc['seo']; ?><?php echo $html;?>" class="projects-item-link"><?php echo $SSonuc['adi']; ?></a> 
							</div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>			
			<?php }?>
        </div>
    </div>

</section>