<?php session_start(); ?>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="../css/default.css">
</head>
<body>
<?php
require('include.php');
//echo "$parent $id";echo '<br>';var_dump(node);
extract($_POST);
//import_request_variables("GP", "p_");
if (!$parent = node::get_node_by_id($id)) {
    die();
}

if (strlen($title) != 0) {
    if ($n = node::get_node_by_id($id)) {
        sql_query("INSERT INTO sections (title) VALUES('$title')");
        $n->spawn_child(TYPE_SECTION, mysql_insert_id());
    }
    go_back();
    exit();
}

echo '<div class="nav_path">';
if ($ischapter) {
    echo build_path($parent) . "ajouter un paragraphe";
} else {
    echo build_path() . "ajouter un chapitre";
}
echo '</div>';
?>
<form method="post" enctype="multipart/form-data" action="#">
    <input type="hidden" name="id" value=<?php echo $id; ?>>
    <input type="hidden" name="ischapter" value=<?php echo $ischapter; ?>>
    <table>
        <tr>
            <td width="100">
                Titre :
            </td>
            <td>
                <input type="text" name="title"/>
            </td>

        </tr>
        <tr>
            <td colspan="2" align="right">
                <br/>
                <input type="submit" value="enregistrer"/>
                <input type="button" value="annuler" onclick="javascript:location='<?php echo build_back_url(); ?>'"/>
            </td>
        </tr>
    </table>
</form>

</body>
</html>
