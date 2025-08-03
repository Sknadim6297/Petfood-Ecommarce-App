<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactQuery;
use Illuminate\Http\Request;

class ContactQueryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = ContactQuery::latest();
        
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $contactQueries = $query->paginate(15);
        
        $stats = [
            'total' => ContactQuery::count(),
            'unread' => ContactQuery::where('status', 'unread')->count(),
            'read' => ContactQuery::where('status', 'read')->count(),
            'replied' => ContactQuery::where('status', 'replied')->count(),
        ];
        
        return view('admin.contact-queries.index', compact('contactQueries', 'stats', 'status'));
    }

    public function show(ContactQuery $contactQuery)
    {
        if ($contactQuery->status === 'unread') {
            $contactQuery->update(['status' => 'read']);
        }
        
        return view('admin.contact-queries.show', compact('contactQuery'));
    }

    public function updateStatus(Request $request, ContactQuery $contactQuery)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied',
            'admin_notes' => 'nullable|string',
        ]);
        
        $updateData = ['status' => $request->status];
        
        if ($request->status === 'replied' && $contactQuery->status !== 'replied') {
            $updateData['replied_at'] = now();
        }
        
        if ($request->filled('admin_notes')) {
            $updateData['admin_notes'] = $request->admin_notes;
        }
        
        $contactQuery->update($updateData);
        
        return back()->with('success', 'Contact query status updated successfully!');
    }

    public function destroy(ContactQuery $contactQuery)
    {
        $contactQuery->delete();
        
        return back()->with('success', 'Contact query deleted successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:mark_read,mark_replied,delete',
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:contact_queries,id',
        ]);
        
        $contactQueries = ContactQuery::whereIn('id', $request->selected_ids);
        
        switch ($request->action) {
            case 'mark_read':
                $contactQueries->update(['status' => 'read']);
                $message = 'Selected queries marked as read!';
                break;
            case 'mark_replied':
                $contactQueries->update(['status' => 'replied', 'replied_at' => now()]);
                $message = 'Selected queries marked as replied!';
                break;
            case 'delete':
                $contactQueries->delete();
                $message = 'Selected queries deleted!';
                break;
        }
        
        return back()->with('success', $message);
    }
}
