<?php echo !defined("GUVENLIK") ? die("Erisim Engellendi!.") : null;?>
<?php 
$menubul 	= $db->query("SELECT * FROM menu WHERE menu_url = '".$htc['iletisimurl']."' OR link = '".$htc['iletisimurl']."' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
$menubas 	= $db->query("SELECT * FROM menu WHERE id = '{$menubul['menu_ust']}' AND dil = '{$_SESSION['k_dil']}'")->fetch(PDO::FETCH_ASSOC);
?>
<section class="vk-content">
    <div class="vk-banner vk-background-image-3" style="background-image: url(<?php echo tema;?>/uploads/arkaplan/arkaplan14/<?php echo $arkaplan['arkaplan14'];?>)">
        <div class="vk-background-overlay vk-background-black-1 _80"></div>
        <div class="container wrapper">
            <div class="page-heading">
                <?=@$dil['txt70'];?>
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
				<li class="active"><?=@$dil['txt70'];?></li>
            </ul>
        </nav>
    </div>

    <div class="vk-page vk-page-contact">
        <div class="container">
            <div class="vk-map">
                <?php echo maps;?>
            </div>

            <div class="vk-contact">
                <div class="row">
                    <div class="col-md-9 left-content">
                        <h4 class="vk-heading text-uppercase"><?=@$dil['txt259'];?></h4>
                        <div id="message-contact"></div>
                        <form method="post" action="_class/site_islem.php" autocomplete="off">
                            <div class="vk-contact-form">
                                <div class="user-info">
                                    <div class="form-group">
                                        <i class="fa fa-user"></i>
                                        <input type="text" name="isim" placeholder="<?=@$dil['txt5'];?>" class="form-control validate-required">
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-phone"></i>
                                        <input type="tel" name="telefon" placeholder="<?=@$dil['txt7'];?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" name="email" placeholder="<?=@$dil['txt6'];?>" class="form-control validate-required validate-email">
                                    </div>
                                    <div class="form-group">
                                        <i class="fa fa-pencil-square-o"></i>
                                        <input type="text" name="konu" placeholder="<?=@$dil['txt72'];?>" class="form-control">
                                    </div>
                                </div>
                                <div class="message-content">
                                    <div class="form-group">
                                        <textarea name="mesaj" placeholder="<?=@$dil['txt73'];?>" class="form-control validate-required"></textarea>
                                    </div>
                                </div>

                                <div class="vk-buttons">
									<input type="hidden" name="kontrol" value="" id="kontrol">	
									<input type="hidden" name="iletisimurl" value="<?php echo $sayfalink;?>" />
                                    <button type="submit" name="mesajbtn" class="btn_1 rounded vk-btn vk-btn-default vk-btn-l vk-fullwidth">
                                        <i class="fa fa-paper-plane" id="submit-contact"></i><?=@$dil['txt74'];?>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="col-md-3 right-content">
                        <div class="contact-info">
                            <h4 class="vk-heading text-uppercase"><?=@$dil['txt223'];?></h4>
                            <ul class="vk-list vk-office">
                                <?php if(adres){?><li><i class="fa fa-map-marker"></i><?php echo adres;?></li><?php }?>
                                <?php if(email){?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo email;?>"><?php echo email;?></a></li><?php }?>
                                <?php if(telefon){?><li><i class="fa fa-phone"></i><a href="tel:<?php echo telefon;?>"><?php echo telefon;?></a></li><?php }?>
                                <?php if(fax){?><li><i class="fa fa-fax"></i><?php echo fax;?></li><?php }?>
                            </ul>
                        </div>
						
						<?php if($moduller['alan27'] == "1"){?>
						<ul class="vk-list vk-social-link mb-3">
							<?php if(facebook){?><li class="facebook"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-facebook-f"></a></li><?php }?>
							<?php if(linkedin){?><li class="linkedin"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-linkedin-in"></a></li><?php }?>
							<?php if(twitter){?><li class="twitter"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-twitter"></a></li><?php }?>
							<?php if(instagram){?><li class="instagram-sosyal"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-instagram"></a></li><?php }?>
							<?php if(youtube){?><li class="youtube"><a target="_blank" href="<?php echo facebook;?>" class="fab fa-youtube"></a></li><?php }?>
						</ul>
						<?php }?> 

						<?php if($moduller['alan28'] == "1"){?>
                        <div class="business-hours">
                            <h5 class="vk-heading text-uppercase"><?=@$dil['txt235'];?> </h5>
                            <ul class="vk-list vk-office">
                                <li><i class="fa fa-clock-o"></i><?=@$dil['txt236'];?></li>
                            </ul>
                        </div>
                        <?php }?>
                    </div>

                </div>
            </div>
        </div>
        <div class="vk-space x-medium"></div>
    </div>
</section>