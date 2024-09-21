<?php

namespace App\Http\Controllers;

use App\Models\Produtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function verifyCPF(Request $request)
    {
        $cpf = $request->input('cpf');
        $produtor = Produtor::where('cpf', $cpf)->first();

        if ($produtor) {
            return response()->json(['name' => $produtor->nome], 200);
        }

        return response()->json(['message' => 'CPF not found'], 404);
    }

    public function confirmUser(Request $request)
    {
        $cpf = $request->input('cpf');
        $produtor = Produtor::where('cpf', $cpf)->first();

        if ($produtor) {
            // Gera um código de protocolo
            $protocol = strtoupper(uniqid());

            // Salva o protocolo na tabela "logs"
            DB::table('logs')->insert([
                'name' => $produtor->nome,
                'cpf' => $produtor->cpf,
                'protocol' => $protocol,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Caminho para o arquivo PDF
            $filePath = storage_path('app/public/pdfs/lista_vermelha-2024.pdf');

            if (file_exists($filePath)) {
                Log::info("Tentando baixar o PDF: " . $filePath);
                return response()->download($filePath, 'protocolo.pdf', ['Content-Type' => 'application/pdf']);
            }

            Log::error("PDF not found at: " . $filePath);
            return response()->json(['message' => 'PDF not found'], 404);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function downloadSecondFile(Request $request)
    {
        $cpf = $request->input('cpf');
        $produtor = Produtor::where('cpf', $cpf)->first();

        if ($produtor) {
            $filePath = storage_path('app/public/pdfs/lista_defensivos-2024.pdf');

            if (file_exists($filePath)) {
                return response()->download($filePath, 'Outro-arquivo.pdf', ['Content-Type' => 'application/pdf']);
            }

            return response()->json(['message' => 'PDF not found'], 404);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function savePhone(Request $request)
    {
        $cpf = $request->input('cpf');
        $phone = $request->input('phone');

        // Busca o log do usuário pelo CPF
        $log = DB::table('logs')->where('cpf', $cpf)->first();

        if ($log) {
            // Atualiza o log com o número de telefone
            DB::table('logs')->where('cpf', $cpf)->update([
                'phone' => $phone,
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Phone number saved successfully'], 200);
        }

        return response()->json(['message' => 'Log not found'], 404);
    }
}
