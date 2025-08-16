<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketsModel;


class DashboardController extends Controller
{
    public function CountTransactions()
    {
        $tickets = TicketsModel::all();

        return view('index', compact('tickets'));
    }
}
