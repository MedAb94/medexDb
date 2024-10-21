<?php

namespace App\Http\Controllers;

use App\Models\GlobalModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class GlobaleModelsController extends Controller
{
    public function index()
    {
        return view('globales.index');

    }

    public function getDT()
    {
        $global_models = GlobalModel::query()->orderbyDesc('id');
        return DataTables::of($global_models)
            ->addColumn('actions', function ($model) {
                return view('globales.actions', ["model" => $model])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function formAdd()
    {
        return view('globales.add');
    }

    public function formEdit($id)
    {
        $global_model = GlobalModel::find($id);
        return view('globales.get', [
            'global' => $global_model,

        ]);
    }

    public function save()
    {
        $this->validate(request(), [
            'model' => 'required|unique:global_models',
            'titre' => 'required',
            'url_prefix' => 'required|unique:global_models',
        ]);
        // check model exist and if not create it
        $model = explode('\\', request()->input('model'));
        $model = end($model);
        if (!class_exists(request()->input('model'))) {
            $this->createModel($model);
            $this->generateMigration($model);
        }
        else {
            // check if migration exist
            if (!Schema::hasTable(Str::snake(Str::plural($model)))) {
                $this->generateMigration($model);
            }
        }
        $global_model = new GlobalModel();
        $global_model->name = request()->input('titre');
        $global_model->model = request()->input('model');
        $global_model->url_prefix = request()->input('url_prefix');
        $global_model->icon = request()->input('icon');
        $global_model->add_title = request()->input('add_title');
        $global_model->edit_title = request()->input('edit_title');
        $global_model->save();
        return response()->json($global_model->id);

    }

    public function update()
    {
        $this->validate(request(), [
            'model' => 'required|unique:global_models,model,' . request()->input('id') . ',id',
            'titre' => 'required',
            'url_prefix' => 'required|unique:global_models,url_prefix,' . request()->input('id') . ',id'
        ]);
        $global_model = GlobalModel::find(request()->input('id'));
        $global_model->name = request()->input('titre');
        $global_model->model = $global_model->model;
        $global_model->url_prefix = request()->input('url_prefix');
        $global_model->icon = request()->input('icon');
        $global_model->add_title = request()->input('add_title');
        $global_model->edit_title = request()->input('edit_title');
        $global_model->save();
        return response()->json($global_model->id);
    }

    public function delete($id)
    {

        $global_model = GlobalModel::find($id);
        $global_model->delete();
        return response()->json($global_model->id);
    }


    public function indexObjects($model_id)
    {
        $model = GlobalModel::findByUrlPrefix($model_id);
        return view('globales.object.index', [
            'model' => $model,
        ]);

    }

    public function getDTObject($model_object_id)
    {
        $objects = GlobalModel::find($model_object_id)->model::query()->orderbyDesc('id');
        return DataTables::of($objects)
            ->addColumn('actions', function ($object) use ($model_object_id) {
                return view('globales.object.actions', [
                    "object" => $object,
                    "model" => GlobalModel::find($model_object_id),
                ])->render();
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function formAddObject($model)
    {
        $model = GlobalModel::find($model);
        return view('globales.object.add', [
            'model' => $model,

        ]);
    }


    public function saveObject()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $global_model = GlobalModel::find(request()->input('model_id'));

        $object = new $global_model->model();
        $object->name = request()->input('name');
        $object->save();
        return response()->json($object->id);
    }

    public function formEditObject($model, $object_id)
    {
        $global_model = GlobalModel::find($model);
        $object = $global_model->model::find($object_id);
        return view('globales.object.get', [
            'model' => $global_model,
            'object' => $object,


        ]);
    }

    public function updateObject()
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);
        $global_model = GlobalModel::find(request()->input('model_id'));

        $object = $global_model->model::find(request()->input('id'));
        $object->name = request()->input('name');
        $object->save();
    }

    public function deleteObject($model, $object_id)
    {
        $global_model = GlobalModel::find($model);
        $object = $global_model->model::find($object_id);
        $object->delete();
        return response()->json($global_model->id);
    }

    private function createModel($modelInput)
    {
        $modelPath = app_path('Models') . '/' . $modelInput . '.php';

        // Create the directory if it doesn't exist
        (new Filesystem)->ensureDirectoryExists(app_path('Models'));

        // Generate the model content
        $modelContent = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\SoftDeletes;\n\nclass {$modelInput} extends Model\n{\n    use SoftDeletes;\n\n    protected \$fillable = ['name'];\n\n    // Your additional model logic...\n}\n";

        // Write the content to the model file
        file_put_contents($modelPath, $modelContent);
    }

    private function generateMigration($modelInput)
    {
        // Generate migration file for the model
        $tableName = Str::snake(Str::plural($modelInput));
        $migrationName = 'create_' . $tableName . '_table';
        $migrationFileName = date('Y_m_d_His') . '_' . $migrationName;

        // Generate migration content
        $migrationContent = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\nreturn new class extends Migration\n{\n    public function up()\n    {\n        Schema::create('{$tableName}', function (Blueprint \$table) {\n";

        // Add columns to the migration content
        $migrationContent .= "            \$table->id();\n";
        $migrationContent .= "            \$table->string('name');\n";
        $migrationContent .= "            \$table->timestamps();\n";
        $migrationContent .= "            \$table->softDeletes();\n";

        // Your additional columns can be added here

        // Close the migration content
        $migrationContent .= "        });\n    }\n\n    public function down()\n    {\n        Schema::dropIfExists('{$tableName}');\n    }\n};";

        // Write the content to the migration file
        $migrationPath = database_path('migrations/' . $migrationFileName . '.php');
        file_put_contents($migrationPath, $migrationContent);
        Artisan::call('migrate');
    }

}
