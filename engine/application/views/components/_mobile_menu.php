<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nasabah-navbar">
                <span class="sr-only">Mainmenu</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('home'); ?>" style="padding:0 0 0 20%;">
                <img src="<?php echo site_url('assets/img/logo-mobile.png'); ?>" class="img-responsive" style="height: 50px;">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="nasabah-navbar">
            <ul class="nav navbar-nav">
                <li <?php echo $active_menu=='home'?'class="active"':''; ?>><a href="<?php echo site_url(); ?>">Home</a></li>
                <?php if (isset($mainmenus)): ?>
                <?php foreach ($mainmenus as $menu): ?>
                <?php if (count($menu->children)): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php echo ucwords($menu->name); ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($menu->children as $child): ?>
                        <li><a href="<?php echo $child->url; ?>"><?php echo ucfirst($child->name); ?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <?php else: ?> 
                <li <?php echo $active_menu==$menu->slug?'class="active"':''; ?>><a href="<?php echo site_url('category/'.$menu->slug); ?>"><?php echo $menu->name; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="col-sm-12 text-center" style="margin-top: 8px;">
        <span class="small"><?php echo indonesia_date_format('%D, %d %M %Y'); ?></span>
    </div>
</nav>

<div class="row" id="panel-menu-pilihan">
    <div class="col-sm-12">
        <div class="btn-group btn-group-justified">
            <a class="btn btn-link" href="<?php echo site_url('utama'); ?>" style="color: #ffffff; font-size: 16px;">Berita Utama</a>
            <a class="btn btn-link" href="<?php echo site_url('populer'); ?>" style="color: #ffffff; font-size: 16px;">Terpopuler</a>
            <a class="btn btn-link" href="<?php echo site_url('newsindex'); ?>" style="color: #ffffff; font-size: 16px;">Indeks</a>
        </div>
    </div>
</div>

<?php if ($adverts && isset($adverts[ADV_TYPE_MOBILE_TOP])): ?>
<?php $this->load->view('frontend/advert/mobile_top'); ?>
<?php endif; ?>

<div class="well well-sm">
    <div id="main-search">
        <form action="<?php echo site_url('search'); ?>" method="post">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" id="search_input" name="search_input" placeholder="Search" value="<?php echo isset($search_input)?$search_input:''; ?>" />
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
                </div>
            </div>
        </form>
    </div>
</div>