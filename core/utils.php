<?php

function get($item)
{
    $config = get_config();

    return $config[$item];
}

function show($item)
{
    echo get($item);
}

function _e($item)
{
    return isset($item) ? $item : '';
}

function get_config()
{
    $json_str = file_get_contents('config/app.json');

    return json_decode($json_str, true);
}

function get_path()
{
    $page = 'home';
    $app = get_config();

    if (!empty($_GET)) {
        $route = current(array_keys($_GET));
        if (empty(trim($_GET[$route]))) $page = $route;
    } else {
        $page = $app['home_route'];
    }

    $parts = explode('-', $page);
    $head_req = $parts[0];
    $heading = '';
    $handler = '';

    foreach ($app['headings'] as $head_temp) {
        if ($head_req == $head_temp['name']) {
            $heading = $head_temp;
            break;
        }
    }

    if ($heading) {
        define('HEADING', $heading['name']);
        $cruds_path = './headings/' . $heading['dir'] . '/cruds.php';
        if (file_exists($cruds_path)) {
            require_once $cruds_path;
            if (count($parts) > 1 and !empty(trim($parts[1]))) {
                if (function_exists($parts[1])) {
                    $handler = $parts[1];
                }
            }
        }
    }
    return $handler;
}

function load_view($viewname, $data = array())
{
    $app = get_config();
    $view_path = './headings/' . heading('dir') . '/' . $viewname . '.php';

    require_once './themes/' . $app['theme'] . '/head.php';

    if (file_exists($view_path)) require_once $view_path;
    else require_once './themes/' . $app['theme'] . '/404_view.php';

    require_once './themes/' . $app['theme'] . '/footer.php';
}

function generate_view($viewname)
{
    $data['fields'] = get_fields(heading('table'));

    if ($data['fields'] == false) {
        $data['fields'] = array();
        flash(l('return'), 'error');
    }

    $app = get_config();
    $view_path = './headings/sample/' . $viewname . '.php';

    require_once './themes/' . $app['theme'] . '/head.php';

    if (file_exists($view_path)) require_once $view_path;
    else require_once './themes/' . $app['theme'] . '/404_view.php';

    require_once './themes/' . $app['theme'] . '/footer.php';
}

function load_page($pagename, $data = array())
{
    $app = get_config();
    require_once './headings/' . heading('name') . '/' . $pagename . '.php';
}

function show_404()
{
    $app = get_config();
    require_once './themes/' . $app['theme'] . '/404.php';
}

function requiere_post()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        show_404();
    }
}

function heading($param, $heading = '')
{
    $app = get_config();

    foreach ($app['headings'] as $head_temp) {
        if ($heading) {
            if ($heading == $head_temp['name']) {
                return (isset($head_temp[$param])) ? $head_temp[$param] : '';
            }
        } else {
            if (HEADING == $head_temp['name']) {
                return (isset($head_temp[$param])) ? $head_temp[$param] : '';
            }
        }
    }

    return '';
}

function route($handler, $params = array(), $heading = '')
{
    if (strpos($handler, '-')) {
        $parts = explode('-', $handler);
        if (count($parts) > 1) {
            $heading = $parts[0];
            $handler = $parts[1];
        }
    }
    $qs = '';
    foreach ($params as $key => $value) $qs .= '&' . $key . '=' . $value;
    return '?' . ((empty($heading)) ? heading('name') : $heading) . '-' . $handler . $qs;
}

function redirect($route, $params = array())
{
    if (strpos($route, '-') == FALSE) $route = heading('name') . '-' . $route;
    $qs = '';
    foreach ($params as $key => $value) $qs .= '&' . $key . '=' . $value;
    $link = root_url() . '?' . $route . $qs;
    header('Location: ' . $link);
    exit();
}

