    <style type="text/css">
        .bottom-menu { display: block; margin: auto; padding: 5px 0 5px 0; }
        .bottom-menu a { border-left: solid 1px #cccccc; display: inline-block; float: left; padding: 0 3px 0 3px; line-height: 10px; font-size: 10px; color: #CFA554!important; margin-top: 5px;}
        .bottom-menu a:first-child { border: none; }
    </style>
    
    <?php if ($adverts && isset($adverts[ADV_TYPE_MOBILE_BOTTOM])): ?>
    <?php $this->load->view('frontend/advert/mobile_bottom'); ?>
    <?php endif; ?>
    
    <footer>
        <div id="back-top" class="row">
            <div class="col-xs-12 text-center">
                <a href="#top">Kembali ke atas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="bottom-menu btn-group btn-group-justified" role="group">
                    <a href="<?php echo site_url('category/tajuk'); ?>" class="btn btn-link" role="button">Tajuk</a>
                    <a href="<?php echo site_url('category/berita'); ?>" class="btn btn-link" role="button">Berita</a>
                    <a href="<?php echo site_url('category/ekonomi'); ?>" class="btn btn-link" role="button">Ekonomi</a>
                    <a href="<?php echo site_url('category/hankam'); ?>" class="btn btn-link" role="button">Hankam</a>
                    <a href="<?php echo site_url('category/politik'); ?>" class="btn btn-link" role="button">Politik</a>
                    <a href="<?php echo site_url('category/internasional'); ?>" class="btn btn-link" role="button">Internasional</a>
                    <a href="<?php echo site_url('category/regional'); ?>" class="btn btn-link" role="button">Regional</a>
                </div>
            </div>
        </div>
        <!-- continue bottom news if elements more than 8 elements -->
        <div class="row">
            <div class="col-xs-8  col-xs-offset-2">
                <div class="bottom-menu btn-group btn-group-justified" role="group">
                    <a href="<?php echo site_url('category/inspirasi'); ?>" class="btn btn-link" role="button">Inspirasi</a>
                    <a href="<?php echo site_url('category/opini'); ?>" class="btn btn-link" role="button">Opini</a>
                    <a href="<?php echo site_url('category/refleksi'); ?>" class="btn btn-link" role="button">Refleksi</a>
                    <a href="<?php echo site_url('category/gaya-hidup'); ?>" class="btn btn-link" role="button">Gaya Hidup</a>
                </div>
            </div>
        </div>
        <div class="row" style="border-top: solid 1px #CCC; border-bottom: solid 1px #CCC; margin-top: 5px;">
            <div class="col-xs-12 text-center">
                <div class="btn-group btn-group-justified" role="group">
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/redaksi'); ?>">Redaksi</a>
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/about'); ?>">Tentang Kami</a>
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/iklan'); ?>">Info Iklan</a>
                    <a class="btn btn-link btn-sm" href="<?php echo site_url('staticpage/index/privacypolicy'); ?>">Privacy Policy</a>
                </div>
            </div>
        </div>
        <div class="row" style="font-size: 9px; border-bottom: solid 1px #CCC;">
            <div class="col-xs-6 text-right">
                <span style="color: #CFA554;">
                    Terbit sejak 1 Desember 2015<br>
                    Visitor: <?php echo number_format($visitor_count); ?>
                </span><br>
                <a href="http://indonesiasatu.co"><span>www.indonesiasatu.co</span></a>
            </div>
            <div class="col-xs-6 text-left" style="border-left: solid 1px #CCC;">
                <span style="color: #CFA554;">
                    Diterbitkan oleh<br>
                    PT. Veritas Dharma Satya
                </span><br>
                <a href="http://www.veritasdharmasatya.com" target="_blank"><span>www.veritasdharmasatya.com</span></a>
            </div>
        </div>
        <p class="redaksi" style="font-size: 10px; padding-top: 5px; padding-bottom: 5px; background-color: #424242;">
            Penasihat: Letjen TNI (Purn) Kiki Syahnakri<br>
            Pendiri/Pemimpin Redaksi: Valens Daki-Soo<br>
            Redaktur Pelaksana: Simon Leya
        </p>
        <p class="redaksi" style="font-size: 8px;">
            Graha VDS Lantai 2, Jl. Tebet Raya No. 25 Tebet, Jakarta Selatan Telp:(021) 28542045, 28543705, Fax:(021) 26542232 
            Email: <a href="mailto:redaksi@indonesiasatu.co">redaksi@indonesiasatu.co</a>, 
            <a href="mailto:iklan@indonesiasatu.co">iklan@indonesiasatu.co</a>
        </p>
        <p class="copyright">Copyright &copy; 2015 <a href="<?php echo site_url(); ?>">IndonesiaSatu.co</a> All Rights Reserved<br></p>
    </footer>
    <script type="text/javascript">
            $(document).ready(function(){
                $('.media-list').on('click','.media',function(){
                    if ($(this).attr('data-href')){
                        window.location = $(this).attr('data-href');
                    }
                });
            });
        </script>
    
        <!-- bootstrap -->
        <script src="<?php echo site_url(config_item('path_lib').'bootstrap/js/bootstrap.min.js'); ?>"></script>
        
        <!-- Flexslider -->
        <script src="<?php echo site_url(config_item('path_lib').'flexslider/2.4/jquery.flexslider-min.js'); ?>"></script>
    </body>
</html>