<?php

namespace Stats4sd\TeamManagement\Http\Controllers\Admin;

use Stats4sd\TeamManagement\Http\Requests\InviteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Stats4sd\TeamManagement\Models\Invite;

/**
 * Class InviteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InviteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

    public function setup()
    {
        CRUD::setModel(Invite::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/invite');
        CRUD::setEntityNameStrings('invite', 'invites');
    }

    protected function setupListOperation()
    {
        CRUD::column('email');
        CRUD::column('team')->type('relationship');
        CRUD::column('inviter')->type('relationship');
        CRUD::column('is_confirmed')->type('boolean');

    }


}
