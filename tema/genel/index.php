<?php define("GUVENLIK",true);?>
<?php 
if($moduller['alan21'] == "1"){
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")
	{
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $redirect);
		exit();
	}
}
?>
<?php $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
$url=$protocol.$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']); 
$sayfalink = $protocol.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$dilsay		= $db->query("SELECT * FROM  diller")->rowCount();
$dilyaz  	= $db->query("SELECT * FROM diller WHERE id = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<?php require_once('pages/sayac.php');?>
<!doctype html>
<html lang="tr">

<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta charset="UTF-8" />
    <base href="<?php echo $url;?><?php echo(altklasor == "1" ? '/' : '');?>">
	<title><?php echo $title;?></title>
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="keywords" content="<?php echo $keywords;?>" />		
	<!-- Facebook Metadata Start -->
	<meta property="og:image:height" content="300" />
	<meta property="og:image:width" content="573" />
	<meta property="og:title" content="<?php echo $title;?>" />
	<meta property="og:description" content="<?php echo $description;?>" />
	<meta property="og:url" content="<?php echo $sayfalink;?>" />
	<meta property="og:image" content="<?php echo $url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo $paylasim;?>" />
	<link rel="icon" type="image/png" href="<?php echo tema;?>/uploads/favicon/<?php echo fav;?>">
	<?php echo dogrulama;?>
    <link href="<?php echo tema;?>/plugin/fonts/transfonter/fonts.css" rel="stylesheet">
    <link href="<?php echo tema;?>/plugin/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<!-- Font Awesome CSS -->
    <link href="<?php echo tema;?>/plugin/fonts/font-awesome/all.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/fonts/platicon/font/flaticon.css" rel="stylesheet">
    <link href="<?php echo tema;?>/plugin/fonts/themify/themify-icons.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/animsition/css/animsition.min.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/lightbox/css/lightbox.min.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/css/animate.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/slick/slick.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/slick/slick-theme.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/plugin/jquery-ui/jquery-ui.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/css/style.php" rel="stylesheet" />
    <link href="<?php echo tema;?>/css/yeni.css" rel="stylesheet" />
    <link href="<?php echo tema;?>/css/customize.css" rel="stylesheet" />
	<link href="<?php echo tema;?>/plugin/image_plugin/src/css/swipebox.css" rel="stylesheet">	
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $url;?><?php echo(altklasor == "1" ? '/' : '');?><?php echo yonetim;?>/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css" />
	
	<!--iziModal -->
	<link rel="stylesheet" href="<?php echo tema;?>/css/iziModal.min.css" type="text/css">
	
	<!--sweetalert2 -->
	<link rel="stylesheet" href="<?php echo tema;?>/css/sweetalert2.min.css">
	
	<!--remodal -->
	<link rel="stylesheet" href="<?php echo tema;?>/css/remodal.css">
    <link rel="stylesheet" href="<?php echo tema;?>/css/remodal-default-theme.css">
	
    <script src="<?php echo tema;?>/plugin/modernizr.js"></script>
	<script src="<?php echo tema;?>/plugin/jquery/jquery.js"></script>
	<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=605509344d1bac0012adf0bf&product=inline-share-buttons' async='async'></script>
	<?php echo analytics;?>
	<?php echo canli_destek;?>
	
	<?php if($moduller['alan24'] == "1"){?>
	<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $ayar["rcaptha"];?>"></script>
	<script>
	  function onClick(e) {
		e.preventDefault();
		grecaptcha.ready(function() {
		  grecaptcha.execute('<?php echo $ayar["rcaptha"];?>', {action: 'submit'}).then(function(token) {
			  // Add your logic to submit to your backend server here.
		  });
		});
	  }
	</script>
	<?php }?>
	
	<?php
	if($moduller['alan20'] == "1"){
		$html = ".html";
	}
	else
	{
		$html = "";
	}	
	?>
</head>

<body>
	<?php if($dilsay > 1){?>
	<div class="diller">
		<a href="javascript:void(0);" class="trigger-link" title="<?=@$dil['txt1'];?>" alt="<?=@$dil['txt1'];?>"><i class="flag-icon rounded-25 <?php echo $dilyaz['bayrak'];?>"></i></a>
		<span class="tooltiptext"><?=@$dil['txt1'];?></span>
	</div>
	<?php }?>
	
	<div id="modal-demo" class="iziModal text-center">
		<div class="p-4">
			<div class="lang">
				<h4><?=@$dil['txt2'];?></h4>
				<?php 
				$DILSorgu = $db->prepare("SELECT * FROM diller ORDER BY sira ASC");
				$DILSorgu->execute();
				$DILislem 	= $DILSorgu->fetchALL(PDO::FETCH_ASSOC);?>						
				<?php foreach ( $DILislem as $DILSonuc ){?> 
					<a data-id="<?=@$DILSonuc['id'];?>" href="javascript:void(0);" class="<?php echo($dilyaz['id'] == $DILSonuc['id'] ? 'activelang' : '');?> dildegis"><i class="flag-icon <?php echo $DILSonuc['bayrak'];?>"></i> <?php echo $DILSonuc['adi'];?></a>				
				<?php }?>								
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>						
	</div>
	<?php echo whatsapp;?>
    <div class="<?php if($moduller['alan19'] == "1"){?>animsition<?php }?> main-wrapper">

        <header class="vk-header">
		
			<div class="vk-header-top hidden-lg hidden-md">
                <div class="container">
                    <div class="content">
                        <ul class="quick-address">
                            <li><a class="nolink" href="tel:<?php echo telefon;?>"><i class="fas fa-phone-square-alt"></i> <?php echo telefon;?></a></li>
                            <li><a class="nolink" href="mailto:<?php echo email;?>"><i class="fas fa-envelope-open-text"></i> <?php echo email;?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
			
            <nav class="vk-navbar  navbar">
                <div class="container">
                    <div class="vk-navbar-header navbar-header">
                        <button type="button" class="navbar-toggle vk-navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                            <i class="toggle-icon"></i>
                        </button>
                        <!--./vk-navbar-toggle-->

                        <a class="vk-navbar-brand navbar-brand" href="./">
                            <img src="<?php echo tema;?>/uploads/logo/<?php echo logo;?>" alt="<?php echo firma_adi;?>" title="<?php echo firma_adi;?>">
                        </a>
                        <!--./vk-navbar-brand-->

                    </div>
                    <!--./vk-navbar-header-->

                    <div class="collapse navbar-collapse vk-navbar-collapse" id="menu">
					
						<ul class="vk-navbar-nav navbar-right">
						<?php $MENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
						$MENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
						$MENUislem = $MENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
						<?php foreach ( $MENUislem as $MENUSonuc ){?>
						<?php $altvarmi	= $db->query("SELECT * FROM menu WHERE menu_durum = '1' AND menu_ust = '{$MENUSonuc['id']}' ORDER BY id DESC")->rowCount();?>
							<?php if($MENUSonuc['tip']==0){?>	
							<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
							<?php $ALTMENUSorgu = $db->prepare("SELECT * FROM menu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC");
							$ALTMENUSorgu->execute(array("1",$MENUSonuc['id'],$_SESSION['k_dil']));
							$ALTMENUislem = $ALTMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
							<?php if($ALTMENUSorgu->rowCount()){?>									
								<ul class="vk-navbar-nav child">
								<?php foreach ( $ALTMENUislem as $ALTMENUSonuc ){?>
									<li><a <?php echo($ALTMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($ALTMENUSonuc['menu_url'] == "0" ? $ALTMENUSonuc['link'] : $ALTMENUSonuc['menu_url'].$html); ?>"><?php echo $ALTMENUSonuc['menu_isim']; ?></a></li>
								 <?php }?>
								</ul>									
								<?php }?>
							</li>									
							<?php } else { ?>
							
							<?php if($MENUSonuc['tip']==1){?>											
							<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
								<ul class="vk-navbar-nav child">	
								<?php 
								function getCategory($CatID=0){
									global $db;
									global $htc;
									global $html;
									$AllMenus = $db->query("SELECT * FROM urun_kategori WHERE ustid = '{$CatID}' AND dil = '{$_SESSION['k_dil']}' order by sira asc")->fetchALL(PDO::FETCH_ASSOC);														
									foreach($AllMenus as $Menu){														
										$SubCategory = $db->query("SELECT COUNT(*) as total FROM urun_kategori WHERE ustid = '{$Menu['id']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
										if($SubCategory['total'] != 0){?>
											<li><a href="<?php echo $htc['urunkategoriurl']; ?>/<?=$Menu['seo'];?><?php echo $html;?>"><?=h43KEsAyau_ilkbuyuk($Menu['adi']);?></a>
												<ul class="vk-navbar-nav">	
												<?php getCategory($Menu['id']); ?>
												</ul>
											</li>
											<?php }else{?>
												<li><a href="<?php echo $htc['urunkategoriurl']; ?>/<?=$Menu['seo'];?><?php echo $html;?>"><?=h43KEsAyau_ilkbuyuk($Menu['adi']);?></a></li>
											<?php 
										}
										
									}
								}
								getCategory(0) ;
								?>
								<?php if($MENUSonuc['tbuton']!=""){?>
								<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
								<?php } ?>
								</ul>
							</li>							
							<?php }?>
							
							<?php if($MENUSonuc['tip']==2){?>
							<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
							<?php $MENUURUNSorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
							$MENUURUNSorgu->execute(array("1",$_SESSION['k_dil']));
							$MENUURUNislem = $MENUURUNSorgu->fetchALL(PDO::FETCH_ASSOC);?>	
								<ul class="vk-navbar-nav child">														
									<?php foreach ( $MENUURUNislem as $MENUURUNSonuc ){?>
									<li><a href="<?php echo $htc['urundetayurl']; ?>/<?php echo $MENUURUNSonuc['seo']; ?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($MENUURUNSonuc['adi']);?></a></li>
									<?php }?>											
									<?php if($MENUSonuc['tbuton']!=""){?>
									<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
									<?php } ?>
								</ul>
							</li>
							<?php }?>
							
							<?php if($MENUSonuc['tip']==3){?>
							<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
								<?php $MENUHIZMETSorgu = $db->prepare("SELECT * FROM hizmetler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
								$MENUHIZMETSorgu->execute(array("1",$_SESSION['k_dil']));
								$MENUHIZMETislem = $MENUHIZMETSorgu->fetchALL(PDO::FETCH_ASSOC);?>			
								<ul class="vk-navbar-nav child">
								<?php foreach ( $MENUHIZMETislem as $MENUHIZMETSonuc ){?>
									<li><a href="<?php echo $htc['hizmetdetayurl']; ?>/<?php echo $MENUHIZMETSonuc['seo']; ?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($MENUHIZMETSonuc['adi']);?></a></li>
									<?php } ?>
									<?php if($MENUSonuc['tbuton']!=""){?>
									<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
									<?php } ?>
								</ul>									
							</li>
							<?php } ?>
							
							<?php if($MENUSonuc['tip']==4){?>
							<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
								<?php $MENUPKATSorgu = $db->prepare("SELECT * FROM foto_galeri WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
								$MENUPKATSorgu->execute(array("1",$_SESSION['k_dil']));
								$MENUPKATislem = $MENUPKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>		
								<ul class="vk-navbar-nav child">
								<?php foreach ( $MENUPKATislem as $MENUPKATSonuc ){?>
									<li><a href="<?php echo $htc['fotodetayurl']; ?>/<?php echo $MENUPKATSonuc['seo']; ?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($MENUPKATSonuc['adi']);?></a></li>
									<?php } ?>
									<?php if($MENUSonuc['tbuton']!=""){?>
									<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
									<?php } ?>
								</ul>									
							</li>
							<?php } ?>
							
							<?php if($MENUSonuc['tip']==5){?>
							<li><a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
								<?php $MENUPKATSorgu = $db->prepare("SELECT * FROM video_galeri WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
								$MENUPKATSorgu->execute(array("1",$_SESSION['k_dil']));
								$MENUPKATislem = $MENUPKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>		
								<ul class="vk-navbar-nav child">
								<?php foreach ( $MENUPKATislem as $MENUPKATSonuc ){?>
									<li><a href="<?php echo $htc['videodetayurl']; ?>/<?php echo $MENUPKATSonuc['seo']; ?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($MENUPKATSonuc['adi']);?></a></li>
									<?php } ?>
									<?php if($MENUSonuc['tbuton']!=""){?>
									<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
									<?php } ?>
								</ul>									
							</li>
							<?php } ?>
							
							<?php if($MENUSonuc['tip']==6){?>
							<li>
								<a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
								<?php $MENUPKATSorgu = $db->prepare("SELECT * FROM proje_kategori WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
								$MENUPKATSorgu->execute(array("1",$_SESSION['k_dil']));
								$MENUPKATislem = $MENUPKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<ul class="vk-navbar-nav child">
									<?php foreach ( $MENUPKATislem as $MENUPKATSonuc ){?>
									<li><a href="<?php echo $htc['projekategoriurl']; ?>/<?php echo $MENUPKATSonuc['seo']; ?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($MENUPKATSonuc['adi']);?></a></li>
									<?php }?>
									<?php if($MENUSonuc['tbuton']!=""){?>
									<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
									<?php } ?>
								</ul>
							</li>
							<?php }?>
							<?php if($MENUSonuc['tip']==7){?>
							<li>
								<a <?php echo($MENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($MENUSonuc['menu_url'] == "0" ? $MENUSonuc['link'] : $MENUSonuc['menu_url'].$html); ?>"><?php echo $MENUSonuc['menu_isim']; ?></a>
								<?php $MENUPKATSorgu = $db->prepare("SELECT * FROM projeler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT ".$MENUSonuc['klimit']."");
								$MENUPKATSorgu->execute(array("1",$_SESSION['k_dil']));
								$MENUPKATislem = $MENUPKATSorgu->fetchALL(PDO::FETCH_ASSOC);?>
								<ul class="vk-navbar-nav child">
									<?php foreach ( $MENUPKATislem as $MENUPKATSonuc ){?>
									<li><a href="<?php echo $htc['projedetayurl']; ?>/<?php echo $MENUPKATSonuc['seo']; ?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($MENUPKATSonuc['adi']);?></a></li>
									<?php }?>
									<?php if($MENUSonuc['tbuton']!=""){?>
									<li><a href="<?php echo $MENUSonuc['tbuton']; ?>"><?=@$dil['txt4'];?></a></li>
									<?php } ?>
								</ul>
							</li>
							<?php }?>
							
						<?php }?>
						<?php }?>
						
						<?php if($moduller['alan26'] == "1"){?>
						<li class="item-search">
                            <span class="btn-search hidden-xs hidden-sm" data-toggle="collapse" data-target="#box-search-header"><i class="fa fa-search"></i></span>
                        </li>
						<?php }?>
						</ul>
                        <!--./vk-navbar-nav-->

						<?php if($moduller['alan26'] == "1"){?>
                        <div class="box-search-header collapse" id="box-search-header">
							<form method="get" action="ara<?php echo $html;?>" autocomplete="off">
                            <div class="vk-input-group">
                                <input type="text" name="kelime" placeholder="<?=@$dil['txt81'];?>" class="form-control" required>
                                <button class="vk-btn btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
							</form>
                        </div>
                        <?php }?>

                    </div>
                    <!--./vk-navbar-collapse-->

                </div>
                <!--./container-->

            </nav>
            <!--./vk-navbar-->

            <div class="vk-header-top hidden-xs hidden-sm">
                <div class="container">
                    <div class="content">
                        <ul class="quick-address">
                            <li><a class="nolink" href="tel:<?php echo telefon;?>"><?php echo telefon;?></a></li>
                            <li><a class="nolink" href="mailto:<?php echo email;?>"><?php echo email;?></a></li>
							<?php if($moduller['alan28'] == "1"){?>
                            <li><?=@$dil['txt236'];?></li>
							<?php }?>
                        </ul>
                    </div>
                </div>
            </div>

        </header>
        <!--./vk-header-->
        <?php 
		if(isset($_GET['sayfa'])){
			$s = $_GET['sayfa'];
			switch($s){
				
			case ''.$htc['anaurl'].'';
			require_once("pages/anasayfa.php");
			break;
			
			case ''.$htc['urunkategoriurl'].'';
			require_once("pages/urun_kategori.php");
			break;
			
			case ''.$htc['urunlerurl'].'';
			require_once("pages/urunler.php");
			break;
			
			case ''.$htc['urundetayurl'].'';
			require_once("pages/urun_detay.php");
			break;
			
			case ''.$htc['projekategoriurl'].'';
			require_once("pages/proje_kategori.php");
			break;
			
			case ''.$htc['projelerurl'].'';
			require_once("pages/projeler.php");
			break;
			
			case ''.$htc['projedetayurl'].'';
			require_once("pages/proje_detay.php");
			break;
			
			case ''.$htc['sayfaurl'].'';
			require_once("pages/sayfalar.php");
			break;
			
			case ''.$htc['ekibdetayurl'].'';
			require_once("pages/ekip.php");
			break;
			
			case ''.$htc['ekiburl'].'';
			require_once("pages/ekibimiz.php");
			break;
			
			case ''.$htc['haberurl'].'';
			require_once("pages/haberler.php");
			break;
			
			case ''.$htc['haberdetayurl'].'';
			require_once("pages/haber_detay.php");
			break;				
			
			case ''.$htc['hizmeturl'].'';
			require_once("pages/hizmetler.php");
			break;
			
			case ''.$htc['hizmetdetayurl'].'';
			require_once("pages/hizmet_detay.php");
			break;				
						
			case ''.$htc['fotourl'].'';
			require_once("pages/foto_galeri.php");
			break;
			
			case ''.$htc['fotodetayurl'].'';
			require_once("pages/foto.php");
			break;
			
			case ''.$htc['videourl'].'';
			require_once("pages/video_galeri.php");
			break;
			
			case ''.$htc['videodetayurl'].'';
			require_once("pages/video.php");
			break;
			
			case ''.$htc['refurl'].'';
			require_once("pages/referanslar.php");
			break;
			
			case ''.$htc['refdetayurl'].'';
			require_once("pages/referans.php");
			break;
			
			case ''.$htc['belgeurl'].'';
			require_once("pages/belgelerimiz.php");
			break;
			
			case ''.$htc['subeurl'].'';
			require_once("pages/bayiler.php");
			break;
			
			case ''.$htc['katalogurl'].'';
			require_once("pages/e_katalog.php");
			break;
			
			case ''.$htc['musteriurl'].'';
			require_once("pages/musteri_gorusleri.php");
			break;
			
			case ''.$htc['bankahesapurl'].'';
			require_once("pages/banka_hesaplari.php");
			break;
			
			case '404';
			require_once("pages/404.php");
			break;
			
			case 'ara';
			require_once("pages/ara.php");
			break;
			
			case ''.$htc['sssurl'].'';
			require_once("pages/sss.php");
			break;
			
			case ''.$htc['ikurl'].'';
			require_once("pages/ik.php");
			break;
			
			case ''.$htc['iletisimurl'].'';
			require_once("pages/iletisim.php");
			break;
						
			default:
			require_once("pages/anasayfa.php");
			}
		}else{
		require_once("pages/anasayfa.php");
		}
		?>
		<?php if($moduller['alan23'] == "1"){?>
		<div class="newsletter" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan2/<?php echo $arkaplan['arkaplan2'];?>)">
			<div class="container c-container__content">
				<div class="newsletter-container">
					<div class="c-title"><?=@$dil['txt47'];?></div> 
					<span class="newsletter-subtitle"><?=@$dil['txt41'];?></span>
					<form action="_class/site_islem.php" autocomplete="off" method="post" data-newsletterform="true" class="c-footer__newsletter-form" novalidate="novalidate"> 
						<input type="text" name="email" placeholder="<?=@$dil['txt221'];?>" class="c-footer__newsletter-form-input"> 
						<input type="hidden" name="kontrol" value="" id="kontrol">	
						<input type="hidden" name="donus_url" value="<?php echo $sayfalink;?>" />
						<button type="submit" name="ebultenbtn" class="c-footer__newsletter-form-button c-button"><span><i class="fas fa-envelope"></i> <?=@$dil['txt19'];?></span></button> 
					</form>
				</div>
			</div>
		</div>
		<?php }?>
        <footer class="vk-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-item about">
						<div class="logo">
							<a href="./"><img src="<?php echo tema;?>/uploads/logo/footer/<?php echo footerlogo;?>" alt="" /></a>
						</div>
                        <p class="vk-text"><?=@$dil['txt10'];?></p>
						<?php if($moduller['alan27'] == "1"){?>
                        <ul class="vk-list vk-social-link">
                            <?php if(facebook){?><li class="facebook"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-facebook-f"></a></li><?php }?>
                            <?php if(linkedin){?><li class="linkedin"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-linkedin-in"></a></li><?php }?>
                            <?php if(twitter){?><li class="twitter"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-twitter"></a></li><?php }?>
                            <?php if(instagram){?><li class="instagram-sosyal"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-instagram"></a></li><?php }?>
                            <?php if(youtube){?><li class="youtube"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-youtube"></a></li><?php }?>
                        </ul>
						<?php }?>
                    </div>
                    <!--./about-->


                    <div class="col-md-5 footer-item quick-link">
                        <h4 class="vk-heading text-uppercase"><?=@$dil['txt222'];?></h4>						
						<div class="row clearfix">
							<div class="col-lg-6 col-md-6 col-sm-12">									
								<ul class="vk-list vk-quick-link text-capitalize">
								<?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 0,7");
								$FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
								$FMENUislem = $FMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $FMENUislem as $FMENUSonuc ){?>
									<li><a <?php echo($FMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>"><?php echo $FMENUSonuc['menu_isim']; ?></a></li>
									<?php }?> 
								</ul>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<ul class="vk-list vk-quick-link text-capitalize">
								<?php $FMENUSorgu = $db->prepare("SELECT * FROM footermenu WHERE menu_durum = ? AND menu_ust = ? AND dil = ? ORDER BY menu_sira ASC LIMIT 7,7");
								$FMENUSorgu->execute(array("1","0",$_SESSION['k_dil']));
								$FMENUislem = $FMENUSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php foreach ( $FMENUislem as $FMENUSonuc ){?>
									<li><a <?php echo($FMENUSonuc['sekme'] == 1 ? 'target="_blank"' : '');?> href="<?php echo($FMENUSonuc['menu_url'] == "0" ? $FMENUSonuc['link'] : $FMENUSonuc['menu_url'].$html); ?>"><?php echo $FMENUSonuc['menu_isim']; ?></a></li>
									<?php }?> 
								</ul>
							</div>
                        </div>
                    </div>
                    <!--./quick-link-->


                    <div class="col-md-3 footer-item office">
                        <h4 class="vk-heading text-uppercase"><?=@$dil['txt223'];?></h4>
						<h6 class="yazirenk1"><?=@$dil['txt230'];?></h6>
                        <ul class="vk-list vk-office footer-con">
                            <?php if(adres){?><li><i class="fas fa-map-marker-alt"></i><?php echo adres;?></li><?php }?>
                            <?php if(email){?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo email;?>"><?php echo email;?></a></li><?php }?>
                            <?php if(telefon){?><li><i class="fa fa-phone"></i><a href="tel:<?php echo telefon;?>"><?php echo telefon;?></a></li><?php }?>
                            <?php if(fax){?><li><i class="fa fa-fax"></i><?php echo fax;?></li><?php }?>
                        </ul>
						<?php if($moduller['alan28'] == "1"){?>
						<h6 class="yazirenk1"><?=@$dil['txt235'];?></h6>
						<div class="timing"><?=@$dil['txt236'];?></div>
						<?php }?>
                    </div>
                    <!--./office-->
                </div>
                <!--./row-->

            </div>
            <!--./container-->
            <div class="footer-bot">
                <div class="container">
                    <p class="vk-text">
                        <?php echo copyright;?>
                    </p>
                </div>
            </div>
            <!--./footer-bot-->
        </footer>
        <!--./vk-footer-->
    </div>
    <!--./main-wrapper-->

    <!-- BEGIN: SCRIPT -->
	<script src="<?php echo tema;?>/plugin/sweetalert2.all.min.js"></script>
	<script src="<?php echo tema;?>/plugin/sweetalert2.min.js"></script>
	<!--iziModal -->
	<script src="<?php echo tema;?>/plugin/iziModal.min.js"></script>
    <script src="<?php echo tema;?>/plugin/plugin.min.js"></script>
    <script src="<?php echo tema;?>/plugin/main.js"></script>
	<script src="<?php echo tema;?>/plugin/image_plugin/src/js/jquery.swipebox.js"></script>
	<script src="<?php echo tema;?>/plugin/remodal.js"></script>
	<script src="<?php echo tema;?>/plugin/turkey.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {

			/* Basic Gallery */
			$( '.swipebox' ).swipebox();
			
			/* Video */
			$( '.swipebox-video' ).swipebox();
			

			/* Smooth scroll */
			$( '.scroll' ).on( 'click', function () {
				$( 'html, body' ).animate( { scrollTop: $( $( this ).attr('href') ).offset().top - 15 }, 750 ); // Go
				return false;
			});
      } );
	</script>
	<script>
	$(document).on('click', '.dildegis', function () {
		var dilID = $(this).data("id");
		$.ajax({
			url: 'dildegis.php',
			dataType: 'JSON',
			data: {id: dilID},
		})
		.done(function(msg) {
			if(msg.hata){
				alert("Bir hata oluştu");
			}else{
				window.location = "./";
			}
		})
		.fail(function(err) {
			console.log(err);
		});
	});
	</script>
	<script type="text/javascript">
	$("#modal-demo").iziModal({
        title: "",
        subtitle: "",
        iconClass: '',
		background:null,
		theme:'light',
		closeButton:true,
		overlay:true,
		overlayClose:true,
		transitionInOverlay:'fadeIn',
		transitionOutOverlay:'fadeOut',
        overlayColor: 'rgba(0, 0, 0, 0.85)',
        width: 500,
        padding: 20
    });
    $(document).on('click', '.trigger-link', function (event) {
        event.preventDefault();
        $('#modal-demo').iziModal('open');
    });
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var my_cookie = $.cookie($('.modal-check').attr('name'));
			if (my_cookie && my_cookie == "true") {
				$(this).prop('checked', my_cookie);
				console.log('checked checkbox');
			} else {
				$('#actionsModal').modal('show');
				console.log('uncheck checkbox');
			}
			$(".modal-check").change(function() {
				$.cookie($(this).attr("name"), $(this).prop('checked'), {
					path: '/',
					expires: 1
				});
			});
		});
	</script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.4/cookieconsent.min.js"></script>
	<script>
		window.addEventListener("load", function() {
			window.cookieconsent.initialise({
				"palette": {
					"popup": {
						"background": "<?=@$ayar['renk1'];?>"
					},
					"button": {
						"background": "#fff",
						"text": "#000000"
					}
				},
				"theme": "classic",
				"position": "bottom-left",
				"content": {
					"message": "<?=@$dil['yaz290'];?>",
					"dismiss": "<?=@$dil['yaz291'];?>",
					"link": "<?=@$dil['yaz292'];?>",
					"href":"<?=@$dil['yaz293'];?>"
				}
			})
		});
	</script>
	<script>
	$(window).bind('load', function() {
	  $('img').each(function() {
		if( (typeof this.naturalWidth != "undefined" && this.naturalWidth == 0) 
		||  this.readyState == 'uninitialized'                                  ) {
			$(this).attr('src', '<?php echo tema;?>/uploads/logo/<?php echo logo;?>');
		}
	  });
	});	
	</script>
    <!-- END: SCRIPT -->
	<?php 
	h43KEsAyau_site_mesaj("TeklifBtn",1,"yes",@$dil['txt122'],@$dil['txt123'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("TeklifBtn",2,"no",@$dil['txt125'],@$dil['txt126'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("TeklifBtn",3,"bos",@$dil['txt127'],@$dil['txt128'],@$dil['txt124']);
	
	h43KEsAyau_site_mesaj("yorumbtn",1,"yes",@$dil['txt122'],@$dil['txt123'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("yorumbtn",2,"no",@$dil['txt125'],@$dil['txt126'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("yorumbtn",3,"bos",@$dil['txt127'],@$dil['txt128'],@$dil['txt124']);

	h43KEsAyau_site_mesaj("mesajbtn",1,"yes",@$dil['txt122'],@$dil['txt123'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("mesajbtn",2,"no",@$dil['txt125'],@$dil['txt126'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("mesajbtn",3,"bos",@$dil['txt127'],@$dil['txt128'],@$dil['txt124']);
	
	h43KEsAyau_site_mesaj("SiparisBtn",1,"yes",@$dil['txt122'],@$dil['txt123'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("SiparisBtn",2,"no",@$dil['txt57'],@$dil['txt126'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("SiparisBtn",3,"bos",@$dil['txt59'],@$dil['txt128'],@$dil['txt124']);
	
	h43KEsAyau_site_mesaj("ebultenbtn",1,"yes",@$dil['txt122'],@$dil['txt123'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("ebultenbtn",2,"no",@$dil['txt125'],@$dil['txt126'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("ebultenbtn",3,"bos",@$dil['txt127'],@$dil['txt128'],@$dil['txt124']);
	
	h43KEsAyau_site_mesaj("ikbtn",1,"yes",@$dil['txt122'],@$dil['txt123'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("ikbtn",2,"no",@$dil['txt125'],@$dil['txt126'],@$dil['txt124']);
	h43KEsAyau_site_mesaj("ikbtn",3,"bos",@$dil['txt127'],@$dil['txt128'],@$dil['txt124']);
	
	h43KEsAyau_site_mesaj("sitedemo",3,"no",@$dil['txt125'],@$dil['txt129'],@$dil['txt124']);
	?>
</body>
</html>