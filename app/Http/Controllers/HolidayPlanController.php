<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetByIdHolidayPlanRequest;
use App\Http\Requests\HolidayPlanRequest;
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

    public function store(HolidayPlanRequest $request){
        $holidayPlan = $this->holidayPlay->create($request->all());

        if($request->participants){
            $holidayPlan->participants()->createMany($request->participants);
        }

        if(!$holidayPlan){
            return response('Holiday plan does not was created', 400);
        }

        return new HolidayPlanResource($holidayPlan);
    }

    public function update(){

    }
}
