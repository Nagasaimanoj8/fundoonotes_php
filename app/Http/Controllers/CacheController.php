<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CacheController extends Controller
{
    public function getUser(){
        $user = Cache::remember('users',10, function(){
            return User::all();
        });
        return $user;
    }

    public function getNotesAndLabel(){
        $notes = Cache::remember('notes',10, function(){
            return DB::table('notes')->join('label', 'notes.id', '=', 'label.notes_id')
            ->select('notes.*', 'label.label')->get();;
        });
        return $notes;
    }

}