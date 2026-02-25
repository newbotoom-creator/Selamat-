<?php

namespace App\Services;

class MathService
{
    public function calculate($n1, $n2, $operation)
{
    switch ($operation) {
        case 'add': return $n1 + $n2;
        case 'subtract': return $n1 - $n2;
        case 'multiply': return $n1 * $n2;
        case 'divide': return $n2 != 0 ? $n1 / $n2 : 0;
        case 'power': return pow($n1, $n2); // Pangkat: n1 pangkat n2
        case 'sqrt': return sqrt($n1);      // Akar: Akar dari n1 (n2 diabaikan)
        default: return 0;

        
    }
}

public function getExplanation($n1, $n2, $operation, $result)
{
    $symbols = [
        'add' => '+', 
        'subtract' => '-', 
        'multiply' => '\times', 
        'divide' => '\div',
        'power' => '^',
        'sqrt' => '\sqrt'
    ];
    
    $s = $symbols[$operation] ?? '+';

    // Logika visual khusus untuk Akar
    if ($operation == 'sqrt') {
        $visual = "$$ \sqrt{" . $n1 . "} = " . $result . " $$";
        $langkah = "Mencari nilai yang jika dikalikan dirinya sendiri menghasilkan $n1$.";
    } else if ($operation == 'power') {
        $visual = "$$ " . $n1 . "^{" . $n2 . "} = " . $result . " $$";
        $langkah = "Mengalikan angka $n1$ sebanyak $n2$ kali.";
    } else {
        $visual = "$$ " . $n1 . " " . $s . " " . $n2 . " = " . $result . " $$";
        $langkah = "Melakukan operasi $operation antara $n1 dan $n2.";
    }

    return [
        'rumus_visual' => $visual,
        'langkah' => $langkah
    ];
}

    public function solveQuadratic($a, $b, $c)
    {
        $d = ($b ** 2) - (4 * $a * $c);
        
        if ($d < 0) {
            return [
                'result' => 'Imajiner',
                'langkah' => "<p class='text-red-500'>Akar tidak real karena $$ D < 0 $$</p>"
            ];
        }

        $x1 = (-$b + sqrt($d)) / (2 * $a);
        $x2 = (-$b - sqrt($d)) / (2 * $a);

        $langkah = "
            <p class='font-bold text-blue-600'>Rumus ABC:</p>
            $$ x = \frac{-b \pm \sqrt{b^2 - 4ac}}{2a} $$
            $$ x = \frac{-($b) \pm \sqrt{($b)^2 - 4($a)($c)}}{2($a)} $$
            $$ x_1 = " . number_format($x1, 2) . ", \quad x_2 = " . number_format($x2, 2) . " $$
        ";

        return [
            'x1' => $x1,
            'x2' => $x2,
            'langkah' => $langkah
        ];
    }

    
}