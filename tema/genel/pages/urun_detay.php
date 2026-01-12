<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
	$Sorgu = $db->prepare("SELECT * FROM urunler WHERE seo = ? AND durum = ? AND dil = ?");
	$Sorgu->execute(array($_GET['id'],"1",$_SESSION['k_dil']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
		$kategori =$db->query("SELECT * FROM urun_kategori WHERE durum = '1' AND find_in_set('{$Sonuc['kategori']}',id) AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
else
{
	$Sorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND dil = ? ORDER BY id ASC");
	$Sorgu->execute(array("1",$_SESSION['k_dil']));
	if($Sorgu->rowCount())
	{
		$Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
		$kategori =$db->query("SELECT * FROM urun_kategori WHERE durum = '1' AND find_in_set('{$Sonuc['kategori']}',id) AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
		exit();
	}
}
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['urunkategoriurl']."/".$kategori['seo']."".$html."' OR link = '".$htc['urunkategoriurl']."/".$kategori['seo']."".$html."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$Bread = [];
function breadcrumb($id)
{
    global $db;
    global $Bread;
    $query = $db->query("SELECT * FROM urun_kategori WHERE id = '{$id}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
    $Bread[$query['ustid']] = [
        'seo' => $query['seo'],
        'adi' => $query['adi'],
    ];
    if($query['ustid']!=0){
        breadcrumb($query['ustid']);
    }

    return $Bread;
}

$bc = breadcrumb($Sonuc['kategori']);
ksort($bc);
$sozlesme 	= $db->query("SELECT * FROM sayfalar WHERE sayfa = '2' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch();
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan18/<?php echo $arkaplan['arkaplan18'];?>)">
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
				<li><a href="<?php echo $htc['urunlerurl'];?><?php echo $html;?>"><?=@$dil['txt90'];?></a></li>
				<?php foreach($bc as $b){?>
				<li><a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $b['seo'];?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($b['adi']);?></a></li>
				<?php }?>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->

    <!--  -->
    <div class="" data-example-id="media-alignment">
        <div class="vk-product-wrapper">
            <!------ BEGIN BLOG WRPPER ------>
            <div class="container">
                <div class="box-shop">
                    <div class="row">
                        <div class="product-view clearfix">
                            <div class="col-md-6">
                                <div class="vk-slider-shop">
                                    <div class="slider-for urun_detay">
                                        <li>
											<a href="<?php echo tema;?>/uploads/urunler/<?php echo $Sonuc['kapak']; ?>" class="swipebox" title="<?php echo $Sonuc['adi']; ?>"><img src="<?php echo tema;?>/uploads/urunler/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>"></a>
										</li>
										<?php $ISorgu = $db->prepare("SELECT * FROM urunresim WHERE pid = ? ORDER BY id ASC");
										$ISorgu->execute(array($Sonuc['id']));
										$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);?>
										<?php foreach ( $Iislem as $Ikey => $ISonuc ){?>
										<li><a href="<?php echo tema;?>/uploads/urunler/diger/<?php echo $ISonuc['resim']; ?>" class="swipebox" title="<?php echo $Sonuc['adi']; ?>"><img src="<?php echo tema;?>/uploads/urunler/diger/<?php echo $ISonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>"></a></li>
										<?php }?>
									</div>
                                    <div class="slider-nav row">
										<?php $ISorgu = $db->prepare("SELECT * FROM urunresim WHERE pid = ? ORDER BY id ASC");
										$ISorgu->execute(array($Sonuc['id']));
										$Iislem = $ISorgu->fetchALL(PDO::FETCH_ASSOC);
										if($ISorgu->rowCount()){?>
										<div class="col-md">
                                            <div class="vk-img-frame urunkucuk">
                                                <img src="<?php echo tema;?>/uploads/urunler/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>">
                                            </div>
                                        </div>
										<?php foreach ( $Iislem as $Ikey => $ISonuc ){?>
                                        <div class="col-md">
                                            <div class="vk-img-frame urunkucuk">
                                                <img src="<?php echo tema;?>/uploads/urunler/diger/<?php echo $ISonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>">
                                            </div>
                                        </div>
										<?php }?>
										<?php }?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="detail-product">
                                    <div class="price">
                                        <h2 class="vk-text-capitalize"><?php echo $Sonuc['adi']; ?></h2>
										
                                        <?php if($moduller['alan25'] == "1"){?>								
										<div class="item-price">
										<?php if($Sonuc['ifiyat'] != ""){?>
										<?php $sformfiyat = $Sonuc['ifiyat'];?>
										<?php echo para_format($Sonuc['ifiyat']); ?> <?php echo $ayar['pbirim']; ?>
										<span><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?></span>
										<?php }else{?>
										<?php $sformfiyat = $Sonuc['fiyat'];?>
										<?php echo para_format($Sonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?>
										<?php }?>
										</div>
										<?php }?>										
                                    </div>
									<div class="info">
									<p><span><?=@$dil['txt91'];?></span> <?php echo($Sonuc['stok'] == 0 ? @$dil['txt107'] : @$dil['txt108']); ?></p>
									<p><span><?=@$dil['txt92'];?></span> 
									<?php foreach($bc as $key => $b){?>
										<a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $b['seo'];?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($b['adi']);?></a><?php echo($key === end(array_keys($bc)) ? '' : ',');?>
									<?php }?>
									</p>
									</div>
									<div class="vk-space x-small"></div>
                                    <div class="intro">
                                        <p><?php echo $Sonuc['spot']; ?></p>
                                    </div>
                                    <div class="vk-divider"></div>
                                    <div class="info">
                                        <div class="vk-space x-small"></div>
                                        <p><span><?=@$dil['txt93'];?></span> <?php echo $Sonuc['urun_kodu']; ?></p>
										
										<p><span><?=@$dil['txt94'];?></span>
										<?php $parcala = explode(",",$Sonuc['keywords']);
										foreach($parcala as $key => $ozellik){?>
											<a href="<?php echo $htc['urundetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $ozellik;?></a> <?php echo($key === end(array_keys($parcala)) ? '' : ',');?>
										<?php }?>
										</p>									
                                        <div class="vk-space x-small"></div>
                                        <div class="share">
                                            <div class="sharethis-inline-share-buttons"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="vk-space medium"></div>
                        <div class="col-md-12">
                            <div class="description">
                                <div class="vk-tab vk-tab-flat tab-flat-bg">
                                    <ul class="vk-list vk-list-inline vk-nav-tabs clearfix">
										<?php if($Sonuc['dokuman']){$dosya = true;}?>
										<?php if($Sonuc['katalog']){$dosya = true;}?>
										<?php if($dosya == true || $moduller['alan29'] == "1"){?>
                                        <li role="presentation" class="active">
                                            <a class="vk-cc-font-bold vk-text-uppercase" href="#tab" data-toggle="tab"><?=@$dil['txt95'];?></a>
                                        </li>
										<?php }?>
										<?php if($dosya == true){?>
                                        <li role="presentation">
                                            <a class="vk-cc-font-bold vk-text-uppercase" href="#tab2" data-toggle="tab"><?=@$dil['txt96'];?></a>
                                        </li>
										<?php }?>
										<?php if($moduller['alan29'] == "1"){?>
										<li role="presentation">
                                            <a class="vk-cc-font-bold vk-text-uppercase" href="#tab3" data-toggle="tab"><?=@$dil['txt97'];?></a>
                                        </li>
										<?php }?>
                                    </ul>

                                    <div class="tab-content vk-tab-content">
                                        <div class="tab-pane active" id="tab">
                                            <?php echo $Sonuc['aciklama']; ?>
                                        </div>
										<?php if($dosya == true){?>
                                        <div class="tab-pane" id="tab2">
                                            <?php if($Sonuc['dokuman']){?>
											<div class="broucher-box">
												<a target="_blank" href="<?php echo tema;?>/uploads/urunler/dokuman/<?php echo $Sonuc['dokuman']; ?>" class="overlay-link"></a>
												<div class="broucher-inner">
													<span class="download-icon fas fa-download"></span>
													<?=@$dil['txt98'];?>
												</div>
											</div>
											<?php }?>											
											<?php if($Sonuc['katalog']){?>
											<div class="broucher-box">
												<a target="_blank" href="<?php echo tema;?>/uploads/urunler/katalog/<?php echo $Sonuc['katalog']; ?>" class="overlay-link"></a>
												<div class="broucher-inner">
													<span class="download-icon fas fa-download"></span>
													<?=@$dil['txt99'];?>
												</div>
											</div>
											<?php }?>
                                        </div>
										<?php }?>
										<?php if($moduller['alan29'] == "1"){?>
										<div class="tab-pane" id="tab3">
                                            <div class="vk-contact-form">
												<form method="post" action="_class/site_islem.php" autocomplete="off">
													<h4 class="vk-title text-uppercase pb-2"><?=@$dil['txt97'];?></h4>
													<div class="vk-divider mb-3"></div>
													<div class="user-info">
														<div class="form-group">
															<i class="fa fa-user"></i>
															<input type="text" name="adsoyad" placeholder="<?=@$dil['txt5'];?>" class="form-control">
														</div>
														<div class="form-group">
															<i class="fa fa-phone"></i>
															<input type="tel" name="telefon" placeholder="<?=@$dil['txt7'];?>" class="form-control">
														</div>
														<div class="form-group">
															<i class="fa fa-envelope"></i>
															<input type="email" name="email" placeholder="<?=@$dil['txt6'];?>" class="form-control">
														</div>
														<div class="form-group">
															<i class="fas fa-address-book"></i>
															<input type="text" name="il" placeholder="<?=@$dil['txt100'];?>" class="form-control">
														</div>
														<div class="form-group">
															<i class="fas fa-address-book"></i>
															<input type="text" name="ilce" placeholder="<?=@$dil['txt101'];?>" class="form-control">
														</div>
														<div class="form-group">
															<i class="fas fa-map-marker-alt"></i>
															<input type="text" name="adres" placeholder="<?=@$dil['txt102'];?>" class="form-control">
														</div>
													</div>
													<!-- /.user-info -->

													<div class="message-content">
														<div class="form-group">
															<textarea name="notu" placeholder="<?=@$dil['txt103'];?>" class="form-control siparisformtext"></textarea>
														</div>
													</div>
													<!-- /.message-content -->
	
													<div class="check-box mb-3"><input type="checkbox" name="sozlesme" required id="account-option"> &ensp; <label for="account-option"><a href="javascript:void(0);" data-remodal-target="sozlesme" data-remodal-backdrop="static" data-remodal-keyboard="false"><?php echo $sozlesme['adi'];?></a> <?=@$dil['txt104'];?></label></div>
		
													<div class="vk-buttons">
														<input type="hidden" name="siparisno" value="<?php echo time();?>">
														<input type="hidden" name="url" value="<?php echo $sayfalink;?>">
														<input type="hidden" name="fiyat" value="<?php echo $sformfiyat;?>">
														<input type="hidden" name="pbirim" value="<?php echo $ayar['pbirim'];?>">
														<input type="hidden" name="urun" value="<?php echo $Sonuc['id'];?>">
														<input type="hidden" name="adi" value="<?php echo $Sonuc['adi'];?>">
														<input type="hidden" name="kontrol" value="" id="kontrol">
														<button type="submit" name="SiparisBtn" class="vk-btn vk-btn-default vk-btn-l vk-fullwidth">
															<i class="fa fa-paper-plane"></i><?=@$dil['txt105'];?>
														</button>
													</div>
												</form>
											</div>
                                        </div>
										<?php }?>
                                    </div>

                                </div>
                            </div>
                        </div>
						
						<?php if($moduller['alan13'] == "1"){?>
                        <div class="related vk-shop-related">
                            <div class="clearfix"></div>
                            <div class="vk-space small"></div>
                            <h2 class="vk-heading vk-heading-border vk-heading-border-left">
                                <span>
                                    <?=@$dil['txt106'];?>
                                </span>
                            </h2>
                            <div class="vk-shop-item vk-shop-item-light-s1 clearfix">
							<div class="container">
                            <div class="row">
							<?php $BENZERSorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND kategori = ? AND dil = ? ORDER BY sira ASC LIMIT 8");
							$BENZERSorgu->execute(array("1",$kategori['id'],$_SESSION['k_dil']));
							$BENZERislem = $BENZERSorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<?php foreach ( $BENZERislem as $BENZERSonuc ){?>	
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="item">
										<div class="vk-img-frame">
											<?php if($BENZERSonuc['yeni'] == 1){?><span class="label"><?=@$dil['txt239'];?></span><?php }?>
											<?php if($BENZERSonuc['ifiyat'] != ""){?><span class="label discount"><?=@$dil['txt240'];?></span><?php }?>
											<a href="<?php echo $htc['urundetayurl'];?>/<?php echo $BENZERSonuc['seo']; ?><?php echo $html;?>" class="vk-img urunler">
												<img src="<?php echo tema;?>/uploads/urunler/<?php echo $BENZERSonuc['kapak']; ?>" alt="<?php echo $BENZERSonuc['adi']; ?>" />
											</a>
										</div>     
										<a class="vk-text-capitalize uruntitle" href="<?php echo $htc['urundetayurl'];?>/<?php echo $BENZERSonuc['seo']; ?><?php echo $html;?>"><?php echo $BENZERSonuc['adi']; ?></a>
										<div class="vk-divider"></div>

										<div class="vk-price-rate clearfix">
											<?php if($moduller['alan25'] == "1"){?>
											<div class="price vk-cc-font-bold">
											<?php if($BENZERSonuc['ifiyat'] != ""){?>
											<span class="discount"><?php echo para_format($BENZERSonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?> </span> <?php echo para_format($BENZERSonuc['ifiyat']); ?> <?php echo $ayar['pbirim']; ?>
											<?php }else{?>
											<?php echo para_format($BENZERSonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?>
											<?php }?>
											</div>
											<?php }?>
										</div>
										<div class="vk-buttons clearfix">
											<a href="<?php echo $htc['urundetayurl'];?>/<?php echo $BENZERSonuc['seo']; ?><?php echo $html;?>" class="vk-btn  text-uppercase vk-btn-addtocart w-100"><?=@$dil['txt241'];?></a>
										</div>
									</div>
                                </div>
								<?php }?>
                            </div>
                            </div>
                            </div>
                        </div>
						<?php }?>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / -->

</section>
<!--./content-->
<?php if($moduller['alan29'] == "1"){?>
<div class="remodal p-0 popupform" data-remodal-id="sozlesme" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
	<a href="javascript:void(0);" data-remodal-action="close" class="remodal-close bg-white" style="left: 0;"></a>
	<div class="form-column">
		<div class="inner-column-1 mt-0 rounded-0 text-left" style="overflow-y: scroll;height: 74vh;">
			<h2 class="text-left"><?php echo $sozlesme['adi'];?></h2>
			<!--Default Form-->
			<div class="default-form text-white">
				<div class="clearfix">
					<?php echo $sozlesme['aciklama'];?>
				</div>
			</div>

		</div>
	</div>
</div>
<?php }?>