<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // If leaderboard is empty or ?recalc=1 provided, (re)calculate scores
        if (Leaderboard::count() === 0 || request()->query('recalc')) {
            Leaderboard::recalculateAllScores();
        }

        $leaderboard = Leaderboard::with('student')->orderBy('score', 'desc')->take(50)->get();
        return view('leaderboard', compact('leaderboard'));
    }
}
