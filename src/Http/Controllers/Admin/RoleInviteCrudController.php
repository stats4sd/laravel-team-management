<?php

namespace Stats4sd\TeamManagement\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Stats4sd\TeamManagement\Http\Requests\RoleInviteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RoleInviteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RoleInviteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\Stats4sd\TeamManagement\Models\RoleInvite::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/role-invite');
        CRUD::setEntityNameStrings('role invite', 'role invites');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('email')->label('Sent to');
        CRUD::column('role')->type('relationship')->label('Role invited to');
        CRUD::column('inviter')->type('relationship')->label('Invited by');
        CRUD::column('invite_day')->type('date')->label('Invite sent on');
        CRUD::column('is_confirmed')->type('boolean')->label('Invite Accepted?');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::field('email');
        CRUD::field('role_id')->type('relationship');
        CRUD::field('inviter_id')->type('hidden')->default(Auth::user()->id);
        CRUD::field('token')->type('hidden')->default(Str::random(24));

        CRUD::setValidation([
            'email' => 'email|required',
            'role_id' => 'required',
            'inviter_id' => 'required',
            'token' => 'required',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
