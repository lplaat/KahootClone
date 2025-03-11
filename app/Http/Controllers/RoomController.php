<?php

namespace App\Http\Controllers;


class RoomController extends Controller
{
    public static function createRoom($request, $from) {
        $from->send(json_encode([
            "type" => "createRooms",
            "success" => true
        ]));
    }
}