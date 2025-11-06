<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Contacts\CreateRequest;

use Inertia\Inertia;
use Inertia\Response;

use App\Models\Contact;

class ContactController extends Controller
{
    public function create(Request $request): Response
    {
        return Inertia::render('contact');
    }

    public function store(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Contact::create($data);

        return to_route('eduno.contact.index');
    }
}
