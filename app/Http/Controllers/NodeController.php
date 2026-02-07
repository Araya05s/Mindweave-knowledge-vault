<?php

namespace App\Http\Controllers;

use App\Models\Node;

use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index()
    {
        $nodes = Node::all();
        return view('nodes.partials.list', [
            'nodes' => $nodes
        ]);
    }
}
