<?php

namespace App\Http\Controllers\Dashboard\Staff;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Staff;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function __construct()
    {
        //проверяем авторизацию для данного раздела
        $this->middleware(['auth']);
    }

    /**
     * Список всех сотрудников
     *
     * @return void
     */
    public function all(Request $request)
    {
        // 
        return view('dashboard.pages.staff.all', [
            "page_title" => "Список компаний",
            "data" => [
                "company" => [
                    "all" => [
                        // "items" => $compnay_items
                    ]
                ]
            ]
        ]);
    }

    /**
     * Просмотр сотрудника
     *
     * @return void
     */
    public function show(Request $request, $id)
    {
        $staff_item = Staff::with('company')->get()->find($id);
        // 
        // dd($id);
        return view('dashboard.pages.staff.show', [
            "page_title" => "Карточка сотрудника",
            "data" => [
                "staff" => [
                    "item" =>  $staff_item,
                ]
            ]
        ]);
    }


    public function createForm()
    {
        $compnay_items = Company::all();
        return view('dashboard.pages.staff.create', [
            "page_title" => "Создание сотрудника",
            "data" => [
                "company" => [
                    "items" => [
                        "all" => $compnay_items
                    ]
                ]
            ]
        ]);
    }

    /**
     * Создание нового сотрудника
     *
     * @return void
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            //Валидация 
            $validatedData = Validator::make($data, [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email'],
                'phone' => ['required'],
                'company_id' => ['required']
            ]);

            //иначе выдаем ошибку
            if ($validatedData->fails()) {
                return redirect()->route('staff.create_form')
                    ->withErrors($validatedData)
                    ->withInput();
            } else {
                // dd($request->all());
                //Если прошел валидацию создаем
                $staff = new Staff();
                //
                $staff->name = $data['name'];
                $staff->email = $data['email'];
                $staff->phone = $data['phone'];
                $staff->company_id = $data['company_id'];
                //
                // dd($staff);
                $staff->save();

                //redirect
                return redirect()->route('staff.show', $staff->id);

                // $company->logo_src = $logo_src;
            }
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }


    /**
     * Обновление сотрудника
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            //Валидация 
            $validatedData = Validator::make($data, [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email'],
                'phone' => ['required'],
                'company_id' => ['required']
            ]);

            //иначе выдаем ошибку
            if ($validatedData->fails()) {
                return redirect()->route('staff.update_form', $id)
                    ->withErrors($validatedData)
                    ->withInput();
            } else {
                // dd($request->all());
                //Если прошел валидацию создаем
                $staff = Staff::with('company')->get()->find($id);
                //
                $staff->name = $data['name'];
                $staff->email = $data['email'];
                $staff->phone = $data['phone'];
                $staff->company_id = $data['company_id'];
                //
                // dd($staff);
                $staff->save();

                //redirect
                return redirect()->route('staff.show', $id);

                // $company->logo_src = $logo_src;
            }
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }

    /**
     * Обновление сотрудника
     *
     * @return void
     */
    public function updateForm(Request $request, $id)
    {
        // 
        $compnay_items = Company::all();
        $staff_item = Staff::with('company')->get()->find($id);

        // 
        // dd($id);
        return view('dashboard.pages.staff.update', [
            "page_title" => "Редактирование карточки сотрудника",
            "data" => [
                "staff" => [
                    "item" =>  $staff_item,
                ],
                "company" => [
                    "items" => [
                        "all" => $compnay_items
                    ]
                ]
            ]
        ]);
    }

    /**
     * Удаление сотрудника
     *
     * @return void
     */
    public function delete(Request $request, $id)
    {
        // 
        try {
            // 
            $staff_item = Staff::find($id)->with('staff')->first();

            //staff delete
            $staff_item->delete();

            return redirect()->route('staff.all');
        } catch (ErrorException $e) {
            return redirect()->back();
        }
    }

    public function tablesShowData()
    {
        return datatables()->of(
            //queryies
            Staff::query()->with('company')
        )->make(true);
    }
}
