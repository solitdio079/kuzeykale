<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$Sorgu 	= $db->prepare("SELECT * FROM sorular WHERE durum = ? AND dil = ? ORDER BY sira ASC");
$Sorgu->execute(array("1",$_SESSION['k_dil']));
$collapsed = 1;
$in 	= 1;
$activeblock= 1;
$islem 	= $Sorgu->fetchALL(PDO::FETCH_ASSOC);?>
<?php 
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['sssurl']."' OR link = '".$htc['sssurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan7/<?php echo $arkaplan['arkaplan7'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt84'];?>
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
                <li class="active"><?=@$dil['txt84'];?></li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="vk-page vk-page-faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="vk-faq-wrapper">

                        <div class="vk-toggle vk-toggle-border">
                            <div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true">
								<?php foreach ( $islem as $Sonuc ){?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapse-<?php echo $Sonuc['id'];?>" aria-expanded="true" aria-controls="collapse-<?php echo $Sonuc['id'];?>" class="<?php echo($collapsed++ == "1" ? '' : 'collapsed');?>">
                                                <?php echo $Sonuc['adi'];?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-<?php echo $Sonuc['id'];?>" class="panel-collapse collapse <?php echo($in++ == "1" ? ' in' : '');?>" role="tabpanel">
                                        <div class="panel-body">
                                            <p><?php echo strip_tags($Sonuc['aciklama']);?></p>
                                        </div>
                                    </div>
                                </div>
								<?php }?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--./row-->
        </div>
        <!--./container-->
    </div>
    <!--./vk-page-->

</section>
<!--./content-->