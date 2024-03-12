<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetByIdHolidayPlanRequest;
use App\Http\Resources\HolidayPlanResource;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;

class HolidayPlanController extends Controller
{
private $holidayPlay;

    public function __construct(HolidayPlan $holidayPlan) {
        $this->holidayPlay = $holidayPlan;
    }

    public function index(){
        return HolidayPlanResource::collection(
            $this->holidayPlay->all()
        );
    }

    public function get(GetByIdHolidayPlanRequest $request){
        $holidayPlan = $this->holidayPlay->find($request->id);

        if(!$holidayPlan) return response('Holiday plan does not exist', 404);

        return new HolidayPlanResource($holidayPlan);
    }
}
