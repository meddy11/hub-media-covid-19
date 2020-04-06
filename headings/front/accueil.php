<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVID-19 Infos</title>

    <link rel="icon" type="image/x-icon" href="<?= theme_url('covid'); ?>assets/img/logo-covid.png">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="<?= theme_url('covid'); ?>assets/css/mobile.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="active"><i class="fas fa-globe"></i> Actualités</li>
                <li><i class="fas fa-info-circle"></i> Sensibilisation</li>
                <li><i class="fas fa-university"></i> Mesures gouvernementales</li>
                <li><i class="fas fa-newspaper"></i> Points de presse</li>
                <li><i class="fas fa-head-side-cough-slash"></i> Fake news</li>
                <li><i class="fas fa-map"></i> Cartes</li>
                <li><i class="fas fa-gamepad"></i> Jeux</li>
            </ul>
        </nav>
    </header>
    <section class="home">
        <div class="head">
            <h1 class="titre"><span>Hub média</span><span>COVID-19</span></h1>
            <a class="appeler" href="tel:1410">Appeler le 1410<br>gratuitement</a>
        </div>
        <div class="statistiques">
            <div class="tabs">
                <div id="tab-one" class="tab active"><img class="mr-5" src="https://cdn.countryflags.com/thumbs/gabon/flag-400.png" height="15px" alt="Drapeau du Gabon"><span>Gabon</span></div>
                <div id="tab-two" class="tab"><img class="mr-5" src="https://static.thenounproject.com/png/661707-200.png" height="20px" alt="Image de l'Afrique"><span>Afrique</span></div>
            </div>
            <div id="tab-one-content" class="content tab-content">
                <span class="date">Mis à jour le 5 avril à 20:00</span>
                <div class="chiffres">
                    <div class="orange borders-radius-left">
                        <span><span class="nouveau">3</span> nouveaux cas</span>
                        <span class="nombre">24</span>
                        <span>Cas</span>
                    </div>
                    <div class="vert">
                        <span><span class="nouveau">0</span> nouveau cas</span>
                        <span class="nombre">1</span>
                        <span>Guéri</span>
                    </div>
                    <div class="rouge borders-radius-right">
                        <span><span class="nouveau">0</span> nouveaux cas</span>
                        <span class="nombre">1</span>
                        <span>Décès</span>
                    </div>
                </div>
            </div>
            <div id="tab-two-content" class="content tab-content hide">
                <span class="date">Mis à jour le 4 avril à 19:18</span>
                <div class="chiffres">
                    <div class="orange borders-radius-left">
                        <span><span class="nouveau">--</span> nouveaux cas</span>
                        <span class="nombre">1.056.159</span>
                        <span>Cas confirmés</span>
                    </div>
                    <div class="rouge mx-5">
                        <span><span class="nouveau">--</span> nouveaux cas</span>
                        <span class="nombre">57.206</span>
                        <span>Décès</span>
                    </div>
                    <div class="gris borders-radius-right">
                        <span><span class="nouveau">0</span> nouveau pays</span>
                        <span class="nombre">208</span>
                        <span>Pays</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-slider">
        <div class="slider">
            <div class="article-slider border-none">
                <span class="vues"><i class="fa fa-eye"></i> 526</span>
                <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
                <div class="article-slider-titre">Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</div>
            </div>
            <div class="article-slider border-none">
                <span class="vues"><i class="fa fa-eye"></i> 526</span>
                <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
                <div class="article-slider-titre">Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</div>
            </div>
            <div class="article-slider border-none">
                <span class="vues"><i class="fa fa-eye"></i> 526</span>
                <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
                <div class="article-slider-titre">Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</div>
            </div>
        </div>
    </section>
    <section class="articles">
        <div class="article border-none">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article article-fluid">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
            <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article">
            <div>
                <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
            </div>
            <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
        </div>
        <div class="article article-fluid">
            <div>
                <p</p> </div> <img src="https://gaboninfoslive.files.wordpress.com/2016/07/sans-titre-00053.png" alt="article">
            </div>
            <div class="article">
                <div>
                    <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                    <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
                </div>
                <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
            </div>
            <div class="article">
                <div>
                    <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                    <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
                </div>
                <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
            </div>
            <div class="article">
                <div>
                    <p>Coronavirus: gratuité de l'eau et de l'électricité pour 3 mois</p>
                    <div class="actu-footer"><span class="source">Medisite</span><span class="vues"><i class="fa fa-eye"></i> 526</span></div>
                </div>
                <img src="<?= theme_url('covid'); ?>assets/img/actu.jpeg" alt="article">
            </div>
    </section>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        (function() {
            let tabs = document.querySelectorAll('.tab');
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    if (!this.className.includes('active')) {
                        switchTab(this.id)
                    }
                })
            });

            el('.article, .article-slider').forEach(function(article) {
                article.addEventListener('click', function() {
                    location.href = '<?php echo route('front-read') ?>';
                })
            });

            /* Auto play du slider*/
            $('.slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3700,
                arrows: false,
                pauseOnFocus: false,
                infinite: true
            });

            function switchTab(id) {
                let tabs = document.querySelectorAll('.tab');
                tabs.forEach(function(tab) {
                    tab.className = 'tab';
                });

                let tabsContent = document.querySelectorAll('.tab-content');
                tabsContent.forEach(function(content) {
                    content.classList.add('hide');
                    console.log(content.classList)
                });

                let target = document.querySelector('#' + id);
                let targetContent = document.querySelector('#' + id + '-content');
                target.className = 'tab active';
                if (targetContent) {
                    targetContent.classList.remove('hide');
                }
            }

            function el(seletor) {
                return document.querySelectorAll(seletor);
            }
        })();
    </script>
</body>

</html>