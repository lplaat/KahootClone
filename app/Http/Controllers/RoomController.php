<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public static function createRoom($request, $from) {
        $quiz = Quiz::find($request['data']['quiz_id']);
        if($quiz == null) {
            $from->send(json_encode([
                "type" => "createRooms",
                "success" => false,
                "message" => "Quiz not found!"
            ]));
        }

        $room = new Room();
        $room->quiz_id = $quiz->id;
        $room->generateCode();
        $room->save();

        $from->send(json_encode([
            "type" => "createRooms",
            "success" => true
        ]));

        $from->send(json_encode([
            "type" => "loadPage",
            "data" => [
                "name" => "roomStart",
                "values" => [
                    "room_id" => $room->id,
                    "room_code" => $room->code,
                ]
            ],
            "success" => true
        ]));
    }

    public static function loadPage($request, $from) {
        $compiled = view('rooms.' . $request['data']['name'], $request['data']['values'])->render();
        $from->send(json_encode([
            "type" => "renderPage",
            "data" => $compiled,
            "success" => true
        ]));
    }
}