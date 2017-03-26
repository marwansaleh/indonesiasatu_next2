<?php foreach ($selected_news_category as $selcat): ?>
<div class="article-box">
    <div class="box-title">
        <h2><?php echo $selcat->name; ?></h2>
        <div class="title-line"></div>
    </div>
    <div class="articles-slider">
        <div class="flex-viewport">
            <?php $i=1; foreach ($selcat->articles as $article): ?>

            <?php if ($i==1): ?>
            <div class="main-article">
                <div class="title">
                    <span><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></span>
                </div>
                <figure>
                    <img class="medium" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_MEDIUM); ?>" alt="">
                </figure>
                <div class="main-text">
                    <div class="inner">
                        <span class="article-info"><?php echo date('d/m/Y',$article->date); ?></span>
                        <p><?php echo $article->synopsis; ?> <a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <article>
                <figure style="overflow:hidden;"><img class="img-responsive small" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                <div class="text">
                    <h3><a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                    <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                </div>
            </article>
            <?php endif; ?>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</div>
<?php endforeach;