<?php 
if(isset($_GET['sayfa'])){
	$s = $_GET['sayfa'];
	switch($s){
		
	case ''.$htc['anaurl'].'';
	$title 			= baslik;
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['sayfaurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM sayfalar WHERE seo = ? ORDER BY id ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['resim'] != "")
	{
		$paylasim		= "".tema."/uploads/sayfalar/".$TITLESonuc['resim']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['urunkategoriurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM urun_kategori WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['kapak'] != "")
	{
		$paylasim		= "".tema."/uploads/kategoriler/kapak/".$TITLESonuc['kapak']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['urunlerurl'].'';
	$title 			=@$dil['txt90'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['urundetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM urunler WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['kapak'] != "")
	{
		$paylasim		= "".tema."/uploads/urunler/".$TITLESonuc['kapak']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['projekategoriurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM proje_kategori WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['kapak'] != "")
	{
		$paylasim		= "".tema."/uploads/proje_kategoriler/kapak/".$TITLESonuc['kapak']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['projelerurl'].'';
	$title 			=@$dil['txt233'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['projedetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM projeler WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['kapak'] != "")
	{
		$paylasim		= "".tema."/uploads/projeler/".$TITLESonuc['kapak']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['ekiburl'].'';
	$title 			= @$dil['txt55'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['ekibdetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM ekibimiz WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['resim'] != "")
	{
		$paylasim		= "".tema."/uploads/ekibimiz/".$TITLESonuc['resim']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['haberurl'].'';
	$title 			= @$dil['txt59'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['haberdetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM haberler WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['resim'] != "")
	{
		$paylasim		= "".tema."/uploads/haberler/".$TITLESonuc['resim']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['hizmeturl'].'';
	$title 			= @$dil['txt64'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['hizmetdetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM hizmetler WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['resim'] != "")
	{
		$paylasim		= "".tema."/uploads/hizmetler/".$TITLESonuc['resim']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['fotourl'].'';
	$title 			= @$dil['txt57'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	$anasayfa		= "hayır";
	break;
	
	case ''.$htc['fotodetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM foto_galeri WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['kapak'] != "")
	{
		$paylasim		= "".tema."/uploads/fotogaleri/".$TITLESonuc['kapak']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['videourl'].'';
	$title 			= @$dil['txt85'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['videodetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM video_galeri WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['resim'] != "")
	{
		$paylasim		= "".tema."/uploads/videogaleri/".$TITLESonuc['resim']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['refurl'].'';
	$title 			= @$dil['txt83'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['refdetayurl'].'';
	$TITLESorgu 	= $db->prepare("SELECT * FROM referanslar WHERE seo = ? ORDER BY sira ASC");
	$TITLESorgu->execute(array($_GET['id']));
	$TITLESonuc 	= $TITLESorgu->fetch(PDO::FETCH_ASSOC);
	$title 			= "".h43KEsAyau_ilkbuyuk($TITLESonuc['adi'])."";
	$keywords 		= "".$TITLESonuc['keywords']."";
	$description	= "".$TITLESonuc['description']."";
	if($TITLESonuc['resim'] != "")
	{
		$paylasim		= "".tema."/uploads/referanslar/".$TITLESonuc['resim']."";
	}
	else
	{
		$paylasim		= "".tema."/uploads/logo/".logo."";
	}
	break;
	
	case ''.$htc['belgeurl'].'';
	$title 			= @$dil['txt48'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['subeurl'].'';
	$title 			= @$dil['txt42'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['katalogurl'].'';
	$title 			= @$dil['txt43'];
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['bankahesapurl'].'';
	$title 			= @$dil['txt38'];
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['musteriurl'].'';
	$title 			= @$dil['txt75'];
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['sssurl'].'';
	$title 			= @$dil['txt84'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['iletisimurl'].'';
	$title 			= @$dil['txt70'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case ''.$htc['ikurl'].'';
	$title 			= @$dil['txt65'];
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
	case '404';
	$title 			= @$dil['txt16'];	
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	$noheader		= true;
	break;
	
	case 'ara';
	$title 			= @$dil['txt263'];
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	break;
	
				
	default:
	$title 			= baslik;
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
	}
}
else
{
	$title 			= baslik;
	$description 	= site_desc;
	$keywords 		= site_keyw;
	$paylasim		= "".tema."/uploads/logo/".logo."";
}
?>