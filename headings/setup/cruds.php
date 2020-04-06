<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 01/11/2019
 * Time: 20:13
 */

function home()
{
    $data['db'] = DBINFOS::get_config();
    $data['tables'] = array();

    $res = x('SHOW TABLES;');

    if ($res) {
        $tables = $res->fetchAll(PDO::FETCH_NUM);
        foreach ($tables as $details) {
            $table = $details[0];
            array_push($data['tables'], $table);
        }
    } else {
        flash(l('return'), 'error');
    }

    load_page('index', $data);
}

function drop_db()
{
    $sql = 'DROP DATABASE `pad`;';

    x($sql);
}

function create_table()
{
    requiere_post();

    $table = $_POST['table_name'];

    $sql = "CREATE TABLE IF NOT EXISTS `{$table}` (`id` int(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`));";

    $res = x($sql);

    if (!$res) {
        flash(l('return'), 'error');
        redirect('setup-home');
    } else {
        flash("La table '{$table}' a bien été créée");
        redirect('setup-home');
    }
}

function drop_table()
{
    requiere_post();

    $table = $_POST['table_name'];

    $sql = "DROP TABLE `{$table}`;";

    $res = x($sql);

    if (!$res) {
        flash(l('return'), 'error');
        redirect('setup-home');
    } else {
        flash("La table '{$table}' a bien été supprimée");
        redirect('setup-home');
    }
}

function reset_db()
{
    //drop_db();

    $db_desc_json = file_get_contents('config/tables.json');
    $db_desc = json_decode($db_desc_json, true);

    $sql = '';

    foreach ($db_desc as $table) {



        if (isset($table['timestamp']) and $table['timestamp']) {
            array_push($table['fields'], ["name" => "created_at", "type" => "datetime", "default" => "timestamp"]);
            array_push($table['fields'], ["name" => "updated_at", "type" => "datetime", "default" => "timestamp"]);
        }

        if (isset($table['trash']) and $table['trash']) {
            array_push($table['fields'], ["name" => "deleted_at", "type" => "datetime", "null" => true]);
        }

        $foreign = '';

        $sql .= "DROP TABLE IF EXISTS `{$table['name']}`; CREATE TABLE IF NOT EXISTS `{$table['name']}` (";
        $sql .= '`id` int(11) NOT NULL AUTO_INCREMENT,';

        foreach ($table['fields'] as $field) {
            $line = "`{$field['name']}`";
            switch ($field['type']) {
                case 'integer':
                    if (isset($field['length'])) $line .= " int({$field['length']})";
                    else $line .= " int(11)";
                    break;
                case 'string':
                    if (isset($field['length'])) $line .= " varchar({$field['length']})";
                    else $line .= " text";
                    break;
                default:
                    $line .= " {$field['type']}";
                    break;
            }
            if (!isset($field['null']) or !$field['null']) $line .= " NOT NULL";

            if (isset($field['default'])) $line .= " DEFAULT " . ($field['default'] == 'timestamp' ? 'CURRENT_TIMESTAMP' : $field['default']);

            $line .= ",";
            $sql .= $line;

            if (isset($field['relation'])) {
                $foreign .= " ALTER TABLE `{$table['name']}` ADD CONSTRAINT ";
                switch (gettype($field['relation'])) {
                    case 'string':
                        $const_name = "{$table['name']}_{$field['name']}_{$field['relation']}_id";
                        $foreign .= "`{$const_name}` FOREIGN KEY (`{$field['name']}`) REFERENCES `{$field['relation']}` (`id`);";
                        break;
                    case 'array':
                        $const_name = $table['name'] . "_" . $field['name'] . "_" . $field['relation']['table'] . "_" . $field['relation']['field'];
                        $foreign .= "`{$const_name}` FOREIGN KEY (`{$field['name']}`) REFERENCES `{$field['relation']['table']}` (`{$field['relation']['field']}`);";
                        break;
                }
            }
        }

        $sql .= " PRIMARY KEY (`id`));";

        $sql .= $foreign;

    }

    $res = x($sql);

    if (!$res) {
        flash(l('return'), 'error');
        redirect('setup-home');
    } else {
        flash('La base de données a bien été réinitialisée');
        redirect('setup-home');
    }
}

function create_admin()
{

    $table = 'user';

    $user = array(
        "username" => "admin",
        "pass" => md5("1234"),
        "profile" => 1,
        "hospital_id" => 1,
        "name" => "Key Master"
    );

    if (!one($table, $user)) {
        $res = e($table, $user);
        if ($res) {
            flash('L\'utilisateur admin bien été créé');
            redirect('setup-home');
        } else {
            flash(l('return'), 'error');
            redirect('setup-home');
        }
    } else {
        flash('L\'utilisateur admin existe déjà', 'error');
        redirect('setup-home');
    }

}

