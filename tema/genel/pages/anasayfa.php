<?php if($popup['durum'] == 1){?>

<!-- Modal -->

<div class="modal fade" id="actionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body p-1">

				<div class="row">

					<div class="col-md-12 text-center">

						<a href="<?php echo $popup['url']?>" <?php echo($popup['sekme'] == 1 ? 'target="_blank"' : '');?> title="<?php echo $popup['adi']?>">

							<img src="<?php echo tema;?>/uploads/popup/<?php echo $popup['resim']?>" class="img-responsive" alt="<?php echo $popup['adi']?>" title="<?php echo $popup['adi']?>" style="margin: 0 auto;">

						</a>

					</div>

				</div>

			</div>

			<div class="modal-footer">

				<div class="checkbox pull-right">

					<label>

						<input class="modal-check" name="modal-check" type="checkbox"> <?=@$dil['txt22'];?>

					</label>

				</div>

			</div>

        </div>

    </div>

</div>

<?php }?>



<section class="vk-content">

	<div class="vk-home vk-home-default">

		<?php if($moduller['alan18'] == "1"){?>

		<div class="vk-baner-slider vk-slider-arrow-image">
		


		<?php $Sorgu = $db->prepare("SELECT * FROM slider WHERE durum = ? AND dil = ? ORDER BY sira ASC");

		$Sorgu->execute(array("1",$_SESSION['k_dil']));

		$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

			<?php foreach ( $islem as $Sliderkey => $Sonuc ){?> 

			<div class="vk-banner vk-banner-large vk-banner-mod slider" style="background-image: url(<?php echo tema;?>/uploads/slider/<?php echo $Sonuc['resim']?>);">

				<?php if($moduller['alan22'] == "1"){?><div class="vk-background-overlay vk-background-black _30"></div><?php }?>

				<?php if($moduller['alan1'] == "1"){?>

				<div class="container wrapper">

					<div class="page-heading">

						<?php if($Sonuc['adi']){?>

						<span class="vk-text title-main">

							<span class="vk-text-color-yellow-1" data-animation="fadeInLeft" data-delay="0.5s"><?php echo $Sonuc['adi'];?></span>

						</span>

						<?php }?>

						<?php if($Sonuc['aciklama']){?>

						<span class="vk-text title-sub" data-animation="fadeInUp" data-delay="1.3s"><?php echo $Sonuc['aciklama'];?></span>

						<?php }?>

						

						

					</div>

				</div>

				<?php }?>

			</div>
			<div class="hero">
  <iframe
    src="https://www.youtube.com/embed/oB2wMlE6GAY?autoplay=1&mute=1&loop=1&playlist=oB2wMlE6GAY&controls=0&showinfo=0&rel=0"
    frameborder="0"
    allow="autoplay; fullscreen"
    allowfullscreen>
  </iframe>

  <div class="hero-overlay"></div>

  <div class="hero-content">
    <div>
      <h1>Kuzeykale İnşaat</h1>
      <p>Güvenle Yükselen Yapılar</p>
    </div>
  </div>
</div>

			<!--./vk-banner-->

			<?php }?>

		</div>

		<?php }?>

		

		<?php if($moduller['alan18'] == "2"){?>		

		<div class="vk-service-section vk-section-style-5">

		<?php $Sorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira ASC LIMIT 4");

		$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

		$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

			<?php foreach ( $islem as $Hizmetkey => $Sonuc ){?> 

			<div class="col-md-3 col-sm-6 vk-clear-padding">

				<div class="vk-img-frame hizmetslider">

					<a href="<?php echo $htc['hizmetdetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-img">

						<img src="<?php echo tema;?>/uploads/hizmetler/<?php echo $Sonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>">

						<div class="vk-background-black-1 vk-background-overlay _50"></div>

					</a>

				</div>

				<h2 class="vk-heading text-uppercase" aria-label="0<?php echo $Hizmetkey+1; ?>">

					<span><a href="<?php echo $htc['hizmetdetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $Sonuc['adi']; ?></a></span>

				</h2>

			</div>

			<?php }?>

		</div>

		<?php }?>

		

		<?php if($moduller['alan18'] == "3"){?>

		<div class="vk-service-section vk-section-style-5">

		<?php $Sorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira ASC LIMIT 4");

		$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

		$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

			<?php foreach ( $islem as $Hizmetkey => $Sonuc ){?> 

			<div class="col-md-3 col-sm-6 vk-clear-padding">

				<div class="vk-img-frame hizmetslider">

					<a href="<?php echo $htc['projedetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-img">

						<img src="<?php echo tema;?>/uploads/projeler/kapak/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>">

						<div class="vk-background-black-1 vk-background-overlay _50"></div>

					</a>

				</div>

				<h2 class="vk-heading text-uppercase" aria-label="0<?php echo $Hizmetkey+1; ?>">

					<span><a href="<?php echo $htc['projedetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $Sonuc['adi']; ?></a></span>

				</h2>

			</div>

			<?php }?>

		</div>

		<?php }?>

		<div class="clearfix"></div>

		<?php $SiralamaSorgu = $db->prepare("SELECT * FROM siralama ORDER BY sira ASC");

		$SiralamaSorgu->execute();

		$Siralamaislem = $SiralamaSorgu->fetchALL(PDO::FETCH_ASSOC);?>

		<?php foreach ( $Siralamaislem as $Siralamakey => $SiralamaSonuc ){ // Forech Döngü Başlangıç//?>	

		

		<?php  if ($SiralamaSonuc['id']=='2') { // Kurumsal Bilgi?>

		<?php if($moduller['alan3'] == "1"){?>

		<?php $kurumsal = $db->query("SELECT * FROM sayfalar WHERE anasayfa = '1' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch();?>

		<div class="vk-what-we-do-section vk-section vk-section-style-2 vk-section-style-3 who-we-are">

			<div class="container">

				<div class="row">

					<div class="col-md-6 left">

						<img src="<?php echo tema;?>/uploads/sayfalar/<?php echo $kurumsal['resim'];?>" alt="<?php echo $kurumsal['adi'];?>">

					</div>

					<div class="col-md-6 right">

						<h2 class="vk-heading">

							<span class="vk-text-color-yellow-1"><?=@$dil['txt234'];?></span>

						</h2>

						<div class="content">

							<h4 class="text-uppercase vk-title"><?php echo $kurumsal['adi'];?></h4>

							<p><?php echo h43KEsAyau_kisa(strip_tags($kurumsal['aciklama']),500);?><a href="https://www.kuzeykaleinsaat.com/icerik/hakkimizda"> <font color="blue">Devamı için tıklayınız.</font></a>

</p>

						</div>

					</div>

				</div>

			</div>

		</div>



<div class="container">

				<div class="row">

					<div class="col-md-6 left">

						<iframe width="100%" height="315" src="https://www.youtube.com/embed/NLHZkAVyXxI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

					</div>

					<div class="col-md-6 right">

						<iframe width="100%" height="315" src="https://www.youtube.com/embed/Idllukl24Xs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

					</div>

				</div>

			</div>

		

		<?php }?>

		<?php }?>

		<?php  if ($SiralamaSonuc['id']=='7') { // Son Projelerimiz?>

		<?php if($moduller['alan4'] == "1"){?>

		<div class="vk-section vk-our-project-section">

			<div class="container">

				<h2 class="vk-heading vk-heading-border vk-heading-border-left">

					<span><?=@$dil['txt243'];?></span>

				</h2>



				<div class="row">

					<div class="vk-our-project-list">

						<div class="item">

							<div class="vk-project-grid slick-slider-homepage vk-slider-arrow-top clearfix">

							<?php $Sorgu = $db->prepare("SELECT projeler.*, proje_kategori.adi AS kategori_adi FROM projeler LEFT JOIN proje_kategori ON FIND_IN_SET(proje_kategori.id,projeler.kategori) WHERE projeler.durum = ? AND projeler.anasayfa = ? AND projeler.dil = ? ORDER BY projeler.sira ASC");

							$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

							$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

								<?php foreach ( $islem as $Sonuc ){?>	

								<div class="col-md-4 col-sm-6 col-xs-12 item">

									<div class="projects-item"> 

										<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="projects-item-image">

											<figure> <img alt="<?php echo $Sonuc['adi']; ?>" src="<?php echo tema;?>/uploads/projeler/kapak/<?php echo $Sonuc['kapak']; ?>"> </figure> <cite></cite>

										</a>

										<div class="projects-item-title"> 

											<a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="projects-item-link"><?php echo $Sonuc['adi']; ?></a> 

										</div>

									</div>

								</div>

								<?php }?>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='5') { // Öne Çıkan Ürünlerimiz?>

		<?php if($moduller['alan15'] == "1"){?>

		<div class="related vk-shop-related vk-section vk-section-style-3">		

			<div class="vk-shop-item vk-shop-item-light-s1 clearfix">

				<div class="container">

					<h2 class="vk-heading vk-heading-border vk-heading-border-left">

						<span><?=@$dil['txt238'];?></span>

					</h2>

					<div class="row">

					<?php $Sorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira ASC");

					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Sonuc ){?>

						<div class="col-md-3 col-sm-6 col-xs-12">

							<div class="item">

								<div class="vk-img-frame">

									<?php if($Sonuc['yeni'] == 1){?><span class="label"><?=@$dil['txt239'];?></span><?php }?>

									<?php if($Sonuc['ifiyat'] != ""){?><span class="label discount"><?=@$dil['txt240'];?></span><?php }?>

									<a href="<?php echo $htc['urundetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-img urunler">

										<img src="<?php echo tema;?>/uploads/urunler/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>" />

									</a>

								</div>     

								<a class="vk-text-capitalize uruntitle" href="<?php echo $htc['urundetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $Sonuc['adi']; ?></a>

								<div class="vk-divider"></div>



								<div class="vk-price-rate clearfix">

									<?php if($moduller['alan25'] == "1"){?>

									<div class="price vk-cc-font-bold">

									<?php if($Sonuc['ifiyat'] != ""){?>

									<span class="discount"><?php echo para_format($Sonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?> </span> <?php echo para_format($Sonuc['ifiyat']); ?> <?php echo $ayar['pbirim']; ?>

									<?php }else{?>

									<?php echo para_format($Sonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?>

									<?php }?>

									</div>

									<?php }?>

								</div>

								<div class="vk-buttons clearfix">

									<a href="<?php echo $htc['urundetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-btn  text-uppercase vk-btn-addtocart w-100"><?=@$dil['txt241'];?></a>

								</div>

							</div>

						</div>

						<?php }?>

					</div>

				</div>

			</div>

		</div>		

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='6') { // Ürün Grupları?>

		<?php if($moduller['alan17'] == "1"){?>

		<div class="related vk-shop-related vk-section vk-section-style-3 arkaplan3">			

			<div class="vk-shop-item vk-shop-item-light-s1 clearfix">

				<div class="container">

					<h2 class="vk-heading vk-heading-border vk-heading-border-left">

						<span>

							<?=@$dil['txt242'];?>

						</span>

					</h2>

					<div class="row">

					<?php $Sorgu = $db->prepare("SELECT * FROM urun_kategori WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira asc");

					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Sonuc ){?>

						<div class="team-block col-lg-4 col-md-4 col-sm-12">

							<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">

								<div class="image">

									<a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>">

									<img src="<?php echo tema;?>/uploads/kategoriler/<?php echo $Sonuc['kapak']; ?>" alt="<?php echo $Sonuc['adi']; ?>" />

									<div class="overlay-box">

										<div class="overlay-inner"></div>

									</div>

									</a>

								</div>

								<div class="lower-content">

									<h4><a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $Sonuc['adi']; ?></a></h4>

								</div>

							</div>

						</div>

						<?php }?>

					</div>

				</div>

			</div>

		</div>		

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='9') { // İstatistikler?>

		<?php if($moduller['alan7'] == "1"){?>

		<div class="vk-counter-section vk-background-image-1 vk-counter-section-style-1">

			<div class="vk-background-overlay vk-background-black-1 _80"></div>

			<div class="container">

				<div class="row">



					<div class="col-md-3 col-sm-6">



						<div class="vk-counter vk-counter-dark vk-counter-inline first-child">

							<i class="flaticon flaticon-ruler-and-pencil"></i>

							<ul class="content">

								<li class="number-count" data-to="<?=@$dil['txt26'];?>"><?=@$dil['txt26'];?></li>

								<li class="title"><?=@$dil['txt27'];?></li>

							</ul>

						</div>



					</div>



					<div class="col-md-3 col-sm-6">



						<div class="vk-counter vk-counter-dark vk-counter-inline">

							<i class="flaticon flaticon-worker-1"></i>

							<ul class="content">

								<li class="number-count" data-to="<?=@$dil['txt28'];?>"><?=@$dil['txt28'];?></li>

								<li class="title"><?=@$dil['txt29'];?></li>

							</ul>

						</div>



					</div>



					<div class="col-md-3 col-sm-6">



						<div class="vk-counter vk-counter-dark vk-counter-inline">

							<i class="flaticon flaticon-wrench"></i>

							<ul class="content">

								<li class="number-count" data-to="<?=@$dil['txt30'];?>"><?=@$dil['txt30'];?></li>

								<li class="title"><?=@$dil['txt31'];?></li>

							</ul>

						</div>



					</div>



					<div class="col-md-3 col-sm-6">



						<div class="vk-counter vk-counter-dark vk-counter-inline">

							<i class="flaticon flaticon-bricks"></i>

							<ul class="content">

								<li class="number-count" data-to="<?=@$dil['txt34'];?>"><?=@$dil['txt34'];?></li>

								<li class="title"><?=@$dil['txt35'];?></li>

							</ul>

						</div>



					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='4') { // Hizmetler?>

		<?php if($moduller['alan6'] == "1"){?>

		<div class="vk-what-we-do-section vk-section vk-section-style-2 vk-section-style-3">

			<div class="container">

				<h2 class="vk-heading vk-heading-border vk-heading-border-left">

					<span><?=@$dil['txt64'];?></span>

				</h2>

				<nav class="box-filter text-center clearfix">



					<ul class="vk-filter vk-filter-button-fix hidden-xs hidden-sm">

					<?php $Sorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira ASC");

					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Hizmetkey => $Sonuc ){?> 

						<li class="data-filter" data-filter=".<?php echo($Hizmetkey == 0 ? 'first' : $Sonuc['seo']); ?>"><?php echo $Sonuc['adi']; ?></li>

						<?php }?>

					</ul>



					<select class="vk-filter vk-filter-button-fix form-control hidden-md hidden-lg" id="dropdown-filter">

					<?php $Sorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira ASC");

					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Hizmetkey => $Sonuc ){?> 

						<option class="data-filter" value=".<?php echo($Hizmetkey == 0 ? 'first' : $Sonuc['seo']); ?>"><?php echo $Sonuc['adi']; ?></option>

						<?php }?>

					</select>

				</nav>



				<div class="row vk-filter-fix">

				<?php $Sorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY sira ASC");

				$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

				$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

					<?php foreach ( $islem as $Hizmetkey => $Sonuc ){?> 

					<div class="item <?php echo($Hizmetkey == 0 ? 'first' : $Sonuc['seo']); ?>">

						<div class="col-md-6 left">



							<div class="vk-img-frame vk-img">

								<img src="<?php echo tema;?>/uploads/hizmetler/<?php echo $Sonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>" />

							</div>

						</div>



						<div class="col-md-6 right">

							<div class="content">

								<h4 class="text-uppercase vk-title"><?php echo $Sonuc['adi']; ?></h4>

								<p><?php echo h43KEsAyau_kisa(strip_tags($Sonuc['aciklama']),650); ?></p>

							</div>

							<div class="vk-buttons">

								<a href="<?php echo $htc['hizmetdetayurl'];?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-btn vk-btn-transparent text-uppercase"><?=@$dil['txt37'];?>

									<i class="fa fa-arrow-right"></i>

								</a>

							</div>

						</div>

					</div>

					<?php }?>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='14') { // Hemen Arayın?>

		<?php if($moduller['alan10'] == "1"){?>

		<div class="vk-join-our-team-section vk-background-fixed vk-background-image-7 vk-section-style-4 vk-space x-large" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan1/<?php echo $arkaplan['arkaplan1'];?>)">

			<div class="vk-background-overlay vk-background-black-1 _70"></div>



			<div class="container">

				<div class="content-section">

					<h2 class="vk-heading vk-heading-border vk-heading-border-right">

						<span>

							<span class="vk-text-color-yellow-1"><?=@$dil['txt33'];?></span> <?=@$dil['txt244'];?>

						</span>

					</h2>

					<p><?=@$dil['txt245'];?></p>



					<div class="vk-buttons">

						<a href="<?php echo $htc['iletisimurl'];?><?php echo $html;?>" class="vk-btn vk-btn-icon vk-btn-default">

							<span class="title"><?=@$dil['txt246'];?></span>

							<span class="icon">

								<i class="fa fa-long-arrow-right"></i>

							</span>

						</a>

					</div>

				</div>

			</div>

		</div>		

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		

		<?php  if ($SiralamaSonuc['id']=='15') { // Haberler ve Duyurular?>

		<?php if($moduller['alan14'] == "1"){?>

		<div class="vk-section vk-recent-blog-section">

			<div class="container">

				<h2 class="vk-heading vk-heading-border vk-heading-border-left">

					<span><?=@$dil['txt36'];?></span>

				</h2>

				<div class="row">

					<div class="vk-recent-blog-list vk-slider-arrow-top  vk-slider-arrow-dot-top recent-blog-slider">

					<?php $Sorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC LIMIT 6");

					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Sonuc ){?>

						<div class="col-md-6">

							<div class="vk-recent-blog">

								<div class="vk-img-frame anasayfa-haber">

									<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-img">

										<img src="<?php echo tema;?>/uploads/haberler/<?php echo $Sonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>">

									</a>

								</div>

								<div class="brief-content">

									<h4 class="vk-title"><a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>"><?php echo $Sonuc['adi']; ?></a></h4>

									<p class="vk-text brief"><?php echo $Sonuc['spot']; ?></p>

									<div class="vk-buttons">

										<a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" class="vk-btn vk-btn-transparent text-uppercase vk-btn-readmore"><?=@$dil['txt37'];?>

											<i class="fa fa-long-arrow-right"></i>

										</a>

									</div>

								</div>

							</div>

						</div>

						<?php }?>

					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		

		<?php  if ($SiralamaSonuc['id']=='12') { // Ekibimiz?>

		<?php if($moduller['alan16'] == "1"){?>

		<div class="vk-section vk-our-team">

            <div class="container">

                <h2 class="vk-heading vk-heading-border vk-heading-border-left">

                    <span><?=@$dil['txt55'];?></span>

                </h2>

                <div class="row">

                    <div class="col-md-10 col-md-offset-1">

                        <div class="row">

                            <div class="row">

                                <div class="vk-slider vk-slick-slider vk-slider-center" data-slick='{"slidesToShow": 3, "centerMode": true}'>

                                <?php $EKIPSorgu = $db->prepare("SELECT * FROM ekibimiz WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC");

								$EKIPSorgu->execute(array("1","1",$_SESSION['k_dil']));

								$EKIPislem = $EKIPSorgu->fetchALL(PDO::FETCH_ASSOC);?>

									<?php foreach ( $EKIPislem as $EKIPSonuc ){?>    

									<div class="item col-md-3">

                                        <div class="vk-img-frame">

											<a <?php if($EKIPSonuc['detay'] == 1){?>href="<?php echo $htc['ekibdetayurl']; ?>/<?php echo $EKIPSonuc['seo']; ?><?php echo $html;?>" class="vk-img" <?php }else{?> class="swipebox vk-img" rel="ekibimiz" title="<?php echo $EKIPSonuc['adi']; ?>" href="<?php echo tema;?>/uploads/ekibimiz/<?php echo $EKIPSonuc['resim']; ?>" <?php }?>>

                                                <img src="<?php echo tema;?>/uploads/ekibimiz/<?php echo $EKIPSonuc['resim']; ?>" alt="">

                                            </a>

                                        </div>

                                        <ul class="content">

                                            <li class="title"><?php echo $EKIPSonuc['adi']; ?></li>

                                            <li class="position"><?php echo $EKIPSonuc['gorev'];?></li>

                                        </ul>

                                    </div>

									<?php }?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>



		<?php  if ($SiralamaSonuc['id']=='8') { // Müşteri Görüşleri?>

		<?php if($moduller['alan12'] == "1"){?>

		<div class="home-builder-psd vk-what-we-do-section vk-section vk-section-style-2 vk-section-style-3 t-home-psd">

			<div class="container">

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12 trangslide">

					<?php $Sorgu = $db->prepare("SELECT * FROM musteri_gorusleri WHERE durum = ? ORDER BY id DESC");

					$Sorgu->execute(array("1"));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Sonuc ){?>	

						<div class="home-builder-psd-exception">

							<div class="col-md-12 col-sm-12 home-builder-title">

								<div class="col-md-3"></div>

								<div class="col-md-6 title-psd">

									<i class="fa fa-quote-left" aria-hidden="true"></i>

									<h2><?=@$dil['txt254'];?></h2>

									<div class="img">

										<img src="<?php echo tema;?>/images/home-builder/line2.png">

									</div>

								</div>

								<div class="col-md-3"></div>

							</div>

							<div class="col-md-12 col-sm-12 col-xs-12 wicon-text">

								<p><?php echo $Sonuc['yorum']; ?></p>

							</div>

							<div class="content">

								<div class="img">

									<img src="<?php echo tema;?>/images/unnamed.png" style="height: 80px;">

								</div>

								<div class="text-psd">

									<h5><?php echo $Sonuc['isim']; ?></h5>

									<p><?php echo $Sonuc['meslek']; ?></p>

								</div>

							</div>

						</div>

						<?php }?>

					</div>

				</div>

			</div>

		</div>		

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='10') { // Paketlerimiz?>

		<?php if($moduller['alan11'] == "1"){?>

		<div class="vk-pricing-table">

			<div class="pricing pricing-1">

				<div class="container">

					<div class="row">

						<div class="vk-space medium"></div>

						<div class=" vk-text-center">

							<h2 class="vk-heading vk-heading-line vk-heading-line-center mb-2">

								<span><?=@$dil['txt247'];?></span>

							</h2>

						</div>

						<div class="vk-space medium"></div>

						<?php $PAKETSorgu = $db->prepare("SELECT * FROM paketler WHERE durum = ? AND dil = ? ORDER BY id DESC");

						$PAKETSorgu->execute(array("1",$_SESSION['k_dil']));

						$PAKETislem = $PAKETSorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $PAKETislem as $PAKETSonuc ){?>	

						<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-0">

							<!-- PRICE ITEM -->

							<div class="panel price panel-basic">

								<div class="vk-panel vk-panel-basic vk-overlay">

									<div class="vk-be-overlay">

										<div class="panel-heading  text-center ">

											<h3 class="vk-text-uppercase"><?php echo $PAKETSonuc['adi']; ?></h3>

										</div>

										<div class="panel-body text-center">

											<p class="lead vk-price"> <big><?php echo $PAKETSonuc['fiyat']; ?> <span class="price-small"><?php echo $PAKETSonuc['pbirim']; ?></span></big> 

											<small>/ <?php if($PAKETSonuc['periyod'] == 0){?>

											<?=@$dil['txt249'];?>

											<?php }elseif($PAKETSonuc['periyod'] == 1){?>

											<?=@$dil['txt250'];?>

											<?php }else{?>

											<?=@$dil['txt251'];?>

											<?php }?></small> </p>

										</div>

									</div>

								</div>

								<ul class="list-group list-group-flush text-center">

								<?php $parcala = preg_split('/,/', $PAKETSonuc['ozellikler'], null, PREG_SPLIT_NO_EMPTY);

								foreach($parcala as $ozellik){?>

								<li class="list-group-item"><?php echo $ozellik;?></li>

								<?php }?>

								</ul>

								<div class="panel-footer">

									<a href="<?php echo $Sonuc['link']; ?>" class="vk-btn vk-btn-default vk-btn-m text-uppercase"> <span class="title"><?=@$dil['txt252'];?></span> </a>

								</div>

							</div>

						</div>

						<?php }?>

						<div class="clearfix"></div>

						<div class="vk-space medium"></div>

					</div>

				</div>

			</div>

		</div>		

		<div class="clearfix"></div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='1') { // Teklif Formu?>

		<?php if($moduller['alan2'] == "1"){?>

		<div class="callback-section">

			<div class="auto-container">

				<div class="row clearfix">



					<!-- Image Column -->

					<div class="image-column col-lg-6 col-md-12 col-sm-12">

						<div class="inner-column">

							<div class="image wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">

								<img src="<?php echo tema;?>/uploads/arkaplan/arkaplan23/<?php echo $arkaplan['arkaplan23'];?>" alt="<?=@$dil['txt226'];?>" />

							</div>

						</div>

					</div>



					<!-- Content Column -->

					<div class="content-column col-lg-6 col-md-12 col-sm-12">

						<div class="inner-column">

							<div class="sec-title-three">

								<h2><?=@$dil['txt226'];?></h2>

							</div>



							<!-- CallBack Form -->

							<div class="callback-form">

								<!-- Contact Form -->

								<form action="_class/site_islem.php" method="post" autocomplete="off">

									<div class="row clearfix">



										<div class="form-group col-lg-6 col-md-6 col-sm-12">

											<input type="text" name="isim" placeholder="<?=@$dil['txt5'];?>">

										</div>



										<div class="form-group col-lg-6 col-md-6 col-sm-12">

											<input type="text" name="telefon" placeholder="<?=@$dil['txt7'];?>">

										</div>



										<div class="form-group col-lg-12 col-md-12 col-sm-12">

											<input type="email" name="email" placeholder="<?=@$dil['txt6'];?>">

										</div>



										<div class="form-group col-lg-12 col-md-12 col-sm-12">

											<textarea name="aciklama" placeholder="<?=@$dil['txt228'];?>"></textarea>

										</div>



										<div class="form-group col-lg-12 col-md-12 col-sm-12">

											<input type="hidden" name="kontrol" value="" id="kontrol">	

											<input type="hidden" name="teklifurl" value="<?php echo $sayfalink;?>" />

											<button class="theme-btn submit-btn" type="submit" name="TeklifBtn"><?=@$dil['txt231'];?></button>

										</div>



									</div>

								</form>

							</div>



						</div>

					</div>



				</div>

			</div>

		</div>

		<?php }?>

		<?php }?>

		

		<?php  if ($SiralamaSonuc['id']=='3') { // Referanslar?>

		<?php if($moduller['alan5'] == "1"){?>

		<div class="vk-client-shop-section">

			<div class="container">

				<div class="vk-list-client-shop">

					<ul class="vk-list vk-list-client-style-2 vk-list-client-slider">

					<?php $Sorgu = $db->prepare("SELECT * FROM referanslar WHERE durum = ? AND anasayfa = ? AND dil = ? ORDER BY id DESC");

					$Sorgu->execute(array("1","1",$_SESSION['k_dil']));

					$islem = $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>

						<?php foreach ( $islem as $Sonuc ){?>

						 <li class="vk-img-frame vk-img">

							<a <?php if($Sonuc['detay'] == 1){?> class="d-ortala" href="<?php echo $htc['refdetayurl']; ?>/<?php echo $Sonuc['seo']; ?><?php echo $html;?>" <?php }else{?> class="d-ortala swipebox" rel="referanslar" href="<?php echo tema;?>/uploads/referanslar/<?php echo $Sonuc['resim']; ?>" alt="<?php echo $Sonuc['adi'];?>" title="<?php echo $Sonuc['adi'];?>" <?php }?>><img src="<?php echo tema;?>/uploads/referanslar/<?php echo $Sonuc['resim']; ?>" alt="<?php echo $Sonuc['adi']; ?>"></a>

						</li>

						<?php }?>

					</ul>

				</div>

			</div>

		</div>

		<?php }?>

		<?php }?>

		<?php } // Sıralama Forech Döngü Sonu//?>

		

	</div>

	<!--./home-->

	

</section>

<!--./content-->