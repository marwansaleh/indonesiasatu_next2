<div class="well well-sm">
    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="<?php echo site_url('newsindex'); ?>">
                <div class="row">
                    <div class="form-group form-group-sm">
                        <div class="col-xs-3">
                            <select class="form-control" name="index_day">
                                <option value="0" <?php echo isset($index_day)&&$index_day==0?'selected':''; ?>>Tanggal</option>
                                <?php for($day=1;$day<=31;$day++): ?>
                                <option value="<?php echo $day; ?>" <?php echo isset($index_day)&&$index_day==$day?'selected':''; ?>><?php echo str_pad($day, 2, "0", STR_PAD_LEFT); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <select class="form-control" name="index_month">
                                <option value="0" <?php echo isset($index_month)&&$index_month==0?'selected':''; ?>>Pilih Bulan</option>
                                <?php foreach ($indonesian_months as $m_index => $m_name): ?>
                                <option value="<?php echo $m_index; ?>" <?php echo isset($index_month)&&$index_month==$m_index?'selected':''; ?>><?php echo $m_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="index_year">
                                <option value="0" <?php echo isset($index_year)&&$index_year==0?'selected':''; ?>>Tahun</option>
                                <?php for($year=$article_years['min'];$year<=$article_years['max'];$year++): ?>
                                <option value="<?php echo $year; ?>" <?php echo isset($index_year)&&$index_year==$year?'selected':''; ?>><?php echo $year; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-default btn-primary btn-block btn-xs" type="submit">Filter</button>
            </form>
        </div>
    </div>
</div>
<div class="main">
    <?php if ($adverts && isset($adverts[ADV_TYPE_MOBILE_BODY])): ?>
    <div id="adv-mobile-body">
        <?php $this->load->view('frontend/advert/mobile_body'); ?>
    </div>
    <?php endif; ?>
    
    <?php if (count($articles)): ?>
    <ul id="news-list" class="media-list">
        <?php foreach ($articles as $article): ?>
        <li class="media">
            <div class="media-left">
                <a href="'+data[i].link_href+'">
                    <img class="media-object" src="<?php echo get_image_thumb($article->image_url, IMAGE_THUMB_SQUARE); ?>">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    <small><?php echo $article->category_name; ?></small><br>
                    <a href="<?php echo site_url('detail/'.$article->url_title); ?>"><?php echo $article->title; ?></a>
                </h4>
                <p class="date"><?php echo date('d/m/Y',$article->date); ?></p>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>Belum ada berita hari ini</p>
    <?php endif; ?>
</div>
