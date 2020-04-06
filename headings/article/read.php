<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(_e($data['article']['titre']), ENT_QUOTES, 'UTF-8') ?> | COVID-19 Infos</title>

    <meta name="theme-color" content="#030946">

    <meta name="author" content="Ecole 241">
    <meta name="description" content="<?= htmlspecialchars(_e($data['article']['description']), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="keywords" content="HUB MÉDIA, COVID-19, COVID-19 Infos, Coronavirus, Coronavirus Gabon, Ecole 241, OkaCode, Infos coronavirus, Alert coronavirus, en direct coronavirus, covid19, gabon actualité covid19, gabon recommandation mesures covid19">

    <meta name="og:title" content="<?= htmlspecialchars(_e($data['article']['titre']), ENT_QUOTES, 'UTF-8') ?>">
    <meta name="og:type" content="article">
    <meta name="og:image" content="<?= _e($data['article']['image']) ?>" />
    <meta name="og:url" content="<?= _e($data['article']['share_link']) ?>" />
    <meta name="og:site_name" content="HUB MÉDIA - COVID-19">
    <meta name="og:description" content="<?= htmlspecialchars(_e($data['article']['description']), ENT_QUOTES, 'UTF-8') ?>">

    <link rel="icon" type="image/x-icon" href="<?= asset('assets/img/logo-covid.png', 'covid'); ?>">


    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= asset('assets/css/read.css', 'covid'); ?>">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161415127-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-161415127-1');
    </script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="active" data-url="."><i class="fas fa-globe"></i> Actualités</li>
                <li><i class="fas fa-info-circle"></i> Sensibilisation</li>
                <li><i class="fas fa-university"></i> Mesures gouvernementales</li>
                <li><i class="fas fa-newspaper"></i> Points de presse</li>
                <li><i class="fas fa-head-side-cough-slash"></i> Fake news</li>
                <li><i class="fas fa-map"></i> Cartes</li>
                <li><i class="fas fa-gamepad"></i> Jeux</li>
            </ul>
        </nav>
    </header>
    <main>
        <h1><?= _e($data['article']['titre']) ?></h1>
        <p class="source-date"><a href="<?= _e($data['article']['source_lien']) ?>">Sources :</a> <?= _e($data['article']['source_nom']) ?> - le <?= _e($data['article']['pub_date']) ?></p>
        <img src="<?= _e($data['article']['image']) ?>" alt="<?= _e($data['article']['titre']) ?>">
        <p class="texte">
            <?= _e($data['article']['contenu']) ?>
        </p>
        <div class="like">
            <i class="far fa-thumbs-up"><span></span></i>
            <i class="far fa-thumbs-down fa-flip-horizontal"></i>
        </div>
        <h2 class="fs-17">Partager</h2>
        <div class="share">
            <a href="https://wa.me/?text=<?= $data['article']['share_link'] ?>"><i class="fab fa-whatsapp fa-2x"></i></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $data['article']['share_link'] ?>"><i class="fab fa-facebook fa-2x"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $data['article']['share_link'] ?>&title=<?= _e($data['article']['titre']) ?>&summary=<?= _e($data['article']['description']) ?>&source=<?= $data['article']['share_link'] ?>"><i class="fab fa-linkedin fa-2x"></i></a>
            <a href="https://twitter.com/share?url=<?= $data['article']['share_link'] ?>"><i class="fab fa-twitter-square fa-2x"></i></a>
        </div>
        <div class="lire-aussi">
            <h2>Lire aussi</h2>
            <?php foreach ($data['autres'] as $article) : ?>
                <div class="article" id="<?= $article['id'] ?>">
                    <div>
                        <p><?= $article['titre'] ?></p>
                        <div class="actu-footer"><span class="source"><?= $article['source_nom'] ?></span><span class="vues"><?= ($article['vues'] > 0) ? '<i class="fa fa-eye"></i> ' . $article['vues'] : '' ?></span></div>
                    </div>
                    <img src="<?= $article['image'] ?>" alt="article">
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
        (function() {

            el('.article').forEach(function(article) {
                article.addEventListener('click', function() {
                    if (article.id) {
                        location.href = '<?php echo route('article-read', ['article' => '']) ?>' + article.id;
                    }
                })
            });

            el('nav ul li').forEach(function(rubrique) {
                rubrique.addEventListener('click', function() {
                    if (rubrique.dataset.url) {
                        location.href = rubrique.dataset.url;
                    }
                })
            });

            function el(seletor) {
                return document.querySelectorAll(seletor);
            }
        })();
    </script>

</body>

</html>