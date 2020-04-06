<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= get('name'); ?> | Setup</title>

    <link href="<?= theme_url('inspinia'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="<?= theme_url('inspinia'); ?>css/animate.css" rel="stylesheet">
    <link href="<?= theme_url('inspinia'); ?>css/style.css" rel="stylesheet">

    <link href="<?= theme_url('inspinia'); ?>css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?= theme_url('inspinia'); ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css"
          rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?= theme_url('inspinia'); ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">

</head>

<body class="top-navigation">

<div id="wrapper">
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

                <a href="dashboard_4.html#" class="navbar-brand"><?= get('name'); ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-reorder"></i>
                </button>

                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="active">
                            <a aria-expanded="false" role="button" href="<?= route('user-home'); ?>"> Retour à
                                l'application</a>
                        </li>

                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="">
                                <i class="fa fa-database"></i> <?= (isset($data['db']) ? $data['db']['base'] : '') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Compte administrateur
                                    <small>Création</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="text-center">
                                    <a class="btn btn-info" href="<?= route('create_admin') ?>">Créer le compte
                                        admin</a>
                                    <p class="mt-3">Un compte sera créé avec <code>admin</code> comme nom d'utilisateur
                                        et <code>1234</code> comme mot de passe.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Base de données
                                    <small>(Description)</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="text-center">
                                    <a class="btn btn-info" href="<?= route('update_schema') ?>">Mettre à jour la
                                        description</a>
                                    <p class="mt-3">La description des tables sera mise à jour par rapport à l'état
                                        actuelle de la base de données.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Exportation
                                    <small>(Exportation les données)</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="text-center">
                                    <a class="btn btn-info" href="<?= route('export_data') ?>">Exporter les données</a>
                                    <p class="mt-3">Cette opération exportera tous les enregistrements de toutes les
                                        tables.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox border-bottom">
                            <div class="ibox-title">
                                <h5>Modification d'une table
                                    <small>(Ajout d'un champ)</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="display: none">
                                <form role="form" method="post" action="<?= route('add_field') ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="table_name">Nom de la table</label>
                                                <select class="form-control" name="table_name" id="table_name" required>
                                                    <option value="">-- Choisir une table --</option>
                                                    <?php foreach ($data['tables'] as $table): ?>
                                                        <option value="<?= $table ?>"><?= $table ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="field_type">Type du champ</label>
                                                <select id="field_type" name="field_type" class="form-control">
                                                    <option value="integer">int</option>
                                                    <option value="string">Chaine de caractères</option>
                                                    <option value="datetime">Datetime</option>
                                                    <option value="date">Date</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="field_default">Valeur par défaut</label>
                                                <select id="field_default" name="field_default" class="form-control">
                                                    <option value="">Aucune</option>
                                                    <option value="custom">Définie</option>
                                                    <option value="NULL">NULL</option>
                                                    <option value="timestamp">CURRENT_TIMESTAMP</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Ajouter après le champ :</label>
                                                <input type="text" placeholder="Laissez vide pour ajouter à la fin"
                                                       name="field_after"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <label>Nom du champ</label>
                                                    <input type="text" placeholder="Nom du champ" name="field_name"
                                                           class="form-control" required>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>&nbsp;</label>
                                                    <div class="checkbox m-r-xs mt-2">
                                                        <input type="checkbox" id="checkbox1" name="field_null">
                                                        <label for="checkbox1">
                                                            NULL
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Taille du champ</label>
                                                <input type="number" placeholder="Taille du champ" name="field_length"
                                                       class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Valeur personnalisée</label>
                                                <input type="text" placeholder="Valeur personnalisée"
                                                       name="field_default_value"
                                                       class="form-control">
                                                <span class="form-text m-b-none">A renseigner si vous avez choisi <b>Définie</b> comme valeur par défaut.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-sm btn-success m-t-n-xs float-left"
                                                type="submit">Ajouter le champ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox border-bottom">
                            <div class="ibox-title">
                                <h5>Nouvelle table
                                    <small>Création</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="display: none;">
                                <div class="text-center">
                                    <form method="post" action="<?= route('create_table') ?>">
                                        <div class="form-group">
                                            <label>Nom de la table</label>
                                            <input type="text" placeholder="Nom de la table à créer" name="table_name"
                                                   class="form-control" required>
                                        </div>
                                        <input type="submit" class="btn btn-info" value="Créer la table"/>
                                    </form>
                                    <p class="mt-3">La table sera créée avec comme seul champ <code>id</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox border-bottom">
                            <div class="ibox-title">
                                <h5>Importation
                                    <small>(Importation des données)</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="display: none;">
                                <div class="text-center">
                                    <form name="form_import" method="post" enctype="multipart/form-data"
                                          action="<?= route('import_data') ?>">
                                        <label class="btn btn-info" for="backup_file">
                                            <i class="fa fa-upload"></i> Importer des données
                                            <input type="file" accept="application/json" id="backup_file"
                                                   onchange="document.form_import.submit()"
                                                   name="backup_file" style="display:none">
                                        </label>
                                    </form>
                                    <p class="mt-3">Cette opération remplira les tables de la base de données.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 border-danger">
                        <div class="ibox border-bottom">
                            <div class="ibox-title">
                                <h5 class="text-danger">Supprimer une table</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="display: none;">
                                <div class="text-center">
                                    <form method="post" action="<?= route('drop_table') ?>">
                                        <div class="form-group">
                                            <label for="table_name">Nom de la table</label>
                                            <select class="form-control border-danger" name="table_name" id="table_name"
                                                    required>
                                                <option value="">-- Choisir une table --</option>
                                                <?php foreach ($data['tables'] as $table): ?>
                                                    <option value="<?= $table ?>"><?= $table ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-danger" value="Supprimer la table"/>
                                    </form>
                                    <p class="text-danger mt-3"><i class="fa fa-warning"></i> La table sera supprimée de
                                        manière permanente</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox border-bottom">
                            <div class="ibox-title">
                                <h5 class="text-danger">Base de données
                                    <small>Mise à zéro</small>
                                </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-down"></i>
                                    </a>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content" style="display: none;">
                                <div class="text-center">
                                    <a class="btn btn-danger" href="<?= route('reset_db') ?>">Réinitialiser la base de
                                        données</a>
                                    <p class="text-danger mt-3">Attention cette opération supprimera toutes les données
                                        contenues dans les tables.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="float-right">
                by <strong><?= $app['author']['name']; ?></strong>
            </div>
            <div>
                <strong>Copyright</strong> <?= (isset($app['owner']) ? $app['owner'] : $app['author']['name']); ?> &copy; 2019
            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?= theme_url('inspinia'); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?= theme_url('inspinia'); ?>js/popper.min.js"></script>
<script src="<?= theme_url('inspinia'); ?>js/bootstrap.js"></script>
<script src="<?= theme_url('inspinia'); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= theme_url('inspinia'); ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= theme_url('inspinia'); ?>js/inspinia.js"></script>
<script src="<?= theme_url('inspinia'); ?>js/plugins/pace/pace.min.js"></script>


<!-- Toastr -->
<script src="<?= theme_url('inspinia'); ?>js/plugins/toastr/toastr.min.js"></script>

<?php $flash = get_flash(); ?>
<?php if ($flash) : ?>
    <script>
        $(document).ready(function () {
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 8 * 1000
                };
                <?php if ($flash['type'] == 'success'): ?>
                toastr.success("<?= $flash['message']; ?>", 'Opération réussie');
                <?php elseif ($flash['type'] == 'error') : ?>
                toastr.error("<?= $flash['message']; ?>", 'Opération échouée');
                <?php endif; ?>
            }, 1300);
        });
    </script>
<?php endif; ?>


<!-- iCheck -->
<script src="<?= theme_url('inspinia'); ?>js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>

</html>
