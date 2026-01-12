<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php
if(strip_tags(isset($_GET['id'])))
{
    $Sorgu = $db->prepare("SELECT * FROM urun_kategori WHERE seo = ? AND dil = ?");
    $Sorgu->execute(array($_GET['id'],$_SESSION['k_dil']));
    if($Sorgu->rowCount()){
        $Sonuc 		= $Sorgu->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
        exit();
    }
}
else
{
    $Sorgu = $db->prepare("SELECT * FROM urun_kategori WHERE dil = ? ORDER BY sira ASC");
    $Sorgu->execute(array($_SESSION['k_dil']));
    if($Sorgu->rowCount()){
        $Sonuc = $Sorgu->fetch(PDO::FETCH_ASSOC);
    }else{
        header("Location:".$url.(altklasor == "1" ? '/' : '')."404".$html."");
        exit();
    }
}
?>

<?php
$ReqUri = explode('?',$_SERVER['REQUEST_URI']);
$Vals = '';
if(isset($ReqUri[end(array_keys($ReqUri))])){
    $Vals = "&".$ReqUri[end(array_keys($ReqUri))];
}
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$order_by = "sira ASC";
if(@$_GET['order'] == "fiyat_asc")
    $order_by = "IFNULL(ifiyat, fiyat) ASC";

if(@$_GET['order'] == "fiyat_desc")
    $order_by = "IFNULL(ifiyat, fiyat) DESC";

if(@$_GET['order'] == "order_last")
    $order_by = "id DESC";

$where = NULL;
$catids = $Sonuc['id'];

$CategoryCheck = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$Sonuc['id']}'");

function kategoricheck($ID=''){
    global $db;
    $catids="";
    $CategoryAll = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$ID}'")->fetchAll(PDO::FETCH_ASSOC);
    foreach($CategoryAll as $CategoryDetail){
        $catids .= ','.$CategoryDetail['id'];
        $catids .=kategoricheck($CategoryDetail['id']);
    }


    return $catids;
}


$catids = kategoricheck($Sonuc['id']);
$catids = ltrim($catids,",");

if(!$catids){
    $catids = $Sonuc['id'];
}

if(isset($_GET['kelime'])){
    $where .= "AND adi LIKE '%{$_GET['kelime']}%' OR urun_kodu LIKE '%{$_GET['kelime']}%'";
    $catids = '';
}

$whereArray = array("1",$_SESSION['k_dil']);

if(is_array($_GET['oz'])) {
    $say = 0;
    foreach ($_GET['oz'] as $k => $v) {
        $where .= " AND (";
        foreach ($v as $v2) {
            $vvv = str_replace($k.'_','',$v2);
            $where .= " ozellik REGEXP '".$k."-(.*?)".$vvv."+'  OR";
        }
        $where = rtrim($where, 'OR');
        $where .= " )";
        $say++;
    }
}
if(!empty($catids)){

    $ttsorgu = $db->prepare("SELECT COUNT(*) FROM urunler WHERE durum = ? AND kategori in ({$catids}) AND dil = ?".$where);
}else{
    $ttsorgu = $db->prepare("SELECT COUNT(*) FROM urunler WHERE durum = ? AND dil = ?".$where);
}
$ttsorgu->execute($whereArray);
$total = $ttsorgu->fetchColumn();

$limit= $limitayar['limit_sayfaurunler'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;


if(!empty($catids)){
    $URUNSorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND kategori in ({$catids}) AND dil = ? {$where} ORDER BY {$order_by} LIMIT $show,$limit");
}else{
    $URUNSorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND dil = ? {$where} ORDER BY {$order_by} LIMIT $show,$limit");
}

$URUNSorgu->execute($whereArray);


$URUNislem = $URUNSorgu->fetchALL(PDO::FETCH_ASSOC);

$AllProducts = $URUNislem;

$CategoryCheck = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$Sonuc['id']}'");

