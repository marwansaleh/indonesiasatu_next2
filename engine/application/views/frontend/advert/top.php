<?php if ($adverts && isset($adverts[ADV_TYPE_TOP])): ?>
<div class="row">
    <div class="col-sm-12 <?php echo count($adverts[ADV_TYPE_TOP])>1?'flexslider':''; ?>" style="margin-bottom:5px;" id="advert-top-desktop">
        <ul ul class="slides">
            <?php foreach ($adverts[ADV_TYPE_TOP] as $adv): ?>
            <li>
                <?php if ($adv->link_url && $adv->link_url != '#'): ?>
                <a href="<?php echo site_url('click/run/'.$adv->id.'/'.  urlencode(base64_encode($adv->link_url))); ?>" <?php echo $adv->new_window==1?'target="blank"':''; ?>>
                    <img class="img-responsive" src="<?php echo $adv->file_name; ?>">
                </a>
                <?php else: ?>
                <img class="img-responsive" src="<?php echo $adv->file_name; ?>">
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
<?php if (count($adverts[ADV_TYPE_TOP])>1): ?>
<script type="text/javascript">
    $(document).ready(function (){
        $('#advert-top-desktop').flexslider({
            animation: "slide",
            slideshow: true,
            controlNav: false,
            animationLoop: true,
            //itemWidth: 400,
            itemMargin: 0
        });
    });
</script>
<?php endif; 