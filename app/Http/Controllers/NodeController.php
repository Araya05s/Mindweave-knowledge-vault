<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Tag;

use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index()
    {
        $nodes = Node::with('tags')->get();
        return view('nodes.partials.list', [
            'nodes' => $nodes
        ]);
    }

    public function createnode(Request $request) 
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'tag_name' => 'nullable|string|max:100',
            'tag_color' => 'nullable|string|max:20',
        ]);    
        
        $node = Node::create([
            'title' => $data['title'],
            'content' => $data['content'] ?? null,
        ]);

        if (!empty($data['tag_name'])) {
            $tag = Tag::firstOrCreate(
                ['name' => $data['tag_name']],
                ['color' => $data['tag_color'] ?? '#6c757d']
            );

            $node->tags()->syncWithoutDetaching([$tag->id]);
        }
        

        return view('nodes.partials.list', [
            'nodes' => Node::with('tags')->get()
        ]);
    }

    public function check(Request $request)
    {
        $name = $request->input('tag_name');

        // If empty, return nothing
        if (empty($name)) {
            return '';
        }

        $exists = Tag::where('name', $name)->exists();

        if ($exists) {
            return '<small class="text-danger fw-bold">
                        <i class="bi bi-exclamation-triangle"></i> This tag name already exists! tag color changes will be ignored.
                    </small>';
        }

        return '<small class="text-success">Name available</small>';
    }

    public function move(Request $request, Node $node)
    {
        $validated = $request->validate([
            'x_pos' => 'required|numeric',
            'y_pos' => 'required|numeric',
        ]);

        $node->update($validated);

        return response()->json(['status' => 'success']);
    }
    
    public function edit(Node $node)
    {
        return view('nodes.partials.form', compact('node'));
    }

    public function update(Request $request, Node $node)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'x_pos' => 'nullable|string',
        ]);

        $node->update($data);

        $node->load('tags');

        return response()->noContent()->withHeaders(['HX-Refresh' => 'true']);
    }

    public function delete(Node $node)
    {
        $node->delete();

        return response('', 204);
    }
}
