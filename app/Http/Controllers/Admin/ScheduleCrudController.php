<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ScheduleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ScheduleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }

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
        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();
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
        // CRUD::column('no_lesson');

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
        // CRUD::field('classroom_id');
        CRUD::addField([
            'label'     => 'Classroom',
            'type'      => 'checklist',
            'name'      => 'classroom_id',
            'entity'    => 'Classroom',
            'attribute' => 'classname',
            'model'     => "App\Models\Classroom",
            // 'pivot'     => true,
            // 'number_of_columns' => 3,
        ]);
        CRUD::addField([
            'type'      => 'checklist',
            'name'      => 'timetable_id',
            'entity'    => 'Timetable',
            'attribute' => 'subject',
            'model'     => "App\Models\Timetable",
            // 'pivot'     => true,
            // 'options'     => function($query){
            //     // dd($query->get('subject'));
            //     return $query->get('subject');
            // },
        ]);
        CRUD::addField([
            'type'      => 'checklist',
            'name'      => 'day_id',
            'entity'    => 'Day',
            'attribute' => 'day_name',
            'model'     => "App\Models\Day",
            // 'pivot'     => true,
        ]);
        
        // CRUD::field('teacher_id');
        // CRUD::addField([
        //     'type' => 'select',
        //     'name' => 'subject_lesson_id', // the relationship name in your Migration
        //     'entity' => 'SubjectLesson', // the relationship name in your Model
        //     'attribute' => 'subject_name',
        // ]);

        // Check no lesson
        CRUD::addField([
            'hint'     => '*(Pilih jam pelajaran yang tidak digunakan untuk belajar, semisal homeroom, break etc)',
            'type'      => 'checklist',
            'name'      => 'no_lesson',
            'entity'    => 'Timetable',
            'attribute' => 'subject',
            'model'     => "App\Models\Timetable",
            'pivot'     => true,
        ]);
        // CRUD::field('no_lesson');

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
        // $this->setupCreateOperation();
        CRUD::setValidation(UpdateScheduleRequest::class);

        CRUD::addField([
            'type' => 'select',
            'name' => 'school_year_id', // the relationship name in your Migration
            'entity' => 'Schoolyear', // the relationship name in your Model
            'attribute' => 'school_year_name',
            'attributes' => [
                'readonly' => 'readonly'
            ]
        ]);

        CRUD::addField([
            'type' => 'select',
            'name' => 'classroom_id', // the relationship name in your Migration
            'entity' => 'Classroom', // the relationship name in your Model
            'attribute' => 'classname',
            'attributes' => [
                'readonly' => 'readonly'
            ]
        ]);

        CRUD::addField([
            'type' => 'select',
            'name' => 'timetable_id', // the relationship name in your Migration
            'entity' => 'Timetable', // the relationship name in your Model
            'attribute' => 'subject',
            'attributes' => [
                'readonly' => 'readonly'
            ]
        ]);

        CRUD::field('teacher_id');
        CRUD::addField([
            'type' => 'select',
            'name' => 'subject_lesson_id', // the relationship name in your Migration
            'entity' => 'SubjectLesson', // the relationship name in your Model
            'attribute' => 'subject_name',
        ]);

        CRUD::addField([
            'type' => 'select',
            'name' => 'day_id', // the relationship name in your Migration
            'entity' => 'Day', // the relationship name in your Model
            'attribute' => 'day_name',
            'attributes' => [
                'readonly' => 'readonly'
            ]
        ]);

        CRUD::field('no_lesson');
    }

    public function update(){
        // dd($this->crud->getRequest()->request->get('school_year_id'));
        // $check = Schedule::with('Classroom','SchoolYear','Timetable','Day')
        // ->where('school_year_id',$this->crud->getRequest()->request->get('school_year_id'))
        // ->where('classroom_id',$this->crud->getRequest()->request->get('classroom_id'))
        // ->where('timetable_id',$this->crud->getRequest()->request->get('timetable_id'))
        // ->where('day_id',$this->crud->getRequest()->request->get('day_id'))
        // // ->orWhere('subject_lesson_id',$this->crud->getRequest()->request->get('subject_lesson_id'))
        // // ->orWhere('teacher_id',$this->crud->getRequest()->request->get('teacher_id'))
        // ->first();

        // dd($check->id != $this->crud->getRequest()->request->get('id'));
        // // dd($this->crud->getRequest()->request->get('id'));
        // // dd($this->crud->getStrippedSaveRequest($this->crud->validateRequest()));
        // // dd($this->crud->getRequest()->request->get('id'));

        // if($check && $check->id != $this->crud->getRequest()->request->get('id')){
        //     \Alert::error("Class ".$check->Classroom->classname." with JP Lesson at ".$check->Timetable->subject." on ".$check->Day->day_name." in the ".$check->SchoolYear->school_year_name." school year is already there.")->flash();

        //     return redirect()->back()->withInput();
        // }else {
            $this->crud->hasAccessOrFail('update');

            // execute the FormRequest authorization and validation, if one is required
            $request = $this->crud->validateRequest();

            // register any Model Events defined on fields
            $this->crud->registerFieldEvents();
            
            if($this->crud->getRequest()->request->get('subject_lesson_id') != 0){

                // Ini untuk melakukan pengecekan apakah ada guru yang sudah mengajar di kelas yg terpilih dengan mata pelajaran yang sama, jika ada maka kasih error pesan di bawah, jika tidak or gurunya sama maka boleh, tpi ini masih dipertimbangkan, bagaimana jjika satu kelas 1 mapel 2 guru?
                $checkSubjectLesson = Schedule::with('Classroom','SchoolYear','Teacher','SubjectLesson')
                ->where('school_year_id',$this->crud->getRequest()->request->get('school_year_id'))
                ->where('classroom_id',$this->crud->getRequest()->request->get('classroom_id'))
                ->where('subject_lesson_id',$this->crud->getRequest()->request->get('subject_lesson_id'))
                ->orWhere('subject_lesson_id',0)
                ->first();

                if(!(($this->crud->getRequest()->request->get('subject_lesson_id') == $checkSubjectLesson->SubjectLesson->id) && ($this->crud->getRequest()->request->get('teacher_id') == $checkSubjectLesson->teacher->id))){
                    \Alert::error("Pelajaran ".$checkSubjectLesson->SubjectLesson->subject_name." di kelas ".$checkSubjectLesson->Classroom->classname." tahun ajaran ".$checkSubjectLesson->SchoolYear->school_year_name." sudah di ajar oleh ".$checkSubjectLesson->teacher->teacher_name)->flash();
                    return redirect()->back()->withInput();
                }
    
                // if($checkSubjectLesson){
                //     \Alert::error("Pelajaran ".$checkSubjectLesson->SubjectLesson->subject_name." di kelas ".$checkSubjectLesson->Classroom->classname." tahun ajaran ".$checkSubjectLesson->SchoolYear->school_year_name." sudah di ajar oleh ".$checkSubjectLesson->teacher->teacher_name)->flash();
                //     return redirect()->back()->withInput();
                // }
            }
            // update the row in the db
            $item = $this->crud->update(
                $request->get($this->crud->model->getKeyName()),
                $this->crud->getStrippedSaveRequest($request)
            );
            $this->data['entry'] = $this->crud->entry = $item;

            // show a success message
            \Alert::success(trans('backpack::crud.update_success'))->flash();

            // save the redirect choice for next time
            $this->crud->setSaveAction();

            return $this->crud->performSaveAction($item->getKey());


        // }


    }
    public function store()
    {
        // $parsedUrl = parse_url(URL::previous());
        // parse_str($parsedUrl['query'], $parsedUrl);
        

        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();

        // register any Model Events defined on fields
        $this->crud->registerFieldEvents();
        
        // if(!$parsedUrl['action']){

            $getClassroom = json_decode($this->crud->getRequest()->request->get('classroom_id'), true);
            $getTimetable = json_decode($this->crud->getRequest()->request->get('timetable_id'), true);
            $getDay = json_decode($this->crud->getRequest()->request->get('day_id'), true);
            $getNoLesson = json_decode($this->crud->getRequest()->request->get('no_lesson'), true);

            $getAllDataForCheck = $this->crud->model->all();
            // dd($getDay);
            $query = [];
            for ($i=0; $i < count($getClassroom); $i++) {
                for ($k=0; $k < count($getDay); $k++) { 
                    for ($l=0; $l < count($getTimetable); $l++) {
                    $checkfirst = $getAllDataForCheck
                    ->where('school_year_id', $this->crud->getRequest()->request->get('school_year_id'))
                    ->where('classroom_id',$getClassroom[$i])
                    ->where('day_id',$getDay[$k])
                    ->where('timetable_id',$getTimetable[$l]);
                        if(!count($checkfirst)){
                            $query[] = [
                                "school_year_id" => $this->crud->getRequest()->request->get('school_year_id'),
                                "classroom_id" => $getClassroom[$i],
                                "timetable_id" => $getTimetable[$l],
                                "teacher_id" => null,
                                "day_id" => $getDay[$k],
                                "subject_lesson_id" => null,
                                "no_lesson" => in_array($getTimetable[$l], $getNoLesson) ? 1 : 0,
                                "created_at" => Carbon::now(),
                                "updated_at" => Carbon::now(),
                            ];
                        }else {

                            Alert::error("The class at ".$checkfirst->first()->Timetable->subject." on ".$checkfirst->first()->Day->day_name." in ".$checkfirst->first()->Classroom->classname." Classroom already exists")->flash();
                            return redirect()->back()->withInput();

                            
                        }
                    }
                }
            }
        
        // }
        if(!count($query)){
            \Alert::error(trans('data sudah ada'))->flash();

            return redirect()->back()->withInput();
        }
        
        $item = $this->crud->create($query[0]);
        unset($query[0]);
        DB::table('schedules')->insert($query);
        
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
        
      // do something before validation, before save, before everything
    //   $response = $this->traitStore();
      // do something after save
    //   return $response;
    }
}