function dump(...$var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

function set_case($text, $case)
{
    switch ($case) {
        case 'upper':
            return strtoupper($text);
        case 'lower':
            return strtolower($text);
        case 'first':
            return ucfirst($text);
        case 'words':
            return ucwords($text);
        default:
            return $text;
    }
}

function get_data()
{
    $data = array();

    $r = s(heading('table'));
    if ($r) $data = $r;

    return array_map(function ($item) {
        $columns = heading('listing')['columns'];
        foreach ($columns as $label => $column) {
            if (is_array($column)) {
                if (isset($column['matching'])) {
                    if (isset($item[$label])) {
                        if (isset($column['matching'][$item[$label]])) $item[$label] = $column['matching'][$item[$label]];
                    }
                }
                if (isset($column['relation'])) {
                    if (isset($column['relation']['table']) and isset($column['relation']['field'])) {
                        $table = $column['relation']['table'];
                        $field = $column['relation']['field'];
                        if (isset($item[$label])) {
                            $one = one($table, ['id' => $item[$label]]);
                            if ($one and isset($one[$field]))
                                $item[$label] = $one[$field];
                        }
                    }
                }
                if (isset($column['format'])) {
                    $item[$label] = date('d M Y', strtotime($item[$label]));
                }
                if (isset($column['case'])) {
                    $item[$label] = set_case($item[$label], $column['case']);
                }
            }
        }
        return $item;
    }, $data);
}

function push_data($view = 'index')
{
    load_view($view, get_data());
}

function session($param)
{
    if (isset($_SESSION[$param]))
        return $_SESSION[$param];
    else
        return '';
}

function ends_with($text, $needle)
{
    return strpos($text, $needle, strlen($text) - 1);
}

function root_url()
{
    $app = get_config();
    $root_url = is_prod() ? $app['prod_url'] : $app['root_url'];
    if (!ends_with($root_url, '/')) $root_url .= '/';
    return $root_url;
}

function theme_url($theme = null)
{
    $app = get_config();
    $theme = ($theme) ? $theme : $app['theme'];
    return root_url() . 'themes' . '/' . $theme . '/';
}

function asset($ressource, $theme = null)
{
    $app = get_config();
    return theme_url($theme) . $ressource . '?ver=' . $app['version'];
}

function has_actions_grouped()
{
    foreach (heading('listing')['actions'] as $action) {
        if (isset($action['group']) and $action['group'] and has_right($action)) return true;
    }
    return false;
}

function get_actions($view)
{
    $actions = array();
    foreach (heading($view)['actions'] as $action) {
        $actions[$action['type']] = $action;
    }
    return $actions;
}

function has_right($item)
{
    return !(isset($item['deny']) and in_array(session($item['deny']['session']), $item['deny']['values']));
}

function change_format($date)
{
    return utf8_encode(strftime("%e %B %Y", strtotime($date)));
}

function is_prod()
{
    $app = get_config();
    return strpos($app['prod_url'], $_SERVER['HTTP_HOST']);
}

function flash($message, $type = 'success')
{
    $_SESSION['flash'] = array(
        'message' => $message,
        'type' => $type
    );
}

function get_flash()
{
    $flash = (isset($_SESSION['flash'])) ? $_SESSION['flash'] : null;
    unset($_SESSION['flash']);
    return $flash;
}

function apostrophe($str)
{
    $voyelles = array("a", "e", "i", "o", "u", "h");
    $str = strtolower($str);
    $str = substr($str, 0, 1);
    return in_array($str, $voyelles);
}

function get_fields($table)
{
    $fields = array();

    $res = x("DESCRIBE `{$table}`;");

    if (!$res) return false;

    $desc = $res->fetchAll(PDO::FETCH_ASSOC);

    foreach ($desc as $detail) {

        $field = [];

        if (strtolower($detail['Field']) == 'id') continue;

        $name = $detail['Field'];
        $field['name'] = $name;

        if ($detail['Null'] == 'NO') $field['required'] = true;

        $add_config = heading('add');
        if (isset($add_config['fields'][$name])) {
            $field_config = $add_config['fields'][$name];

            if (isset($field_config['type'])) {
                if (!isset($field_config['options'])) {
                    $field_config['options'] = array("0" => "-- Aucune valeur --");
                } else {
                    if (isset($field_config['options']['table']) and isset($field_config['options']['field'])) {
                        $table = $field_config['options']['table'];
                        $value = $field_config['options']['field'];
                        $res = s($table);
                        if ($res) {
                            $field_config['options'] = [];
                            foreach ($res as $item) {
                                $field_config['options'][$item['id']] = $item[$value];
                            }
                        }
                    }
                }
            }
            $field = array_merge($field, $field_config);
        }

        $fields[] = $field;
    }

    return $fields;
}
