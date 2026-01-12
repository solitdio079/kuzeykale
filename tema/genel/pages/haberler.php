<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$page = @intval($_GET['s']);
if(!$page) $page = 1;
$ttsorgu = $db->prepare("SELECT COUNT(*) FROM haberler WHERE durum = ? AND dil = ?");
$ttsorgu->execute(array("1",$_SESSION['k_dil']));
$total = $ttsorgu->fetchColumn();
$limit= $limitayar['limit_sayfahaber'];
$page_count = ceil($total/$limit);
if($page > $page_count) $page = 1;
$show = $page * $limit - $limit;
$BSorgu = $db->prepare("SELECT * FROM haberler WHERE durum = ? AND dil = ? ORDER BY sira ASC LIMIT $show,$limit");
$BSorgu->execute(array("1",$_SESSION['k_dil']));
$Bislem = $BSorgu->fetchALL(PDO::FETCH_ASSOC);
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['haberurl']."' OR link = '".$htc['haberurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan13/<?php echo $arkaplan['arkaplan13'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt59'];?>
            </div>
        </div>
    </div>

    <div class="vk-breadcrumb">
        <nav class="container">
            <ul>
                <li><a href="./"><?=@$dil['txt17'];?></a></li>
				<?php if($menubas['menu_isim'] != ""){?>
				<li><a href="<?php echo($menubas['menu_url'] == "0" ? $menubas['link'] : $menubas['menu_url'].$html);?>"><?php echo h43KEsAyau_ilkbuyuk($menubas['menu_isim']);?></a></li>
				<?php }?>
				<li class="active"><?=@$dil['txt59'];?></li>
            </ul>
        </nav>
    </div>

    <div class="" data-example-id="media-alignment">
        <div class="vk-blog-wrapper vk-blog-grid">
            <div class="container">
                <div class="row">
                    <div class="blog-list clearfix">
                        <div class="col-md-12">
                            <div class="blog-content">
								<?php if($BSorgu->rowCount() != "0"){?>
                                <div class="row">
									<?php foreach ( $Bislem as $BSonuc ){?>
                                    <div class="col-lg-<?php echo $limitayar['limit_haber'];?> col-md-<?php echo $limitayar['limit_haber'];?> col-sm-12">
                                        <div class="content-box">

                                            <div class="vk-img-frame haberler">
                                                <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>" class="vk-img">
                                                    <img src="<?php echo tema;?>/uploads/haberler/<?php echo $BSonuc['resim']; ?>" alt="<?php echo $BSonuc['adi']; ?>">
                                                </a>
                                            </div>

                                            <div class="content haber-p">
                                                <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>">
                                                    <h4 class="vk-text-uppercase"><?php echo $BSonuc['adi']; ?></h4>
                                                </a>
                                                <div class="vk-divider"></div>
                                                <p><?php echo $BSonuc['spot']; ?></p>
                                                <div class="vk-buttons">
                                                    <a href="<?php echo $htc['haberdetayurl']; ?>/<?php echo $BSonuc['seo']; ?><?php echo $html;?>" class="vk-btn vk-btn-transparent text-uppercase vk-btn-readmore"><?=@$dil['txt37'];?>
                                                        <i class="fa fa-long-arrow-right"></i>
													</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
									<?php }?>
                                </div>
								
								<?php if($limitayar['limit_sayfahaber'] < $total && $limitayar['limit_sayfahaber'] > 0){?>
                                <nav class="box-pagination text-center">
									<p class="text-center"><?php echo $total;?> <?=@$dil['txt49'];?>  <?php echo $page;?> - <?php echo $limitayar['limit_sayfahaber'];?> <?=@$dil['txt50'];?></p>
                                    <ul class="vk-pagination">
                                        <?php
										if($limitayar['limit_sayfahaber'] < $total && $limitayar['limit_sayfahaber'] > 0){
										$showing = 3;
										if($page > 1){?>
										<?php $previous = $page - 1;?>
										<li class="back arrow"><a href="<?php echo $htc['haberurl'];?>/<?php echo $previous;?><?php echo $html;?>"><?=@$dil['txt24'];?></a></li>
										<?php }
										for($i= $page - $showing; $i < $page + $showing + 1; $i++){
										if($i > 0 and $i <= $page_count){
										if($i == $page){?>
										<li class="active"><?php echo $i; ?></li>
										<?php }else{?>
										<li><a href="<?php echo $htc['haberurl'];?>/<?php echo $i; ?><?php echo $html;?>"><?php echo $i; ?></a></li>
										<?php }
										}
										}
										if($page != $page_count){?>
										<?php  $next = $page +1;?>
										<li class="next arrow"><a href="<?php echo $htc['haberurl'];?>/<?php echo $next; ?><?php echo $html;?>"><?=@$dil['txt25'];?></a></li>
										<?php }} ?>
                                    </ul>
                                </nav>
								<?php }?>								
								<?php }else{?>
								<div class="alert alert-warning text-left" style="width:100%;" role="alert">
									<p><strong><?=@$dil['txt51'];?></strong></p>
									<?=@$dil['txt52'];?></br>
									<?=@$dil['txt53'];?>
								</div>
								<?php }?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>