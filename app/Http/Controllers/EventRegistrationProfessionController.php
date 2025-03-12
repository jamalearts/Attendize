<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Conference;
use App\Models\Event;
use App\Models\Profession;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRegistrationProfessionController extends MyBaseController
{

    /**
     * Show the 'Edit Profession' modal
     *
     * @param Request $request
     * @param int $event_id
     * @param int $profession_id
     * @return View
     */
    public function showEditProfession(Request $request, $event_id, $profession_id)
    {
        $profession = Profession::findOrFail($profession_id);
        $event = Event::find($event_id);

        $data = [
            'profession' => $profession,
            'event' => $event,
        ];

        return view('ManageEvent.Modals.EditProfession', $data);
    }



}
