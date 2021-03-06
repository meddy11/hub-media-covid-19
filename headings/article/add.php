<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>COVID-19 Infos | Nouvelle publication</title>
    <meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="theme-color" content="#1565C0">
    <link rel="shortcut icon" href="<?= asset('../assets/img/logo_temp.png', 'covid'); ?>" type="image/x-icon">
    <meta name=author content="Ecole 241">
    <meta name=description
          content="COVID-19 Infos est un système de notifications permettant de suivre l'évolution du coronavirus au Gabon.">
    <meta name=keywords
          content="COVID-19, COVID-19 Infos, Coronavirus, Coronavirus Gabon, Ecole 241, OkaCode, Infos coronavirus, Alert coronavirus, en direct coronavirus, covid19, gabon actualité covid19, gabon recommandation mesures covid19">

    <meta name=og:title content="COVID-19 Infos">
    <meta name=og:type content="website">
    <meta name=og:image content="<?= asset('../assets/img/logo_temp.png', 'covid'); ?>"/>
    <meta name=og:url content="https://covid-19-infos.netlify.com"/>
    <meta name=og:site_name content="COVID-19 Infos">
    <meta name=og:description
          content="COVID-19 Infos est un système de notifications permettant de suivre l'évolution du coronavirus au Gabon.">

    <link rel="stylesheet" href="<?= asset('assets/css/admin.css', 'covid'); ?>">

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
    <main>
        <header>
            <h1>COVID-19 Infos</h1>
            <h2>Nouvelle publication</h2>
        </header>
        <div>
            <p class="message success hide"></p>
        </div>
        <form method="POST" action="<?= route('save') ?>">
            <input type="hidden" name="statut" value="BROUILLON">
            <div class="bloc">
                <label for="pubAuteur">Auteur</label>
                <input type="text" name="auteur" id="pubAuteur" placeholder="Renseignez votre nom (Ex: Jean SAGUE)" required>
            </div>
            <div class="bloc">
                <label for="pubTitre">Titre *</label>
                <input type="text" name="titre" id="pubTitre" placeholder="Donnez un titre à votre publication" required>
            </div>
            <div class="bloc">
                <label for="pubImage">Image *</label>
                <input type="url" name="image" id="pubImage" placeholder="Renseignez l'adresse du lien de l'image" required>
            </div>
            <div class="bloc">
                <label for="pubDescription">Description *</label>
                <textarea name="description" id="pubDescription" cols="30" rows="10" placeholder="Veuillez décrire en quelques mots le contenu de votre publication..."required></textarea>
            </div>
            <div class="bloc">
                <fieldset>
                    <legend>Type de publication</legend>
                    <label for="pubTypeTexte"><input type="radio" checked name="type" id="pubTypeTexte" value="TEXTE" data-target="#contentTypeTexte" required>
                        Texte</label>
                    <label for="pubTypeImage"><input type="radio" name="type" id="pubTypeImage" value="IMAGE" data-target="#contentTypeImage" required>
                        Image</label>
                    <label for="pubTypeVideo"><input type="radio" name="type" id="pubTypeVideo" value="VIDEO" data-target="#contentTypeVideo" required>
                        Vidéo</label>
                    <label for="pubTypeURL"><input type="radio" name="type" id="pubTypeURL" value="URL" required data-target="#contentTypeURL"> URL </label>
                    <label for="pubTypeLocalisation"><input type="radio" name="type" id="pubTypeLocalisation" value="LOCALISATION"
                                                            required data-target="#contentTypeLocalisation"> Localisation</label>
                </fieldset>
            </div>
            <div class="bloc">
                <div class="pubContent" id="contentTypeTexte">
                    <label for="pubContentTexte">Contenu</label>
                    <textarea name="contenu" id="pubContentTexte" cols="30" rows="10" placeholder="Veuillez décrire en quelques mots le contenu de votre type de publication..."required></textarea>
                </div>

                <div class="pubContent hide" id="contentTypeImage">
                    <label for="pubContentImage">URL de l'image en taille réelle</label>
                    <input type="url" id="pubContentImage" placeholder="Renseignez l'URL qui pointe directement sur l'image">
                </div>

                <div class="pubContent hide" id="contentTypeVideo">
                    <label for="pubContentVideo">URL de la vidéo</label>
                    <input type="url" id="pubContentVideo" placeholder="Exemple : https://m.youtube.com/watch?v=yK4OXj-kt-Q">
                </div>

                <div class="pubContent hide" id="contentTypeURL">
                    <label for="pubContentURL">Adresse web</label>
                    <input type="url" id="pubContentURL" placeholder="Renseignez l'URL à publier">
                </div>

                <div class="pubContent hide" id="contentTypeLocalisation">
                    <fieldset>
                        <legend>Coordonnées GPS</legend>
                        <label for="pubLatitude">Latitude</label>
                        <input type="text" id="pubLatitude" placeholder="Exemple : 0.412812">
                        <label for="pubLongitude">Longitude</label>
                        <input type="text" id="pubLongitude" placeholder="Exemple : 9.449617">
                    </fieldset>
                </div>
            </div>
            <div class="bloc">

                <fieldset>
                    <legend>Source</legend>
                    <label for="pubSourceNom">Nom de la source *</label>
                    <input type="text" name="source_nom" id="pubSourceNom" placeholder="Ex: Gabon Media Time" required>
                    <label for="pubSourceURL">URL de la source *</label>
                    <input type="url" name="source_lien" id="pubSourceURL" placeholder="Renseignez le lien de votre source" required>
                </fieldset>

            </div>
            <div class="bloc">

                <fieldset>
                    <legend>Importance</legend>
                    <label for="pubImportanceNormal"><input type="radio" checked name="important" id="pubImportanceNormal"
                                                            value="NORMAL" required> Normal</label>
                    <label for="pubImportanceFakeNews"><input type="radio" name="important" id="pubImportanceFakeNews" value="FAKE"
                                                            required> Fake News</label>
                    <label for="pubImportanceUrgent"><input type="radio" name="important" id="pubImportanceUrgent" value="URGENT"
                                                            required> Urgent</label>
                </fieldset>

            </div>
            <div class="envoyer">
                <input type="submit" value="Soumettre la publication">

            </div>
        </form>

    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="<?= asset('assets/js/utils.js', 'covid'); ?>"></script>
    <script src="<?= asset('assets/js/admin.js', 'covid'); ?>"></script>
</body>
</html>