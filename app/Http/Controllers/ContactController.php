<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactType;
use App\Models\Country;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contacts.index');
    }

    //dt
    public function dt()
    {
        $contacts = Contact::query()->latest();
        $type_id = request()->type_id;
        $country_id = request()->country_id;

        if ($type_id) {
            $contacts->where('type_id', $type_id);
        }
        if ($country_id) {
            $contacts->where('country_id', $country_id);
        }
        return datatables()->of($contacts)
            ->editColumn('country_id', function ($contact) {
                return $contact->country->name ?? "";
            })
            ->editColumn('type_id', function ($contact) {
                return $contact->type->name ?? "";
            })
            ->addColumn('phones', function ($contact) {
                return $contact->phone1 . ' - ' . $contact->phone2 . ' - ' . $contact->phone3;
            })
            //edit website
            ->editColumn('website', function ($contact) {
                return "<a href='" . $contact->website . "' target='_blank'>" . $contact->website . "</a>";
            })
            ->editColumn('email', function ($contact) {
                return "<a href='mailto:" . $contact->email . "'>" . $contact->email . "</a>";
            })
            ->addColumn('actions', function ($contact) {
                return view('pages.contacts.actions', compact('contact'));
            })
            ->rawColumns(['website', 'email', 'actions'])
            ->make(true);
    }

    public
    function create($id = null)
    {
        $contact = null;
        if ($id) {
            $contact = Contact::findOrfail($id);
        }
        $countries = Country::all();
        $types = ContactType::all();
        return view('pages.contacts.create', compact('countries', 'types', 'contact'));
    }

    //store
    public
    function store(Request $data)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'type_id' => 'required'
        ]);

        Contact::updateOrCreate(['id' => $data->id], $data->all());
        return response()->json([
            'message' => 'Le contact a été ' . ($data->id ? 'mis à jour' : 'créé') . ' avec succès'
        ], 200);
    }

    public function delete($id)
    {
        $contact = Contact::findOrfail($id);
        $contact->delete();
        return response()->json(['message' => 'Contact deleted successfully'], 200);
    }
}
