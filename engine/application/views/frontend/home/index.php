<div class="row">
    <!-- Latest news -->
    <div class="col-sm-6 article-box">
        <div class="row">
            <div class="box-title">
                <h2>Berita Terkini </h2>
                <div class="title-line"></div>
            </div>
            <?php $i=1; foreach ($latest_news as $latest): ?>
            <article <?php echo $i==1?'class="first-child"':'';$i++; ?>>
                <figure>
                    <img class="square" src="<?php echo get_image_thumb($latest->image_url, IMAGE_THUMB_SQUARE); ?>" alt="">
                </figure>
                <div class="text">
                    <span class="text-muted small"><?php echo strtoupper($latest->category); ?></span>
                    <h3><a href="<?php echo $latest->url_short ? $latest->url_short : site_url('detail/'.$latest->url_title); ?>"><?php echo $latest->title; ?></a></h3>
                    <span class="info"><?php echo date('d/m/Y',$latest->date); ?></span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php if (isset($politics)): ?>
        <div class="row">
            <div class="box-title">
                <h2><?php echo $politics->name; ?></h2>
                <div class="title-line"></div>
            </div>
            <?php if ($politics->articles): ?>
            <div class="articles-slider">
                <div class="flex-viewport">
                    <?php $i=1; foreach ($politics->articles as $article): ?>

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
                                <p><?php echo $article->synopsis; ?> <a href="<?php echo site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <article>
                        <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                        <div class="text">
                            <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                            <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                        </div>
                    </article>
                    <?php endif; ?>
                    <?php $i++; endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- refleksi -->
        <?php if (isset($category_refleksi)):?>
        <div class="row">
            <div class="box-title">
                <h2><?php echo $category_refleksi->name; ?></h2>
                <div class="title-line"></div>
            </div>
            <?php if ($category_refleksi->articles): ?>
            <div class="articles-slider">
                <div class="flex-viewport">
                    <?php foreach ($category_refleksi->articles as $article): ?>

                    <article>
                        <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                        <div class="text">
                            <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                            <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- internasional -->
        <?php if (isset($category_internasional)):?>
        <div class="row">
            <div class="box-title">
                <h2><?php echo $category_internasional->name; ?></h2>
                <div class="title-line"></div>
            </div>
            <?php if ($category_internasional->articles): ?>
            <div class="articles-slider">
                <div class="flex-viewport">
                    <?php foreach ($category_internasional->articles as $article): ?>

                    <article>
                        <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                        <div class="text">
                            <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                            <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <!-- daerah -->
        <?php if (isset($category_daerah)):?>
        <div class="row">
            <div class="box-title">
                <h2><?php echo $category_daerah->name; ?></h2>
                <div class="title-line"></div>
            </div>
            <?php if ($category_daerah->articles): ?>
            <div class="articles-slider">
                <div class="flex-viewport">
                    <?php foreach ($category_daerah->articles as $article): ?>

                    <article>
                        <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                        <div class="text">
                            <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                            <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <!-- sastra -->
        <?php if (isset($category_sastra)):?>
        <div class="row">
            <div class="box-title">
                <h2><?php echo $category_sastra->name; ?></h2>
                <div class="title-line"></div>
            </div>
            <?php if ($category_sastra->articles): ?>
            <div class="articles-slider">
                <div class="flex-viewport">
                    <?php foreach ($category_sastra->articles as $article): ?>

                    <article>
                        <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                        <div class="text">
                            <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                            <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($adverts && isset($adverts[ADV_TYPE_BOTTOM_LEFT])): ?>
        <?php $this->load->view('frontend/advert/bottom_left'); ?>
        <?php endif; ?>
    </div>
    <!-- start category -->
    <?php foreach ($categories as $index => $category): ?>
    <div class="col-sm-6 article-box">
        <div class="box-title" <?php echo $index>=1?'style="margin-top:20px;"':''; ?>>
            <h2><?php echo $category->name; ?></h2>
            <div class="title-line"></div>
        </div>
        
        <?php if ($category->articles): ?>
        <div class="articles-slider">
            <div class="flex-viewport">
                <?php $i=1; foreach ($category->articles as $article): ?>
                
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
                            <p><?php echo $article->synopsis; ?> <a href="<?php echo site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <article>
                    <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                    <div class="text">
                        <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                        <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                    </div>
                </article>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
    <?php endforeach; ?>
    <!-- category gaya hidup -->
    <?php if (isset($category_gayahidup)):?>
    <div class="col-sm-6 article-box">
        <div class="box-title">
            <h2><?php echo $category_gayahidup->name; ?></h2>
            <div class="title-line"></div>
        </div>
        <?php if ($category_gayahidup->articles): ?>
        <div class="articles-slider">
            <div class="flex-viewport">
                <?php $i=1; foreach ($category_gayahidup->articles as $article): ?>

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
                            <p><?php echo $article->synopsis; ?> <a href="<?php echo site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <article>
                    <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                    <div class="text">
                        <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                        <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                    </div>
                </article>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <?php if (isset($category_hiburan)):?>
    <div class="col-sm-6 article-box">
        <div class="box-title">
            <h2><?php echo $category_hiburan->name; ?></h2>
            <div class="title-line"></div>
        </div>
        <?php if ($category_hiburan->articles): ?>
        <div class="articles-slider">
            <div class="flex-viewport">
                <?php $i=1; foreach ($category_hiburan->articles as $article): ?>

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
                            <p><?php echo $article->synopsis; ?> <a href="<?php echo site_url('detail/'.$article->url_title); ?>">Read more...</a></p>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <article>
                    <figure style="overflow:hidden;"><img class="img-responsive" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SMALL); ?>" alt=""></figure>
                    <div class="text">
                        <h3><a href="<?php echo $article->url_short ? $article->url_short : site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a></h3>
                        <span class="info"><?php echo date('d/m/Y',$article->date); ?></span>
                    </div>
                </article>
                <?php endif; ?>
                <?php $i++; endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