function field_to_sql($field)
{
    $line = "`{$field['name']}`";
    switch ($field['type']) {
        case 'integer':
            if (isset($field['length'])) $line .= " int({$field['length']})";
            else $line .= " int(11)";
            break;
        case 'string':
            if (isset($field['length'])) $line .= " varchar({$field['length']})";
            else $line .= " text";
            break;
        default:
            $line .= " {$field['type']}";
            break;
    }
    if (!isset($field['null']) or !$field['null'] or $field['null'] == false) $line .= " NOT NULL";
    else $line .= " NULL";

    if (isset($field['default'])) $line .= " DEFAULT " . ($field['default'] == 'timestamp' ? 'CURRENT_TIMESTAMP' : ((gettype($field['default']) == 'string') ? "\"{$field['default']}\"" : $field['default']));

    $line .= ",";

    return $line;
}

function add_field()
{
    requiere_post();

    $table = $_POST['table_name'];
    $after = (empty($_POST['field_after'])) ? null : $_POST['field_after'];
    $field = array(
        "name" => $_POST['field_name'],
        "type" => $_POST['field_type'],
        "length" => (empty($_POST['field_length'])) ? null : $_POST['field_length'],
        "null" => (empty($_POST['field_null'])) ? false : $_POST['field_null']
    );

    if (isset($_POST['field_default']) and !empty($_POST['field_default'])) {

        if ($_POST['field_default'] == 'custom') {
            if (!isset($_POST['field_default']) or empty($_POST['field_default_value'])) {
                $field['default'] = 'NULL';
            } else {
                $field['default'] = $_POST['field_default_value'];
            }
        } else $field['default'] = $_POST['field_default'];
    }

    $line = field_to_sql($field);
    $sql = "ALTER TABLE `{$table}` ADD ";
    $sql .= str_replace(',', '', $line);
    if ($after) $sql .= " AFTER `{$after}`;";

    //dump($sql);

    $res = x($sql);

    if ($res) {
        flash("Le champ '{$_POST['field_name']}' a bien été ajouté à la table '{$table}'");
        redirect('setup-home');
    } else {
        flash(l('return'), 'error');
        redirect('setup-home');
    }
}

function export_data()
{
    $export = array();

    $res = x('SHOW TABLES;');

    if ($res) {
        $tables = $res->fetchAll(PDO::FETCH_NUM);
        foreach ($tables as $details) {

            $table = $details[0];

            $items = s($table);

            $export[] = array(
                'table' => $table,
                'data' => $items
            );

        }

        $json = json_encode($export, JSON_PRETTY_PRINT);

        $filename = 'backup_' . strtolower(get('name')) . '_' . date('YmdHis') . '.json';

        file_put_contents($filename, $json);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));

        readfile($filename);

        unlink($filename);
    } else {
        flash(l('return'), 'error');
        redirect('setup-home');
    }
}

function import_data()
{
    if (isset($_FILES['backup_file'])) {
        $filename = time() . '.json';
        $tempname = $_FILES['backup_file']['tmp_name'];
        if (move_uploaded_file($tempname, $filename)) {
            $json = file_get_contents($filename);
            $backup = json_decode($json, true);
            foreach ($backup as $data) {
                foreach ($data['data'] as $item) {
                    $res = e($data['table'], $item);
                    if (!$res) {
                        unlink($filename);
                        flash(l('return'), 'error');
                        redirect('setup-home');
                    }
                }
            }
            unlink($filename);
            flash('Les données ont bien été importées');
            redirect('setup-home');
        } else {
            flash('Un problème est survenu lors de l\'importation du fichier', 'error');
            redirect('setup-home');
        }
    }
}

function update_schema()
{
    $schema = array();

    $res = x('SHOW TABLES;');

    if ($res) {
        $tables = $res->fetchAll(PDO::FETCH_NUM);
        foreach ($tables as $details) {

            $table = $details[0];

            $res = x("DESCRIBE `{$table}`;");

            $desc = $res->fetchAll(PDO::FETCH_ASSOC);

            $fields = [];

            foreach ($desc as $detail) {

                if (strtolower($detail['Field']) == 'id') continue;

                $field['name'] = $detail['Field'];

                if (strpos($detail['Type'], 'int') !== false) $field['type'] = 'integer';
                else if (strpos($detail['Type'], 'text') !== false or strpos($detail['Type'], 'varchar') !== false) $field['type'] = 'string';
                else $field['type'] = $detail['Type'];

                $pos = strpos($detail['Type'], '(');
                if ($pos !== false) $field['length'] = (int)str_replace(')', '', substr($detail['Type'], $pos + 1));
                else unset($field['length']);

                if ($detail['Null'] == 'YES') $field['null'] = true;
                else unset($field['null']);

                if ($detail['Default'] == 'CURRENT_TIMESTAMP') $field['default'] = 'timestamp';
                else if($detail['Default'] != null) {
                    if (is_integer($detail['Default'])) $field['default'] = (int)$detail['Default'];
                    else $field['default'] = $detail['Default'];
                }
                else unset($field['default']);

                $fields[] = $field;
            }

            $schema[] = array(
                'name' => $table,
                'fields' => $fields
            );

        }
        $json = json_encode($schema, JSON_PRETTY_PRINT);

        $filename = 'config/tables.json';

        if (file_put_contents($filename, $json)){
            flash('Le schéma des tables a bien été mis à jour');
        } else {
            flash('Un problème est survenu lors de la mmise à jour du schéma des tables', 'error');
        }
        redirect('setup-home');
    }
}

function download_file($filename)
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));

    readfile($filename);
}