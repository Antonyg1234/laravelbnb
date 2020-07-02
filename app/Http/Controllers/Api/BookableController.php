<?php

namespace App\Http\Controllers\Api;

use App\Models\Bookable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookableShowResource;
use App\Http\Resources\BookableIndexResource;

class BookableController extends Controller
{
    public function index()
    {
        return BookableIndexResource::collection(Bookable::all());
    }

    public function show($bookableId)
    {
        return new BookableShowResource(Bookable::find($bookableId));
    }
}
