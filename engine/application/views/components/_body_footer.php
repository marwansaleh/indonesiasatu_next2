<?php if ($adverts && isset($adverts[ADV_TYPE_MOBILE_ARTICLE])):
$this->load->view('frontend/advert/bottom_most');
endif; ?>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="<?php echo site_url('assets/img/logo.png'); ?>" class="img-responsive center-block" />
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="redaksi-container">
                            <p class="redaksi">
                                Penasihat: Letjen TNI (Purn) Kiki Syahnakri<br>
                                <!-- Pendiri: Valens Daki-Soo<br>-->
                                Pendiri/Pemimpin Redaksi: Valens Daki-Soo<br>
                                Redaktur Pelaksana: Simon Leya<br>
                                Penerbit: Divisi Publishing PT VERITAS DHARMA SATYA<br>
                                <!--Website: <a href="http://www.veritasdharmasatya.com" target="_blank" style="color: blue;">www.veritasdharmasatya.com</a><br>-->
                                <!-- SIUP: 01290/24.1.0/31.71-01.1002/1.824.271/2015 -->
                            </p>
                            <p class="alamat">
                                <span class="text-bold alamat-judul">Alamat Redaksi:</span><br>
                                Graha VDS Lantai 2, Jl. Tebet Raya No. 25 Tebet, Jakarta Selatan,<br>
                                Telp:(021) 28542045, 28543705, Fax:(021) 28542232 Email: redaksi@indonesiasatu.co, iklan@indonesiasatu.co<br>
                                Situs: <a href="<?php echo site_url(); ?>">www.indonesiasatu.co</a>, <a href="http://www.veritasdharmasatya.com" target="_blank">www.veritasdharmasatya.com</a><br>
                                Copyright@2015IndonesiaSatu.co
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 kanal-berita">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>PROFIL</h3>
                                <ul class="kanal-list">
                                    <li><a href="<?php echo site_url('staticpage/index/about'); ?>">Tentang kami</a></li>
                                    <li><a href="<?php echo site_url('staticpage/index/redaksi'); ?>">Redaksi</a></li>
                                    <li><a href="<?php echo site_url('staticpage/index/iklan'); ?>">Info iklan</a></li>
                                    <li><a href="<?php echo site_url('contact'); ?>">Hubungi kami</a></li>
                                    <li><a href="<?php echo site_url('staticpage/index/karir'); ?>">Karir</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <h3>KANAL</h3>
                        <div class="row small">
                            <?php $i=1; foreach ($channels as $channel): ?>
                            <div class="col-md-15 col-lg-15" <?php if ($i%6==0) echo 'style="clear:both;"'; ?>>
                                <h6 style="font-size:12px; margin-top: 2px; margin-bottom: 0;">
                                    <a style="color: orange!important;" href="<?php echo site_url('category/'.$channel->slug); ?>"><?php echo $channel->name; ?></a>
                                </h6>
                                <ul class="kanal-list">
                                    <?php foreach ($channel->children as $channel_child): ?>
                                    <li><a href="<?php echo site_url('category/'.$channel_child->slug); ?>"><?php echo $channel_child->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                        <div class="row small">
                            <div class="col-sm-10 pull-right">
                                <div class="row" style="font-size: 10px; margin-top: 9px;">
                                    <div class="col-xs-6 text-right">
                                        <span style="color: #CFA554;">Terbit sejak 1 Desember 2015. Visitor: <?php echo number_format($visitor_count); ?></span><br>
                                        <a href="http://indonesiasatu.co"><span style="color: #FFF;">www.indonesiasatu.co</span></a>
                                    </div>
                                    <div class="col-xs-6 text-left" style="border-left: solid 1px #CCC;">
                                        <span style="color: #CFA554;">Diterbitkan oleh PT. Veritas Dharma Satya</span><br>
                                        <a href="http://www.veritasdharmasatya.com" target="_blank"><span style="color: #FFF;">www.veritasdharmasatya.com</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript">
    $(document).ready(function (){
        $('.flexslider-bottom-advert').flexslider({
            animation: "slide",
            slideshow: true,
            controlNav: false,
            animationLoop: true,
            itemWidth: 300,
            itemMargin: 5
        });
    });
</script>