function getSubProduct($catID){
    global $db,$where,$order_by,$show,$limit;
    $returnProducts = [];
    $CategoryAll = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$catID}'")->fetchAll(PDO::FETCH_ASSOC);
    if(isset($CategoryAll)){
        
    	foreach($CategoryAll as $CategoryDetail){
    		$whereArrayCat = array("1",$CategoryDetail['id'],$_SESSION['k_dil']);
    		$URUNSorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND kategori = ? AND dil = ? {$where} ORDER BY {$order_by} LIMIT $show,$limit");
    		$URUNSorgu->execute($whereArrayCat);
    		$returnProducts = array_merge($returnProducts,$URUNSorgu->fetchALL(PDO::FETCH_ASSOC));
    		$returnProducts = array_merge($returnProducts,getSubProduct($CategoryDetail['id']));
    	}
	}
	return $returnProducts;
}

if($CategoryCheck->rowCount()){
    $CategoryAll = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$Sonuc['id']}'")->fetchAll(PDO::FETCH_ASSOC);

	foreach($CategoryAll as $CategoryDetail){
		$whereArrayCat = array("1",$CategoryDetail['id'],$_SESSION['k_dil']);
		$URUNSorgu = $db->prepare("SELECT * FROM urunler WHERE durum = ? AND kategori = ? AND dil = ? {$where} ORDER BY {$order_by} LIMIT $show,$limit");
		$URUNSorgu->execute($whereArrayCat);
		$AllProducts = array_merge($AllProducts,$URUNSorgu->fetchALL(PDO::FETCH_ASSOC));
		$AllProducts = array_merge($AllProducts,getSubProduct($CategoryDetail['id']));
	}

}

$newProducts = [];
foreach($AllProducts as $AllProduct){
    $newProducts[$AllProduct['id']] = $AllProduct;
}

$AllProducts = $newProducts;


$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['urunkategoriurl']."/".$Sonuc['seo']."".$html."' OR link = '".$htc['urunkategoriurl']."/".$Sonuc['seo']."".$html."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$katurunsayisi	= $db->query("SELECT * FROM  urunler WHERE durum = '1' AND find_in_set({$Sonuc['id']},kategori) AND dil = '{$_SESSION['k_dil']}'")->rowCount();
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

$bc = breadcrumb($Sonuc['id']);
ksort($bc);

