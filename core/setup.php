<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 31/10/2019
 * Time: 15:39
 */

require_once 'load.php';

/*
$user = array(
    "username" => "admin",
    "pass" => md5("pad2019"),
    "profile" => 1,
    "name" => "Administrator"
);

if (!one('user', $user)) {
    $res = e('user', $user);
    if ($res) echo 'L\'utilisateur admin bien été créé<br>';
    else l(true);
} else {
    echo 'L\'utilisateur admin existe déjà<br>';
}
*/


function reset_db()
{
    $db_desc_json = file_get_contents('../config/tables.json');
    $db_desc = json_decode($db_desc_json, true);

    foreach ($db_desc as $table) {

        if (isset($table['timestamp']) and $table['timestamp']) {
            array_push($table['fields'], ["name" => "created_at", "type" => "datetime", "default" => "timestamp"]);
            array_push($table['fields'], ["name" => "updated_at", "type" => "datetime", "default" => "timestamp"]);
        }

        if (isset($table['trash']) and $table['trash']) {
            array_push($table['fields'], ["name" => "deleted_at", "type" => "datetime", "null" => true]);
        }

        var_dump($table);

        $foreign = '';

        $sql = "DROP TABLE IF EXISTS `{$table['name']}`; CREATE TABLE IF NOT EXISTS `{$table['name']}` (";
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

        //dump($sql);

        $res = x($sql);

        if ($res) die("Table {$table['name']} created");
        else l(true);
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
    if (!isset($field['null']) or !$field['null']) $line .= " NOT NULL";

    if (isset($field['default'])) $line .= " DEFAULT " . ($field['default'] == 'timestamp' ? 'CURRENT_TIMESTAMP' : $field['default']);

    $line .= ",";

    return $line;
}

function add_field($table, $field, $after = '')
{
    $line = field_to_sql($field);
    $sql = "ALTER TABLE `{$table}` ADD ";
    $sql .= str_replace(',', '', $line);
    if ($after) $sql .= " AFTER `{$after}`;";

    //dump($sql);

    $res = x($sql);

    if ($res) die("Table {$table} created");
    else l(true);
}

$field = array(
    "name" => "lieu_naiss",
    "type" => "string",
    "length" => 15
);

add_field('users', $field);