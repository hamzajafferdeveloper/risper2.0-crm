<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientCompanyAddress;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Client::with(['companyAddress.addedBy', 'category']);

            // 🔍 Apply filters dynamically
            if ($request->company_id) {
                $query->whereHas('companyAddress', function ($q) use ($request) {
                    $q->where('id', $request->company_id);
                });
            }

            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->added_by) {
                $query->whereHas('companyAddress', function ($q) use ($request) {
                    $q->where('added_by', $request->added_by);
                });
            }

            if ($request->start_date && $request->end_date) {
                $query->whereBetween('created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ]);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('added_by', function ($row) {
                    $user = $row->companyAddress?->addedBy;
                    if (!$user) return '-';

                    $image = $user->profile_pic
                        ? asset('storage/' . $user->profile_pic)
                        : asset('assets/images/avatar/avatar.png');

                    return '
                        <div class="flex items-center gap-2">
                            <img src="' . $image . '" alt="' . e($user->name) . '" class="w-8 h-8 rounded-full object-cover border">
                            <span>' . e($user->name) . '</span>
                        </div>
                    ';
                })
                ->addColumn('category_name', fn($row) => $row->category->name ?? '-')
                ->addColumn('company_name', fn($row) => $row->companyAddress->name ?? '-')
                ->addColumn('action', function ($row) {
                    return '
                        <div class="flex gap-2">
                            <button class="btn btn-sm !bg-[#8D35E3] hover:!bg-[#8D35E3]/80 text-white p-2 rounded editClient" data-id="'.$row->id.'" title="Edit">
                                <iconify-icon icon="mdi:pencil" class="text-lg"></iconify-icon>
                            </button>
                            <button data-id="'.$row->id.'" class="btn btn-sm !bg-red-500 hover:!bg-red-500/80 text-white p-2 rounded deleteClient" title="Delete">
                                <iconify-icon icon="mage:trash" class="text-lg"></iconify-icon>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['added_by', 'action'])
                ->make(true);
        }

        return view('admin.client.index');
    }


    public function show(string $id)
    {
        $client = Client::with('companyAddress', 'country', 'category', 'subCategory', 'language')->findOrFail($id);

        return view('admin.client.show', compact('client'));
    }

    /**
     * Store a new client with company details
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:clients,email',
                'password' => 'required|string|min:6',
                'profile_pic' => 'nullable|image|max:2048',
                'salutation' => 'in:Mr,Mrs,Miss,Dr.,Sir,Madam',
                'country_id' => 'nullable|exists:countries,id',
                'mobile' => 'nullable|string|max:20',
                'gender' => 'in:male,female,other',
                'language' => 'nullable|exists:languages,id',
                'login_allowed' => 'nullable',
                'receive_email_notification' => 'nullable',
                'category_id' => 'nullable|exists:client_categories,id',
                'sub_category_id' => 'nullable|exists:client_categories,id',
            ]);

            $validated['login_allowed'] = $request->has('login_allowed') ? 'yes' : 'no';
            $validated['receive_email_notification'] = $request->has('receive_email_notification') ? 'yes' : 'no';

            // Upload Profile Picture
            $profilePicPath = $request->file('profile_pic')
                ? $request->file('profile_pic')->store('profiles', 'public')
                : null;

            // Create Client
            $client = Client::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'salutation' => $validated['salutation'],
                'password' => Hash::make($validated['password']),
                'country_id' => $validated['country_id'],
                'mobile' => $validated['mobile'],
                'gender' => $validated['gender'],
                'language_id' => $validated['language'],
                'category_id' => $validated['category_id'],
                'sub_category_id' => $validated['sub_category_id'],
                'login_allowed' => $validated['login_allowed'],
                'receive_email_notification' => $validated['receive_email_notification'],
                'profile_pic' => $profilePicPath,
            ]);

            // Upload Company Logo
            $companyLogoPath = $request->file('company_logo')
                ? $request->file('company_logo')->store('companies', 'public')
                : null;

            // Create Company
            ClientCompanyAddress::create([
                'client_id' => $client->id,
                'name' => $request->company_name,
                'tax_name' => $request->tax_name,
                'tax_number' => $request->tax_number,
                'office_phone_number' => $request->office_phone_number,
                'website' => $request->website,
                'state' => $request->state,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'added_by' => $request->added_by,
                'address' => $request->address,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
                'logo' => $companyLogoPath,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Client and company added successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();

            // Delete uploaded files if they exist (cleanup)
            if (! empty($profilePicPath)) {
                Storage::disk('public')->delete($profilePicPath);
            }
            if (! empty($companyLogoPath)) {
                Storage::disk('public')->delete($companyLogoPath);
            }

            // Log error for debugging
            Log::error('Client store failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Something went wrong while adding client.');
        }
    }

    public function edit(Request $request)
    {
        $client = Client::with('companyAddress')->findOrFail($request->id);

        return response()->json(['client' => $client]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $client = Client::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => "required|email|unique:clients,email,{$client->id}",
                'password' => 'nullable|string|min:6',
                'profile_pic' => 'nullable|image|max:2048',
                'salutation' => 'in:Mr,Mrs,Miss,Dr.,Sir,Madam',
                'country_id' => 'nullable|exists:countries,id',
                'mobile' => 'nullable|string|max:20',
                'gender' => 'in:male,female,other',
                'language' => 'nullable|exists:languages,id',
                'login_allowed' => 'nullable',
                'receive_email_notification' => 'nullable',
                'category_id' => 'nullable|exists:client_categories,id',
                'sub_category_id' => 'nullable|exists:client_categories,id',
            ]);

            $validated['login_allowed'] = $request->has('login_allowed') ? 'yes' : 'no';
            $validated['receive_email_notification'] = $request->has('receive_email_notification') ? 'yes' : 'no';

            // === Handle Profile Picture ===
            $profilePicPath = $client->profile_pic;
            if ($request->hasFile('profile_pic')) {
                if ($client->profile_pic && Storage::disk('public')->exists($client->profile_pic)) {
                    Storage::disk('public')->delete($client->profile_pic);
                }
                $profilePicPath = $request->file('profile_pic')->store('profiles', 'public');
            }

            // === Update Client ===
            $client->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'salutation' => $validated['salutation'],
                'password' => $request->filled('password') ? Hash::make($validated['password']) : $client->password,
                'country_id' => $validated['country_id'],
                'mobile' => $validated['mobile'],
                'gender' => $validated['gender'],
                'language_id' => $validated['language'],
                'category_id' => $validated['category_id'],
                'sub_category_id' => $validated['sub_category_id'],
                'login_allowed' => $validated['login_allowed'],
                'receive_email_notification' => $validated['receive_email_notification'],
                'profile_pic' => $profilePicPath,
            ]);

            // === Handle Company Data ===
            $company = ClientCompanyAddress::firstOrNew(['client_id' => $client->id]);

            // === Handle Company Logo ===
            $companyLogoPath = $company->logo;
            if ($request->hasFile('company_logo')) {
                if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                    Storage::disk('public')->delete($company->logo);
                }
                $companyLogoPath = $request->file('company_logo')->store('companies', 'public');
            }

            $company->fill([
                'name' => $request->company_name,
                'tax_name' => $request->tax_name,
                'tax_number' => $request->tax_number,
                'office_phone_number' => $request->office_phone_number,
                'website' => $request->website,
                'state' => $request->state,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'added_by' => $request->added_by,
                'address' => $request->address,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
                'logo' => $companyLogoPath,
            ])->save();

            DB::commit();

            return response()->json(['message' => 'Client updated successfully.'], 200);
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Client update failed', [
                'client_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            return response()->json(['error' => 'Failed to update client.'], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();

            return response()->json(['message' => 'Client deleted successfully.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to delete client.'], 500);
        }
    }
}
