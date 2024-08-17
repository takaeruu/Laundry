<?php
// app/Helpers/permission_helper.php
function has_permission($menu_name)
{
    $db = \Config\Database::connect();
    $level = session()->get('level');
    $query = $db->table('permissions')
        ->where('level', $level)
        ->where('menu_name', $menu_name)
        ->get();
    return $query->getRow() && $query->getRow()->can_access;
}
