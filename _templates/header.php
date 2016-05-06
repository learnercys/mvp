<?php
include_once __DIR__.'/l10n.php';

if (!isset($l10n)) {
   $l10n = new Translator();
}
$page['lang'] = $l10n->lang();

$page['lang-root'] = $sitewide['root'];
if (isset($page['lang']) && $page['lang'] != 'en') {
    $page['lang-root'] .= $page['lang'].'/';
}
if (!isset($page['path'])) {
    $page['path'] = str_replace($sitewide['root'], '/', $sitewide['path']);
    $page['path'] = str_replace('/'.$page['lang'].'/', '/', $page['path']);
}
if (!isset($page['name'])) {
    $page['name'] = trim(preg_replace('#\.php$#', '', $page['path']), '/');
    if (empty($page['name'])) {
        $page['name'] = 'index';
    }
}
if (isset($page['title'])) {
    $page['title'] = $l10n->translate($page['title'], $page['name']);
}

$l10n->init();
$l10n->set_domain('layout');
$l10n->begin_html_translation();
?>
<!doctype html>
<!--[if IE]><html lang="<?php echo !empty($page['lang']) ? $page['lang'] : 'en'; ?>" class="ie-legacy"><![endif]-->
<!--[if !IE]><!--><html lang="<?php echo !empty($page['lang']) ? $page['lang'] : 'en'; ?>"><!--<![endif]-->
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>">
        <meta name="author"      content="<?php echo !empty($page['author']) ? $page['author'] : $sitewide['author']; ?>">
        <meta name="theme-color" content="<?php echo !empty($page['theme-color']) ? $page['theme-color'] : $sitewide['theme-color']; ?>">

        <meta name="twitter:card"        content="summary_large_image">
        <meta name="twitter:site"        content="@elementary">
        <meta name="twitter:creator"     content="@elementary">

        <meta property="og:title"       content="<?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?>" />
        <meta property="og:description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>" />
        <meta property="og:image"       content="<?php echo !empty($page['image']) ? $page['image'] : $sitewide['image']; ?>" />

        <meta itemprop="name"        content="<?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?>" />
        <meta itemprop="description" content="<?php echo !empty($page['description']) ? $page['description'] : $sitewide['description']; ?>" />
        <meta itemprop="image"       content="<?php echo !empty($page['image']) ? $page['image'] : $sitewide['image']; ?>" />

        <meta name="apple-mobile-web-app-title" content="elementary">
        <link rel="manifest" href="/manifest.json">

        <title><?php echo !empty($page['title']) ? $page['title'] : $sitewide['title']; ?></title>

        <base href="<?php echo $sitewide['root']; ?>">

        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="images/launcher-icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="images/favicon.png" sizes="256x256">

        <?php if (!empty($page['lang']) && $page['lang'] != 'en') { ?>
        <link rel="alternate" type="text/html" hreflang="en" href="<?php echo $sitewide['root'].(($page['name'] == 'index') ? '' : $page['name']); ?>">
        <link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Raleway:100,100italic|Open+Sans:300,400,600,300italic,400italic|Droid+Sans|Roboto+Mono&subset=latin,greek,vietnamese,greek-ext,latin-ext,cyrillic,cyrillic-ext">
        <?php } else { ?>
        <link rel="alternate" type="text/html" hreflang="en" href="<?php echo $sitewide['root'].(($page['name'] == 'index') ? '' : $page['name']); ?>">
        <link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Raleway:100,100italic|Open+Sans:300,400,600,300italic,400italic|Droid+Sans|Roboto+Mono">
        <?php } ?>

        <link rel="stylesheet" type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="all" href="styles/main.css">

        <script>
            (function(d,s,f){g=d.createElement(s),u=d.getElementsByTagName(s)[0],g.async=1,g.src=f,u.parentNode.insertBefore(g,u)})
            (document,'script','https:<?php echo $sitewide['branch_root']; ?>backend/hsts.php')
        </script>

        <script>
            <?php include __DIR__.'/../scripts/jql.min.js'; ?>
            jQl.loadjQ('//cdn.jsdelivr.net/g/jquery');
            jQl.boot();
            <?php include __DIR__.'/../scripts/popover.js'; ?>
            <?php include __DIR__.'/../scripts/smooth-scrolling.js'; ?>
            <?php include __DIR__.'/../scripts/twitter-links.js'; ?>
            <?php include __DIR__.'/../scripts/external-links.js'; ?>
        </script>

        <?php echo !empty($page['scripts']) ? $page['scripts'] : false; ?>

        <?php if ( $trackme ) { ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-19280770-1', 'auto');
            ga('set', 'forceSSL', true);
            ga('set', 'anonymizeIp', true);
            ga('require', 'displayfeatures');
            ga('send', 'pageview');
            ga('send', 'event', 'Language', 'Pageload', document.documentElement.lang);
        </script>
        <?php } ?>

    </head>
    <body class="page-<?php echo $page['name']; ?>">
        <nav class="nav">
            <div class="nav-content">
                <ul>
                    <li><a href="<?php echo $page['lang-root']; ?>" class="logomark"><?php include __DIR__.'/../images/logomark.svg'; ?></a></li>
                    <li><a href="http://blog.elementary.io">Blog</a></li>
                    <li><a href="<?php echo $page['lang-root'].'support'; ?>">Support</a></li>
                    <!-- <li><a href="<?php echo $page['lang-root'].'store'; ?>">Store</a></li> -->
                </ul>
                <ul class="right">
                    <li><a href="<?php echo $page['lang-root'].'developer'; ?>">Developer</a></li>
                    <li><a href="<?php echo $page['lang-root'].'get-involved'; ?>">Get Involved</a></li>
                </ul>
            </div>
        </nav>
        <div id="content-container">
<?php
$l10n->set_domain($page['name']);
