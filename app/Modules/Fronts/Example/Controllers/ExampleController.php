<?php


namespace App\Modules\Fronts\Example\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Core\MVC\Controllers\CommonActionController;
use App\Modules\Fronts\Example\Models\ExampleModel;
use App\Modules\Fronts\Example\Services\ExampleService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExampleController extends BaseAdminController implements CommonActionController
{
    /**
     * @var string
     */
    private $className = 'Example';
    /**
     * @var string
     */
    private $route = 'example.index';
    /**
     * @var ExampleService
     */
    private $exampleService;

    /**
     * ExampleController constructor.
     * @param ExampleService $exampleService
     */
    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        //dd(trans("Example::messages.successfully"));
        $models = $this->exampleService->list($request);
        return view('Example::index', [
            'data' => $models
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function add(Request $request) {
        return view('Example::add');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, $id) {
        $model = $this->exampleService->fetchById($id);
        return view('Example::edit', [
            "data" => $model
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function create(Request $request) {
        try {
            $example = $this->exampleService->add($request);
            return self::responseAndMessage($example, $this->className, self::ADD, $this->route);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, $id) {
        try {
            $example = $this->exampleService->update($request, $id);
            return self::responseAndMessage($example, $this->className, self::UPDATE, $this->route);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request) {
        try {
            $example = $this->exampleService->delete($request, $id);
            return self::responseAndMessage($example, $this->className, self::DELETE, $this->route);
        } catch (Exception $ex){
            throw $ex;
        }
    }
}
