<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use App\Models\Classification;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Calcul du nombre total de documents, utilisateurs, et classifications
        $totalDocuments = Document::count();
        $totalUsers = User::count();
        $totalClassifications = Classification::count();
    
        // Calcul du nombre de sous-répertoires créés
        $dailySubdirectories = Classification::whereDate('created_at', Carbon::today())->count();
        $weeklySubdirectories = Classification::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthlySubdirectories = Classification::whereMonth('created_at', Carbon::now()->month)->count();
        $yearlySubdirectories = Classification::whereYear('created_at', Carbon::now()->year)->count();

        // Initialisation des données pour chaque jour de la semaine
        $subdirectoriesPerDay = [];

        // Boucle sur chaque jour de la semaine
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->startOfWeek()->addDays($i);
            $subdirectoriesPerDay[$date->format('l')] = Classification::whereDate('created_at', $date)->count();
        }

        // Passer toutes les données à la vue
        return view('admin.dashboard', compact(
            'totalDocuments',
            'totalUsers',
            'totalClassifications',
            'dailySubdirectories',
            'weeklySubdirectories',
            'monthlySubdirectories',
            'yearlySubdirectories',
            'subdirectoriesPerDay'
        ));
    }
}
