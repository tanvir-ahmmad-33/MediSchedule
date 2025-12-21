<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\AppointmentTypeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $userService, $appointmentTypeService;

    public function __construct()
    {
        $this->appointmentTypeService = new AppointmentTypeService();
        $this->userService      = new UserService();
    }

    public function index() {
        $appointmentTypes = $this->appointmentTypeService->getActiveAppointmentTypes();
        return view('home', [
            'appointmentTypes' => $appointmentTypes
        ]);
    }
}
