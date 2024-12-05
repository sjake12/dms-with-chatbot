<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RasaChatBotController extends Controller
{
    /**
     * Endpoint for Rasa to fetch dynamic application data
     */
    public function getChatbotData(Request $request)
    {
        // Check if user is authenticated using session auth
        if (!auth()->check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        // Fetch relevant data from your application
        // This could be user-specific, context-based data
        $user = auth()->user();
        $id = $user->username;

        if (!$id) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $name = Student::find($id)->first_name
            ?? Faculty::find($id)->first_name
            ?? Admin::find($id)->first_name
            ?? 'Unknown User';

        $data = [
            'user_context' => [
                'name' => $name,
                'recent_activity' => $this->getUserRecentActivity(),
                'preferences' => $this->getUserPreferences()
            ],
            'knowledge_base' => $this->getRelevantKnowledgeBase()
        ];

        return response()->json($data);
    }

    /**
     * Send message to Rasa and get response
     */
    public function processChatMessage(Request $request)
    {
        $message = $request->input('message');

        try {
            // Forward message to Rasa server
            $rasaResponse = Http::post('http://localhost:5005/webhooks/rest/webhook', [
                'sender' => auth()->user()->username ?? 'default_user',
                'message' => $message
            ])->json();

            return response()->json($rasaResponse);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to process chat message',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    // Helper methods to retrieve context and knowledge base
    private function getUserRecentActivity()
    {
        // Retrieve user's recent interactions, purchases, etc.
        return [];
    }

    private function getUserPreferences()
    {
        // Retrieve user's preferences and settings
        return [];
    }

    private function getRelevantKnowledgeBase()
    {
        // Fetch relevant data from your database
        // This could include FAQs, product information, etc.
        return [];
    }
}
