<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Supports\CreateSupportDTO;
use App\DTO\Supports\UpdateSupportDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    public function index(Request $request) 
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 1),
            filter: $request->filter,
        );

        $filters = ['filter' => $request->get('filter', '')];

        return view('admin/supports/index', compact('supports', 'filters'));
    }

    public function show(string $id)
    {
        //$support = Support::where('id', $id)->first;

        /*if (!$support = Support::find($id)){
            return back();
        }*/

        if (!$suport = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateRequest $request, Support $support)
    {
	    $this->service->new(
		    CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    /*public function store(StoreUpdateSupportRequest $request, Support $support)
    {
        $data = $request->validated();
        $data['status'] = 'a';

        //Support::create($data);
        $support->create($data);
        
        return redirect()->route('supports.index');
    }*/

    public function edit(string $id)
    {
        /*if(!$support = $support->where('id', $id)->first()) {
            return back();
        }*/

        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupportRequest $request, Support $support, string $id)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );

        if(!$support) {
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();

        // $support->update($request->only([
        //     'subject', 'body'
        //  ]));
        
        // $support->update($request->validated());
        
        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {
        /*if(!$support = Support::find($id)) {
            return back();
        }

        $support->delete();*/

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
