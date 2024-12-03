<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class RidingMenuModel extends Model
{
    protected $table = 'tbl_luggage_menu';
    protected $primaryKey = 'lug_menu_id';
    protected $allowedFields = ['lug_menu'];
}