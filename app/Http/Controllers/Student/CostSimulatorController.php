<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CostSimulatorController extends Controller
{
    public function show()
    {
        return view('cost-simulator.show', ['result' => null, 'input' => []]);
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'monthly_budget' => ['required', 'numeric', 'min:0'],
            'tuition' => ['required', 'numeric', 'min:0'],
            'monthly_fee' => ['required', 'numeric', 'min:0'],
            'transport' => ['nullable', 'numeric', 'min:0'],
            'materials' => ['nullable', 'numeric', 'min:0'],
            'months' => ['required', 'integer', 'min:1', 'max:120'],
        ]);

        $transport = $validated['transport'] ?? 0;
        $materials = $validated['materials'] ?? 0;

        $monthlyTotal = $validated['monthly_fee'] + $transport + $materials;
        $periodTotal = $validated['tuition'] + ($monthlyTotal * $validated['months']);
        $monthlyBalance = $validated['monthly_budget'] - $monthlyTotal;

        $result = [
            'monthly_total' => $monthlyTotal,
            'period_total' => $periodTotal,
            'monthly_balance' => $monthlyBalance,
            'months' => $validated['months'],
        ];

        return view('cost-simulator.show', ['result' => $result, 'input' => $validated]);
    }
}
