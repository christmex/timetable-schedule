<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ScheduleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ScheduleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ScheduleCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Schedule::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/schedule');
        CRUD::setEntityNameStrings('schedule', 'schedules');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            "name" => "school_year_id",
            "label" => "School Year",
            "entity" => "SchoolYear",
            "model" => "App\Models\SchoolYear",
            "type" => "select",
            "attribute" => "school_year_name"
        ]);
        CRUD::column('classroom_id');
        CRUD::addColumn([
            "name" => "timetable_id",
            "label" => "Timetable",
            "entity" => "Timetable",
            "model" => "App\Models\Timetable",
            "type" => "select",
            "attribute" => "subject"
        ]);
        
        CRUD::column('teacher_id');
        CRUD::column('day_id');
        CRUD::addColumn([
            "name" => "subject_lesson_id",
            "label" => "Subject Lesson",
            "entity" => "SubjectLesson",
            "model" => "App\Models\SubjectLesson",
            "type" => "select",
            "attribute" => "subject_name"
        ]);
        CRUD::column('no_lesson');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ScheduleRequest::class);

        CRUD::addField([
            'type' => 'select',
            'name' => 'school_year_id', // the relationship name in your Migration
            'entity' => 'Schoolyear', // the relationship name in your Model
            'attribute' => 'school_year_name',
        ]);
        CRUD::field('classroom_id');
        CRUD::addField([
            'type' => 'select',
            'name' => 'timetable_id', // the relationship name in your Migration
            'entity' => 'Timetable', // the relationship name in your Model
            'attribute' => 'subject',
        ]);
        
        CRUD::field('teacher_id');
        CRUD::field('day_id');
        CRUD::field('subject_lesson_id');
        CRUD::addField([
            'type' => 'select',
            'name' => 'subject_lesson_id', // the relationship name in your Migration
            'entity' => 'SubjectLesson', // the relationship name in your Model
            'attribute' => 'subject_name',
        ]);
        CRUD::field('no_lesson');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
