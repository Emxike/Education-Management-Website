<?php


namespace App\Modules\Admins\Dashboard\Controllers;


use App\Core\MVC\Controllers\BaseAdminController;
use App\Modules\Admins\Dashboard\Services\DashboardService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    /**
     * @var string
     */
    private $className = 'Dashboard';
    /**
     * @var string
     */
    private $route = 'dashboard.index';
    /**
     * @var DashboardService
     */
    private $dashboardService;

    /**
     * DashboardController constructor.
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request) {
        $totalDepart = $this->dashboardService->getDepartment();
        $totalStaff = $this->dashboardService->getStaff();
        $totalIdea = $this->dashboardService->getIdea();
        $total = $this->dashboardService->getStaffOfDepartment();
        foreach ($total as $item) {
            $item["color"] = dechex(rand(0x000000, 0xFFFFFF));
        }
        return view('Dashboard::index', [
            'totalDepart' => count($totalDepart),
            'totalStaff' => count($totalStaff),
            'totalIdea' => count($totalIdea),
            'total' => $total
        ]);
    }
}
