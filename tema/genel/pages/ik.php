<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['ikurl']."' OR link = '".$htc['ikurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<?php $iksayfa = $db->query("SELECT * FROM sayfalar WHERE sayfa = '1' AND dil = '{$_SESSION['k_dil']}' ORDER BY id ASC LIMIT 1")->fetch();?>
<section class="vk-content">

    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan6/<?php echo $arkaplan['arkaplan6'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt65'];?>
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
                <li class="active"><?=@$dil['txt65'];?></li>
            </ul>
        </nav>
    </div>

    <div class="vk-page vk-page-career">
        <div class="container">
            <div class="row align-items-center">
				<?php if($iksayfa){?>
                <div class="col-md-5 col-xs-12 left">
                    <div class="content-top">
                        <div class="vk-section-style-7">
                            <div class="content">
                                <?php echo $iksayfa['aciklama'];?>
                            </div>
                        </div>
                    </div>                 
                </div>
				<?php }?>

                <div class="<?php echo($iksayfa == true ? 'col-md-7 col-xs-12 right arkarenk2' : 'col-md-12');?>">

                      <div class="content-bot">
                        <div id="message-career"></div>
                        <div class="vk-contact-form">
                            <form method="post" action="_class/site_islem.php" enctype="multipart/form-data" autocomplete="off">
                                <h4 class="vk-title text-uppercase"><?=@$dil['txt253'];?></h4>
                                <div class="vk-divider"></div>
                                <div class="user-info">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i>
                                        <input type="text" name="isim" placeholder="<?=@$dil['txt5'];?>" class="form-control">
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
                                        <i class="fa fa-user"></i>
                                        <input type="text" name="tc" placeholder="<?=@$dil['txt66'];?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-file"></i>
                                        <input type="file" name="cv_dosya" id="file" class="vk-input-file" data-multiple-caption="{count} files selected">
                                        <label for="file" class="input-label">
                                            <span class="input-text"><?=@$dil['txt67'];?></span>
                                            <i class="fa fa-upload"></i>
                                        </label>
                                    </div>
                                </div>

                                <div class="message-content">
                                    <div class="form-group">
                                        <textarea name="mesaj" style="min-height: 330px;" placeholder="<?=@$dil['txt68'];?>" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="vk-buttons">
									<input type="hidden" name="kontrol" value="" id="kontrol">
                                    <button type="submit" name="ikbtn" class="vk-btn vk-btn-default vk-btn-l vk-fullwidth">
                                        <i class="fa fa-paper-plane"></i><?=@$dil['txt74'];?>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
					
                </div>
            </div>
        </div>
    </div>

</section>