if(isset($_GET['oz'])){
foreach ($_GET['oz'] as $oz){
foreach($oz as $oz2){ ?>
	<script>
		$( document ).ready(function() {
			$('input#<?=$oz2;?>').parent().parent().addClass('show');
		});
	</script>
<?php } } } ?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-1" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan18/<?php echo $arkaplan['arkaplan18'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?php if(isset($_GET['kelime'])){?>
					<?=@$dil['txt408'];?> <?=$_GET['kelime'];?>
				<?php }else{ ?>
					<?php echo $Sonuc['adi'];?>
				<?php }?>
            </div>
        </div>
    </div>
    <!--./vk-banner-->

    <div class="vk-breadcrumb">
        <nav class="container">
            <ul>
                <li><a href="./"><?=@$dil['txt17'];?></a></li>
				<li><a href="<?php echo $htc['urunlerurl'];?><?php echo $html;?>"><?=@$dil['txt90'];?></a></li>
				<?php if(isset($_GET['kelime'])){ ?>
				<?php foreach($bc as $b){?>
					<li><a href="<?php echo $sayfalink;?>"><?=@$dil['txt109'];?> <?=$_GET['kelime'];?></a></li>
				<?php }?>
				<?php }else{ ?>
					<?php foreach($bc as $b){?>
						<li><a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $b['seo'];?><?php echo $html;?>"><?php echo h43KEsAyau_ilkbuyuk($b['adi']);?></a></li>
					<?php }?>
				<?php } ?>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <!--  -->
    <div class="" data-example-id="media-alignment">
        <div class="vk-shop-wrapper">
            <!------ BEGIN SHOP WRAPPER ------>
            <div class="container">
                <div class="vk-space medium"></div>
                <div class="row">
                    <div class="vk-siderbar vk-shop-side-bar clearfix">
                        <div class="col-md-9 right-content">
                            <div class="clearfix"></div>
							<?php if(count($AllProducts)){?>
                            <div class="vk-shop-item vk-shop-item-light-s1 clearfix">								
                                <ul class="vk-list vk-list-inline clearfix ">
									<?php foreach ( $AllProducts as $URUNSonuc ){?>
                                    <li class="col-lg-<?php echo $limitayar['limit_urunler'];?> col-md-<?php echo $limitayar['limit_urunler'];?> col-xs-12">
                                        <div class="item">
                                            <div class="vk-img-frame">
												<?php if($URUNSonuc['yeni'] == 1){?><span class="label"><?=@$dil['txt239'];?></span><?php }?>
												<?php if($URUNSonuc['ifiyat'] != ""){?><span class="label discount"><?=@$dil['txt240'];?></span><?php }?>
                                                <a href="<?php echo $htc['urundetayurl'];?>/<?php echo $URUNSonuc['seo']; ?><?php echo $html;?>" class="vk-img urunler">
                                                    <img src="<?php echo tema;?>/uploads/urunler/<?php echo $URUNSonuc['kapak']; ?>" alt="<?php echo $URUNSonuc['adi']; ?>" />
                                                </a>
                                            </div>     
                                            <a class="vk-text-capitalize uruntitle" href="<?php echo $htc['urundetayurl'];?>/<?php echo $URUNSonuc['seo']; ?><?php echo $html;?>"><?php echo $URUNSonuc['adi']; ?></a>
                                            <div class="vk-divider"></div>

                                            <div class="vk-price-rate clearfix">
												<?php if($moduller['alan25'] == "1"){?>
                                                <div class="price vk-cc-font-bold">
												<?php if($URUNSonuc['ifiyat'] != ""){?>
												<span class="discount"><?php echo para_format($URUNSonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?> </span> <?php echo para_format($URUNSonuc['ifiyat']); ?> <?php echo $ayar['pbirim']; ?>
												<?php }else{?>
												<?php echo para_format($URUNSonuc['fiyat']); ?> <?php echo $ayar['pbirim']; ?>
												<?php }?>
												</div>
												<?php }?>
                                            </div>
                                            <div class="vk-buttons clearfix">
                                                <a href="<?php echo $htc['urundetayurl'];?>/<?php echo $URUNSonuc['seo']; ?><?php echo $html;?>" class="vk-btn  text-uppercase vk-btn-addtocart w-100"><?=@$dil['txt241'];?></a>
                                            </div>
                                        </div>
                                    </li>
									<?php }?>
                                </ul>
                            </div>
							
                            <?php if($limitayar['limit_sayfaurunler'] < $total && $limitayar['limit_sayfaurunler'] > 0){?>
							<!-- PAGE NUMBER -->
							<nav class="box-pagination text-center">
								<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfaurunler'];?> <?=@$dil['txt50'];?></p>
								<ul class="vk-pagination">
									<?php
									if($limitayar['limit_sayfaurunler'] < $total && $limitayar['limit_sayfaurunler'] > 0){
									$showing = 3;
									if($page > 1){?>
									<?php $previous = $page - 1;?>
									<li class="back arrow"><a href="<?php echo $htc['urunkategoriurl'];?>-<?php echo $Sonuc['seo']?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
									<?php }
									for($i= $page - $showing; $i < $page + $showing + 1; $i++){
									if($i > 0 and $i <= $page_count){
									if($i == $page){?>
									<li class="active"><?php echo $i; ?></li>
									<?php }else{?>
									<li><a href="<?php echo $htc['urunkategoriurl'];?>-<?php echo $Sonuc['seo']?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
									<?php }
									}
									}
									if($page != $page_count){?>
									<?php  $next = $page +1;?>
									<li class="next arrow"><a href="<?php echo $htc['urunkategoriurl'];?>-<?php echo $Sonuc['seo']?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
									<?php }} ?>
								</ul>
							</nav>
							<?php }?>					
							
							
                            <div class="vk-space medium hidden-xs hidden-sm"></div>
                            <div class="vk-space large hidden-md hidden-lg"></div>
							
							<?php }else{?>
							<div class="alert alert-warning text-left " style="width:100%;" role="alert">
								<p><strong><?=@$dil['txt51'];?></strong></p>
								<?=@$dil['txt52'];?></br>
								<?=@$dil['txt53'];?>
							</div>
							<?php }?>

                        </div>

                        <div class="col-md-3 left-content">
                            <div class="sidebar-menu">
                                <!---- Input search ---->
                                <div class="vk-search-form  vk-fullwidth">
									<form method="GET">
										<div class="form-group">
											<input type="text" name="kelime" placeholder="<?=@$dil['txt81'];?>" value="<?php if(isset($_GET['kelime'])) { echo $_GET['kelime']; } ?>" class="form-control">
											<button class="vk-btn vk-btn-search"><i class="fa fa-search"></i></button>
										</div>
									</form>
                                </div>
                                <!---- Archives ---->
                                <div class="archives">
									<?php if(isset($_GET['kelime'])){?>
										<h4 class="mb-2"><?=@$dil['txt109'];?> <?=$_GET['kelime'];?> <button class="col-kolaymenu"><span class="icon"><i class="fas fa-bars"></i></span></button></h5>
									<?php }else{ ?>
										<h4 class="mb-2"><?php echo $Sonuc['adi'];?> <button class="col-kolaymenu"><span class="icon"><i class="fas fa-bars"></i></span></button></h5>
									<?php }?>
									<span><?php echo count($AllProducts);?></span> <?=@$dil['txt111'];?>									
									<div class="vk-space x-small"></div>
									<?php if(isset($_GET['kelime'])){?>
									<?php $KATSorgu = $db->prepare("SELECT * FROM urun_kategori WHERE durum = ? AND dil = ? AND ustid = ? ORDER BY sira ASC");
									$KATSorgu->execute(array("1",$_SESSION['k_dil'],0));
									$KATislem = $KATSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<ul class="vk-list vk-menu-right">
										<?php foreach ( $KATislem as $KATSonuc ){
											$catids = $KATSonuc['id'];
											$CategoryCheck = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$catids}'");
											if($CategoryCheck->rowCount()){
												$CategoryAll = $db->query("SELECT * FROM urun_kategori WHERE ustid='{$catids}'")->fetchAll(PDO::FETCH_ASSOC);
												foreach($CategoryAll as $CategoryDetail){
													$catids .= kategoricheck($CategoryDetail['id']);
												}
											}
											?>
											<?php $urunsayisi	= $db->query("SELECT * FROM  urunler WHERE durum = '1' AND kategori in ({$catids}) AND dil = '{$_SESSION['k_dil']}'")->rowCount();?>
											<li><a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $KATSonuc['seo'];?><?php echo $html;?>"><?php echo $KATSonuc['adi']; ?> <span>( <?php echo $urunsayisi;?> )</span></a></li>
										<?php }?>
									</ul>
								<?php }else{ ?>
									<?php $KATSorgu = $db->prepare("SELECT * FROM urun_kategori WHERE durum = ? AND dil = ? AND ustid = ? ORDER BY sira ASC");
									$KATSorgu->execute(array("1",$_SESSION['k_dil'],$Sonuc['id']));
									$KATislem = $KATSorgu->fetchALL(PDO::FETCH_ASSOC);?>
									<?php if($KATSorgu->rowCount()){?>
										<ul class="vk-list vk-menu-right">
											<?php foreach ( $KATislem as $KATSonuc ){?>
												<?php
												$catids = kategoricheck($KATSonuc['id']);
												$catids = ltrim($catids,",");
												if(!$catids){
													$catids = $KATSonuc['id'];
												}
												 $Query = "SELECT * FROM  urunler WHERE durum = '1' AND kategori in ({$catids}) AND dil = '{$_SESSION['k_dil']}'";
												 $urunsayisi	= $db->query($Query)->rowCount();
												 ?>
												<li><a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $KATSonuc['seo'];?><?php echo $html;?>"><?php echo $KATSonuc['adi']; ?> <span>( <?php echo $urunsayisi;?> )</span></a></li>
											<?php }?>
										</ul>
									<?php }else{?>
										<?php $KATSorgu = $db->prepare("SELECT * FROM urun_kategori WHERE durum = ? AND dil = ? AND ustid = ? ORDER BY sira ASC");
										$KATSorgu->execute(array("1",$_SESSION['k_dil'],$Sonuc['ustid']));
										$KATislem = $KATSorgu->fetchALL(PDO::FETCH_ASSOC);?>
										<ul class="vk-list vk-menu-right">
											<?php foreach ( $KATislem as $KATSonuc ){
												$catids = kategoricheck($KATSonuc['id']);
												$catids = ltrim($catids,",");
												if(!$catids){
													$catids = $KATSonuc['id'];
												}
												?>
												<?php $urunsayisi	= $db->query("SELECT * FROM  urunler WHERE durum = '1' AND kategori in ({$catids}) AND dil = '{$_SESSION['k_dil']}'")->rowCount();?>
												<li class="<?php echo ($KATSonuc['seo'] == $Sonuc['seo'] ? 'active' : '');?>"><a href="<?php echo $htc['urunkategoriurl'];?>/<?php echo $KATSonuc['seo'];?><?php echo $html;?>"><?php echo $KATSonuc['adi']; ?> <span>( <?php echo $urunsayisi;?> )</span></a></li>
											<?php }?>
										</ul>
									<?php }?>
								<?php }?>
                                </div>
                                <div class="vk-space x-small"></div>
                                <!-- Filter product -->
								<div class="sidebar-widget">
									<div class="widget-content kolay-menu-filter">
										<div class="sidebar-title">
											<h5><?=@$dil['txt112'];?> <button class="col-kolaymenu-filter"><span class="icon"><i class="fas fa-bars"></i></span></button></h5>
										</div>
										<div id="accordion">
											<form name="filtreler" method="get" action="<?php echo $_SERVER['REQUEST_URI'];?>">
												<?php
												$OZKATSorgu = $db->prepare("SELECT * FROM ozellik_kategori WHERE durum = ? AND find_in_set(?,kategori) ORDER BY sira ASC");
												$OZKATSorgu->execute(array("1",$Sonuc['id']));
												$OZKATislem = $OZKATSorgu->fetchALL(PDO::FETCH_ASSOC); ?>
												<?php foreach ( $OZKATislem as $OZKATSonuc ){ ?>
													<div class="card">
														<div class="card-header">
															<a class="card-link" data-toggle="collapse" href="#<?php echo $OZKATSonuc['seo']; ?>" aria-expanded="false" aria-controls="<?php echo $OZKATSonuc['seo']; ?>">
																<h6 class="mb-0">
																	<?php echo $OZKATSonuc['adi']; ?><i class="fa fa-angle-down rotate-icon float-right"></i>
																</h6>
															</a>
														</div>
														<div id="<?php echo $OZKATSonuc['seo']; ?>" class="collapse" aria-labelledby="<?php echo $OZKATSonuc['seo']; ?>" data-parent="#accordion">
															<div class="card-body pl-2 pb-2 pt-2">
																<?php $OZSorgu = $db->prepare("SELECT * FROM ozellik WHERE durum = ? AND kategori = ? ORDER BY id ASC");
																$OZSorgu->execute(array("1",$OZKATSonuc['id']));
																$OZislem = $OZSorgu->fetchALL(PDO::FETCH_ASSOC);?>
																<?php $dahiller = explode("_", $_GET['oz']);?>
																<?php foreach ( $OZislem as $OZSonuc ){?>
																	<input id="<?php echo $OZSonuc['kategori']; ?>_<?php echo $OZSonuc['id']?>" class="checkbox-custom" name="oz[<?=$OZKATSonuc['id'];?>][]" value="<?php echo $OZSonuc['kategori']; ?>_<?php echo $OZSonuc['id']?>" onclick="filtreler.submit();"

																		<?php if(isset($_GET['oz'])){
																			$gozkat = $_GET['oz'][$OZKATSonuc['id']];
																			if(isset($gozkat)){
																				foreach ($gozkat as $gkat){
																					$katid = $OZSonuc['kategori'].'_'.$OZSonuc['id'];
																					if($gkat == $katid){
																						echo 'checked';
																					}
																				}
																			}
																		} ?>
																		   type="checkbox" style="width:100px;">
																	<label for="<?php echo $OZSonuc['kategori']; ?>_<?php echo $OZSonuc['id']?>" class="checkbox-custom-label"><span class="checktext"><?php echo $OZSonuc['adi']?></span></label>
																<?php }?>
															</div>
														</div>
													</div>
												<?php } ?>
											</form>
										</div>
									</div>
								</div>

                            </div>
                        </div>

                        <div class="vk-space large hidden-md hidden-lg"></div>

                    </div>
                </div>
            </div>
            <!------ END SHOP WRAPPER ------>
        </div>
    </div>
    <!-- / -->
</section>
<!--./content-->