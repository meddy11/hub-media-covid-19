<?php

function home()
{
    $articles = x('SELECT * FROM ' . heading('table', 'article') . ' ORDER BY pub_date DESC');

    if ($articles) {
        $articles = $articles->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $articles = array();
    }
    
    $slider = array();

    if (count($articles) > 3) {
        $slider = array_splice($articles, 0, 3);
        /*$articles = array_splice($articles, 3);*/
    }

    $data = array(
        'slider' => $slider,
        'articles' => $articles
    );



    load_page('index', $data);
}

function add()
{
    load_page('add');
}

function read()
{
    $params = array(
        'id' => $_GET['article'],
    );

    $article = one(heading('table'), $params);

    if ($article) {
        $vues = $article['vues'] + 1;
        e(heading('table'), ['vues' => $vues], $article['id']);
        $article['share_link'] = urlencode(root_url() . route('article-read', ['article' => $article['id']]));
        $article['pub_date'] = change_format($article['pub_date']);

        /* Recuperatio d'autres articles */
        $autres = x('SELECT * FROM ' . heading('table') . ' WHERE id <> ' .  $article['id'] . ' LIMIT 5');

        if($autres) {
            $autres = $autres->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $autres = array();
        }

        $data = array(
            'article' => $article,
            'autres' => $autres
        );

        load_page('read', $data);
    } else {
        redirect('article-home');
    }
}


function save()
{
    requiere_post();

    if (isset($_POST['id'])) {

        $params = array(
            'id' => $_POST['id']
        );
        $user = one(heading('table'), $params);

        if ($user) {
            if (!isset($_POST['pass']) or empty($_POST['pass'])) {
                unset($_POST['pass']);
            } else {
                $_POST['pass'] = md5($_POST['pass']);
            }
            $res = e(heading('table'), $_POST, $user['id']);
            if ($res) {
                if ($user['username'] == $_SESSION['u']) {
                    $_SESSION['n'] = $_POST['name'];
                    $profile = (int) $_POST['profile'];
                    switch ($profile) {
                        case 1:
                            $_SESSION['profile'] = 'Administrateur';
                            break;
                        case 2:
                            $_SESSION['profile'] = 'Sage Femme';
                            break;
                        case 3:
                            $_SESSION['profile'] = 'Major';
                            break;
                        case 4:
                            $_SESSION['profile'] = 'Agent de mairie';
                            break;
                    }
                    $_SESSION['p'] = $_POST['profile'];
                    //var_dump($user); dump($_SESSION);
                }
                redirect('user-home');
            } else redirect('user-edit', ['id' => $user['id']]);
        }
    } else {

        //dump($_POST);

        $params = array(
            'titre' => $_POST['titre']
        );

        $article = one(heading('table'), $params);

        if ($article) {

            redirect('article-home');
        }

        $_POST['titre'] = addslashes($_POST['titre']);
        $_POST['description'] = addslashes($_POST['description']);
        $_POST['contenu'] = addslashes($_POST['contenu']);

        $new_article = e(heading('table'), $_POST);

        if ($new_article) {
            redirect('article-home');
        } else {
            l(true);
            redirect('article-add');
        }
    }
}
