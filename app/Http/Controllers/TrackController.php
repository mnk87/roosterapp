<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Room;
use App\Models\Medient;
use App\Models\Workstation;

class TrackController extends Controller
{
    public function getAll()
    {
        return view('tracks', [
            'tracks' => Track::all()
        ]);
    }

    public function getById($track)
    {
        $rooms = Room::where('track_id', $track)->get();
        $roomnrs = [];
        foreach($rooms as $room)
        {
            array_push($roomnrs, $room->id);
        }
        $workstations = collect();
        foreach($roomnrs as $roomnr)
        {
            $wstations = Workstation::where('room_id', $roomnr)->get();
            foreach($wstations as $wstation)
            {
                $workstations->push($wstation);
            }
            
        }

        return view('track', [
            'track' => Track::find($track),
            'tracks' => Track::all(),
            'rooms' => Room::where('track_id', $track)->get(),
            'medients' => Medient::all(),
            'workstations' => $workstations
        ]); 
    }

    public function getFirst()
    {
        $track = Track::where('isActive', true)->first();
        if($track != null)
        {
            return $this->getById($track->id);    
        } else {
            return view('notrack');
        }
    }
}
